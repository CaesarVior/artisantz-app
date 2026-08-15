<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (app()->environment('production'))
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif
    <title>@yield('title', 'Artisantz Coffee & Eatery - Tempat Nongkrong & Kafe Estetik')</title>
    <meta name="description" content="@yield('meta_description', 'Nikmati kopi artisan terbaik dan hidangan lezat dengan suasana nyaman di Artisantz Coffee & Eatery.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Artisantz Coffee & Eatery')">
    <meta property="og:description" content="@yield('meta_description', 'Nikmati kopi artisan terbaik.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('img/artisantz-banner.webp') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Artisantz Coffee & Eatery">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('meta_description')">
    <meta name="twitter:image" content="{{ asset('img/artisantz-banner.webp') }}">

    @stack('schema')
    {{ $schema ?? '' }}

@vite([
    'resources/css/navfot.css',
    'resources/css/loader.css',
    'resources/css/about.css',
    'resources/css/event.css'
])

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
<div id="loadingOverlay">

    <div class="loader-content">

        <img
            src="{{ asset('img/artisantz-logo-no-bg-full-version.webp') }}"
            alt="Artisantz Coffee & Eatery"
            class="loader-logo heartbeat"
        >

        <div class="loader-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <p class="loader-text">
            Tunggu Sebentar
        </p>

    </div>

</div>
    @if (!Request::is('login'))
        <x-navbar />
    @endif

    <main>
        @yield('content')
    </main>

    @if (!Request::is('login'))
        <x-footer />
    @endif
<script>
    // Navbar scroll
    window.addEventListener('scroll', function () {

        const navbar = document.querySelector('.navbar');

        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

    });


    // Loading screen
    window.addEventListener('load', function () {

        const loader = document.getElementById('loadingOverlay');

        if (loader) {
            setTimeout(function () {
                loader.classList.add('fade-out');
            }, 500);
        }

    });
</script>



</body>

</html>
