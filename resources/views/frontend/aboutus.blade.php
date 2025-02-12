@extends('layouts.master')

@section('style')
<style>
    #content {
        display: flex;

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
        margin-top: 50px !important;
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
<!-- CSS for Additional Styling -->
<style>
    .title-text {
        font-size: 1.5rem;
        font-weight: 600;
        color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    .border-bottom {
        border-bottom: 1px solid #e0e0e0;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .transition-all:hover {
        transform: scale(1.05);
    }

    .cart-items-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .cart-items-list li button {
        background-color: #dc3545;
        color: white;
    }

    .cart-items-list li button:hover {
        background-color: #c82333;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .font-weight-bold {
        font-weight: 700;
    }
</style>
@endsection
@section('body')
<main id="content">
    <div class="container">
        <h2>About Us</h2>
        
        <p>

At SearchAPI, we are changing how background checks and criminal verifications are done in India. We are the first service designed specifically for blue-collar workers, such as maids, nannies, drivers, security guards, babysitters etc. We offer fast, safe, and affordable background checks for these workers, using secure government systems like ecourts, Aadhaar, etc. This allows us to provide accurate information quickly, helping our clients make better hiring choices.<br><br>

Whether you are an employer wanting to hire trustworthy workers, a homeowner needing dependable help at home, or a business that needs to check vendors, SearchAPI has the right solution for you. We make it easier to conduct thorough background checks without the usual hassles of time, complexity, or cost.<br><br>

Our goal is clear: to make background verification easy, transparent, and organized for everyone.<br></p>


<h2>Why SearchAPI Stands Out</h2>
<p>
We understand that when it comes to hiring, trust and safety are non-negotiable. That's why we go the extra mile to offer a service that is:</p>

<b>1. Convenient, Easy & Organized</b>

<p>Navigating traditional verification processes can be cumbersome and frustrating. With SearchAPI, you gain access to a seamless and user-friendly platform where verification requests are processed efficiently.</p>

<b>2. Professionally Verified Workers Only</b>

<p>We ensure that the individuals you hire, whether for household work, corporate roles, or freelance projects, have undergone thorough background checks. This gives you complete peace of mind, knowing you're working with trusted professionals.</p>

<b>3. Quick Turnaround Time</b> 

<p>Time is critical when hiring. We prioritize speed without compromising on accuracy, delivering results faster than traditional methods.</p>

<b>4. Absolutely Hassle-Free</b> 

<p>Forget about tedious paperwork and back-and-forth communications. Our fully digital platform streamlines the entire process, making it smooth and efficient from start to finish.</p>

<b>5. Very Cost-Effective</b> 

<p>We believe that top-notch verification services shouldn't come at a hefty price. Our cost-effective solutions provide great value without compromising quality.


</p>
<b>How It Works</b>

1. <b>Submit Verification Requests:</b> Provide basic details about the individual or worker to be verified.

2. <b>Secure Data Processing:</b> Our system fetches data directly from trusted government sources via APIs.

3. <b>Get Verified Results:</b> Receive comprehensive verification results within a short time frame.


<b>Why Background Verification Matters</b>
<p>
In today's world, ensuring the safety and integrity of your workforce or home environment is more important than ever. By conducting thorough background checks, you minimize risks, protect your organization, and build a safer space for everyone involved.<br>


Join the growing number of individuals and businesses across India who trust SearchAPI for their verification needs. Experience a smarter, faster, and more secure way to verify anyone, because <b>trust begins with verified information.</b>
        </p>
    </div>
</main>
@endsection

