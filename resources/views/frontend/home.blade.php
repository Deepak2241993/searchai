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
</style>

<main id="content">
<section id="slider">
    <div class="owl-carousel owl-theme">
        @foreach ($bannerData as $banner)
        <div class="slider-item" style="background-image: url('{{ url('/') . '/' . ('storage/' . $banner->image) }}')">
                <div class="slider-content m-auto text-center">
                    <h1 class="text-shadow light">{{ $banner->title }}</h1>
                    <h4 class="text-shadow light" style="max-width:780px">{{ $banner->description }}</h4>
                </div>
            </div>
        @endforeach
    </div>
</section>
<div class="button-container">
  <h3>Token Purchase</h3>
    <a href="{{ route('kyc.verification') }}">
        <button class="btn-submit">KYC Verification</button>
    </a>
    <a href="{{ route('kyc.criminal-verification') }}">
        <button class="btn-cancel">KYC + Criminal Background Verification</button>
    </a>
</div>



  <div class="action-bar text-center">
    <a href="find-helpers.html">Find & Hire now <span class="font-icon"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path fill="currentColor" d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />
        </svg></span></a>
  </div>

  <section id="categories">
    <div class="container">
      <h2 class="text-center pb1">Find & Hire</h2>
      <div class="layout-wrap layout-row layout-align-center-center text-center">
        <a class="text-decoration-none" href="find-helpersd22b.html?group=1">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/house.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Domestic<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helperse026.html?group=2">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/chair.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Office<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers5848.html?group=15">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/luggage.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Expats<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers106a.html?group=8">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/car.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Permanent<br />Drivers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers2f2b.html?group=4">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/hospital.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Healthcare<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers4b69.html?group=3">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/shop.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Store<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers1c34.html?group=7">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/food.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Restaurant<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers9244.html?group=6">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/barbershop1.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Salon<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers7383.html?group=16">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/school.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">School<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers61b9.html?group=5">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/factory2.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Factory<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helperscdac.html?group=18">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/workers.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Construction<br />Workers</h4>
            </div>
          </div>
        </a>
        <a class="text-decoration-none" href="find-helpers921f.html?group=19">
          <div style="width:100px;margin:5px" class="card box-hover-effect">
            <div style="background:#ccc;padding:10px;border-radius:10px 10px 0 0;">
              <amp-img src="{{url('/front-assets')}}/images/icons/car2.svg"
                width="60"
                height="60"
                alt="Steps"></amp-img>
            </div>
            <div class="card-body" style="padding:10px">
              <!--<div style="margin:10px 0" class="divider"></div>-->
              <h4 style="font-size:15px;font-weight:400;line-height:24px">Automotive<br />Workers</h4>
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
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/responsive.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Convenient, Easy &amp; Organized</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">It is an Easier, Simpler & Better way of finding Workers. 5 minutes and just a click of a few buttons, that’s all it takes to find Workers at Helpers Near Me.</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/shield2.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Professionally Verified Workers only</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">Helpers Near Me follows a 2/3 Step Verification Process for every Worker registered with the platform. Everyone’s IDs & Court/Criminal Records are checked in detail. <a href="verifications.html">Read more ></a></div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/destination.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Connect with nearby Workers</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">Helpers Near Me connects you with Workers in the vicinity, preferably within 1-2 km of your search location</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/team.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Speak to multiple Workers at a time</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">If available, Helpers Near Me connects you with multiple Workers from nearby, and not just one or two</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/nominal.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Find &amp; Hire Workers at a nominal fee only</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">At Helpers Near Me, you get to connect with multiple Workers at a starting fee of ₹99 only</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/badge.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Get the best-shortlisted Workers from a vast pool</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">A unique rating system allows Helpers Near Me to connect you with the best Workers from around</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/covid.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Ensuring a Covid-19 safe Workers Connect</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">At Helpers Near Me, we are taking every initiative to ensure a Covid-19 Safe Employers-Workers Connect. <a href="blog/our-response-to-covid-19/index.html">Read more ></a></div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/feminist.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Empowers the Workers to connect with you directly</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">Helpers Near Me supports the Workers in finding nearby Work Opportunities and connecting with you directly. Workers join Helpers Near Me free of cost, and on their free will.</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/no-stopping.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">No middlemen &amp; commissions in between</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">At Helpers Near Me, you get to connect with the Workers directly, so there are no middlemen & commissions in between</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/salary.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Worker gets to earn one&#039;s full salary</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">Every Worker who gets hired through Helpers Near Me gets an opportunity to earn one's full salary, without having to pay someone else in between</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/credit-card.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">Safe &amp; Secure Payment</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">Every transaction processed at Helpers Near Me goes through the recognised payment gateways like Paytm, PayU & others. Your details are entirely secured & protected against any unauthorised transactions.</div>
          </section>
          <section class="card p0 mb1">
            <header class="card-header md-list">
              <div class="md-list-item">
                <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/money-back-guarantee.svg" width="40" height="40" alt=""></amp-img>
                <p class="px2">100% Refund Policy</p>
                <span>
                  <amp-img layout="fixed" src="{{url('/front-assets')}}/images/icons/ic_keyboard_arrow_down.svg" width="24" height="24" alt=""></amp-img>
                </span>
              </div>
            </header>
            <div class="card-body">At Helpers Near Me, there's always an assurance of a happy experience. For every genuine reason, the refunds are processed without any questions asked. So, you either get to find a worker through the platform, or we make a 100% refund for you. <a href="refund-policy-details.html">Read more ></a></div>
          </section>
        </amp-accordion>
      </div>
    </div>
  </section>

  
  <div class="divider"></div>


  <section id="about-us">
    <h2 class="text-center m3">About Us</h2>
    <div class="container">
      <p class="text-center">As the name suggests, Helpers Near Me (HNM) helps you find & hire workers near you. HNM uses technology and a lot of groundwork to help you connect directly with workers without any middlemen or commissions. On one end, HNM helps the underprivileged workers of India find local employment, free of cost, directly from nearby employers like yourself. And on the other, the digital infrastructure built around HNM makes it easy, quick, reliable & affordable for anyone to find & hire 100+ profiles of nearby workers. With a vision to end poverty, forced labour, worker exploitation, and human trafficking, HNM is working towards building an unbiased and inclusive digital ecosystem where the underprivileged workforce of India can join the platform easily and access local employment free of cost, with or without smartphones.</p>
      <div class="text-center block m3">
        <a style="border-radius:4px" class="ampstart-btn btn btn-sm btn-outline-primary" href="about-us.html">Read more&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
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
                        <section class="faq" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <h3 class="faq-qus" itemprop="name">
                                {{ $faq->question }}
                            </h3>
                            <div class="faq-ans" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
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
        <amp-carousel height="190"
          layout="fixed-height"
          type="carousel">
          <a style="text-decoration:none;padding:2px" href="find-helpers.html">
            <div style="min-width:125px" class="card box-hover-effect">
              <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                <amp-img src="{{url('/front-assets')}}/images/icons/destination.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
              </div>
              <div style="padding:8px" class="card-body">
                <!--<div style="margin:10px 0" class="divider"></div>-->
                <h4 style="font-size:16px;font-weight:400;line-height:24px">Find &amp; Hire<br>Workers</h4>
              </div>
            </div>
          </a>
          <a style="text-decoration:none;padding:2px" href="verifications.html">
            <div style="min-width:125px" class="card box-hover-effect">
              <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                <amp-img src="{{url('/front-assets')}}/images/icons/shield2.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
              </div>
              <div style="padding:8px" class="card-body">
                <!--<div style="margin:10px 0" class="divider"></div>-->
                <h4 style="font-size:16px;font-weight:400;line-height:24px">Verify your<br />Worker</h4>
              </div>
            </div>
          </a>
          <a style="text-decoration:none;padding:2px" href="salary-tracker.html">
            <div style="min-width:125px" class="card box-hover-effect">
              <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                <amp-img src="{{url('/front-assets')}}/images/icons/trending.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
              </div>
              <div style="padding:8px" class="card-body">
                <!--<div style="margin:10px 0" class="divider"></div>-->
                <h4 style="font-size:16px;font-weight:400;line-height:24px">Find What's<br />Trending</h4>
              </div>
            </div>
          </a>
          <a style="text-decoration:none;padding:2px" href="https://worker.helpersnearme.com/">
            <div style="min-width:125px" class="card box-hover-effect">
              <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                <amp-img src="{{url('/front-assets')}}/images/icons/join_us.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
              </div>
              <div style="padding:8px" class="card-body">
                <!--<div style="margin:10px 0" class="divider"></div>-->
                <h4 style="font-size:16px;font-weight:400;line-height:24px">काम के लिए<br />आज ही जुड़ें</h4>
              </div>
            </div>
          </a>
          <a style="text-decoration:none;padding:2px" href="my-orders.html">
            <div style="min-width:125px" class="card box-hover-effect">
              <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                <amp-img src="{{url('/front-assets')}}/images/icons/your_orders.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
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
                <amp-img src="{{url('/front-assets')}}/images/icons/customer-review.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
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
                <amp-img src="{{url('/front-assets')}}/images/icons/chat.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
              </div>
              <div style="padding:8px" class="card-body">
                <!--<div style="margin:10px 0" class="divider"></div>-->
                <h4 style="font-size:16px;font-weight:400;line-height:24px">Refer<br />your Friends</h4>
              </div>
            </div>
          </a>
          <a style="text-decoration:none;padding:2px" href="refer-a-worker.html">
            <div style="min-width:125px" class="card box-hover-effect">
              <div style="background:#ccc;padding:10px 6px;border-radius:10px 10px 0 0;">
                <amp-img src="{{url('/front-assets')}}/images/icons/referral.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
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
                <amp-img src="{{url('/front-assets')}}/images/icons/contact-us.svg"
                  width="75"
                  height="75"
                  alt="Steps"></amp-img>
              </div>
              <div style="padding:8px" class="card-body">
                <!--<div style="margin:10px 0" class="divider"></div>-->
                <h4 style="font-size:16px;font-weight:400;line-height:24px">Have a doubt?<br />Write to us</h4>
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