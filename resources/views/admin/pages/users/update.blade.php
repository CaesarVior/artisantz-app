@extends('admin.layout.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <div class="text-center mb-8">
            <h1
                class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-white mb-2 sm:mb-4 inline-block px-6 border-b-[1.5px] border-white pb-2">
                Edit Pengguna
            </h1>
            <p class="text-lg font-semibold text-white">FBN Artisantz Coffee & Eatery</p>
        </div>

        <div class="container mx-auto max-w-6xl">
            <div class="bg-white rounded-2xl max-w-2xl mx-auto border border-gray-200 shadow-md p-6 sm:p-8 lg:p-10">
                <form action="{{ route('admin-users-update', $user->id) }}" method="POST" id="userEditForm">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-5">
                        <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">
                            Nama
                        </label>
                        <input type="text" id="title" name="title"
                            value="{{ old('title', $user->title ?? $user->name) }}"
                            class="w-full px-4 py-2.5 text-sm border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                            placeholder="Masukkan Nama Pengguna">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="mb-5">
                        <label for="role_id" class="block text-gray-700 text-sm font-semibold mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select id="role_id" name="role_id"
                            class="w-full px-4 py-2.5 text-sm border @error('role_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white text-gray-700 transition duration-200">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2.5 text-sm border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                            placeholder="Masukkan Email Pengguna">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="mb-5">
                        <label for="phone_number" class="block text-gray-700 text-sm font-semibold mb-2">
                            Nomor Telepon
                        </label>
                        <input type="number" id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $user->phone_number) }}"
                            class="w-full px-4 py-2.5 text-sm border @error('phone_number') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                            placeholder="Masukkan Nomor Telepon Pengguna">
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password (Opsional saat update) --}}
                    <div class="mb-8">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">
                            Password
                        </label>

                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full pl-4 pr-11 py-2.5 text-sm border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                                placeholder="Masukkan Password">

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg id="eyeOpenIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg id="eyeClosedIcon" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                    <path
                                        d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                    <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                    <line x1="2" x2="22" y1="2" y2="22" />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center flex justify-center items-center space-x-4 pt-2">
                        <button type="button" onclick="history.back()"
                            class="py-2.5 px-8 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm font-medium transition duration-200 shadow-sm">
                            Batal
                        </button>
                        <button type="submit" id="submitBtn"
                            class="py-2.5 px-8 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm font-medium transition duration-200 shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpenIcon = document.getElementById('eyeOpenIcon');
            const eyeClosedIcon = document.getElementById('eyeClosedIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpenIcon.classList.add('hidden');
                eyeClosedIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpenIcon.classList.remove('hidden');
                eyeClosedIcon.classList.add('hidden');
            }
        }
    </script>
@endsection
