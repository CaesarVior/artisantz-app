@extends('admin.layout.app')

@section('title', 'Tambah Role')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <div class="text-center mb-8">
            <h1
                class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-white mb-2 sm:mb-4 inline-block px-6 border-b-[1.5px] border-white pb-2">
                {{ __('admin-role.create-form-add-role') }}
            </h1>
            <p class="text-lg font-semibold text-white">FBN Artisantz Coffee & Eatery</p>
        </div>

        <div class="container mx-auto max-w-6xl">
            <div class="bg-white rounded-2xl max-w-2xl mx-auto border border-gray-200 shadow-md p-6 sm:p-8 lg:p-10">
                <form action="{{ route('admin-roles-store') }}" method="POST" id="roleForm">
                    @csrf

                    {{-- Field Input Name --}}
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">
                            {{ __('admin-role.create-role-title') }}
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 text-sm border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                            placeholder="{{ __('admin-role.create-role-title-placeholder') }}">

                        {{-- Validation Error Message --}}
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="text-center flex justify-center items-center space-x-4 pt-2">
                        <button type="button" onclick="history.back()"
                            class="py-2.5 px-8 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm font-medium transition duration-200 shadow-sm">
                            {{ __('admin-role.create-role-cancel') }}
                        </button>
                        <button type="submit" id="submitBtn"
                            class="py-2.5 px-8 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm font-medium transition duration-200 shadow-sm">
                            {{ __('admin-role.create-role-add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/admin/pages/blog/create.js')
@endsection
