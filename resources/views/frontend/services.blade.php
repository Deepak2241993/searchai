@extends('layouts.master')
@section('body')
<style>
    #content {
        background: #ED760D;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 100%;
        color: #fff;
    }

    #content h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
        color: #ffffff;
    }

    #content p {
        font-size: 1.2em;
        line-height: 1.6;
        color: #ffffff;
    }

    .btn-container {
        margin-top: 30px;
    }

    .btn-back {
        background: #ffffff;
        color: #ED760D;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #ED760D;
        color: #ffffff;
        border: 1px solid #ffffff;
    }
</style>
<!-- Bootstrap CSS (ensure this is in the <head> section of your HTML) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<main id="content">
    <div class="container-fluid vh-100">
        <div class="row h-100">
            @foreach ($services as $item)
                <!-- Left side with the image -->
                <div class="col-md-6 p-0">
                    <img src="{{ $item->image_url ?? 'default-image.jpg' }}" alt="{{ $item->name }}" class="img-fluid h-100 w-100 object-fit-cover">
                </div>

                <!-- Right side with the content -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <h2 class="display-4 font-weight-bold text-center mb-4">{{ $item->name }}</h2>
                                <h4 class="text-primary text-center mb-3">₹{{ number_format($item->price, 2) }}</h4>

                                <!-- Purchase Form -->
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tokens">Number of Tokens:</label>
                                        <input type="number" id="tokens" name="tokens" min="1" required class="form-control">
                                        <input type="hidden" name="pricePerItem" value="{{ $item->price }}">
                                        <input type="hidden" name="serviceName" value="{{ $item->name }}">
                                    </div>

                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="submit" class="btn btn-primary">{{ $item->name }}</button>
                                    </div>
                                </form>

                                <p class="lead text-center mt-4">
                                    {{ $item->short_description }}
                                </p>
                                <p class="lead text-center mt-4">
                                    {{ $item->long_description }}
                                </p>
                               
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-lg btn-dark mt-4 px-5 py-3 shadow-sm" type="button">Buy Now!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <section>
        <h1>KYC Verification Page</h1>
        <p>Welcome to the KYC Verification page.</p>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>


@endsection