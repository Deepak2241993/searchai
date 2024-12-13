<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCoupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function couponList()
    {
        $data = GiftCoupon::select('gift_coupons.*')->orderby('id','DESC')->get();
        return view('admin.coupon.list',compact('data'));
    }
}
