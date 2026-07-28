@extends('admin.layout.app')

@section('title', 'Edit Berita')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <div class="text-center mb-8">
            <h1
                class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-white mb-2 sm:mb-4 inline-block px-6 border-b-[1.5px] border-white pb-2">
                {{ __('admin-news.update-form-add-news') }}
            </h1>
            <p class="text-lg font-semibold text-white">Through Language we Connect the World for You</p>
        </div>

        <div class="container mx-auto max-w-6xl">
            <div class="bg-white rounded-xl max-w-2xl mx-auto border border-black p-6 sm:p-8 lg:p-12">
                <form enctype="multipart/form-data" id="editNewsForm">
                    @csrf
                    @method('PUT')

                    <!-- Hidden input untuk menyimpan ID/slug dari URL parameter -->
                    <input type="hidden" id="newsId" name="id">
                    <div class="mb-6">
                        <label for="status"
                            class="block text-gray-700 text-sm font-medium mb-1">{{ __('admin-news.update-choose-status') }}</label>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4 mb-4 pb-5 border-b border-black"
                            id="status">
                            <label class="inline-flex items-center space-x-2">
                                <input type="radio" name="status" value="pending" class="form-radio text-green-600" />
                                <span class="text-sm text-gray-700">{{ __('admin-news.index-list-status-pending') }}</span>
                            </label>
                            <label class="inline-flex items-center space-x-2">
                                <input type="radio" name="status" value="publish" class="form-radio text-green-600" />
                                <span class="text-sm text-gray-700">{{ __('admin-news.index-list-status-publish') }}</span>
                            </label>
                            <label class="inline-flex items-center space-x-2">
                                <input type="radio" name="status" value="unpublish" class="form-radio text-red-600" />
                                <span
                                    class="text-sm text-gray-700">{{ __('admin-news.index-list-status-unpublish') }}</span>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="">

                    <div class="mb-6">
                        <label for="title"
                            class="block text-gray-700 text-sm font-medium mb-1">{{ __('admin-news.update-news-title') }}</label>
                        <input type="text" id="title" name="title"
                            class="w-full px-0 py-2 border-b border-black focus:outline-none focus:ring-0 text-xs placeholder-gray-500 transition-colors duration-200"
                            placeholder="{{ __('admin-news.create-news-title-placeholder') }}">
                    </div>

                    <!-- Container untuk label dan Quill -->
                    <div class="mb-6">
                        <label for="content"
                            class="block text-gray-700 text-sm font-medium mb-1">{{ __('admin-news.update-news-description') }}</label>
                        <!-- Quill Editor -->
                        <div id="quillContent"
                            class="bg-white border border-black rounded p-2 text-sm h-48 sm:h-56 lg:h-64">
                        </div>
                        <!-- Hidden input untuk isi konten -->
                        <input type="hidden" id="content" name="content">
                    </div>

                    <div class="mb-8">
                        <label for="images"
                            class="block text-gray-700 text-sm font-medium mb-1">{{ __('admin-news.update-news-upload-file') }}</label>

                        <!-- Tampilkan gambar existing jika ada -->
                        <div class="mb-4" id="currentImageContainer" style="display: none;">
                            <p class="text-xs text-gray-600 mb-2">Gambar saat ini:</p>
                            <img src="" alt="Current Image"
                                class="w-32 h-32 object-cover rounded border border-gray-300" id="currentImage">
                        </div>

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-b border-black">
                            <div class="text-center">
                                <!-- Bungkus SVG dan IMG dalam satu container supaya bisa toggle -->
                                <div id="previewContainer"
                                    class="mx-auto w-40 h-40 flex items-center justify-center rounded shadow border border-gray-300 bg-gray-50 transition-colors duration-200">
                                    <svg id="uploadSvg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 48 48"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <img id="imagePreview" class="hidden w-full h-full object-cover rounded"
                                        alt="Preview Gambar Baru" />
                                </div>

                                <div class="flex text-sm text-gray-400 mt-3">
                                    <label for="images"
                                        class="relative cursor-pointer bg-white rounded-md font-medium hover:text-gray-600">
                                        <span>{{ __('admin-news.update-news-upload-file-placeholder') }}</span>
                                        <input id="images" name="images" type="file" class="sr-only"
                                            accept="image/*" />
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ __('admin-news.update-news-empty-file-placeholder') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center flex justify-center items-center space-x-5">
                        <button type="button" onclick="history.back()"
                            class="py-1 px-9 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-base font-light transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" id="submitBtn"
                            class="py-1 px-9 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-base font-light transition-colors duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/admin/pages/blog/update.js')
@endsection
