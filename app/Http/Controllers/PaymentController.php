<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Payments;
use App\Models\CustomerAddress;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'alternateaddress' => 'nullable|string|max:255',
        ]);

        // Update the user's name and email
        $user = User::find(auth()->id());

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update or create customer address
        $user->customerAddress()->updateOrCreate(
            ['user_id' => $user->id], // Match condition
            [
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'alternate_address' => $validated['alternateaddress'],
            ]
        );

        // Create a Razorpay order
        try {
            // Initialize Razorpay API instance
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            // Amount in paise (1 INR = 100 paise)
            $amountInPaise = $validated['amount'] * 100;

            // Razorpay order data
            $orderData = [
                'amount' => $amountInPaise,
                'currency' => 'INR',
                'receipt' => 'order_rcptid_' . uniqid(),
                'payment_capture' => 1, // Auto capture payment
            ];

            // Create Razorpay order
            $razorpayOrder = $api->order->create($orderData);

            // Log the Razorpay order creation
            Log::info("Razorpay order created successfully", [
                'order_id' => $razorpayOrder['id'],
                'amount' => $amountInPaise,
                'currency' => 'INR',
            ]);

            // Save Razorpay order ID to the local database (orders table)
            $order = Order::create([
                'user_id' => $user->id,
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $validated['amount'],
                'currency' => 'INR', // Add the currency field here
                'status' => 'pending', // Customize this according to your logic
            ]);

            // Return the Razorpay order details as a response
            return response()->json([
                'orderId' => $razorpayOrder['id'], // Razorpay order ID
                'amount' => $validated['amount'], // Amount in INR
            ], 201);
        } catch (\Exception $e) {
            Log::error("Error creating Razorpay order", [
                'error_message' => $e->getMessage(),
                'user_id' => $user->id,
            ]);

            return response()->json(['error' => 'Failed to create order'], 500);
        }
    }


    public function initiatePayment($orderId)
    {
        // Retrieve the order from the database
        $order = Order::findOrFail($orderId);

        // Initialize Razorpay API
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Create an order with Razorpay
        $razorpayOrder = $api->order->create([
            'amount' => $order->amount * 100, // Amount in paise (e.g., 500.00 INR = 50000 paise)
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . $order->id, // Unique receipt
        ]);

        // Update the order with the Razorpay order_id
        $order->razorpay_order_id = $razorpayOrder->id;
        $order->save();

        // Return a view with the Razorpay order details to initiate the payment
        return view('payment', ['order' => $razorpayOrder]);
    }



    public function paymentCallback(Request $request)
    {
        // Initialize Razorpay API
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        // Retrieve Razorpay payment data from the callback
        $razorpayPaymentId = $request->razorpay_payment_id;
        $razorpayOrderId = $request->razorpay_order_id;
        $razorpaySignature = $request->razorpay_signature;

        // Validate the payment signature
        if ($this->verifySignature($razorpayPaymentId, $razorpayOrderId, $razorpaySignature)) {
            // Retrieve the order from the database
            $order = Order::where('razorpay_order_id', $razorpayOrderId)->first();

            if (!$order) {
                Log::error('Order not found', ['razorpay_order_id' => $razorpayOrderId]);
                return response()->json(['error' => 'Order not found'], 404);
            }

            try {
                // Fetch payment details using Razorpay API
                $payment = $api->payment->fetch($razorpayPaymentId);

                // Check if payment is successful
                if ($payment->status === 'captured') {
                    // Create a new payment record
                    $paymentRecord = new Payment();
                    $paymentRecord->order_id = $order->id;
                    $paymentRecord->razorpay_payment_id = $razorpayPaymentId;
                    $paymentRecord->razorpay_order_id = $razorpayOrderId;
                    $paymentRecord->status = 'success'; // Payment status
                    $paymentRecord->amount = $order->amount;
                    $paymentRecord->currency = $order->currency;
                    $paymentRecord->save();

                    // Update order status to 'paid'
                    $order->status = 'paid'; 
                    $order->save();

                    // Post-payment actions like sending confirmation emails
                    // Example: Mail::to($order->email)->send(new PaymentSuccessMail($order));

                    // Redirect to success page
                    return response()->json(['success' => true, 'message' => 'Payment successful']);
                } else {
                    // Handle payment failure
                    Log::error('Payment failed', ['razorpay_payment_id' => $razorpayPaymentId]);
                    return response()->json(['error' => 'Payment failed'], 400);
                }
            } catch (\Exception $e) {
                // Log any exceptions
                Log::error('Error verifying payment', [
                    'error_message' => $e->getMessage(),
                    'razorpay_payment_id' => $razorpayPaymentId,
                    'razorpay_order_id' => $razorpayOrderId,
                ]);

                return response()->json(['error' => 'Payment verification failed'], 500);
            }
        } else {
            // If signature verification fails, log and return an error
            Log::error('Signature verification failed', [
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_signature' => $razorpaySignature
            ]);
            return response()->json(['error' => 'Payment verification failed'], 400);
        }
    }


    private function verifySignature($razorpayPaymentId, $razorpayOrderId, $razorpaySignature)
    {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $attributes = [
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            return true; // Signature is valid
        } catch (\Exception $e) {
            Log::error('Payment signature verification failed', [
                'error_message' => $e->getMessage(),
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId
            ]);
            return false; // Signature is invalid
        }
    }
}
