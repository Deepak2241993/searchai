@extends('layouts.master')
@section('body')
    <style>
        /* General Styling */
        #content {
            background: linear-gradient(135deg, #FF7E5F, #ED760D);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        #content h1 {
            font-size: 3em;
            margin-bottom: 20px;
            color: #ffffff;
            font-weight: bold;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        #content p {
            font-size: 1.3em;
            line-height: 1.8;
            color: #ffffff;
            margin-bottom: 40px;
        }

        .table-wrap {
            margin: 30px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        th {
            background: #ED760D;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        td button {
            background-color: #FF4C4C;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        td button:hover {
            background-color: #FF0000;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-info img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .product-info h2 {
            font-size: 1.2em;
            color: #333;
        }

        .total-cost-bar {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin: 30px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .total-cost-bar h3 {
            font-size: 1.8em;
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
            font-size: 1.2em;
            color: #333;
        }

        .total-cost-bar ul li span {
            font-weight: bold;
            color: #ED760D;
        }

        .btn-wrap {
            margin-top: 30px;
            text-align: right;
        }

        .btn-wrap button {
            background: #0B7CA1;
            color: #fff;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-wrap button:hover {
            background: #ED760D;
            color: #fff;
        }

        .btn-primary {
            display: inline-block;
            background-color: #0B7CA1;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ED760D;
            color: #fff;
        }
    </style>
    <main id="content" style="padding: 20px; font-family: Arial, sans-serif;">
        <h1 style="text-align: center; margin-bottom: 20px;">Your Cart</h1>
        <p style="text-align: center; color: #555;">Review your selected items below and proceed to checkout.</p>

        <div class="container" style="max-width: 800px; margin: 0 auto;">
            @if (empty($cart) || count($cart) == 0)
                <div class="no-items" style="text-align: center; margin-top: 50px;">
                    <p style="font-size: 18px; color: #888;">No items added to your cart.</p>
                    <a href="{{ route('home') }}" class="btn-primary"
                        style="padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">Add
                        Items</a>
                </div>
            @else
                <div class="table-wrap" style="margin-top: 30px; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; box-shadow: 0px 2px 5px rgba(0,0,0,0.1);">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #dee2e6;">Service Name
                                </th>
                                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #dee2e6;">Price Per
                                    Token</th>
                                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #dee2e6;">Tokens (Qty)
                                </th>
                                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #dee2e6;">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($cart as $item)
                                @if (is_array($item))
                                    <tr id="cart-item-{{ $item['id'] }}" data-price-per-item="{{ $item['pricePerItem'] }}"
                                        style="border-bottom: 1px solid #dee2e6;">
                                        <td>
                                            <div class="product-info" style="font-weight: bold;">
                                                <h2>{{ $item['serviceName'] }}</h2>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <h2>&#8377;{{ $item['pricePerItem'] }}</h2>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" value="{{ $item['tokens'] }}"
                                                min="1" style="width: 80px;"
                                                onchange="updateTotalPrice(this, {{ $item['pricePerItem'] }}, '{{ $item['id'] }}')">

                                            {{-- <p style="margin-top: 5px; font-size: 14px;">
                                                <strong>Price:</strong> Rs.<span
                                                    class="item-total">{{ number_format($item['tokens'] * $item['pricePerItem'], 2) }}</span>
                                            </p> --}}
                                        </td>
                                        <td>
                                            <button onclick="deleteItem('{{ $item['id'] }}')"
                                                style="padding: 5px 10px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">Remove</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="total-cost-bar" style="margin-top: 20px; text-align: right;">
                    <h3>Total Cost</h3>
                    <ul style="list-style: none; padding: 0; font-size: 16px; color: #555;">
                        <li><strong>Total:</strong> <span id="subtotal"
                                style="font-size: 18px; color: #000;">&#8377;{{ number_format($subtotal, 2) }}</span></li>
                    </ul>
                </div>

                <div class="btn-wrap" style="margin-top: 20px; text-align: center;">
                    <form action="{{ route('checkout') }}" method="get" style="display: inline-block;">
                        @csrf
                        <input type="hidden" id="cart-data" name="cart" value="{{ json_encode($cart) }}">
                        <button type="submit"
                            style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Proceed
                            to Checkout</button>
                    </form>
                </div>
            @endif
        </div>
    </main>

    <script>
        function updateTotalPrice(input, pricePerItem, itemId) {
            const quantity = parseInt(input.value) || 1;
            const itemTotal = pricePerItem * quantity;
            const itemRow = document.querySelector(`#cart-item-${itemId}`);
            const priceElement = itemRow.querySelector('.item-total');
            if (priceElement) {
                priceElement.innerText = `Rs.${itemTotal.toFixed(2)}`;
            }
            updateCartData();
            updateSubtotalAndTotal();
        }

        function updateCartData() {
            const cart = [];
            document.querySelectorAll('tr[id^="cart-item-"]').forEach(row => {
                const itemId = row.id.replace('cart-item-', '');
                const quantityInput = row.querySelector('input[type="number"]');
                const pricePerItem = parseFloat(row.dataset.pricePerItem);
                const quantity = parseInt(quantityInput.value) || 1;
                const serviceName = row.querySelector('.product-info h2').innerText;
                cart.push({
                    id: itemId,
                    serviceName: serviceName,
                    tokens: quantity,
                    pricePerItem: pricePerItem,
                    totalPrice: pricePerItem * quantity
                });
            });
            const cartDataInput = document.getElementById('cart-data');
            if (cartDataInput) {
                cartDataInput.value = JSON.stringify(cart);
            }
        }

        function updateSubtotalAndTotal() {
            let subtotal = 0;
            document.querySelectorAll('tr[id^="cart-item-"]').forEach(row => {
                const quantityInput = row.querySelector('input[type="number"]');
                const pricePerItem = parseFloat(row.dataset.pricePerItem);
                const quantity = parseInt(quantityInput.value) || 1;
                subtotal += pricePerItem * quantity;
            });
            const subtotalElement = document.getElementById('subtotal');
            if (subtotalElement) {
                subtotalElement.innerText = `Rs.${subtotal.toFixed(2)}`;
            }
        }

        function deleteItem(itemId) {
        if (confirm('Are you sure you want to remove this item?')) {
            fetch(`{{ route('cart.remove', '') }}/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to remove item.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const itemRow = document.querySelector(`#cart-item-${itemId}`);
                    if (itemRow) {
                        itemRow.remove();
                    }
                    updateSubtotalAndTotal();
                    updateCartData();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
    </script>

    </main>
@endsection
