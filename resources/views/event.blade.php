@extends('app')

@section('title', 'Event - Artisantz Coffee & Eatery')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <x-navbar />

    <section class="event-section">

        <div class="event-container">
            <h2>Gallery Event</h2>
            <!-- GALLERY EVENT -->
            <div class="event-gallery">
                <!-- SWIPER CAROUSEL CONTAINER -->
                <div class="swiper eventGallerySwiper">
                    <div class="swiper-wrapper">
                        @if ($events->isNotEmpty())
                            {{-- Tampilkan foto-foto event jika event ada --}}
                            @foreach ($events as $event)
                                @php
                                    $photos = is_string($event->photo)
                                        ? json_decode($event->photo, true)
                                        : $event->photo;
                                @endphp

                                @if (!empty($photos) && is_array($photos))
                                    @foreach (array_values($photos) as $index => $img)
                                        <div class="swiper-slide">
                                            <div class="event-thumb">
                                                <img src="{{ asset($img) }}" alt="{{ $event->name }} - Foto {{ $index + 1 }}">
                                                
                                                {{-- Tombol Icon Pembesar Gambar --}}
                                                <button type="button" class="zoom-btn" onclick="openImageModal('{{ asset($img) }}')" title="Perbesar Gambar">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                        <line x1="11" y1="8" x2="11" y2="14"></line>
                                                        <line x1="8" y1="11" x2="14" y2="11"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            {{-- Tampilkan COMING SOON jika tidak ada event --}}
                            <div class="swiper-slide">
                                <div class="event-thumb coming-soon">
                                    <span>COMING SOON</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination & Navigasi -->
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            {{-- EVENT CARDS (Dinamis dari Database) --}}
            @forelse ($events as $event)
                <div class="event-card mb-8">

                    <!-- LEFT -->
                    <div class="event-left">

                        <h2 class="event-title">
                            {{ $event->name }}
                        </h2>
                        <div class="ql-editor" style="margin-bottom: 25px">
                            {!! $event->description !!}
                        </div>

                        @if (!empty($event->theme))
                            <p class="text-sm text-gray-500 mb-2">Tema: {{ $event->theme }}</p>
                        @endif

                        <div class="event-info">
                            <span>📅</span>
                            <div>
                                <strong>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</strong>
                                {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('H:i') }} WIB
                            </div>
                        </div>

                        <div class="event-info">
                            <span>📍</span>
                            <div>
                                Artisantz Coffee & Eatery
                            </div>
                        </div>

                        <div class="event-info">
                            <span>👤</span>
                            <div>
                                Dibuat oleh: {{ $event->user->name ?? 'Admin' }}
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="event-right">
                        <h3>Reservasi Sekarang</h3>
                        <p>
                            Booking meja terlebih dahulu agar tidak kehabisan tempat.
                        </p>
                        <a href="https://wa.me/6285645160494?text=Halo%20Artisantz,%20saya%20ingin%20reservasi%20untuk%20event%20{{ urlencode($event->name) }}"
                            target="_blank" class="reserve-btn">
                            Reservasi via WhatsApp
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center bg-gray-50 rounded-xl mb-8">
                    <p class="text-gray-500">Belum ada event yang dijadwalkan dalam waktu dekat.</p>
                </div>
            @endforelse
        </div>
    </section>
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <span class="close-modal">&times;</span>
        <img class="modal-content-img" id="imgModalTarget" alt="Preview Event">
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('imgModalTarget');
            modalImg.src = src;
            modal.classList.add('active');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.eventGallerySwiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                centeredSlides: true,

                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },

                speed: 600,

                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
@endsection
