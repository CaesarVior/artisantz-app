@extends('app')
@section('content')
    <div class="container">

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
                        ABC123@gmail.com
                    </div>

                    <div class="mb-4">
                        <strong>Phone</strong><br>
                        (+62) 812345678910
                    </div>

                    <div>
                        <strong>Office</strong><br>
                        Jl. Donau Cihuy
                    </div>

                </div>

            </div>

            <!-- Right -->
            <div class="col-lg-7">

                <div class="card-custom contact-form">

                    <h1 class="fw-bold">Get In touch</h1>

                    <p class="text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
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
    @endsection
