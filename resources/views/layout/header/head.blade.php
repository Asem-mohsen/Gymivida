<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Gymivida – Smart Gym Management System')</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="Gymivida – Smart Gym Management System for Gym Owners">
    <meta name="description" content="Gymivida helps gym owners simplify operations, manage trainers, track performance, and grow their business with an all-in-one fitness management platform.">
    <meta name="keywords" content="gym management system, fitness software, gym software, gym admin dashboard, gym booking system, gym member tracking, fitness center software, gym CRM">
    <meta name="author" content="Gymivida Team">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Gymivida – Smart Gym Management System">
    <meta property="og:description" content="Simplify your gym operations with Gymivida — manage memberships, trainers, attendance, branches, and reports all in one platform.">
    <meta property="og:image" content="{{ asset('assets/img/logo/og-image.jpg') }}">
    <meta property="og:site_name" content="Gymivida Gym System">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Gymivida – Smart Gym Management System">
    <meta name="twitter:description" content="Gymivida gives gym owners full control — from branch management to trainer scheduling and performance scoring. All in one platform.">
    <meta name="twitter:image" content="{{ asset('assets/img/logo/og-image.jpg') }}">
    <meta name="twitter:creator" content="@Gymividagym">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" rel="icon">
    <link href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@500;700;900&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PFHL9QBPBY"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-PFHL9QBPBY');
    </script>
</head>
