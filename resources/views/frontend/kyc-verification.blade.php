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

            <!-- Left side with the image -->
            <div class="col-md-6 p-0">
                <img src="{{ url('storage/banners/kyc-verification.jpg') }}" alt="Background" class="img-fluid h-100 w-100 object-fit-cover">
            </div>

            <!-- Right side with the content -->
            <div class="col-md-6 d-flex align-items-center ">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <h2 class="display-4 font-weight-bold text-center mb-4">Know the Identity</h2>
                            <h4 class="text-primary text-center mb-3">₹849.00</h4>
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="tokens">Number of Tokens:</label>
                                    <input type="number" id="tokens" name="tokens" min="1" required class="form-control">
                                    <input type="hidden" name="pricePerItem" value="849.00">
                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <!-- KYC Verification Button (This will submit the form when clicked) -->
                                    <button type="submit" class="btn btn-primary">KYC Verification</button>

                                    <!-- Add to Cart Button (Commented out because it's now part of the submit action) -->
                                    <!-- <button type="submit" class="btn btn-submit">Add to Cart</button> -->
                                </div>
                            </form>


                            <p class="lead text-center mb-4">
                                When it comes to hiring domestic help, security guards, or any other service personnel for your home or business, knowing who you’re bringing into your personal space is essential.
                                Know the Identity is designed to give you the peace of mind you need by providing quick and reliable identity verification.
                            </p>
                            <p class="font-italic text-center mb-4">
                                <strong>Make the smart choice — verify before you trust.</strong>
                            </p>

                            <h5 class="font-weight-bold mb-3">Why Choose Us?</h5>
                            <ul class="list-unstyled">
                                <li><strong>Comprehensive Background Checks</strong> – HelloVerify provides thorough background verification, including identity checks, criminal records, previous employment, and address verification. This ensures that drivers, nannies, or household staff are trustworthy and have a clean history.</li>
                                <li><strong>Faster Turnaround Time</strong> – With advanced technology and automation, HelloVerify delivers quick verification results. Whether it’s verifying a driver or nanny, you can get results in a fraction of the time compared to traditional methods, ensuring faster onboarding.</li>
                                <li><strong>Criminal Record Verification</strong> – One of the most important factors when hiring household staff is safety. HelloVerify’s service includes checking criminal records from e-courts, giving peace of mind that the person has no prior convictions.</li>
                            </ul>

                            <h5 class="font-weight-bold mb-3">Terms and Conditions</h5>
                            <ul class="list-unstyled">
                                <li><strong>Expiry:</strong> The redeem code provided with your purchase will expire 72 hours after activation.</li>
                                <li><strong>Validity:</strong> The redeem pin remains valid for 1 year before activation.</li>
                                <li><strong>WhatsApp Requirement:</strong> The phone number associated with the contact must have WhatsApp configured.</li>
                                <li><strong>Aadhaar Verification:</strong> If the individual chooses Aadhaar as the document for verification, the phone number must be linked with the Aadhaar card.</li>
                                <li><strong>Exclusive Redemption:</strong> This verification card is redeemable only at HelloVerify.</li>
                            </ul>

                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-dark mt-4 px-5 py-3 shadow-sm" type="button">Buy Now!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section>
        <h1>KYC Verification Page</h1>
        <p>Welcome to the KYC Verification page.</p>
    </section>

    <!-- Bootstrap JS (before closing </body> tag) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</main>

@endsection