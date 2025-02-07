@extends('layouts.master')
@section('body')
<style>
    .button-container {
        background: #ffffff;
        padding: 30px;
        border: 2px solid #74ebd5;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .button-container h3 {
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
        font-family: "Poppins", Sans-serif;
    }

    .button-container button {
        background-color: #ED760D;
        color: #000000;
        border-color: #ffffff;
        -webkit-transition-duration: 0.1s;
        transition-duration: 0.1s;
        font-family: "Poppins", Sans-serif;
        font-weight: 600;
        padding: 12px 25px;
        margin: 0 10px;
        border-style: solid;
        border-width: 1px;
        border-radius: 4px;
        cursor: pointer;
    }

    .button-container button:hover {
        background-color: #000000;
        color: #FFFFFF;
        border-color: #000000;
    }

    .cart-button {
        border-radius: 30px;
        font-weight: bold;
        color: #fff;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .cart-button:hover {
        transform: scale(1.1);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .cart-button .badge {
        font-size: 0.8rem;
        padding: 5px 8px;
        font-weight: bold;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .cart-button i {
        margin-right: 8px;
        font-size: 1.2rem;
    }
    .service_box{
        width:150px;margin:5px
    }
</style>

<main id="content">

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            @foreach ($bannerData as $key => $banner)
                <button type="button" data-bs-target="#carouselExampleCaptions" 
                    data-bs-slide-to="{{ $key }}" 
                    class="{{ $key == 0 ? 'active' : '' }}" 
                    aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $key + 1 }}">
                </button>
            @endforeach
        </div>
    
        <div class="carousel-inner">
            @foreach ($bannerData as $key => $banner)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ url('/').$banner->image }}" class="d-block w-100" alt="{{ $banner->title }}">
                <div class="carousel-caption d-none d-md-block" style="top: 50%; transform: translateY(-50%); left: 0; right: 0;">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-md-6 text-start">
                                <h4 class="fw-bold">{!! $banner->title !!}</h4>
                                <p>{!!  $banner->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    
    
    

    {{-- <section id="slider">
        <div class="owl-carousel owl-theme">
            @foreach ($bannerData as $banner)
            <div class="slider-item"
                style="background-image: url('{{ url('/') . '/' . ('storage/' . $banner->image) }}')">
                <div class="slider-content m-auto text-center">
                    <h1 class="text-shadow light">{{ $banner->title }}</h1>
                    <h4 class="text-shadow light" style="max-width:780px">{{ $banner->description }}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </section> --}}
    <div class="button-container">
        <h3>Token Purchase</h3>
        @foreach ($serviceData as $item)
        <a href="{{ route('services.show', $item->service_slug) }}">
            <button class="btn-submit">{{ $item->name }}</button>
        </a>
        @endforeach
    </div>




    <!-- <div class="action-bar text-center">
        <a href="find-helpers.html">Find & Hire now <span class="font-icon"><svg xmlns="http://www.w3.org/2000/svg"
                    height="24" viewBox="0 0 24 24" width="24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor" d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />
                </svg></span></a>
    </div> -->

    <section id="categories">
        <div class="container">
            <h2 class="text-center pb1">Get Verification Done Today</h2>
            <div class="layout-wrap layout-row layout-align-center-center text-center">
                <a class="text-decoration-none" href="find-helpersd22b.html?group=1">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/house.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Domestic Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helperse026.html?group=2">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/chair.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Office Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers5848.html?group=15">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/luggage.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Expats Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers106a.html?group=8">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/car.svg" width="60" height="60"
                                alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Permanent Drivers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers2f2b.html?group=4">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/hospital.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Healthcare Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers4b69.html?group=3">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/shop.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4 style="font-size:16px; font-weight:500; line-height:20px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                Store Workers
                            </h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers1c34.html?group=7">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/food.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Restaurant Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers9244.html?group=6">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/barbershop1.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Salon Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers7383.html?group=16">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/school.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>School Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers61b9.html?group=5">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/factory2.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Factory Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helperscdac.html?group=18">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/workers.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Construction Workers</h4>
                        </div>
                    </div>
                </a>
                <a class="text-decoration-none" href="find-helpers921f.html?group=19">
                    <div class="service_box card box-hover-effect">
                        <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
                            <amp-img src="{{ url('/front-assets') }}/images/icons/car2.svg" width="60"
                                height="60" alt="Steps"></amp-img>
                        </div>
                        <div class="card-body" style="padding:10px">
                            <!--<div style="margin:10px 0" class="divider"></div>-->
                            <h4>Automotive Workers</h4>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>
    <div class="divider"></div>
    <section id="why-us">
        <div class="container">
            <h2 class="text-center mb3">Why SearchApi for Professional Background Verification?</h2>
            <div class="pb3 ml-auto mr-auto m-auto" style="max-width:580px">
                <amp-accordion id="why-helpers-near-me" expand-single-section animate disable-session-states>
                    <section class="card p0 mb1">
                        <header class="card-header md-list">
                            <div class="md-list-item">
                                <amp-img layout="fixed" src="{{ url('/front-assets') }}/images/icons/responsive.svg"
                                    width="40" height="40" alt=""></amp-img>
                                <p class="px2">Convenient, Easy &amp; Organized</p>
                                <span>
                                    <amp-img layout="fixed"
                                        src="{{ url('/front-assets') }}/images/icons/ic_keyboard_arrow_down.svg"
                                        width="24" height="24" alt=""></amp-img>
                                </span>
                            </div>
                        </header>
                        <div class="card-body">It is an Easier, Simpler & Better way of verifying Workers. 5 minutes and just a click of a few buttons, that’s all it takes to verify Workers at SearchAPI.</div>
                    </section>
                    <section class="card p0 mb1">
                        <header class="card-header md-list">
                            <div class="md-list-item">
                                <amp-img layout="fixed" src="{{ url('/front-assets') }}/images/icons/shield2.svg"
                                    width="40" height="40" alt=""></amp-img>
                                <p class="px2">Professionally Verified Workers only</p>
                                <span>
                                    <amp-img layout="fixed"
                                        src="{{ url('/front-assets') }}/images/icons/ic_keyboard_arrow_down.svg"
                                        width="24" height="24" alt=""></amp-img>
                                </span>
                            </div>
                        </header>
                        <div class="card-body">SearchAPI follows a 2/3 Step Verification Process for every Worker registered with the platform. Everyone’s IDs & Court/Criminal Records are checked in detail.

                        </div>
                    </section>
                    <section class="card p0 mb1">
                        <header class="card-header md-list">
                            <div class="md-list-item">
                                <amp-img layout="fixed" src="{{ url('/front-assets') }}/images/icons/fast_1.svg"
                                    width="40" height="40" alt=""></amp-img>
                                <p class="px2">Quick Turnaround Time</p>
                                <span>
                                    <amp-img layout="fixed"
                                        src="{{ url('/front-assets') }}/images/icons/ic_keyboard_arrow_down.svg"
                                        width="24" height="24" alt=""></amp-img>
                                </span>
                            </div>
                        </header>
                        <div class="card-body">
                            Get the Background Verification report in about 10-15 minutes.</div>
                    </section>
                    <section class="card p0 mb1">
                        <header class="card-header md-list">
                            <div class="md-list-item">
                                <amp-img layout="fixed" src="{{ url('/front-assets') }}/images/icons/empty-inbox_2.svg"
                                    width="40" height="40" alt=""></amp-img>
                                <p class="px2">Absolutely Hasslefree</p>
                                <span>
                                    <amp-img layout="fixed"
                                        src="{{ url('/front-assets') }}/images/icons/ic_keyboard_arrow_down.svg"
                                        width="24" height="24" alt=""></amp-img>
                                </span>
                            </div>
                        </header>
                        <div class="card-body">Get the detailed Background Verification report directly in your email inbox. You are not required to go anywhere for the checks or submit a document anywhere. The whole process is hasslefree and online - end to end.</div>
                    </section>
                    <section class="card p0 mb1">
                        <header class="card-header md-list">
                            <div class="md-list-item">
                                <amp-img layout="fixed" src="{{ url('/front-assets') }}/images/icons/salary.svg"
                                    width="40" height="40" alt=""></amp-img>
                                <p class="px2">Very Cost-Effective</p>
                                <span>
                                    <amp-img layout="fixed"
                                        src="{{ url('/front-assets') }}/images/icons/ic_keyboard_arrow_down.svg"
                                        width="24" height="24" alt=""></amp-img>
                                </span>
                            </div>
                        </header>
                        <div class="card-body">Get the professional background verification of your workers done in as low as ₹300 only.</div>
                    </section>

                    <section class="card p0 mb1">
                        <header class="card-header md-list">
                            <div class="md-list-item">
                                <amp-img layout="fixed" src="{{ url('/front-assets') }}/images/icons/credit-card.svg"
                                    width="40" height="40" alt=""></amp-img>
                                <p class="px2">Safe &amp; Secure Payment</p>
                                <span>
                                    <amp-img layout="fixed"
                                        src="{{ url('/front-assets') }}/images/icons/ic_keyboard_arrow_down.svg"
                                        width="24" height="24" alt=""></amp-img>
                                </span>
                            </div>
                        </header>
                        <div class="card-body">Every transaction processed at SearchAPI goes through the recognised payment gateways like Paytm, PayU & others. Your details are entirely secured & protected against any unauthorised transactions.</div>
                    </section>

                </amp-accordion>
            </div>
        </div>
    </section>


    <div class="divider"></div>


    <section id="about-us">
        <h2 class="text-center m3">About Us</h2>
        <div class="container">
            <p class="text-center">
                SearchAPI, India’s most trusted background screening company, offers state-of-the-art solutions to ensure trust and safety in every interaction.
                We provide compliant, robust, and efficient background screening processes tailored to meet the needs of large enterprises, small businesses, start-ups, and individuals.
                By harnessing the power of Artificial Intelligence (AI) and Machine Learning (ML), SearchAPI delivers the fastest, most accurate, and fully compliant background verification solutions in the industry.
                With SearchAPI, building trustworthy and successful relationships has never been easier.
            </p>
            <div class="text-center block m3">
                <a style="border-radius:4px" class="ampstart-btn btn btn-sm btn-outline-primary" href="about-us.html">
                    Read more&nbsp;<i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </section>

    <div class="divider"></div>
    <section style="background:#fff;color:#000;padding:30px 0">
        <div class="container">
            <div class="m-auto" style="max-width:860px">
                <h2 class="text-center mb-3">Frequently Asked Questions</h2>
                <div itemscope itemtype="https://schema.org/FAQPage">
                    <amp-accordion expand-single-section animate disable-session-states>
                        @forelse($faqData as $faq)
                        <section class="faq" itemscope itemprop="mainEntity"
                            itemtype="https://schema.org/Question">
                            <h3 class="faq-qus" itemprop="name">
                                {{ $faq->question }}
                            </h3>
                            <div class="faq-ans" itemscope itemprop="acceptedAnswer"
                                itemtype="https://schema.org/Answer">
                                <p itemprop="text">{!! $faq->answer !!}</p>
                            </div>
                        </section>
                        @empty
                        <section>
                            <h3>No FAQs available at the moment.</h3>
                        </section>
                        @endforelse
                    </amp-accordion>
                </div>
                <br />
            </div>
        </div>
    </section>
    <div class="divider"></div>
    <section>
        <div class="container">
            <h2 class="text-center my2">Quick Links</h2>
            <div class="text-center my2">
                <amp-carousel height="190" layout="fixed-height" type="carousel">
                    <a style="text-decoration:none;padding:2px" href="find-helpers.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/destination.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Find &amp; Hire<br>Workers
                                </h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="verifications.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/shield2.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Verify your<br />Worker
                                </h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="salary-tracker.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/trending.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Find What's<br />Trending
                                </h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="https://worker.helpersnearme.com/">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/join_us.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">काम के लिए<br />आज ही
                                    जुड़ें</h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="my-orders.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/your_orders.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Your<br />Orders</h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="customer-reviews.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/customer-review.svg"
                                    width="75" height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Customer<br />Reviews</h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="refer-your-friends.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/chat.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Refer<br />your Friends
                                </h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="refer-a-worker.html">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/referral.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Refer<br />a Worker</h4>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration:none;padding:2px" href="mailto:">
                        <div style="min-width:125px" class="card box-hover-effect">
                            <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                                <amp-img src="{{ url('/front-assets') }}/images/icons/contact-us.svg" width="75"
                                    height="75" alt="Steps"></amp-img>
                            </div>
                            <div style="padding:8px" class="card-body">
                                <!--<div style="margin:10px 0" class="divider"></div>-->
                                <h4 style="font-size:16px;font-weight:400;line-height:24px">Have a doubt?<br />Write to
                                    us</h4>
                            </div>
                        </div>
                    </a>
                </amp-carousel>
            </div>
        </div>
    </section>
    <div class="divider"></div>


</main>
@endsection