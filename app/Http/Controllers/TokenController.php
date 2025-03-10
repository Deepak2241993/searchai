<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\Ccrv_case;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CCRVReportMail;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\AadhaarData;

use Illuminate\Support\Facades\Http;


class TokenController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GridLineAPIKey');
    }

    public function addToCart(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'tokens' => 'required|integer|min:1',
            'pricePerItem' => 'required|numeric|min:0',
        ]);

        // Retrieve data from request
        $tokens = $validated['tokens'];
        $pricePerItem = $validated['pricePerItem'];

        // Store data in session
        session(['cart.tokens' => $tokens, 'cart.pricePerItem' => $pricePerItem]);

        // Redirect to checkout form with data
        return redirect()->route('checkout')->with('success', "Added $tokens token(s) to the cart.");
    }

    /**
     * Display the checkout form.
     */
    public function showCheckoutForm()
    {
        // dd('hello');
        $tokens = session('cart.tokens', 0); 
        $pricePerItem = session('cart.pricePerItem', 849.00);
        $serviceName = session('cart.serviceName', 'Aluminium Composite Panels'); 
        return view('frontend.checkout', compact('tokens', 'pricePerItem', 'serviceName'));
    }
    public function processCheckout(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'tokens' => 'required|integer|min:1',
        ]);

        // Retrieve tokens and price from request
        $tokens = $validated['tokens'];
        $pricePerItem = session('cart.pricePerItem', 849.00); // Default price if not set

        // Store the tokens and price in session for cart management
        session(['cart.tokens' => $tokens, 'cart.pricePerItem' => $pricePerItem]);

        // Redirect to cart page with success message
        return redirect()->route('cart')->with('success', "Successfully added $tokens token(s) to the cart.");
    }
    public function viewCart()
    {
        // Retrieve tokens and price from session
        $tokens = session('cart.tokens', 0);
        $pricePerItem = session('cart.pricePerItem', 849.00);

        // Render the cart view
        return view('frontend.cart', compact('tokens', 'pricePerItem'));
    }

    public function tokenList()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please log in to access tokens.');
        }

        $data = Token::with('aadhaarData')
            ->where('user_id', $userId)
           ->where('service_type', 'Aadhar KYC')
            ->paginate(10);
        return view('token.index', compact('data'));
    }
    public function CCRV()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please log in to access tokens.');
        }
        $data = Token::with('aadhaarData')
            ->where('user_id', $userId)
            ->where('service_type', 'CCRV')
            ->paginate(10);

        return view('token.ccrv', compact('data'));
    }

    public function CCRVReport(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:50',
        'address' => 'required|string|max:255',
        'token' => 'required|string',
        'date_of_birth' => 'required|string',
        'service_type' => 'required|string',
    ]);

    $data = [
        "name" => $validated['name'],
        "address" => $validated['address'],
        "father_name" => $request['father_name'],
        "date_of_birth" => $validated['date_of_birth'],  // Since this is validated, use it from $validated
        "consent" => $request->input('consent', 'Y'), // Use default fallback with input()
    ];

    $token = Token::where('token', $validated['token'])->first();
    // Initialize cURL for the search request
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => rtrim(env('CCRV_API_URL'). "search"), // Ensure proper URL formatting
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "X-API-Key: " . env('GridLineAPIKey'),
            "X-Auth-Type: API-Key"
        ],
        CURLOPT_TIMEOUT => 55 // Correct way to set timeout
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if (curl_errno($curl)) {
        $error = curl_error($curl);
        curl_close($curl);
        return response()->json([
            'success' => false,
            'message' => "cURL Error: $error",
        ]);
    }
    curl_close($curl);
    if ($httpCode === 200 && $response) {
        $apiResponse = json_decode($response, true);
        // dd($apiResponse['transaction_id']);

        // Add delay if necessary
        sleep(60);
        if (!isset($apiResponse['transaction_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction ID not found in the API response.',
            ]);
        }


        // Process CCRV Data
        $ccrvDataResult = $this->addCCRVData($apiResponse['transaction_id'], $token);
        
        // Return response based on data processing
        if ($ccrvDataResult['success']) {
            // Send Mail
            // Update token status
            
                // Attempt to send the email
                $authUserEmail = Auth::user()->email;
            if($ccrvDataResult['case_entry'])
            {
                Mail::to($authUserEmail)->send(new CCRVReportMail($ccrvDataResult['cases'], $ccrvDataResult['case_count'], $token->token,$data));
            }
                
            else{
            // dd($ccrvDataResult['debug']['case_count']);
            Mail::to($authUserEmail)->send(new CCRVReportMail($ccrvDataResult['debug']['cases'], $ccrvDataResult['debug']['case_count'], $token->token,$data));
            }
            $token->status = 'expired';
            $token->save(); 
            return response()->json([
                'success' => true,
                'message' => $ccrvDataResult['message']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $ccrvDataResult['message']
            ]);
        }
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Transaction ID not generated.',
        ]);
    }
    }

    
    public function addCCRVData($transaction_id,$token)
    {
        // dd($token->token);
        $curl_report = curl_init();
        curl_setopt_array($curl_report, [
            CURLOPT_URL => rtrim(env('CCRV_API_URL'), '/') . "/result",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "X-API-Key: " . env('GridLineAPIKey'),
                "X-Auth-Type: API-Key",
                "X-Transaction-ID: " . $transaction_id
            ],
        ]);

        $reportResponse = curl_exec($curl_report);
        $reportHttpCode = curl_getinfo($curl_report, CURLINFO_HTTP_CODE);

        if (curl_errno($curl_report)) {
            $error = curl_error($curl_report);
            curl_close($curl_report);
            return [
                'success' => false,
                'message' => "cURL Error: $error",
            ];
        }

        curl_close($curl_report);

        if ($reportHttpCode === 200 && $reportResponse) {
            $reportData = json_decode($reportResponse, true);

            // 🚩 Check for JSON decode errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                return [
                    'success' => false,
                    'message' => 'JSON Decode Error: ' . json_last_error_msg(),
                    'response' => $reportResponse
                ];
            }

            // ✅ Corrected condition with additional safety check
            if (
                isset($reportData['data']['ccrv_data']['case_count']) &&
                $reportData['data']['ccrv_data']['case_count'] != 0
            ) {
                if (isset($reportData['data']['ccrv_data']['cases']) && is_array($reportData['data']['ccrv_data']['cases'])) {
                    foreach ($reportData['data']['ccrv_data']['cases'] as $caseData) {
                        try {
                            $caseRecord = [
                                'algorithm_risk' => $caseData['algorithm_risk'] ?? null,
                                'father_match_type' => $caseData['father_match_type'] ?? null,
                                'name_match_type' => $caseData['name_match_type'] ?? null,
                                'case_category' => $caseData['case_category'] ?? null,
                                'case_decision_date' => $caseData['case_decision_date'] ?? null,
                                'case_number' => $caseData['case_number'] ?? null,
                                'case_status' => $caseData['case_status'] ?? null,
                                'case_type' => $caseData['case_type'] ?? null,
                                'case_year' => $caseData['case_year'] ?? null,
                                'cnr' => $caseData['cnr'] ?? null,
                                'decision_date' => $caseData['decision_date'] ?? null,
                                'district_name' => $caseData['district_name'] ?? null,
                                'filing_date' => $caseData['filing_date'] ?? null,
                                'filing_number' => $caseData['filing_number'] ?? null,
                                'filing_year' => $caseData['filing_year'] ?? null,
                                'first_hearing_date' => $caseData['first_hearing_date'] ?? null,
                                'name' => $caseData['name'] ?? null,
                                'nature_of_disposal' => $caseData['nature_of_disposal'] ?? null,
                                'oparty' => $caseData['oparty'] ?? null,
                                'registration_date' => $caseData['registration_date'] ?? null,
                                'registration_number' => $caseData['registration_number'] ?? null,
                                'registration_year' => $caseData['registration_year'] ?? null,
                                'source' => $caseData['source'] ?? null,
                                'state_name' => $caseData['state_name'] ?? null,
                                'type' => $caseData['type'] ?? null,
                                'under_acts' => $caseData['under_acts'] ?? null,
                                'under_sections' => $caseData['under_sections'] ?? null,
                                'token_id' => $token->id ?? null,
                            ];

                            DB::table('ccrv_cases')->insert($caseRecord);
                        } catch (\Exception $e) {
                            // 🚩 Handle database insertion errors
                            return [
                                'success' => false,
                                'message' => 'Database Error: ' . $e->getMessage(),
                                'caseData' => $caseData
                            ];
                        }
                    }

                    return [
                        'success' => true,
                        'case_entry' => true,
                        'message' => 'CCRV data processed and saved successfully.',
                        'cases' => $reportData['data']['ccrv_data']['cases'],
                        'case_count' => $reportData['data']['ccrv_data']['case_count'],
                        
                    ];
                } else {
                    return [
                        'success' => false,
                        'case_entry' => false,
                        'message' => 'No cases available for entry.',
                        'debug' => $reportData['data']['ccrv_data']
                    ];
                }
            } else {
                return [
                    'success' => true,
                    'case_entry' => false,
                    'message' => 'No cases available (case_count is zero).',
                    'debug' => $reportData['data']['ccrv_data'] ?? []
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Error fetching report data or invalid response from API.',
            'http_code' => $reportHttpCode,
            'raw_response' => $reportResponse
        ];
    }




    

public function AllCCRVReport(){
    $data = Ccrv_case::all();
      return view('ccrv.ccrv_report', compact('data'));

}
public function downloadPdf($id)
{
    // Fetch the token by ID
    $token = Token::findOrFail($id);
    $kyc_date = AadhaarData::where('id_token', $token->id)->first();

    // Generate and download the PDF
    $pdf = PDF::loadView('pdf.template', [
        'token' => $token,
        'kyc_date' => $kyc_date,
    ]);

    return $pdf->download('details_' . $token->id . '.pdf');
}


    public function ReportGenerate(Request $request, $id)
    {
        // Fetch the token by ID
        $token = Token::findOrFail($id);
        // Get the associated CCRV report
        $ccrv_report = Ccrv_case::where('token_id', $token->id)->get();
        $criminal_data = AadhaarData::where('id_token', $token->id)->first();

    
        // Filter Aadhaar data
        $filteredAadhaarData = collect($token->aadhaarData)->except([
            'name', 'mobile', 'landmark', 
            'reference_id', 'aadhaar_token', 'updated_at'
        ]);
    
        // Update the token's Aadhaar data with the filtered version
        $token->aadhaarData = $filteredAadhaarData;
    
        // Pass both token and ccrv_report to the PDF view
        $pdf = PDF::loadView('pdf.ccrv_kyc_report', [
            'token' => $token,
            'ccrv_report' => $ccrv_report,
            'criminal_data' => $criminal_data,
        ]);
    
        // Download the PDF with a filename
        return $pdf->download('details_' . $token->id . '.pdf');
    }
    

    public function CcrvAndBackgroundVerification()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please log in to access tokens.');
        }
        $data = Token::where('user_id', $userId)
            ->where('service_type', 'KYC+CCRV')
            ->paginate(10);

        return view('kyc_ccrv.index', compact('data'));
    }


    //  For OTP Generation on AAdhar 
    public function BackgroundVerificationOtp(Request $request)
{
    Log::info('Attempting to generate OTP.', [
        'request_data' => $request->except(['aadhaar_number', 'token']) // Excluding sensitive data
    ]);

    // Validate request input
    $validated = $request->validate([
        'aadhaar_number' => 'required|digits:12',
        'token' => 'required|string',
        'service_type' => 'required|string|in:KYC VERIFICATION',
    ]);

    Log::debug('Validated request data.', [
        'aadhaar_number' => substr($validated['aadhaar_number'], 0, 4) . '****', // Mask Aadhaar number
        'service_type' => $validated['service_type']
    ]);

    try {
        // Send request to the API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-Key' => $this->apiKey,
            'X-Auth-Type' => 'API-Key',
        ])->post('https://api.gridlines.io/aadhaar-api/boson/generate-otp', [
            'aadhaar_number' => $validated['aadhaar_number'],
            'consent' => 'Y',
        ]);

        // Log raw API response
        Log::debug('API Response:', [
            'status' => $response->status(),
            'body' => $response->json()
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!isset($data['transaction_id'])) {
                Log::warning('API response missing transaction_id.', ['response' => $data]);
                return response()->json([
                    'success' => false,
                    'message' => 'Unexpected API response. Please try again later.',
                ], 400);
            }

            Log::info('OTP generated successfully.', ['transaction_id' => $data['transaction_id']]);

            return response()->json([
                'success' => true,
                'transaction_id' => $data['transaction_id'],
                'token_share_code' => $validated['token'],
                'aadhaar_number' => $validated['aadhaar_number'],
                'service_type' => $validated['service_type'],
            ]);
        }

        // Handle API errors
        Log::warning('Invalid Aadhaar number response.', ['response' => $response->json()]);

        return response()->json([
            'success' => false,
            'message' => $response->json()['message'] ?? 'Invalid Aadhaar number.',
        ], $response->status());
    } catch (\Illuminate\Http\Client\RequestException $e) {
        Log::error('HTTP request error while generating OTP.', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Failed to connect to the API. Please try again later.',
        ], 500);
    } catch (\Exception $e) {
        Log::critical('Exception occurred while generating OTP.', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'An unexpected error occurred. Please try again later.',
        ], 500);
    }
}



    
    //  For KYC OTP Verification
    public function KycOtpSubmit(Request $request)
{
    Log::info('Attempting to submit OTP.', ['request_data' => $request->except(['otp', 'token_share_code'])]);

    $validated = $request->validate([
        'otp' => 'required|digits:6',
        'transaction_id' => 'required|string',
        'aadhaar_number' => 'required|digits:12',
        'token_share_code' => 'required|string',
        'service_type' => 'required|string',
    ]);

    // Fetch token
    $token = Token::where('token', $validated['token_share_code'])->first();
    if (!$token) {
        Log::error('Token not found for the given token_share_code.', ['token_share_code' => $validated['token_share_code']]);
        return back()->withErrors('Invalid token share code. Please try again.');
    }

    // Store transaction ID in session
    session(['transaction_id' => $validated['transaction_id']]);

    Log::debug('Validated OTP submission data.', $validated);

    try {
        // API Call
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-Key' => $this->apiKey,
            'X-Auth-Type' => 'API-Key',
            'X-Transaction-ID' => $validated['transaction_id'],
        ])->post('https://api.gridlines.io/aadhaar-api/boson/submit-otp', [
            'otp' => $validated['otp'],
            'include_xml' => true,
            'token_share_code' => $validated['token_share_code'],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            Log::info('OTP submitted successfully.', ['response_data' => $data]);

            $aadhaarData = $data['data']['aadhaar_data'] ?? null;
            if (!$aadhaarData) {
                Log::error('Missing aadhaar_data in response.', ['response' => $data]);
                return back()->withErrors('Invalid response from Aadhaar API. Please try again.');
            }

            // Save Aadhaar Data
            $createdData = AadhaarData::create([
                'aadhaar_number' => $validated['aadhaar_number'],
                'reference_id' => $aadhaarData['reference_id'] ?? null,
                'id_token' => $token->id,
                'aadhaar_token' => $validated['transaction_id'],
                'name' => $aadhaarData['name'] ?? null,
                'date_of_birth' => $aadhaarData['date_of_birth'] ?? null,
                'gender' => $aadhaarData['gender'] ?? null,
                'mobile' => $aadhaarData['mobile'] ?? null,
                'care_of' => $aadhaarData['care_of'] ?? null,
                'house' => $aadhaarData['house'] ?? null,
                'street' => $aadhaarData['street'] ?? null,
                'district' => $aadhaarData['district'] ?? null,
                'sub_district' => $aadhaarData['sub_district'] ?? null,
                'landmark' => $aadhaarData['landmark'] ?? null,
                'post_office_name' => $aadhaarData['post_office_name'] ?? null,
                'state' => $aadhaarData['state'] ?? null,
                'pincode' => $aadhaarData['pincode'] ?? null,
                'country' => $aadhaarData['country'] ?? 'India',
                'vtc_name' => $aadhaarData['vtc_name'] ?? null,
            ]);

            // **Email Sending Logic**
            try {
                if (Auth::check()) {
                    $authUser = Auth::user();
                    $authUserEmail = $authUser->email ?? null;
                    $order_id = "OT" . ($token->order_id ?? '');
                    $client_data = $authUser;

                    if ($authUserEmail) {
                        Mail::to($authUserEmail)->send(
                            new \App\Mail\AadhaarSuccessMail(
                                $aadhaarData,
                                $aadhaarData['name'] ?? '',
                                $token->token,
                                $validated['service_type'],
                                $createdData,
                                $order_id,
                                $client_data
                            )
                        );

                        Log::info('Aadhaar success email sent successfully.', [
                            'recipient' => $authUserEmail,
                            'aadhaar_data' => $aadhaarData,
                        ]);
                    } else {
                        Log::warning('Authenticated user email not found. Cannot send email.');
                    }
                } else {
                    Log::warning('No authenticated user found. Cannot send email.');
                }
            } catch (\Exception $e) {
                Log::error('Failed to send Aadhaar success email.', [
                    'recipient' => $authUserEmail ?? 'unknown',
                    'error' => $e->getMessage(),
                ]);
            }

            // **Update API Status**
            $token->api_status = 'partially_run';
            $token->save();

            return response()->json(['success' => true, 'message' => 'OTP verified successfully!', 'data' => $data]);
        }
        
        // **Handle Failed Response**
        Log::error('OTP submission failed.', ['response' => $response->body()]);
        return response()->json(['success' => false, 'message' => 'Invalid OTP. Please try again.']);
        } catch (\Exception $e) {
            Log::critical('Exception occurred.', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.']);
        }
        
}

public function CcrvReportGeneration(Request $request){
    $data = $request->all();
   $adhardata =  AadhaarData::where('id_token',$request->token_id)->first();
    // ✅ Call CCRVReport after successful Aadhaar verification
    $ccrvRequest = new Request([
        'name' => $adhardata['name'] ?? null,
        'father_name' => $adhardata['care_of'] ?? null,
        'address' => implode(', ', array_filter([
            $adhardata['house'] ?? '',
            $adhardata['street'] ?? '',
            $adhardata['district'] ?? '',
            $adhardata['state'] ?? '',
            $adhardata['pincode'] ?? ''
        ])),
        'date_of_birth' => $adhardata['date_of_birth'] ?? null,
        'service_type' => $data['service_type'],
        'token' => $data['token']
    ]);
// dd($ccrvRequest);
    Log::info('Initiating CCRVReport after Aadhaar verification.');
    $ccrvResponse = $this->CCRVReport($ccrvRequest);
    $responseData = $ccrvResponse->getData(true); // Convert JSON response to an associative array
    
    if (isset($responseData['success']) && $responseData['success'] === true) {
        $token = Token::find($data['token_id']); // Ensure token_id is correctly passed
    
        if ($token) { // Check if token exists before updating
            $token->update(['api_status' => 'completed']);
        }
    }
    return $responseData;
    
    
}




}
