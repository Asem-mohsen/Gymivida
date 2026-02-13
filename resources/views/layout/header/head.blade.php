@php
    $localization = app(\App\Support\Localization::class);
    $currentUrl = url()->current();
    $alternateUrls = [];
    
    // Get alternate URLs for hreflang
    $routeName = request()->route()->getName();
    $routeParameters = request()->route()->parameters();
    
    foreach ($localization->getSupportedLocales() as $locale) {
        $alternateUrls[$locale] = $localization->getCurrentUrlWithLocale($locale);
    }
    
    // Get localized meta content
    $pageTitle = __('common.site_name', [], $currentLocale) ?? 'Gymivida';
    $metaTitle = __('common.meta_title', [], $currentLocale) ?? 'Gymivida – Smart Gym Management System';
    $metaDescription = __('common.meta_description', [], $currentLocale) ?? 'Gymivida helps gym owners simplify operations, manage trainers, track performance, and grow their business with an all-in-one fitness management platform.';
@endphp

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', $pageTitle)</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="{{ $metaTitle }}">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ __('common.meta_keywords', [], $currentLocale) ?? 'gym management system, fitness software, gym software' }}">
    <meta name="author" content="Gymivida Team">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $currentUrl }}">

    <!-- Hreflang Tags -->
    @foreach($alternateUrls as $locale => $url)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $alternateUrls['en'] ?? $currentUrl }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ asset('assets/img/logo/og-image.jpg') }}">
    <meta property="og:site_name" content="{{ $pageTitle }}">
    <meta property="og:locale" content="{{ $currentLocale === 'ar' ? 'ar_EG' : 'en_US' }}">
    @foreach($alternateUrls as $locale => $url)
        @if($locale !== $currentLocale)
            <meta property="og:locale:alternate" content="{{ $locale === 'ar' ? 'ar_EG' : 'en_US' }}">
        @endif
    @endforeach

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ asset('assets/img/logo/og-image.jpg') }}">
    <meta name="twitter:creator" content="@Gymividagym">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" rel="icon">
    <link href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@500;700;900&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @if($currentLocale === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    @endif

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
