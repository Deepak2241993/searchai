<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function checkout(Request $request)
    {
        $tokens = $request->input('tokens');
        $pricePerItem = $request->input('pricePerItem');
        return view('frontend.checkout', compact('tokens', 'pricePerItem'));
    }

     // Handle adding tokens to the cart
     public function addToCart(Request $request)
     {
         // Validate the input
         $validated = $request->validate([
             'tokens' => 'required|integer|min:1',
         ]);
 
         // Get the number of tokens from the request
         $tokens = $request->input('tokens');
 
         // Store tokens in the session
         session(['cart.tokens' => $tokens]);
 
         // Redirect to the cart page with a success message
         return redirect()->route('cart')->with('success', "Successfully added $tokens token(s) to the cart.");
     }
 
     // Display the cart page
     public function viewCart()
     {
         // Retrieve tokens from the session
         $tokens = session('cart.tokens', 0);
 
         // Render the cart view with tokens
         return view('cart', compact('tokens'));
     }

}
