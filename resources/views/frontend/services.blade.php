@extends('layouts.master')
@section('body')
<style>
    #content {
        background: #ED760D;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;

        color: #fff;
    }

    #content h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    #content p {
        font-size: 1.2em;
        line-height: 1.6;
        color: #ffffff;
    }

    .container-fluid {
        margin: 0;
        padding: 0;
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

    .img-fluid {
        border-radius: 12px 0 0 12px;
        object-fit: cover;
    }

    .form-control {
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 10px;
    }

    .btn-primary {
        background-color: #0056b3;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1.1em;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #003f7f;
    }

    .btn-dark {
        background-color: #333;
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-dark:hover {
        background-color: #000;
    }

    .text-primary {
        color: #FFD700 !important;
        font-weight: bold;
    }

    .lead {
        color: #f1f1f1;
        margin-bottom: 20px;
    }

    .input-group {
        border-radius: 10px;
        border: 1px solid #ccc;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        background-color: #f9f9f9;
        border: none;
        text-align: center;
        font-weight: bold;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.1);
    }

    .btn:active {
        transform: scale(1);
    }

    button#decrease {
        background: rgba(0, 69, 85);
    }

    button#increase {
        background: rgba(0, 69, 85);
    }
</style>

<main id="content">
    <div class="container-fluid vh-100">
        <div class="row h-100">


            @foreach ($services as $item)
            <!-- Left side with the image -->
            <div class="col-md-6 p-0">
                @php
                $image = explode('|', $item->images);
            @endphp
            @foreach ($image as $value)
                <img src="{{$value ? $value : url('/front-assets/default-image.jpg') }}"
                    alt="{{ $item->name ?? 'Image' }}"
                    class="img-fluid h-100 w-100">
                    @endforeach
            </div>
            <!-- Right side with the content -->
            <div class="col-md-6 d-flex align-items-center">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <h2 class="display-4 font-weight-bold text-center mb-4">{{ $item->name }}</h2>
                            <h3 class="text-primary text-center mb-3">₹{{ number_format($item->price, 2) }}</h3>

                            <!-- Purchase Form -->
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="tokens">Number of Tokens:</label>
                                            <div class="input-group">
                                                <button type="button" id="decrease" class="btn btn-outline-secondary">-</button>
                                                <input type="number" id="tokens" name="tokens" min="1" value="1" required class="form-control">
                                                <button type="button" id="increase" class="btn btn-outline-secondary">+</button>
                                            </div>
                                            <input type="hidden" name="pricePerItem" value="{{ $item->price }}">
                                            <input type="hidden" name="serviceName" value="{{ $item->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <p class="lead text-center mt-4">
                                {{ $item->short_description }}
                            </p>
                            <p class="lead text-center mt-4">
                                {{ $item->long_description }}
                            </p>

                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const tokensInput = document.getElementById('tokens');
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');

        // Ensure value is not less than 1
        tokensInput.addEventListener('input', () => {
            if (parseInt(tokensInput.value) < 1) {
                tokensInput.value = 1;
            }
        });

        // Decrease value
        decreaseButton.addEventListener('click', () => {
            let currentValue = parseInt(tokensInput.value);
            if (currentValue > 1) {
                tokensInput.value = currentValue - 1;
            }
        });

        // Increase value
        increaseButton.addEventListener('click', () => {
            let currentValue = parseInt(tokensInput.value);
            tokensInput.value = currentValue + 1;
        });
    </script>
</main>
@endsection