<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;

class OrderRecordsController extends Controller
{
    public function ordersDetails()
    {
        $data = Order::with('user', 'tokens')
        ->orderBy('created_at', 'desc')->paginate(50);
        // dd($data);
        return view('admin.ordersdetails.list', compact('data'));
    }
    public function show($id)
{
    $order = Order::with('user', 'tokens')->findOrFail($id);

    $array_token = []; // Initialize the array outside the condition
    $total_token = 0;

if ($order) {
    $service_names = explode(',', $order->service_names);
    $tokens = explode(',', $order->tokens);
    $User = User::find($order->user_id)->first();
    $user_name = $User->name;

    foreach ($service_names as $key => $value) {
        $service_token = Token::select('service_type', 'token', 'status')
            ->where('user_id', $order->user_id)
            ->where('order_id', $order->id)
            ->where('service_type', $value)
            ->get();

        // Push service tokens to the array, only if not empty
        if (!$service_token->isEmpty()) {
            // Here, you can push only the necessary information from the $service_token collection, like the token details
            $array_token[] = $service_token->toArray(); // Or you can push specific attributes like $service_token->pluck('token')
        }

        // Ensure that the $tokens array has a valid index before accessing it
        if (isset($tokens[$key])) {
            $total_token += (int)$tokens[$key]; // Ensure it's treated as an integer
        }
    }

}

    // Return a structured JSON response for AJAX
    return response()->json([
        'id' => $order->id,
        'user' => $user_name ? $User->name:null,
        'service_tokens' => $array_token,
        'total_token' =>  $total_token?$total_token:0
    ]);
}


    
}
