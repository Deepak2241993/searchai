<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerAddress;
use App\Models\Service;
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
                $service = Service::where('name', $item['serviceName'])->first();
                $taxRate = $service->tax ?? 0;

                // Update tokens and subtotal
                $item['tokens'] += $validated['tokens'];
                $item['subtotal'] = $item['tokens'] * $validated['pricePerItem'];

                // Calculate tax and total price
                $item['tax_pay'] = $item['subtotal'] * ($taxRate / 100);
                $item['total_price'] = $item['subtotal'] + $item['tax_pay'];

                $itemExists = true;
                break;
            }
        }

        // If the item does not exist, add it as a new entry
        if (!$itemExists) {
            $service = Service::where('name', $validated['serviceName'])->first();
            $taxRate = $service->tax ?? 0;
            $subtotal = $validated['tokens'] * $validated['pricePerItem'];
            $taxPay = $subtotal * ($taxRate / 100);

            $cart[] = [
                'id' => $itemId,
                'serviceName' => $validated['serviceName'],
                'tokens' => $validated['tokens'],
                'pricePerItem' => $validated['pricePerItem'],
                'subtotal' => $subtotal,
                'taxRate' => $taxRate,
                'taxAmount' => $taxPay,
                'total_price' => $subtotal + $taxPay,
            ];
        }

// dd($cart);

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
        $tax = 0;
        $rate_of_tax = [];
        
        // Calculate subtotal and tax
        foreach ($cart as $item) {
            if (is_array($item)) {
                $subtotal += $item['pricePerItem'] * $item['tokens'];
        
                // Ensure tax key exists in the item array
                $services = Service::where('name', $item['serviceName'])->first();
                $taxRate = $services['tax'] ?? 0; 
                $tax += ($item['pricePerItem'] * $item['tokens']) * ($taxRate / 100);
                
                // Store tax rate
                $rate_of_tax[] = $taxRate;
            }
        }
        

        $total = $subtotal + $tax;
        return view('frontend.cart', compact('cart', 'subtotal', 'total', 'tax'));

    }

    public function remove(Request $request, $itemId)
{
    $itemId = (int) $itemId; // Ensure integer type
    $cart = session()->get('cart', []);

    foreach ($cart as $key => $item) {
        if ((int) $item['id'] === $itemId) {
            unset($cart[$key]);
            session()->put('cart', array_values($cart));

            return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
        }
    }

    return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
}

    // Proceed to Checkout
    // public function checkout(Request $request)
    // {

    //     dd($request->all());
    //     $carts = session()->get('cart', []);

    //     if (empty($carts)) {
    //         return redirect()->route('front.cart')->with('error', 'Your cart is empty. Please add items to proceed.');
    //     }
    //     // dd($cart);
    //     if (Auth::check() == false) {
    //         if (!session()->has('url.intended')) {

    //             session(['url.intended' => url()->current()]);
    //         }
    //         return redirect()->route('login');
    //     }
    //     $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
    //     // dd($customerAddress);
    //     session()->forget('url.intended');

    //     return view('frontend.checkout', compact('customerAddress', 'carts'));
    // }
    public function checkout(Request $request)
    {

        // Retrieve the cart data from the request
        $cartData = json_decode($request->input('cart'), true);
        // dd($cartData);

        // Ensure cart data is available and not empty
        if (empty($cartData)) {
            return redirect()->route('front.cart')->with('error', 'Your cart is empty. Please add items to proceed.');
        }

        // Check if the user is authenticated
        if (!Auth::check()) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }

        // Retrieve the customer address for the authenticated user
        $customerAddress = CustomerAddress::where('user_id', Auth::id())->first();

        // Forget the intended URL session key
        session()->forget('url.intended');

        // dd($cartData);

        // Pass the cart data and customer address to the checkout view
        return view('frontend.checkout', [
            'customerAddress' => $customerAddress,
            'carts' => $cartData,
        ]);
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
