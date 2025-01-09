<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderRecordsController extends Controller
{
    public function ordersDetails()
    {
        $data = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.ordersdetails.list', compact('data'));
    }
    
}
