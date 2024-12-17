<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCoupon;
use Illuminate\Http\Request;

class GiftCouponController extends Controller
{
    public function couponList()
    {
        $data = GiftCoupon::select('gift_coupons.*')->orderby('id','DESC')->paginate(10);
        return view('admin.coupon.list',compact('data'));
    }
    public function couponCreate()
    {
        return view('admin.coupon.create')->with('pageTitle' , 'Create Coupon');
    }
    public function couponStore(Request $request,GiftCoupon $coupon)
    {
        $data=$request->all();
        $coupon->create($data);
        return redirect()->route('admin.coupon.list')->with('message','Gift Coupon Created Successfully');
    }
    public function couponEdit(Request $request,$coupon)
    {
       $giftCoupon=GiftCoupon::where('status','1')->find($coupon);
       return view('admin.coupon.create',compact('giftCoupon'))->with('pageTitle' , 'Update Coupon');;
    }
    public function couponUpdate(Request $request,GiftCoupon $giftCoupon,$coupen_id)
    {
        $result = $giftCoupon->findOrFail($coupen_id);
        $data=$request->all();
        $result->update($data);
        return redirect()->route('admin.coupon.list')->with('message','Coupon Update Successfully'); 
    }
    public function couponDelete(Request $request, $coupon_id)
    {
        $giftCoupon = GiftCoupon::find($coupon_id);
        if (!$giftCoupon) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon not found',
            ], 404);
        }
        $giftCoupon->delete();
        return response()->json([
            'success' => true,
            'message' => 'Coupon Deleted Successfully',
        ]);
    }

}
