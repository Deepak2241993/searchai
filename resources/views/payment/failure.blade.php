@extends('layouts.master')
@section('body')
<style>
   
#payment-success-page .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
#payment-success-page .card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px;
    width: 90%;
    max-width: 600px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}
#payment-success-page h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #ED760D;
}
#payment-success-page p {
    font-size: 1.2rem;
    margin: 10px 0;
}
#payment-success-page .order-id {
    font-weight: bold;
    color: #ED760D;
}
#payment-success-page a {
    display: inline-block;
    text-align: center;
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 1rem;
    color: #fff;
    background: #ED760D;
    border: none;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
}
#payment-success-page a:hover {
    background: #ED760D;
    transform: scale(1.1);
}

</style>
<main id="content">
    <div class="container-fluid vh-100">
        <div class="row h-100" id="payment-success-page">
        <div class="container">
        <div class="card">
            <h1>Payment Failure!</h1>
            
            
            <a href="{{ url('/') }}">Go to Homepage</a>
            <br>
            <a href="{{ url('/my-orders') }}">My Order</a>
        </div>
    </div>         
        </div>
    </div>
</main>


@endsection