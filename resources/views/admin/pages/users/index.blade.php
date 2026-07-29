@extends('admin.layout.app')

@section('title', __('admin-user.index-user'))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-semibold text-white mb-2 inline-block px-6 border-b-[1.5px] border-black pb-2">
                {{ __('admin-user.index-user') }}
            </h1>
            <p class="text-lg font-semibold text-white">FBN Artisantz Coffee & Eatery</p>
        </div>

        <div class="bg-white pb-5 rounded-2xl shadow-sm px-6 py-5">
            <div class="rounded-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-4">
                    <!-- Tombol Tambahkan - di atas pada mobile, di kanan pada desktop -->
                    <a href="{{ route('admin-users-create') }}"
                        class="order-first lg:order-last w-full lg:w-auto bg-[#426EFF] hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow-md transition-colors duration-200 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <div class="w-4 h-4 bg-white rounded flex items-center justify-center">
                            <svg class="w-3 h-3 text-[#426EFF]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                        <span>{{ __('admin-user.index-add-user') }}</span>
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
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center py-10 hidden" id="globalLoader">
                <div class="w-10 h-10 border-4 border-gray-300 border-t-blue-500 rounded-full animate-spin"></div>
            </div>

            <!-- Table Container with Horizontal Scroll -->
            <div class="overflow-x-auto whitespace-nowrap">
                <div class="min-w-[800px]" id="userTable">
                    <table class="w-full table-fixed">
                        <thead class="bg-[#F7F6FE]">
                            <tr>
                                {{-- Nomor --}}
                                <th class="px-4 py-3 text-center text-sm font-bold text-gray-700 w-16">
                                    <span>{{ __('admin-user.index-table-number') }}</span>
                                </th>

                                {{-- Nama --}}
                                <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 w-48">
                                    <span>{{ __('admin-user.index-table-name') }}</span>
                                </th>

                                {{-- Email --}}
                                <th class="px-4 py-3 text-left text-sm font-bold text-gray-700 w-64">
                                    <span>{{ __('admin-user.index-table-email') }}</span>
                                </th>

                                {{-- No. Telepon --}}
                                <th class="px-4 py-3 text-center text-sm font-bold text-gray-700 w-40">
                                    <span>{{ __('admin-user.index-table-phone-number') }}</span>
                                </th>

                                {{-- Role --}}
                                <th class="px-4 py-3 text-center text-sm font-bold text-gray-700 w-28">
                                    <span>Role</span>
                                </th>

                                {{-- Aksi (Edit & Delete) --}}
                                <th class="px-4 py-3 text-center text-sm font-bold text-gray-700 w-36">
                                    <span>{{ __('admin-user.index-table-action') }}</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                            @forelse ($users as $index => $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    {{-- Nomor Pagination --}}
                                    <td class="px-4 py-3 text-center text-sm text-gray-600">
                                        {{ $users->firstItem() + $index }}
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-4 py-3 text-left text-sm font-medium text-gray-900 truncate">
                                        {{ $user->title ?? $user->name }}
                                    </td>

                                    {{-- Email --}}
                                    <td class="px-4 py-3 text-left text-sm text-gray-600 truncate">
                                        {{ $user->email }}
                                    </td>

                                    {{-- No Telepon --}}
                                    <td class="px-4 py-3 text-center text-sm text-gray-600">
                                        {{ $user->phone_number ?? '-' }}
                                    </td>

                                    {{-- Badge Role --}}
                                    <td class="px-4 py-3 text-center text-sm text-gray-600">
                                        <span
                                            class="px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-full text-xs font-semibold">
                                            {{ $user->role->name ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Tombol Aksi --}}
                                    <td class="px-4 py-3 text-center text-sm space-x-2">
                                        {{-- Edit (Arahkan ke route edit user) --}}
                                        <a href="{{ route('admin-users-edit', $user->id) }}"
                                            class="inline-block px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs rounded-lg transition-colors shadow-sm">
                                            Edit
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin-users-destroy', $user->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded-lg transition-colors shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                        Data user belum tersedia.
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
                            {{ __('admin-user.index-paginate-previous') }}
                        </button>
                    </li>
                    <li id="paginationInfo">
                        <div id="totalData" class="flex gap-1"></div>
                    </li>
                    <li>
                        <button
                            class="px-4 py-2 rounded-md bg-white text-gray-700 hover:bg-gray-100 transition-colors duration-200 text-sm border border-gray-200"
                            id="nextButton">
                            {{ __('admin-user.index-paginate-next') }}
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    @vite('resources/js/admin/pages/blog/index.js')
@endsection
