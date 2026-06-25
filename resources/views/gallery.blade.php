@extends('app')
@section('content')
    <section class="gallery-container">

        @for ($i = 1; $i <= 9; $i++)
            <div class="card">
                <img src="{{ asset('images/default-image.png') }}" alt="">
            </div>
        @endfor

    </section>
@endsection