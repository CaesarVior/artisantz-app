@extends ('app')
@section('content')

        <!-- Pattern background (kalau kamu pakai ini) -->
        <div class="artisantz-pattern"></div>

        <!-- HERO SECTION -->
        <section class="hero">

            <x-artisantz-logo />

            <div class="hero-content">
                <div class="hero-h">
                    <h1>Where Art Meets <br>
                    Your Daily Brew.</h1>
                </div>
                <div class="hero-p">
                    <p>
                        Lebih dari sekadar tempat ngopi. Cafe Artisantz adalah ruang <br> kreatif bagi para penikmat rasa, pencari inspirasi, <br>dan pemburu estetika di tengah kota.

                    </p>
                </div>
            </div>

            </div>
        </section>
        <x-container>

    <section class="artisantz-section">

        <div class="artisantz-wrapper">
            <div class="artisantz-left">
                <h2>What Is 
                Artisantz?</h2>
            </div>

            <div class="artisantz-right">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>

   
    </section>
    <div class="best-seller">

    <h2 class="best-title">
        BEST <span>SELLER!</span>
    </h2>

    <div class="podium-wrapper">

        <!-- Ranking 2 -->
        <div class="rank rank-left">
            <h3>#2</h3>
            <img src="{{ asset('images/kopi2.jpg') }}" alt="Best Seller 2">
        </div>

        <!-- Ranking 1 -->
        <div class="rank rank-center">
            <h3>#1</h3>
            <img src="{{ asset('images/kopi1.jpg') }}" alt="Best Seller 1">
        </div>

        <!-- Ranking 3 -->
        <div class="rank rank-right">
            <h3>#3</h3>
            <img src="{{ asset('images/kopi3.jpg') }}" alt="Best Seller 3">
        </div>

    </div>

</div>

</x-container>
    


@endsection