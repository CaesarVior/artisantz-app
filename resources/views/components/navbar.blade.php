<nav class="navbar">

    <div class="navbar-logo">
        <a href="/" style="text-decoration: none !important; color: #111111;">
            <img src="{{ asset('img/artisantz-logo-no-bg.webp') }}" />
        </a>
    </div>

    <ul class="navbar-menu">
        <li>
            <a href="/" class="navbar-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
        </li>
        <li>
            <a href="/about" class="navbar-link {{ Request::is('about*') ? 'active' : '' }}">About</a>
        </li>
        <li>
            <a href="/gallery" class="navbar-link {{ Request::is('gallery*') ? 'active' : '' }}">Gallery</a>
        </li>
        <li>
            <a href="/events" class="navbar-link {{ Request::is('events') ? 'active' : '' }}">Event</a>
        </li>
    </ul>

    <div class="navbar-contact">
        <a href="/contact" class="{{ Request::is('contact*') ? 'active' : '' }}">Contact</a>
    </div>

    <div class="menu-toggle" onclick="toggleMenu()">
        ☰
    </div>

</nav>

<div class="mobile-menu" id="mobileMenu">
    <a href="/" class="mobile-menu-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
    <a href="/about" class="mobile-menu-link {{ Request::is('about*') ? 'active' : '' }}">About</a>
    <a href="/gallery" class="mobile-menu-link {{ Request::is('gallery*') ? 'active' : '' }}">Gallery</a>
    <a href="/event" class="mobile-menu-link {{ Request::is('contact*') ? 'active' : '' }}">Event</a>
    <a href="/contact" class="mobile-menu-link {{ Request::is('contact*') ? 'active' : '' }}">Contact</a>

</div>

<script>
    function toggleMenu() {
        document.getElementById("mobileMenu").classList.toggle("show");
    }
</script>
