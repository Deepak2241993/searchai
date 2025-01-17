<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderRecordsController extends Controller
{
    public function ordersDetails()
    {
        $data = Order::with('user', 'tokens')->orderBy('created_at', 'desc')->paginate(10);
        // dd($data);
        return view('admin.ordersdetails.list', compact('data'));
    }
    public function show($id)
    {
        $order = Order::with('user', 'tokens')->findOrFail($id);

        // Return a JSON response for AJAX
        return response()->json([
            'id' => $order->id,
            'user' => $order->user,
            'tokens_total' => $order->tokens->sum('quantity'),
            'tokens' => $order->tokens,
        ]);
    }

    
}
