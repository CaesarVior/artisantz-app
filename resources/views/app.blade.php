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

    @vite(['resources/css/navfot.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div id="footer-preloader">
        <div class="footer-loader-wrapper">
            <div class="footer-loader-spinner"></div>
            <p class="footer-loader-text">Tunggu Sebentar</p>
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
        window.addEventListener('scroll', function() {

            const navbar = document.querySelector('.navbar');

            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        window.addEventListener('load', function() {
            const preloader = document.getElementById('footer-preloader');
            if (preloader) {
                preloader.classList.add('footer-preloader-hidden');
            }
        });
    </script>

</body>

</html>
