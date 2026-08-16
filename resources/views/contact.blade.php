@extends('app')
@push('schema')
    <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ContactPage",
  "name": "Hubungi Artisantz Coffee & Eatery",
  "description": "Informasi kontak, alamat lengkap Google Maps, dan jam operasional Artisantz Coffee & Eatery Malang.",
  "url": "{{ config('app.url') }}/contact"
}
</script>
@endpush
@section('title', 'Kontak - Artisantz Coffee & Eatery')
@section('meta_description',
    'Hubungi Artisantz Coffee & Eatery Malang untuk reservasi tempat atau event. Cek rute
    Google Maps, alamat lengkap, dan jam operasional kami di sini.')
@section('content')
    <div class='container-contact'>
        <!-- Content -->
        <div class="row mt-5">

            <!-- Left -->
            <div class="col-lg-5">

                <div class="image-box">
                    🖼️
                </div>

                <div class="card-custom info-card mt-4">

                    <div class="mb-4">
                        <strong>Email</strong><br>
                        artisantzfbn@gmail.com
                    </div>

                    <div class="mb-4">
                        <strong>Phone</strong><br>
                        (+62) 85645160494
                    </div>

                    <div>
                        <strong>Office</strong><br>
                        Jl. Danau Kerinci Raya, Lesanpuro, Kec. Kedungkandang
                    </div>

                </div>

            </div>

            <!-- Right -->
            <div class="col-lg-7">

                <div class="card-custom contact-form">

                    <h1 class="fw-bold">Get In touch</h1>

                    <p class="text-muted">
                    Punya pertanyaan, permintaan reservasi, atau ide kolaborasi?
                    Kami siap membantu. Kirimkan pesan kepada kami dan tim kami akan segera menghubungi Anda kembali.
                    </p>

                    <form>

                        <div class="mb-3">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="First Name...">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email...">
                        </div>

                        <div class="mb-3">
                            <label>Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text">ID</span>
                                <input type="text" class="form-control" placeholder="(+62)">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label>Message</label>
                            <textarea rows="5" class="form-control" placeholder="Leave Us A Message"></textarea>
                        </div>

                        <button class="btn btn-primary w-100">
                            Send Messages
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
