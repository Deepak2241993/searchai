<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;

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
        // Retrieve tokens and price from the session
        $tokens = session('cart.tokens', 0); // Default value is 0 if no tokens exist in session
        $pricePerItem = session('cart.pricePerItem', 849.00); // Default price is 849.00 if no price exists in session

        // Assuming serviceName is available, or set a default
        $serviceName = session('cart.serviceName', 'Aluminium Composite Panels'); // Example default service name

        // Render the checkout view with dynamic values
        return view('frontend.checkout', compact('tokens', 'pricePerItem', 'serviceName'));
    }



    /**
     * Process the checkout form submission.
     */
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

    /**
     * Display the cart page.
     */
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
        $data = Token::where('user_id', $userId)->paginate(10);
        return view('token.index', ['data' => $data]);
    }

}
