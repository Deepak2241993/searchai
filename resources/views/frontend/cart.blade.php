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
            @if (empty($cart) || count($cart) == 0)
            <!-- No items in cart -->
            <div class="no-items">
                <p>No items added to your cart.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Add Items</a>
            </div>
        @else
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
                        @foreach ($cart as $item)
                            @if (is_array($item))
                                <tr id="cart-item-{{ $item['id'] }}">
                                    <td>
                                        <div class="product-info">
                                            <ul class="list-unstyled d-flex align-items-center">
                                                <!-- Remove Button -->
                                                <li>
                                                    <button type="button" class="btn remove-btn"
                                                        onclick="deleteItem('{{ $item['id'] }}');">
                                                        {{-- <i class="las la-times"></i> --}}
                                                    </button>
                                                </li>
                                                <!-- Service Name -->
                                                <li class="ms-3">
                                                    <div class="product-image">
                                                        <h2 class="mb-0">{{ $item['serviceName'] }}</h2>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <table class="quote-results">
                                            <tbody>
                                                <!-- Quantity -->
                                                <tr>
                                                    <td colspan="2"><strong>Quantity:</strong></td>
                                                    <td>
                                                        <input type="number" name="tokens" value="{{ $item['tokens'] }}"
                                                            min="1" class="form-control text-center"
                                                            style="width: 80px;"
                                                            onchange="updateTotalPrice(this, {{ $item['pricePerItem'] }}, '{{ $item['id'] }}');"
                                                            oninput="validateQuantity(this);">
                                                    </td>
                                                </tr>

                                                <!-- Item Price -->
                                                <tr>
                                                    <td colspan="2"><strong>Item Price:</strong></td>
                                                    <td id="item-price-{{ $item['id'] }}">
                                                        ${{ number_format($item['pricePerItem'], 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Total Cost Bar -->
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <div class="total-cost-bar">
                        <h3 class="title-text">Total Cost</h3>
                        <ul>
                            <li><strong>total:</strong> <span id="subtotal">${{ number_format($subtotal, 2) }}</span>
                            </li>
                        </ul>
                        {{-- <div class="total-cost">
                            <strong>Total:</strong>
                            <span id="total">${{ number_format($total, 2) }}</span>
                        </div> --}}
                    </div>
                    <div class="btn-wrap text-right">
                        <form action="{{ route('checkout') }}" method="get">
                            @csrf
                            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
                            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                        </form>
                    </div>
                    
                </div>
            </div>
            @endif
        </div>

        <script>
            function updateTotalPrice(input, pricePerItem, itemId) {
                const quantity = parseInt(input.value) || 1; // Default to 1 if input is invalid
                const itemTotal = pricePerItem * quantity;

                // Update item total price display
                const itemPriceElement = document.getElementById(`item-price-${itemId}`);
                if (itemPriceElement) {
                    itemPriceElement.innerText = `$${itemTotal.toFixed(2)}`;
                }

                // Update subtotal and total dynamically
                updateSubtotalAndTotal();
            }

            function deleteItem(itemId) {
                if (confirm('Are you sure you want to remove this item?')) {
                    // Remove the item from the cart (via session)
                    removeFromCart(itemId);

                    // Remove the item row from the table
                    const itemRow = document.querySelector(`#cart-item-${itemId}`);
                    if (itemRow) {
                        itemRow.remove();
                    }

                    // Update subtotal and total after deletion
                    updateSubtotalAndTotal();
                }
            }

            function removeFromCart(itemId) {
                // Remove item from cart stored in session
                fetch('/cart/remove/{itemId}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            itemId: itemId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Item removed from session:', data);
                    });
            }

            function validateQuantity(input) {
                if (input.value < 1) {
                    alert('Quantity must be at least 1.');
                    input.value = 1; // Reset to minimum value
                }
            }

            function updateSubtotalAndTotal() {
                let subtotal = 0;

                // Calculate subtotal by iterating over all input elements with the name "tokens"
                document.querySelectorAll('input[name="tokens"]').forEach((inputElement) => {
                    const quantity = parseInt(inputElement.value) || 1; // Default to 1 if input is invalid
                    const pricePerItem = getPricePerItemFromInput(inputElement);
                    subtotal += quantity * pricePerItem;
                });

                // Update subtotal and total in the DOM
                document.getElementById('subtotal').innerText = `$${subtotal.toFixed(2)}`;
                document.getElementById('total').innerText = `$${(subtotal * 1.1).toFixed(2)}`; // Assuming 10% tax
            }

            function getPricePerItemFromInput(inputElement) {
                // Extract pricePerItem from the onchange attribute (assuming it exists)
                const onchangeAttribute = inputElement.getAttribute('onchange');
                const priceMatch = onchangeAttribute && onchangeAttribute.match(/, (\d+(\.\d+)?),/);
                return priceMatch ? parseFloat(priceMatch[1]) : 0;
            }
        </script>
    </main>
@endsection
