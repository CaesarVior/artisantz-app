@extends('app')
@push('schema')
    <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ImageGallery",
  "name": "Galeri Foto Artisantz Coffee & Eatery",
  "description": "Koleksi foto suasana kedai kopi dan menu andalan di Artisantz Coffee & Eatery Malang.",
  "url": "{{ config('app.url') }}/gallery"
}
</script>
@endpush
@section('title', 'Galeri Foto - Menu Kopi & Suasana Estetik Artisantz Coffee')
@section('meta_description',
    'Intip galeri foto suasana indoor/outdoor yang nyaman serta jajaran menu kopi ,
    manual brew dan non kopi, serta hidangan lezat di Artisantz Coffee & Eatery Malang.')
@section('content')
    <div class="gallery-section">
        <div class="gallery-container">
            <div class="gallery-category-scroll-container">
                <div class="gallery-category-tabs">
                    @foreach ($categories as $cat)
                        <a href="?category={{ $cat }}"
                            class="gallery-category-tab {{ $activeCategory == $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <h2 class="gallery-category-heading">
                {{ $activeCategory }} Menu
            </h2>

            <div class="gallery-grid">
                @forelse($menuItems as $item)
                    <div class="gallery-item">
                        <div class="gallery-image-box">
                            <img src="{{ asset('img/menu/' . $item['filename']) }}" alt="Menu Artisantz">
                        </div>
                        <h3 class="gallery-item-title">
                            @php
                                $cleanName = preg_replace('/^[^-]+-/', '', $item['filename']);
                            @endphp
                            {{ ucwords(str_replace(['-', '_', '.webp', '.png', '.jpg', '.jpeg'], [' ', ' ', '', '', '', ''], $cleanName)) }}
                        </h3>
                    </div>
                @empty
                    <div class="gallery-no-menu">
                        <p>Belum ada menu di kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
