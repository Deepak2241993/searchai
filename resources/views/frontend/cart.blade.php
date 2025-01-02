@extends('layouts.master')
@section('body')
<style>
    /* General Styling */
    #content {
        background: linear-gradient(135deg, #FF7E5F, #ED760D);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        margin-top: 40px;
        width: 100%;
    }

    #content h1 {
        font-size: 2.8em;
        margin-bottom: 20px;
        color: #000000;
        font-weight: bold;
    }

    #content p {
        font-size: 1.2em;
        line-height: 1.6;
        color: #000000;
    }

    .table-wrap {
        margin: 30px auto;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        background: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #ED760D;
        color: #fff;
        font-weight: bold;
    }

    .product-info ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .product-info ul li {
        display: inline-block;
        margin: 0 5px;
    }

    .product-image img {
        width: 100px;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .btn-container {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .btn-back,
    .btn-primary,
    .btn-default {
        background: #0B7CA1;
        color: #fff;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1em;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-back:hover,
    .btn-primary:hover,
    .btn-default:hover {
        background: #fff;
        color: #0B7CA1;
        border: 1px solid #ED760D;
    }

    .total-cost-bar {
        background: #f7f7f7;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .total-cost-bar .title-text {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 15px;
        color: #ED760D;
    }

    .total-cost-bar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .total-cost-bar ul li {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 1.1em;
    }

    .total-cost-bar ul li span {
        font-weight: bold;
    }

    .btn-wrap {
        margin-top: 20px;
    }

    .btn-wrap a {
        background: #0B7CA1;
        color: #fff;
        padding: 15px 30px;
        border-radius: 10px;
        font-size: 1.2em;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-wrap a:hover {
        background: #fff;
        color: #0B7CA1;
        border: 2px solid #0B7CA1;
    }
</style>

<main id="content">
    <h1>Your Cart</h1>
    <p>Review your selected items below.</p>

    <div class="container">
        <!-- Table Wrap -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="product-info">
                                <ul>
                                    <li>
                                        <button type="button" class="remove-btn" onclick="deleteItem('f976c0bf8e64aeda8d59434b5ff0f097');">
                                            <i class="las la-times"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <div class="product-image">
                                            <h2>KYC VERIFICATION TOKENS</h2>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <table class="quote-results">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><strong>Quantity:</strong></td>
                                        <!-- Show tokens value -->
                                        <td>
                                            <input
                                                type="number"
                                                id="quantity-input"
                                                name="tokens"
                                                value="{{ old('tokens', session('tokens', $tokens)) }}"
                                                min="1"
                                                class="form-control text-center"
                                                style="width: 80px;"
                                                onchange="updateTotalPrice();">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><strong>Item Price:</strong></td>
                                        <td id="item-price">${{ number_format($pricePerItem) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total Cost Bar -->
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <div class="total-cost-bar">
                    <h3 class="title-text">Total Cost</h3>
                    <ul>
                        <li><strong>Subtotal</strong> <span id="subtotal">${{ number_format($pricePerItem * $tokens, 2) }}</span></li>

                    </ul>
                    <div class="total-cost">
                        <strong>Total</strong>
                        <span id="total">${{ number_format($pricePerItem * $tokens * 1.10, 2) }}</span>
                    </div>
                </div>
                <div class="btn-wrap text-right">
                    <form action="{{ route('checkout') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Continue Shopping Button -->
        <!-- <div class="btn-container">
            <a href="https://readytoprint.com.au/product-list" class="btn-back">Continue Shopping</a>
        </div> -->
    </div>

    <script>
        function updateTotalPrice() {
            var quantity = document.getElementById('quantity-input').value; // Get the updated quantity
            var pricePerItem = parseFloat(document.getElementById('item-price').innerText.replace('$', '').trim()); // Get dynamic price per item
            var subtotal = pricePerItem * quantity;
            var total = subtotal;

            // Update the displayed prices
            document.getElementById('subtotal').innerText = '$' + subtotal.toFixed(2);
            document.getElementById('total').innerText = '$' + total.toFixed(2);
        }

        function deleteItem(itemId) {
            if (confirm('Are you sure you want to remove this item?')) {
                // Logic to remove the item, e.g., sending an AJAX request to update session/cart
                console.log(`Item ${itemId} removed.`); // Placeholder for actual removal logic
                // Redirect or refresh the page after removal
            }
        }
    </script>

</main>

@endsection