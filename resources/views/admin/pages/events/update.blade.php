@extends('admin.layout.app')

@section('title', 'Edit Event')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <div class="text-center mb-8">
            <h1
                class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-white mb-2 sm:mb-4 inline-block px-6 border-b-[1.5px] border-white pb-2">
                Edit Event
            </h1>
            <p class="text-lg font-semibold text-white">FBN Artisantz Coffee & Eatery</p>
        </div>

        <div class="container mx-auto max-w-6xl">
            <div class="bg-white rounded-2xl max-w-2xl mx-auto border border-gray-200 shadow-md p-6 sm:p-8 lg:p-10">
                <form action="{{ route('admin-events-update', $event->id) }}" method="POST" enctype="multipart/form-data"
                    id="eventEditForm">
                    @csrf
                    @method('PUT')

                    {{-- Global Validation Alert --}}
                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-red-700 text-sm shadow-sm">
                            <div class="flex items-center mb-1 font-semibold">
                                <svg class="w-4 h-4 mr-2 fill-current text-red-500" viewBox="0 0 20 20">
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                                </svg>
                                <span>Mohon periksa kembali inputan Anda:</span>
                            </div>
                            <ul class="list-disc pl-8 space-y-0.5 text-xs text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Name Input --}}
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">
                            {{ __('admin-event.create-event-title') }}
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}"
                            class="w-full px-4 py-2.5 text-sm border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                            placeholder="{{ __('admin-event.create-event-title-placeholder') }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Theme Input --}}
                    <div class="mb-5">
                        <label for="theme" class="block text-gray-700 text-sm font-semibold mb-2">
                            {{ __('admin-event.create-event-theme') }}
                        </label>
                        <input type="text" id="theme" name="theme" value="{{ old('theme', $event->theme) }}"
                            class="w-full px-4 py-2.5 text-sm border @error('theme') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 placeholder-gray-400 transition duration-200"
                            placeholder="{{ __('admin-event.create-event-theme-placeholder') }}">
                        @error('theme')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Quill Description Input --}}
                    <div class="mb-5">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">
                            {{ __('admin-event.create-event-description') }}
                        </label>
                        <div
                            class="rounded-lg border @error('description') border-red-500 @else border-gray-300 @enderror overflow-hidden focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition duration-200">
                            {{-- Quill div dengan isi awal dari data event --}}
                            <div id="quillContent" class="bg-white text-sm h-48 sm:h-56 lg:h-64">{!! old('description', $event->description) !!}
                            </div>
                        </div>
                        <input type="hidden" id="description" name="description"
                            value="{{ old('description', $event->description) }}">
                        @error('description')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Event Date Input (Langsung Buka Picker saat Diklik) --}}
                    <div class="mb-5">
                        <label for="event_date" class="block text-gray-700 text-sm font-semibold mb-2">
                            {{ __('admin-event.create-event-date') }}
                        </label>
                        <input type="datetime-local" id="event_date" name="event_date"
                            value="{{ old('event_date', isset($event->event_date) ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') : '') }}"
                            onclick="this.showPicker()"
                            class="w-full px-4 py-2.5 text-sm border @error('event_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-gray-700 cursor-pointer transition duration-200">
                        @error('event_date')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Photo Upload Input (Multiple Preview) --}}
                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">
                            {{ __('admin-event.create-event-upload-file') }}
                        </label>

                        <label for="photos"
                            class="block p-6 border-2 border-dashed @error('photos') border-red-400 bg-red-50/30 @else border-gray-300 bg-gray-50/50 @enderror rounded-xl text-center hover:bg-gray-100/80 cursor-pointer transition duration-200">

                            {{-- Container Grid Preview Gambar --}}
                            <div id="previewGrid" class="flex flex-wrap items-center justify-center gap-3 mb-3">

                                {{-- Tampilan Awal (Halaman Update: Jika sudah ada foto lama) --}}
                                @if (!empty($event->photo) && is_array($event->photo))
                                    @foreach ($event->photo as $path)
                                        <div
                                            class="w-24 h-24 rounded-lg border border-gray-200 bg-white shadow-sm overflow-hidden relative">
                                            <img src="{{ asset($path) }}" class="w-full h-full object-cover"
                                                alt="Preview Gambar" />
                                        </div>
                                    @endforeach
                                @else
                                    {{-- Placeholder SVG jika belum ada gambar --}}
                                    <div id="placeholderBox"
                                        class="w-24 h-24 flex items-center justify-center rounded-lg border border-gray-200 bg-white shadow-sm">
                                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 48 48"
                                            aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <span
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-xs font-semibold text-gray-700 shadow-sm pointer-events-none">
                                Pilih Foto Event (Bisa Banyak)
                            </span>

                            {{-- Input Multiple Files --}}
                            <input id="photos" name="photos[]" type="file" class="sr-only" accept="image/*"
                                multiple />
                        </label>

                        @error('photos')
                            <p class="text-red-500 text-xs mt-1.5 text-center">{{ $message }}</p>
                        @enderror
                        @error('photos.*')
                            <p class="text-red-500 text-xs mt-1.5 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="text-center flex justify-center items-center space-x-4 pt-2">
                        <button type="button" onclick="history.back()"
                            class="py-2.5 px-8 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm font-medium transition duration-200 shadow-sm">
                            {{ __('admin-event.create-event-cancel') }}
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

    @vite('resources/js/admin/pages/events/update.js')
@endsection
