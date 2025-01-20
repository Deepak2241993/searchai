<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <button id="rzp-button">Pay Now</button>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}", 
            "amount": "{{ $order->amount }}", 
            "currency": "{{ $order->currency }}",
            "name": "Your Company Name",
            "description": "Test Transaction",
            "order_id": "{{ $order->id }}", 
            "callback_url": "{{ route('payment.callback') }}",
            "prefill": {
                "name": "Test User",
                "email": "test@example.com",
                "contact": "9999999999"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
