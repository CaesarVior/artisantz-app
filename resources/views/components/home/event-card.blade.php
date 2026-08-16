@props(['event' => null, 'bannerImg' => asset('img/event-banner.webp')])

@if ($event)
    <section class="event">
        <div class="event-card-home">
            <img src="{{ asset('event/parade-hujan-tour-album-punar/parade-hujan-banner.jpeg') }}"
                alt="{{ $event->name }}">

            <div class="event-overlay"></div>

            <div class="event-content" style="z-index: 2; color: #fff;">
                <span class="event-badge"
                    style="background: #e74c3c; color: #fff; padding: 2px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold; width: fit-content; margin-bottom: 6px;">
                    UPCOMING EVENT
                </span>

                <h3 class="event-title"
                    style="color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.6); margin: 0; font-weight: 700;">
                    {{ $event->name }}
                </h3>

                <p class="event-date"
                    style="color: #f1f1f1; text-shadow: 0 1px 3px rgba(0,0,0,0.6); margin: 4px 0 14px; font-size: 0.9rem;">
                    <i class="far fa-calendar-alt me-1"></i>
                    {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                </p>

                <a href="{{ route('events.index') }}" class="event-btn">
                    View More
                </a>
            </div>
        </div>
    </section>
@endif
