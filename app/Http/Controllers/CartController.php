<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Log;


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

        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);

        // Generate a unique ID for the new item
        $itemId = uniqid();

        // Check if the item already exists in the cart
        $itemExists = false;
        foreach ($cart as &$item) {
            if ($item['serviceName'] === $validated['serviceName']) {
                // If the item exists, update its tokens and total price
                $item['tokens'] += $validated['tokens'];
                $item['total_price'] = $item['tokens'] * $validated['pricePerItem'];
                $itemExists = true;
                break;
            }
        }

        // If the item does not exist, add it as a new entry
        if (!$itemExists) {
            $cart[] = [
                'id' => $itemId,
                'serviceName' => $validated['serviceName'],
                'tokens' => $validated['tokens'],
                'pricePerItem' => $validated['pricePerItem'],
                'total_price' => $validated['tokens'] * $validated['pricePerItem'],
                'totalItems' => 1, // Track the count of unique items
            ];
        }

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

    public function remove(Request $request, $itemId)
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] === $itemId) {
                unset($cart[$key]);
                session()->put('cart', array_values($cart));
                return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }
    // Proceed to Checkout
    public function checkout(Request $request)
    {

        // dd($request->all());
        $carts = session()->get('cart', []);

        if (empty($carts)) {
            return redirect()->route('front.cart')->with('error', 'Your cart is empty. Please add items to proceed.');
        }
        // dd($cart);
        if (Auth::check() == false) {
            if (!session()->has('url.intended')) {

                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
        // dd($customerAddress);
        session()->forget('url.intended');

        return view('frontend.checkout', compact('customerAddress', 'carts'));
    }
    public function getTotalItems()
    {
        $cart = session()->get('cart', []);
        $totalItems = 0;

        foreach ($cart as $item) {
            if (is_array($item)) {
                $totalItems += $item['tokens'];
            }
        }

        return $totalItems;
    }
}
