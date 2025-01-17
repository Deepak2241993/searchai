<!-- Start Navbar -->

<style>
    .btn.btn-success.btn-sm.position-relative.ms-2:hover {
        background-color: #ED760D;
    }

    .btn.btn-success.btn-sm.position-relative.ms-2 {
        background-color: #ED760D;
    }

    .btn.btn-outline-light.btn-sm {
        background-color: #ED760D;
    }

    .btn.btn-outline-light.btn-sm:hover {
        background-color: #ED760D;
    }

    i.bi.bi-house-door {
        color: #ffffff;
    }

    i.bi.bi-gear {
        color: #ffffff;
    }

    i.bi.bi-cart4 {
        color: #ffffff;
    }
    i.bi.bi-box-arrow-in-right {

        color: #ffffff;
    }
    i.bi.bi-person-plus {
        color: #ffffff;
    }
    a.btn.btn-outline-success.btn-sm.ms-2 {
        background-color: #ED760D;
    }


    span.navbar-text.me-3.text-white {
        display: contents;
    }
</style>


<header class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0, 69, 85, 1);">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('home')}}">
            <amp-img src="{{url('/front-assets')}}/images/footer_logo.png" width="200" height="40" layout="fixed" alt="Helpers near me"></amp-img>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="about-us.html">About<br />Helpers Near Me</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="hnm.html">Join us as a Helper /<br />सहायक के रूप में हमसे जुड़ें</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="verifications.html">Verify your<br />Worker, Legally</a>
                </li>
                <li class="nav-item">
                    @auth
                    <a class="btn btn-outline-light btn-sm" href="{{ route('home') }}">
                        <span class="navbar-text me-3 text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) . strtoupper(substr(strrchr(Auth::user()->name, ' '), 1, 1)) }}
                        </span>
                    </a>

                    <a class="btn btn-outline-light btn-sm" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door"></i>
                    </a>
                    <a class="btn btn-outline-light btn-sm ms-2" href="{{ route('settings') }}">
                        <i class="bi bi-gear"></i>
                    </a>
                    <a class="btn btn-success btn-sm position-relative ms-2" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart4"></i>
                        <span class="badge position-absolute top-0 start-100 translate-middle bg-danger rounded-circle">
                            {{ getTotalCartItems() }}
                        </span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-link ms-2 text-white">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                    @else
                    <a class="btn btn-outline-light btn-sm ms-2" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> 
                    </a>
                    <a class="btn btn-outline-success btn-sm ms-2" href="{{ route('register') }}">
                        <i class="bi bi-person-plus"></i> 
                    </a>
                    @endauth

                </li>
            </ul>
        </div>
    </div>
</header>
<!-- End Navbar -->