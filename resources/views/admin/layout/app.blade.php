<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - @yield('title')</title>

    <link rel="icon" href="{{ asset('img/Badge Adiloka Original-01.png') }}" type="image/png">

    <!-- Toastr CSS -->
    <link href="{{ asset('css/cdn/toastr.min.css') }}" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <!-- Style CSS tambahan -->
    @vite(['resources/css/app.css'])
    @vite(['resources/css/loader.css'])


    <style>
        @font-face {
            font-family: 'Poppins';
            src: url("{{ asset('css/cdn/Poppins/Poppins-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url("{{ asset('img/bg-header.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            /* font-family: 'Poppins', sans-serif; */
        }


        @media (max-width: 768px) {
            body {
                background-attachment: fixed;
            }
        }
    </style>

</head>

<body>
    @include('components.alert')
    <div id="loadingOverlay" class="fixed inset-0 bg-white flex items-center justify-center z-[9999]">
        <div class="relative w-32 h-32 flex items-center justify-center">
            <div
                class="absolute w-32 h-32 rounded-full border-[6px] border-t-blue-500 border-l-transparent border-b-transparent border-r-transparent spin-smooth">
            </div>
            <div class="w-24 h-24 bg-white rounded-full z-10">
                <img src="{{ asset('img/artisantz-logo-no-bg.webp') }}" alt="Logo"
                    class="w-full h-full object-cover rounded-full heartbeat" />
            </div>
        </div>
    </div>
    @include('admin.layout.sidebar')

    <!-- Main Content -->
    <div class="content-area md:ml-64">
        <!-- Content -->
        <main class="p-6">
            <div class="max-w-7xl mx-auto">
                @if (session('error'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const language = localStorage.getItem('locale');
                            let title = '';
                            toastr.options = {
                                positionClass: "toast-top-right",
                                progressBar: true,
                                closeButton: true,
                                newestOnTop: true,
                                timeOut: 3000,
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: false,
                                opacity: 1
                            };
                            if (language === 'id') {
                                title = 'Peringatan!';
                            } else {
                                title = 'Alert!';
                            }

                            toastr.warning('{{ session('error') }}', title);
                        });
                    </script>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- jQuery JS -->
    <script src="{{ asset('js/cdn/jquery-3.7.1.min.js') }}"></script>

    <!-- Toastr JS -->
    <script src="{{ asset('js/cdn/toastr.min.js') }}"></script>

    <!-- SweetAlert JS -->
    <script src="{{ asset('js/cdn/sweetalert2@11.js') }}"></script>


    <!-- Vite app.js -->
    @vite(['resources/js/app.js'])
    @vite(['resources/js/loader.js'])
</body>

</html>
