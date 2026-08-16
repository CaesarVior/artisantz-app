@extends('app')
@push('schema')
    <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "AboutPage",
  "name": "Tentang Artisantz Coffee & Eatery",
  "description": "Kisah, visi, dan dedikasi Artisantz Coffee & Eatery dalam menyajikan kopi berkualitas di Kota Malang.",
  "url": "{{ config('app.url') }}/about"
}
</script>
@endpush
@section('title', 'Tentang Kami - Cerita & Konsep Artisantz Coffee & Eatery Malang')
@section('meta_description',
    'Pelajari dedikasi Artisantz Coffee & Eatery Malang dalam menyajikan kopi artisan pilihan
    dan menciptakan ruang kreatif yang nyaman.')
@section('content')
    <section class="about-page">
        <div class="about-container">

            <!-- Header -->
            <div class="about-header">

                <div class="about-text">
                    <h1>About Artisantz</h1>

                    <p>
                        Cafe Artisantz adalah ruang kreatif yang menggabungkan
                        seni, kopi, dan suasana yang nyaman dalam satu tempat.
                        Kami percaya bahwa secangkir kopi terbaik lahir dari
                        proses yang penuh perhatian dan kreativitas.
                    </p>

                    <p>
                        Lebih dari sekadar cafe, Artisantz menjadi tempat
                        berkumpulnya para penikmat kopi, pekerja kreatif,
                        mahasiswa, dan siapa saja yang ingin menikmati suasana
                        yang tenang serta inspiratif.
                    </p>
                </div>

                <div class="about-image">
                    <img src="{{ asset('img/artisantz-place.webp') }}" alt="Artisantz">
                </div>

            </div>

            <!-- Info -->
            <div class="about-info">

                <div class="info-row">
                    <div class="info-title">
                        Our Vision
                    </div>

                    <div class="info-content">
                        Menjadi ruang kreatif yang menghubungkan seni,
                        komunitas, dan budaya kopi dalam pengalaman yang
                        berkesan.
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-title">
                        Our Mission
                    </div>

                    <div class="info-content">
                        Menyajikan kopi berkualitas, menciptakan suasana
                        nyaman, dan mendukung komunitas kreatif untuk
                        berkembang bersama.
                    </div>
                </div>

            </div>

            <!-- Contact -->
            <div class="contact-section">

                <div class="contact-left">
                    <h3>
                        Let's create something amazing together →
                    </h3>
                </div>

                <div class="contact-right">
                    <h3>hello@artisantz.com</h3>
                    <p>View Profile</p>
                </div>

            </div>

        </div>

    </section>
@endsection
