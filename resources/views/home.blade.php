@extends('app')

@section('content')
    <x-navbar />

    <main>

        {{-- Hero --}}
        <x-home.hero />

        {{-- Event --}}
        <x-home.event-card :event="$event" :banner-img="$bannerImg" />

        {{-- What is Artisantz --}}
        <x-home.container />

        <x-home.best-seller />
    </main>
@endsection
