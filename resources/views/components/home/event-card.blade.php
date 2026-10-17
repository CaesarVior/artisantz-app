@props(['event' => null, 'bannerImg' => asset('img/event-banner.webp')])

@if ($event)
    @php
        $eventName = data_get($event, 'name', 'New Event!');
        $eventDate = data_get($event, 'event_date');
        $rawPhoto  = data_get($event, 'photo');

        $photos = is_string($rawPhoto) ? json_decode($rawPhoto, true) :$rawPhoto;
        if (!is_array($photos)) {$photos = $rawPhoto ? [$rawPhoto] : [];
        }
    @endphp

    <section class="event-banner-section">
        <div class="event-banner-card">
            
            {{-- Swiper Slider --}}
            <div class="swiper eventGallerySwiper">
                <div class="swiper-wrapper">
                    @if (!empty($photos))
                        @foreach (array_values($photos) as $index =>$img)
                            <div class="swiper-slide">
                                <div class="banner-img-container">
                                    {{-- Ambient Background untuk mengisi ruang hitam --}}
                                    <img src="{{ asset($img) }}" class="banner-ambient-bg" alt="" aria-hidden="true">
                                    {{-- Poster Utama di Tengah --}}
                                    <img src="{{ asset($img) }}" class="banner-poster" alt="{{ $eventName }} - Foto {{$index + 1 }}">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="swiper-slide">
                            <div class="banner-img-container">
                                <img src="{{ $bannerImg }}" class="banner-ambient-bg" alt="" aria-hidden="true">
                                <img src="{{ $bannerImg }}" class="banner-poster" alt="{{ $eventName }}">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Overlay Teks & Tombol --}}
            <div class="banner-overlay">
                <div class="banner-header">
                    <span class="banner-badge">UPCOMING EVENT</span>
                    <h3 class="banner-title">{{ $eventName }}</h3>
                </div>

                <div class="banner-action">
                    <a href="{{ route('events.index') }}" class="view-more-btn">
                        View More
                    </a>
                </div>
            </div>

        </div>
    </section>
@endif