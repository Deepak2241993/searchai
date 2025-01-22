@extends('layouts.admin-master')
@section('title')
{{ isset($pageTitle) ? $pageTitle : 'Coupon Create' }}
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ isset($pageTitle) ? $pageTitle : 'Coupon Create' }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($pageTitle) ? $pageTitle : 'Coupon Create' }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content py-4"> 
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center rounded">
                    <h4 class="card-title mb-0">{{ isset($pageTitle) ? $pageTitle : 'Coupon Create' }}</h4>
                    <a href="{{ route('admin.coupon.list') }}" class="btn btn-warning ms-auto">Back</a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($pageTitle) ? $pageTitle : 'Coupon Create' }}</h3>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (isset($giftCoupon))
                                <form method="post" action="{{ route('admin.coupon.update', $giftCoupon->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form method="post" action="{{ route('admin.coupon.store') }}" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6 self">
                                    <label for="title" class="form-label">Coupon Title</label>
                                    <input class="form-control" type="text" name="title"
                                        value="{{ isset($giftCoupon) ? $giftCoupon->title : '' }}" placeholder="Coupon Title"
                                        maxlength="20" id="title" required>
                                </div>
                    
                                <div class="mb-3 col-lg-6 self">
                                    <label for="coupon_code" class="form-label">Coupon Code<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control text-uppercase" type="text" name="coupon_code"
                                        value="{{ isset($giftCoupon) ? $giftCoupon->coupon_code : '' }}" placeholder="Coupon Code"
                                        id="coupon_code"required>
                                    <input class="form-control" type="text" hidden name="user_token"
                                        value="{{ Auth::user()->user_token }}" placeholder="Set Condition" id="coupon_code" readonly
                                        required>
                                </div>
        
                                <div class="mb-3 col-lg-6 self">
                                    <label for="apply_condition" class="form-label">Condition For Apply<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="apply_condition"
                                        value="{{ isset($giftCoupon) ? $giftCoupon->apply_condition : 'Amount<100' }}"
                                        placeholder="Enter Coupon Code" id="apply_condition"required>
                                </div>
                                <div class="mb-3 col-lg-2 self">
                                    <label for="discount_type" class="form-label">Discount Type<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="discount_type" id='discount_type' required>
                                        <option value="">Select Discount</option>
                                        <option
                                            value="amount"{{ isset($giftCoupon->discount_type) && $giftCoupon->discount_type == 'amount' ? 'selected' : '' }}>
                                            Amount</option>
                                        <option
                                            value="percentage"{{ isset($giftCoupon->discount_type) && $giftCoupon->discount_type == 'percentage' ? 'selected' : '' }}>
                                            Percentage</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4 self">
                                    <label for="discount_rate" class="form-label">Discount Percent or Amount<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="discount_rate"
                                        value="{{ isset($giftCoupon) ? $giftCoupon->discount_rate : '' }}"
                                        placeholder="Discout Rate OR Amount" id="discount_rate" required>
                                </div>
                                <div class="mb-3 col-lg-6 self">
                                    <label for="redeem_description" class="form-label">Redeem Description</label>
                                    <textarea onKeyDown="textCounter(this,60);" onKeyUp="textCounter(this,'q17length' ,60)" class="form-control"
                                        name="redeem_description" id="redeem_description" rows="5" cols="">{{ isset($giftCoupon) ? $giftCoupon->redeem_description : '' }}</textarea><br>
        
        
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id='status'>
                                        <option
                                            value="1"{{ isset($giftCoupon->status) && $giftCoupon->status == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option
                                            value="0"{{ isset($giftCoupon->status) && $giftCoupon->status == 0 ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6 mt-4">
        
                                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                </div>
                            </div>
                            </form>
                            
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('scripts')

@endsection
