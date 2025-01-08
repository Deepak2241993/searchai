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

<main id="content">
    <h1>Your Cart</h1>
    <p>Review your selected items below and proceed to checkout.</p>

    <div class="container">
        @if (empty($cart) || count($cart) == 0)
        <div class="no-items">
            <p>No items added to your cart.</p>
            <a href="{{ route('home') }}" class="btn-primary">Add Items</a>
        </div>
        @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Tokens </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    @if (is_array($item))
                    <tr id="cart-item-{{ $item['id'] }}">
                        <td>
                            <div class="product-info">
                                <!-- <img src="{{ $item['image'] ?? 'placeholder.jpg' }}" alt="{{ $item['serviceName'] }}"> -->
                                <h2>{{ $item['serviceName'] }}</h2>
                            </div>
                        </td>
                        <td>
                            <p><strong>Quantity:</strong>
                                <input type="number" value="{{ $item['tokens'] }}" min="1"
                                    onchange="updateTotalPrice(this, {{ $item['pricePerItem'] }}, '{{ $item['id'] }}')">
                            </p>
                            <p><strong>Price:</strong> Rs.{{ number_format($item['pricePerItem'], 2) }}</p>
                        </td>
                        <td>
                            <button onclick="deleteItem('{{ $item['id'] }}')">Remove</button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-cost-bar">
            <h3>Total Cost</h3>
            <ul>
                <li><strong>Total:</strong> <span id="subtotal">Rs.{{ number_format($subtotal, 2) }}</span></li>
            </ul>
        </div>

        <div class="btn-wrap">
            <form action="{{ route('checkout') }}" method="get">
                @csrf
                <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
                <button type="submit">Proceed to Checkout</button>
            </form>
        </div>
        @endif
    </div>
</main>


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

    function deleteItem(itemId) {
        fetch(`/cart/remove/${itemId}`, {
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
                console.log('Item removed:', data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
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