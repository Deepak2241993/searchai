@extends('layouts.admin-master')

@section('title')
Verify OTP
@endsection

@section('content')
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Verify OTP</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verify OTP</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body d-flex justify-content-between align-items-center rounded">
                <h4 class="card-title mb-0">Verify Otp</h4>
            </div>
        </div>
        <h1>Verify OTP</h1>
        <form action="{{ route('aadhaar.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="transaction_id" value="{{ $transactionId }}" required>
            
            <input type="hidden" name="token_share_code" value="{{ $tokenShareCode }}" required>
            <input type="hidden" name="aadhaar_number" value="{{ $aadhaarNumber }}">
            <input type="hidden" name="service_type" value="{{ $serviceType }}">

            <label for="otp">OTP:</label>
            <input type="text" name="otp" id="otp" required>
            <button type="submit">Verify OTP</button>
        </form>

    </div>
</div>


@endsection

@section('scripts')

@endsection