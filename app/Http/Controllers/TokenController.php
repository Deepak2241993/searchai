<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
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
            ->where('service_type', 'New UPI')
            ->paginate(10);

        return view('token.index', compact('data'));
    }

    public function CCRVReport(Request $request){
        $data = [
            "name" => $reques->name,
            "father_name" => $reques->father_name,
            "address" => $reques->address,
            "date_of_birth" => $reques->date_of_birth,
            "consent" => $reques->consent
        ];
        
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
            'X-API-Key: ' . env('GridLineAPIKey'),
            'X-Auth-Type: API-Key'
        ];
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, env('CCRV_API_URL'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            echo $response;
        }
        
        curl_close($ch);
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
