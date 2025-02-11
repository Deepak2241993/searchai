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


class TokenController extends Controller
{

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
        'father_name' => 'required|string|max:50',
        'address' => 'required|string|max:255',
        'token' => 'required|string',
        'date_of_birth' => 'required|string',
        'service_type' => 'required|string',
    ]);
    
    $data = [
        "name" => $validated['name'],
        "father_name" => $validated['father_name'],
        "address" => $validated['address'],
        "date_of_birth" => $validated['date_of_birth'],  // Since this is validated, use it from $validated
        "consent" => $request->input('consent', 'Y'), // Use default fallback with input()
    ];
    

    $token = Token::where('token', $validated['token'])->first();
    // Initialize cURL for the search request
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => env('CCRV_API_URL') . "search",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "X-API-Key: " . env('GridLineAPIKey'),
            "X-Auth-Type: API-Key"
        ],
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

        if (!isset($apiResponse['transaction_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction ID not found in the API response.',
            ]);
        }

        // Add delay if necessary
        sleep(60);

        // Process CCRV Data
        $ccrvDataResult = $this->addCCRVData($apiResponse['transaction_id']);

        // Return response based on data processing
        if ($ccrvDataResult['success']) {
            // Send Mail
            // Update token status
            $token->status = 'expired';
            $token->save();
             // Attempt to send the email
             $authUserEmail = Auth::user()->email;
             Mail::to($authUserEmail)->send(new CCRVReportMail($ccrvDataResult['case'], $ccrvDataResult['total_case'], $token->token));
            return response()->json([
                'success' => true,
                'message' => $ccrvDataResult['message'],
                'redirect_url' => route('all-ccrv-report')
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

    
public function addCCRVData($transaction_id)
{
    $curl_report = curl_init();
    curl_setopt_array($curl_report, [
        CURLOPT_URL => env('CCRV_API_URL') . "result",
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

        if (isset($reportData['data']['ccrv_data']['cases']) && is_array($reportData['data']['ccrv_data']['cases'])) {
            foreach ($reportData['data']['ccrv_data']['cases'] as $caseData) {
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
                ];

                DB::table('ccrv_cases')->insert($caseRecord);
            }

            return [
                'success' => true,
                'message' => 'CCRV data processed and saved successfully.',
                'case' => $reportData['data']['ccrv_data']['cases'],
                'total_case' => $reportData['data']['ccrv_data'],
            ];
        } else {
            return [
                'success' => false,
                'message' => 'No cases found in the report data.'
            ];
        }
    }

    return [
        'success' => false,
        'message' => 'Error fetching report data.'
    ];
}


    

public function AllCCRVReport(){
    $data = Ccrv_case::all();
      return view('ccrv.ccrv_report', compact('data'));

}
    public function downloadPdf($id)
    {
        $token = Token::findOrFail($id);
       
        $filteredAadhaarData = collect($token->aadhaarData)->except([
            'photo_base64', 'mobile', 'landmark', 'reference_id', 'aadhaar_token', 'updated_at' ]);
        $token->aadhaarData = $filteredAadhaarData;
        $pdf = PDF::loadView('pdf.template', [
            'token' => $token,
        ]);
        
        return $pdf->download('details_' . $token->id . '.pdf');
        // dd($pdf->output());
    }
}
