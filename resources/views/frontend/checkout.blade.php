@extends('layouts.master')

@section('body')
<style>
    /* General Styling for Checkout */
    #content {
        display: flex;
        max-width: 1200px;
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
        max-width: 800px;
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

<main id="content">
    <!-- Billing Details Section -->
    <div class="billing-details">
        <h2>Billing Details</h2>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" id="name" name="name" value="{{ old('name', 'Admin') }}" required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name (Optional)</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name', 'Company Name') }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number*</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', 'Phone Number') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address*</label>
                <input type="email" id="email" name="email" value="{{ old('email', 'admin@gmail.com') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address*</label>
                <input type="text" id="address" name="address" value="{{ old('address', 'Add min') }}" required>
            </div>

            <div class="form-group">
                <label for="alternate_address">Alternate Address*</label>
                <input type="text" id="alternate_address" name="alternate_address" value="{{ old('alternate_address', 'e.g. Alternate Address') }}">
            </div>

            <div class="form-group">
                <label for="order_notes">Order Notes (Optional)</label>
                <textarea id="order_notes" name="order_notes" placeholder="Note about your order e.g. special note for your delivery">{{ old('order_notes') }}</textarea>
            </div>

            <button type="submit">Proceed to Payment</button>
        </form>

    </div>

    <!-- Order Summary Section -->
    <div class="order-summary">
        <h3>Your Order</h3>
        <ul>
            <li>
                <span>Service</span>
                <span>{{ $serviceName }}</span>
            </li>
            <li>
                <span>Price Per Item</span>
                <span>${{ number_format($pricePerItem, 2) }}</span>
            </li>
            <li>
                <span>Tokens</span>
                <span>{{ $tokens }}</span>
            </li>
        </ul>
        <div class="total-cost">
            <ul>
                <li><strong>Subtotal:</strong> ${{ number_format($tokens * $pricePerItem, 2) }}</li>
                <!-- <li><strong>GST (10%):</strong> ${{ number_format($tokens * $pricePerItem * 0.10, 2) }}</li> -->
            </ul>
            <div><strong>Total:</strong> ${{ number_format($tokens * $pricePerItem , 2) }}</div>
        </div>
        <!-- Payment Method Section -->
        <div class="payment-method">
            <h4>Credit Card (Razorpay)</h4>
            <button class="stripe-button" type="submit">Proceed to Payment</button>
        </div>
    </div>


</main>
@endsection