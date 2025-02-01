<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use App\Models\Ccrv_case;
use PDF;

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
        $data = [
            "name" => $request->input('name'),
            "father_name" => $request->input('father_name'),
            "address" => $request->input('address'),
            "date_of_birth" => $request->input('date_of_birth'),
            "consent" => $request->input('consent') ?: 'Y',
        ];
    
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
    
        // Check for cURL errors before closing the handle
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
    
            $this->addCCRVData($apiResponse['transaction_id']);
    
            return redirect()->route('all-ccrv-report')
                ->with('message', 'CCRV Report generated successfully!');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Transaction ID not generated.',
            ]);
        }
    }
    
    public function addCCRVData($transaction_id)
    {
        // Fetch the report data
        $curl_report = curl_init();
        curl_setopt_array($curl_report, [
            CURLOPT_URL => env('CCRV_API_URL') . "result",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "X-API-Key: " . env('GridLineAPIKey'),
                "X-Auth-Type: API-Key",
                "X-Transaction-ID:05d0e7b3-e99b-4f7b-8746-cd36cd3cc513"  // Use passed $transaction_id here
            ],
        ]);
    
        $reportResponse = curl_exec($curl_report);
        $reportHttpCode = curl_getinfo($curl_report, CURLINFO_HTTP_CODE);
    
        if (curl_errno($curl_report)) {
            $error = curl_error($curl_report);
            curl_close($curl_report);
            return response()->json([
                'success' => false,
                'message' => "cURL Error: $error",
            ]);
        }
    
        curl_close($curl_report);
    
        if ($reportHttpCode === 200 && $reportResponse) {
            $reportData = json_decode($reportResponse, true);
            // Check if data exists in the response
            if (isset($reportData['data']['ccrv_data']['cases'])) {
                foreach ($reportData['data']['ccrv_data']['cases'] as $caseData) {
                    Ccrv_case::create([
                        'algorithm_risk' => $caseData['algorithm_risk'] ?? null,
                        'father_match_type' => $caseData['father_match_type'] ?? null,
                        'name_match_type' => $caseData['name_match_type'] ?? null,
                        'case_category' => $caseData['case_category'] ?? null,
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
                        'state_name' => $caseData['state_name'] ?? null,
                        'under_acts' => $caseData['under_acts'] ?? null,
                        'under_sections' => $caseData['under_sections'] ?? null,
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'CCRV data processed successfully.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No cases found in the report data.',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching report data.',
            ]);
        }
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
