@extends('layouts.master')
@section('body')

<main id="content">
<section id="slider">
    <div class="owl-carousel owl-theme">
        @foreach ($bannerData as $banner)
            <div class="slider-item" style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                <div class="slider-content m-auto text-center">
                    <h1 class="text-shadow light">{{ $banner->title }}</h1>
                    <h4 class="text-shadow light" style="max-width:780px">{{ $banner->description }}</h4>
                </div>
            </div>
        @endforeach
    </div>
</section>




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


  <section id="customer-reviews">
    <div class="container">
      <div style="max-width:700px;margin:auto">
        <h2 class="text-center m3">Customer Reviews</h2>
        <h3 class="text-center m0"><span class="text-shadow" style="font-size:24px;color:orange">&#9733;</span> 4.3 <small>/5 </small></h3>
        <h4 class="text-center mb-3" style="font-weight:unset">(based on <strong><a style="text-decoration:underline;color:#000" href="customer-reviews.html"> 917 reviews</a></strong> submitted on different platforms of Helpers Near Me)</h4>
        <div class="mt3 mb3">
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Manavendra Kulkarni</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Vashi, Navi Mumbai, Maharashtra 400703, India</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>We are very much happy with HNM&#039;s work (Connected with Cooks)</strong></h4>

              <p class="mt0"><q>We are very much happy with HNM&#039;s work, keep it up</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 2 days ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Karishma Frank</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> South Extension II, New Delhi, Delhi 110049, India</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>I like prompt support from the team (Connected with Live-in Maids)</strong></h4>

              <p class="mt0"><q>I like prompt support from the team</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 1 week ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Shweta Pandey</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Kondhwa, Pune, Maharashtra 411048, India</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>Your transparency and close follow up is appreciated (Connected with Part-time Maids)</strong></h4>

              <p class="mt0"><q>Your transparency and close follow up is appreciated</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 1 week ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Priyanka Shinde</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Akurdi, Pimpri-Chinchwad, Maharashtra, India</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>Its good (Connected with Full Day Maids)</strong></h4>

              <p class="mt0"><q>Its good</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 1 week ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Ajay</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Sector 21, Noida, Uttar Pradesh 201301, India</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>It’s a wow experience (Connected with Private Drivers)</strong></h4>

              <p class="mt0"><q>It’s a wow experience for hiring a personal driver with proper verification</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 1 week ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Shikha</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Nadesar, Chaukaghat, Varanasi, Uttar Pradesh 221002, In</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>Helpersnearme doing great job (Connected with Cooks)</strong></h4>

              <p class="mt0"><q>Helpersnearme doing great job. It would be great if u could enhance your horizon as options r very limited.</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 1 week ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Gunjan</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Pamposh Enclave, Greater Kailash, New Delhi, Delhi 1100</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    5<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>Service is too good (Connected with Full Day Maids)</strong></h4>

              <p class="mt0"><q>Service is too good although I didn’t find a relevant maid this time. I have hired a driver and a maid through them earlier.</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 2 weeks ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Dhruv</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Indore, Madhya Pradesh, India</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    4<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>It&#039;s a good platform (Connected with Salespersons)</strong></h4>

              <p class="mt0"><q>It&#039;s a good platform but data for salesmen is limited near my area</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 2 weeks ago</i>
              </h6>
            </div>
          </div>
          <div class="card mb1">
            <div class="card-header">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading">Erica Chugh</h3>
                  <h5 class="m0 regular"><i class="fa fa-map-marker-alt red"></i> Kailash Colony, Greater Kailash, New Delhi, Delhi 11004</h5>
                </div>
                <div class="media-right media-middle">
                  <h3 class="text-right m0">
                    <span class="rating text-shadow">&#9733;</span>
                    4<small>/5</small>
                  </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h4 class="mt0"><strong>I did like the service. People responded promptly (Connected with Full Day Maids)</strong></h4>

              <p class="mt0"><q>I did like the service. People responded promptly. Process was easy to follow.</q></p>
              <h6 class="text-right strong mb0">
                <i>Review posted on Helpers Near Me, 2 weeks ago</i>
              </h6>
            </div>
          </div>
        </div>
        <div class="text-center pb3">
          <a class="ampstart-btn btn btn-sm btn-outline-primary" href="customer-reviews.html">Read more reviews</a>
        </div>
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
  <section id="about-us">
    <h2 class="text-center m3">Lives impacted thus far:</h2>
    <div class="container">
      <div class="row mb3">
        <div class="sm-col-12 md-col-3 md-col lg-col lg-col-3">
          <div style="background:#eee" class="card box-hover-effect cursor-pointer">
            <div class="card-body">
              <h2 style="font-size:32px" class="text-center box-heading m0">70,200+</h2>
              <p class="text-center m0">Workers have joined Helpers Near Me to find local employment</p>
            </div>
          </div>
        </div>
        <div class="sm-col-12 md-col-3 md-col lg-col lg-col-3">
          <div style="background:#eee" class="card box-hover-effect cursor-pointer">
            <div class="card-body">
              <h2 style="font-size:32px" class="text-center box-heading m0">37,500+</h2>
              <p class="text-center m0">Workers have received local employment offers directly from nearby Employers</p>
            </div>
          </div>
        </div>
        <div class="sm-col-12 md-col-3 md-col lg-col lg-col-3">
          <div style="background:#eee" class="card box-hover-effect cursor-pointer">
            <div class="card-body">
              <h2 style="font-size:32px" class="text-center box-heading m0">29,400+</h2>
              <p class="text-center m0">Women Workers have received local employment offers directly from nearby Employers</p>
            </div>
          </div>
        </div>
        <div class="sm-col-12 md-col-3 md-col lg-col lg-col-3">
          <div style="background:#eee" class="card box-hover-effect cursor-pointer">
            <div class="card-body">
              <h2 style="font-size:32px" class="text-center box-heading m0">1,86,800+</h2>
              <p class="text-center m0">Family members of Workers have been supported by the Helpers Near Me initiative</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <section id="why-us">
    <div class="container">
      <h2 class="text-center mb3">Why Helpers Near Me?</h2>
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

  <section id="our-partners">
    <h2 class="text-center m3">Past engagements</h2>
    <div class="container">
      <div class="row mb3">
        <div class="sm-col-12 md-col-4 md-col lg-col lg-col-4">
          <div class="p3 card text-center">
            <amp-img src="{{url('/front-assets')}}/images/NSDC_logo.png"
              width="111"
              height="100"
              alt="National Skill Development Corporation"></amp-img>
            <h3>NSDC</h3>
            <h5>National Skill<br />Development Corporation</h5>
            <hr class="divider" />
            <p>Engaged with NSDC to help +25,000 Skilled Workers find local employment in India.</p>
            <p>National Skill Development Corporation (NSDC), a not-for-profit, Public-Private-Partnership organization, aims to contribute significantly to the overall target of skilling people in India.</p><br />
          </div>
        </div>
        <div class="sm-col-12 md-col-4 md-col lg-col lg-col-4">
          <div class="p3 card text-center">
            <amp-img src="{{url('/front-assets')}}/images/sewa-logo.jpg"
              width="100"
              height="100"
              alt="SEWA Bharat"></amp-img>
            <h3>SEWA Bharat</h3>
            <h5>All India Federation of<br />Self-Employed Women’s Association</h5>
            <hr class="divider" />
            <p>Engaged with SEWA to help +4,000 Women Workers find local employment in India</p>
            <p>SEWA Bharat is a federation of membership-based organizations of women workers. It aims to strengthen the movement of women workers in the informal economy.</p><br />
          </div>
        </div>
        <div class="sm-col-12 md-col-4 md-col lg-col lg-col-4">
          <div style="min-height:407px" class="p3 card text-center">
            <amp-img src="{{url('/front-assets')}}/images/dwssc_logo.png"
              width="133"
              height="100"
              alt="Domestic Workers Sector Skill Council"></amp-img>
            <h3>DWSSC</h3>
            <h5>Domestic Workers<br />Sector Skill Council</h5>
            <hr class="divider" />
            <p>Engaged with DWSSC to help +950 Domestic Workers find local employment in India.</p>
            <p>Domestic Workers Sector Skill Council (DWSSC), under NSDC, is working towards enhancing the employability of Domestic Workers and helping them acquire the status of a profession or a trade.</p>
          </div>
        </div>
      </div>
      <div class="text-center pb3">
        <a class="ampstart-btn btn btn-sm btn-outline-primary" href="affiliations.html">View details <i class="fa fa-arrow-circle-right"></i>&nbsp;</a>
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
  <section id="promotion">
    <div style="max-width:860px" class="container">
      <h2 class="text-center mb3">How to find a Worker through Helpers Near Me?</h2>
      <div class="pb3">
        <amp-carousel height="470"
          layout="fixed-height"
          type="carousel">
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">Follow<br />`Find & Hire Now`</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_00.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">Login with a valid<br />Phone number</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_02.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">Enter the<br />Profile of worker</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_03.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">Enter your<br />Location</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_04.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">View shortlisted<br />workers from nearby</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_05.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">Tap on profiles<br />to view their details</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_06.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
          <div class="card" style="margin:6px;background:#c9ddf1">
            <div class="card-body">
              <h4 class="text-center mb3">Pay, connect & hire<br />anyone you like</h4>
              <amp-img src="{{url('/front-assets')}}/images/step_07.png"
                width="220"
                height="340"
                alt="Steps">
              </amp-img>
            </div>
          </div>
        </amp-carousel>
      </div>
    </div>
  </section>

  <div class="divider"></div>
  <section>
    <div class="container" style="max-width:920px">
      <h2 class="text-center mb3">Verify your worker, Legally</h2>
      <div class="ad card flex-container" style="background:linear-gradient(to top, #aaa 0%, #e2ebf0 100%)">
        <div class="flex-item">
          <amp-img
            layout="responsive"
            alt="Verify your worker, Legally"
            width="300"
            height="180"
            src="{{url('/front-assets')}}/images/bg_min.jpg" />
        </div>
        <div class="flex-item" style="padding:25px;text-align:center">
          <h3 class="text-center mt0 mb0" style="font-size:28px;line-height:32px">Verify the background of your Workers today.</h3>
          <p style="font-size:16px;line-height:23px">ID Checks | Criminal/Court Records Checks | Address Checks | Fee – starting at ₹249</p>
          <div class="text-center">
            <a class="btn btn-primary" style="display:inline-block;font-size:18px;width:155px;font-weight:300;padding:8px 12px;text-decoration:none" rel="noopener" href="verifications.html" target="_blank">Verify now</a>
          </div>
        </div>
      </div>
    </div><br />
  </section>

  <section id="trendz" style="background:rgba(0,69,85)">
    <div class="container">
      <div class="text-center" style="padding:25px;color:#fff">
        <h2 class="text-center color-white light" style="margin-bottom:27px;margin-top:0">Find the trending salary among workers near you.</h2>
        <p class="color-white light mb3">Know the trending salaries for 100+ profiles of Domestic Workers, Drivers, School Workers, Restaurant Workers, Salon Workers, Office Workers, Factory Workers, Store Workers, Hospital Workers, Construction Workers & many more</p>
        <div class="text-center">
          <a class="btn btn-outline-default light text-transform-unset text-decoration-none block" href="salary-tracker.html"> &nbsp;Let me know what's trending &nbsp; </a>
        </div>
      </div>
    </div>
  </section>


  <!--<div class="divider"></div>-->
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

  <!--<div class="divider"></div>
    <section id="download-app">
        <div class="container">
            <div class="pb3 text-center">
                <h2 style="font-size:32px" class="try-it">Have you tried <b>Helpers Near Me</b> yet?</h2>
                <h3 class="try-it"><b>Helpers Near Me</b> is the easiest & the most reliable way you can find Helpers near you.</h3> 
                <h3 class="try-it">Try it today!</h3>
                <div>
                    <a class="text-decoration-none" href="" aria-label="Download Helpers Near Me from the App Store" title="Download Helpers Near Me from the App Store" rel="noopener" target="_blank">
                        <amp-img layout="fixed" width="135" height="40" src="" alt="Download from App store"></amp-img>
                    </a> &nbsp;
                    <a class="text-decoration-none" href="" aria-label="Download Helpers Near Me from the Play Store" title="Download Helpers Near Me from the Play Store" rel="noopener" target="_blank">
                        <amp-img layout="fixed" width="135" height="40" src="" alt="Download from Play store"></amp-img>
                    </a>
                </div>
            </div>
        </div>
    </section>-->

</main>

@endsection