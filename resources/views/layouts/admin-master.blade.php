<!DOCTYPE html>
<html lang="en"> 
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> @yield('title') | Search Ai Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="@yield('title') | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <link rel="icon" href="{{ URL::asset('admin-assets/assets/img/favicon-32x32.png') }}" type="image/x-icon">
    <meta name="description" content="At SearchAI we provide a compliant and robust background screening process to help large enterprises, small businesses, start-ups and individuals to build successful relationships based on trust and safety.">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/')}}/admin-assets/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
</head> <!--end::Head--> 
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper"> 
        <!--begin::Header-->
        @include('components.admin.navbar')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('components.admin.sidebar')
        <!--end::Sidebar--> 
        <!--begin::App Main-->
        <main class="app-main"> 
            @yield('content')
        </main> 
        <!--end::App Main--> 
        <!--begin::Footer-->
        @include('components.admin.footer')
        <!--end::Footer-->
    </div> 
    <!--end::App Wrapper--> 
    <!--begin::Script--> 
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    @include('components.admin.vendor-scripts')
    <!--end::Script-->
</body>
<!--end::Body-->

</html>