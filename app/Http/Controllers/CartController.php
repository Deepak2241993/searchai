<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerAddress;

class CartController extends Controller
{
    // Add to Cart
    public function add(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'tokens' => 'required|integer|min:1',
            'pricePerItem' => 'required|numeric',
            'serviceName' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        $itemId = uniqid();
        // Add the new item to the cart
        $cart[] = [
            'id' => $itemId,
            'serviceName' => $validated['serviceName'],
            'tokens' => $validated['tokens'],
            'pricePerItem' => $validated['pricePerItem'],
            'total_price' => $validated['tokens'] * $validated['pricePerItem'],
        ];

        // Store the updated cart in the session
        session()->put('cart', $cart);

        // Redirect back to the cart page with a success message
        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }


    // View Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        // Calculate the subtotal
        foreach ($cart as $item) {
            if (is_array($item)) {
                $subtotal += $item['pricePerItem'] * $item['tokens']; 
            }
        }

        $total = $subtotal;

        return view('frontend.cart', compact('cart', 'subtotal', 'total'));
    }

    // Remove an item from the cart
    public function remove($itemId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    // Proceed to Checkout
    public function checkout(Request $request) {

        // dd($request->all());
        $carts = session()->get('cart', []);

        if (empty($carts)) {
            return redirect()->route('front.cart')->with('error', 'Your cart is empty. Please add items to proceed.');
        }
        // dd($cart);
        if (Auth::check() == false) {
            if(!session()->has('url.intended')) {

                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
        // dd($customerAddress);
        session()->forget('url.intended');

        return view('frontend.checkout', compact('customerAddress', 'carts'));

    }

   


    
}
