<!-- Start Navbar -->
<header class="ampstart-headerbar fixed flex justify-start items-center top-0 left-0 right-0 pl3 pr3">
    <a style="line-height:13px" class="my0 mr-auto" href="index.html">
        <amp-img src="images/logo.png" width="200" height="40" layout="fixed" alt="Helpers near me"></amp-img>
    </a>
    <a class="navbar-link text-right pr3" href="about-us.html">About<br/>Helpers Near Me</a>
    <a class="navbar-link text-right pr3" rel="noopener" href="hnm.html">Join us as a Helper /<br/>सहायक के रूप में हमसे जुड़ें</a>
    <a class="navbar-link text-right pr3" href="verifications.html">Verify your<br/>Worker, Legally</a>

    <!-- Start Login/Register buttons -->
    <div class="navbar-auth">
        <!-- If user is logged in, show username and options -->
        @auth
        <div id="user-info" style="display: block;">
            <span id="user-name">{{ Auth::user()->name }}</span> 
            <a class="navbar-link pr3" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="navbar-link pr3" href="{{ route('settings') }}">Settings</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="navbar-link pr3">Logout</button>
            </form>
        </div>
        @else
        <!-- If user is not logged in, show login/register buttons -->
        <div id="auth-buttons" style="display: block;">
            <a class="navbar-link pr3" href="{{ route('login') }}">Login</a>
            <a class="navbar-link pr3" href="{{ route('register') }}">Register</a>
        </div>
        @endauth
    </div>
    <!-- End Login/Register buttons -->
</header>
<!-- End Navbar -->

