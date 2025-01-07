@extends('layouts.master')

@section('style')
<style>
    #content {
        display: flex;
        
        margin: 0 auto;
        padding: 40px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Billing details section on left side */
    .billing-details {
        flex: 1;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-right: 30px;
    }

    .billing-details h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .billing-details label {
        font-weight: bold;
        margin-bottom: 5px;
        display: inline-block;
        color: #555;
    }

    .billing-details input,
    .billing-details textarea {
        width: 100%;
        padding: 15px;
        margin: 10px 0;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 1em;
        color: #333;
    }

    .billing-details textarea {
        height: 100px;
    }

    .billing-details button {
        background-color: #ED760D;
        color: white;
        font-size: 1.2em;
        padding: 15px 20px;
        border-radius: 8px;
        cursor: pointer;
        border: none;
        width: 100%;
        margin-top: 20px;
    }

    .billing-details button:hover {
        background-color: #FF7E5F;
    }

    /* Order Summary Section on right side */
    .order-summary {
        flex: 1;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .order-summary h3 {
        font-size: 1.6em;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .order-summary ul {
        list-style: none;
        padding: 0;
    }

    .order-summary ul li {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 1.2em;
        border-bottom: 1px solid #eee;
    }

    .order-summary .total-cost {
        font-weight: bold;
        font-size: 1.4em;
        text-align: center;
        padding-top: 20px;
    }

    /* Payment Method Section */
    .payment-method {
        text-align: center;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .payment-method h4 {
        font-size: 1.6em;
        margin-bottom: 20px;
        color: #333;
    }

    .stripe-button {
        background-color: #6772e5;
        color: white;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.2em;
        cursor: pointer;
        border: none;
        width: 100%;
    }

    .stripe-button:hover {
        background-color: #5362c6;
    }

    form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* Two columns */
        gap: 20px;
        margin-top: 50px !important;
        margin: 0 auto;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    input,
    textarea {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 1em;
        color: #333;
    }

    textarea {
        height: 100px;
    }

    button {
        background-color: #ED760D;
        color: white;
        font-size: 1.2em;
        padding: 15px 20px;
        border-radius: 8px;
        cursor: pointer;
        border: none;
        grid-column: span 2;
        /* Makes button span across both columns */
        margin-top: 20px;
    }

    button:hover {
        background-color: #FF7E5F;
    }


    /* Responsiveness */
    @media (max-width: 768px) {
        #content {
            flex-direction: column;
        }

        .billing-details,
        .order-summary {
            margin-right: 0;
            margin-bottom: 20px;
        }
    }
</style>
@endsection
@section('body')
<main id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="row">
                    @auth
                    @if (Auth::user()->is_admin == '')
                    <div
                        class="row mt-4 mb-5 justify-content-lg-between justify-content-md-center justify-content-sm-center">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="register-item d-flex align-items-center">
                                <p>Returning Customer? <a href="{{ route('login') }}">Click here to login</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="register-item d-flex align-items-center">
                                <p>Have a Coupon code? <a href="#!">Click here to enter your code</a></p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endauth

                    <form id="orderForm">
                        <!-- Billing Details Section -->
                        <div class="billing-details">
                            <h3>Billing Details</h3>

                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ auth()->check() ? auth()->user()->name : (isset($customerAddress) ? $customerAddress->name : '') }}"
                                    placeholder="Full Name" required>
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group">
                                <label for="phone">Phone Number*</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    value="{{ isset($customerAddress) ? $customerAddress->phone : old('phone') }}"
                                    placeholder="Phone Number"
                                    pattern="[0-9]+"
                                    required>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email">Email Address*</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ auth()->check() ? auth()->user()->email : (isset($customerAddress) ? $customerAddress->email : old('email')) }}"
                                    placeholder="Email Address"
                                    required>
                            </div>


                            <!-- Address Field -->
                            <div class="form-group">
                                <label for="address">Address*</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    value="{{ isset($customerAddress) ? $customerAddress->address : '' }}"
                                    placeholder="e.g. House, Road, Street Name" required>
                            </div>

                            <!-- Alternate Address Field -->
                            <div class="form-group">
                                <label for="alternateaddress">Alternate Address*</label>
                                <input type="text" id="alternateaddress" name="alternateaddress" class="form-control"
                                    value="{{ isset($customerAddress) ? $customerAddress->alternate_address : '' }}"
                                    placeholder="e.g. Alternate Address">
                            </div>

                            <!-- Notes Field -->
                            <div class="form-group mb-0">
                                <label for="note">Order Notes (Optional)</label>
                                <textarea id="note" name="note" class="form-control"
                                    placeholder="Note about your order e.g. special note for your delivery"></textarea>
                            </div>
                        </div>


                        <!-- Order Details Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-lg border-light">
                                <div class="card-body">
                                    <h3 class="title-text mb-4">Your Order</h3>
                                    <div class="cart-items-list mb-4">
                                        <ul class="list-unstyled">
                                            @php
                                            $amount = 0;
                                            @endphp
                                            @foreach ($carts as $item)
                                            @php
                                            $amount += $item['pricePerItem'] * $item['tokens'];
                                            $totalTokens = $item['tokens'];
                                            @endphp
                                            <li class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <h5>{{ $item['serviceName'] }}</h5>
                                                    <span class="text-muted">Rs.{{ $item['pricePerItem'] }} x
                                                        {{ $item['tokens'] }} tokens</span>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteItem('{{ $item['id'] }}');">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="payment-information mb-4">
                                        <div class="form-check">
                                            <input id="credit-card" hidden type="radio" name="payment_method" value="stripe"
                                                class="form-check-input" checked>
                                            <input type="hidden" id="order-amount" name="amount"
                                                value="{{ $amount }}">
                                            <input type="hidden" id="buy-tokens" name="buy-tokens"
                                                value="{{ $totalTokens }}">
                                            
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-primary w-100 btn-rounded shadow-lg">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('orderForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const amount = document.getElementById('order-amount').value;
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const address = document.getElementById('address').value;
        const alternateAddress = document.getElementById('alternateaddress').value;
        const buyTokens = document.getElementById('buy-tokens').value;

        if (!amount || !name || !email || !phone || !address) {
            alert('Please fill all the required fields.');
            return;
        }

        console.log('User Details:', {
            amount,
            name,
            email,
            phone,
            address,
            alternateAddress
        });

        try {
            const response = await fetch("{{ route('payment.createOrder') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    amount,
                    name,
                    email,
                    phone,
                    address,
                    alternateaddress: alternateAddress,
                    buyTokens
                })
            });

            const data = await response.json();
            console.log('Order Creation Response:', data);

            if (data.orderId) {
                const options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: data.amount * 100,
                    currency: "INR",
                    name,
                    description: "Order Payment",
                    order_id: data.orderId,
                    prefill: {
                        name,
                        email,
                        contact: phone
                    },
                    handler: async function(response) {
                        console.log('Razorpay Payment Response:', response);

                        const paymentResponse = await fetch("{{ route('payment.callback') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature
                            })
                        });

                        const paymentData = await paymentResponse.json();
                        console.log('Payment Callback Response:', paymentData);

                        if (paymentData.success) {
                            window.location.href = "{{ route('payment.success') }}";
                        } else {
                            alert('Payment verification failed. Please try again.');
                        }
                    },
                    modal: {
                        ondismiss: function() {
                            console.log('Payment popup closed by the user.');
                            alert('Payment was not completed. Please try again.');
                        }
                    },
                    theme: {
                        color: "#3399cc"
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            } else {
                alert('Failed to create order. Please try again.');
            }
        } catch (error) {
            console.error('Error creating order:', error);
            alert('An error occurred. Please try again.');
        }
    });
</script>
@endsection