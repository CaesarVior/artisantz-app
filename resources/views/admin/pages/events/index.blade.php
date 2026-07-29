@extends('admin.layout.app')

@section('title', __('admin-event.index-event'))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-semibold text-white mb-2 inline-block px-6 border-b-[1.5px] border-black pb-2">
                {{ __('admin-event.index-event') }}
            </h1>
            <p class="text-lg font-semibold text-white">FBN Artisantz Coffee & Eatery</p>
        </div>

        <div class="bg-white pb-5 rounded-2xl shadow-sm px-6 py-5">
            <div class="rounded-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-4">
                    <!-- Tombol Tambahkan - di atas pada mobile, di kanan pada desktop -->
                    <a href="{{ route('admin-events-create') }}"
                        class="order-first lg:order-last w-full lg:w-auto bg-[#426EFF] hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow-md transition-colors duration-200 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <div class="w-4 h-4 bg-white rounded flex items-center justify-center">
                            <svg class="w-3 h-3 text-[#426EFF]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                        <span>{{ __('admin-event.index-add-event') }}</span>
                    </a>

                    <div class="flex flex-row w-full gap-3 order-last lg:order-first">

                        <div class="relative w-full lg:flex-1">
                            <input type="text" id="searchInput" placeholder="Cari data"
                                class="w-full bg-white border border-gray-300 text-black rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6a6ad9] focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="7"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                        </div>


                        <select id="statusFilter"
                            class="w-[40%] lg:w-48 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6a6ad9] focus:border-transparent bg-white text-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjYgOSAxMiAxNSAxOCA5Ij48L3BvbHlsaW5lPjwvc3ZnPg==')] bg-no-repeat bg-[right_0.5rem_center] bg-[length:1rem]">
                            <option value=""><span>{{ __('admin-event.index-status') }}</span></option>
                            <option value="pending">{{ __('admin-event.index-list-status-pending') }}</option>
                            <option value="publish">{{ __('admin-event.index-list-status-publish') }}</option>
                            <option value="unpublish">{{ __('admin-event.index-list-status-unpublish') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center py-10 hidden" id="globalLoader">
                <div class="w-10 h-10 border-4 border-gray-300 border-t-blue-500 rounded-full animate-spin"></div>
            </div>

            <!-- Table Container with Horizontal Scroll -->
            <div class="overflow-x-auto whitespace-nowrap">
                <div class="min-w-[800px]" id="eventTable">
                    <table class="w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-[#F7F6FE]">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3.5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-16">
                                    {{ __('admin-event.index-table-number') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-48">
                                    {{ __('admin-event.index-table-title') }}
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-24">
                                    {{ __('admin-event.index-table-image') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    {{ __('admin-event.index-table-content') }}
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-36">
                                    {{ __('admin-event.index-table-created-at') }}
                                </th>
                                <th scope="col"
                                    class="px-4 py-3.5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-36">
                                    {{ __('admin-event.index-table-action') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700" id="tableBody">
                            @forelse ($events as $index => $event)
                                <tr class="hover:bg-slate-50/80 transition duration-150">
                                    {{-- Nomor --}}
                                    <td class="px-4 py-4 text-center font-medium text-gray-500 whitespace-nowrap">
                                        {{ method_exists($events, 'firstItem') ? $events->firstItem() + $index : $loop->iteration }}
                                    </td>

                                    {{-- Nama Event --}}
                                    <td class="px-6 py-4 font-semibold text-gray-900 truncate">
                                        {{ $event->name }}
                                    </td>

                                    {{-- Foto --}}
                                    <td class="px-4 py-4">
                                        <div class="flex justify-center items-center">
                                            @php
                                                $photos = is_array($event->photo)
                                                    ? $event->photo
                                                    : json_decode($event->photo, true);
                                                $firstPhoto =
                                                    is_array($photos) && count($photos) > 0 ? $photos[0] : null;
                                            @endphp

                                            @if ($firstPhoto)
                                                <div class="relative">
                                                    <img src="{{ asset($firstPhoto) }}" alt="{{ $event->name }}"
                                                        class="w-12 h-12 object-cover rounded-xl border border-gray-200 shadow-sm"
                                                        onerror="this.onerror=null; this.src='{{ asset('img/no-image.jpg') }}';">

                                                    @if (is_array($photos) && count($photos) > 1)
                                                        <span
                                                            class="absolute -top-1 -right-1 bg-indigo-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow">
                                                            +{{ count($photos) - 1 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <img src="{{ asset('img/no-image.jpg') }}" alt="No Image Available"
                                                    class="w-12 h-12 object-cover rounded-xl border border-gray-200 shadow-sm">
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Deskripsi/Content (Clean Text) --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        <p class="line-clamp-2 text-xs leading-relaxed">
                                            {{ Str::limit(strip_tags($event->description ?? $event->theme), 100) }}
                                        </p>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="px-4 py-4 text-center text-xs text-gray-500 whitespace-nowrap">
                                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y, H:i') : ($event->created_at ? \Carbon\Carbon::parse($event->created_at)->translatedFormat('d M Y, H:i') : '-') }}
                                    </td>

                                    {{-- Action Buttons --}}
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin-events-edit', $event->id) }}"
                                                class="inline-block px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition duration-200 shadow-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin-events-destroy', $event->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-lg transition duration-200 shadow-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 bg-gray-50/50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 mb-2 text-gray-300" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                            <p class="text-xs font-medium text-gray-500">Belum ada data event.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <nav id="paginationWrapper" class="flex justify-center mt-6 px-6">
                <ul class="flex space-x-2">
                    <li>
                        <button
                            class="px-4 py-2 rounded-md bg-white text-gray-500 hover:bg-gray-100 transition-colors duration-200 cursor-not-allowed opacity-70 text-sm border border-gray-200"
                            id="prevButton" disabled>
                            {{ __('admin-event.index-paginate-previous') }}
                        </button>
                    </li>
                    <li id="paginationInfo">
                        <div id="totalData" class="flex gap-1"></div>
                    </li>
                    <li>
                        <button
                            class="px-4 py-2 rounded-md bg-white text-gray-700 hover:bg-gray-100 transition-colors duration-200 text-sm border border-gray-200"
                            id="nextButton">
                            {{ __('admin-event.index-paginate-next') }}
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    @vite('resources/js/admin/pages/blog/index.js')
@endsection
