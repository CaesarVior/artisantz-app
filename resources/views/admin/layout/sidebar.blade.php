<style>
    /* Sidebar Animation */
    .sidebar {
        transition: transform 0.3s ease;
    }

    .sidebar-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(2px);
    }

    /* Submenu Animation */
    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .submenu.active {
        max-height: 500px;
    }

    .chevron {
        transition: transform 0.3s ease;
    }

    .chevron.rotate {
        transform: rotate(180deg);
    }

    /* Mobile Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            z-index: 50;
        }

        .sidebar-open {
            transform: translateX(0);
        }
    }

    /* Active Menu Style */
    .menu-item.active,
    .menu-item:hover {
        background-color: #EEF2FF;
        /* indigo-50 */
        color: #0C0950;
    }

    .menu-item.active .icon,
    .menu-item:hover .icon {
        color: #0C0950;
    }

    .submenu-item.active,
    .submenu-item:hover {
        color: #4F46E5;
        /* indigo-600 */
        background-color: #EEF2FF;
        /* indigo-50 */
    }

    /* * {
        border: 1px solid black !important;
    } */
</style>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 z-40 hidden md:hidden"></div>

<!-- Mobile Sidebar Toggle -->
<button id="sidebarToggle"
    class="md:hidden fixed top-4 left-4 z-50 p-3 rounded-lg bg-white shadow-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<!-- Sidebar -->
<aside class="sidebar w-64 bg-white border-r border-gray-200 shadow-lg h-screen fixed overflow-y-auto flex flex-col">
    <!-- Sidebar Header -->
    <div class="p-4 flex items-center justify-between border-b border-gray-200 bg-white">
        <div class="flex items-center">
            <div class="w-10 h-10 flex items-center justify-center mr-3 overflow-hidden">
                <img src="{{ asset('img/artisantz-logo-no-bg.webp') }}" alt="Logo" class="w-10 h-10 object-contain">
            </div>
            <h1 class="text-lg font-semibold text-gray-800">Admin Artisantz</h1>
        </div>
        <button id="sidebarClose" class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 flex-1 flex flex-col justify-between">
        <ul class="space-y-2">
            <!-- Berita -->
            <li>
                <a href="{{ route('admin-events') }}"
                    class="menu-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-[#0C0950] font-medium {{ request()->routeIs('admin-events', 'admin-events-update') ? 'active' : '' }}">
                    <div class="w-6 h-6 mr-3 flex-shrink-0 rounded flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-news w-5 h-5 text-gray-700 hover:text-[#0C0950]">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                            <path d="M8 8l4 0" />
                            <path d="M8 12l4 0" />
                            <path d="M8 16l4 0" />
                        </svg>
                    </div>
                    <span>{{ __('admin-sidebar.sidebar-event') }}</span>
                </a>
            </li>

            <!-- Layanan -->
            <li>
                <a href="{{ route('admin-users-index') }}"
                    class="menu-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-[#0C0950] font-medium {{ request()->routeIs('admin-users-index', 'admin-users-update') ? 'active' : '' }}">
                    <div class="w-6 h-6 mr-3 flex-shrink-0 rounded flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-details  w-5 h-5 text-gray-700 hover:text-[#0C0950]">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M13 5h8" />
                            <path d="M13 9h5" />
                            <path d="M13 15h8" />
                            <path d="M13 19h5" />
                            <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                    </div>
                    <span>{{ __('admin-sidebar.sidebar-user') }}</span>
                </a>
            </li>

            <!-- Testimonial -->
            <li>
                <a href="{{ route('admin-roles-index') }}"
                    class="menu-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-[#0C0950] font-medium {{ request()->routeIs('admin-roles-index', 'admin-roles-update') ? 'active' : '' }}">
                    <div class="w-6 h-6 mr-3 flex-shrink-0 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-700 hover:text-[#0C0950]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <span>{{ __('admin-sidebar.sidebar-role') }}</span>
                </a>
            </li>

            <!-- Menu Item: Pengisian Form -->
            <li>
                <button
                    class="menu-toggle w-full flex items-center justify-between p-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-[#0C0950] font-medium"
                    data-target="form-submenu">
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-3 flex-shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-700 icon-gray" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span>{{ __('admin-sidebar.sidebar-form-submission') }}</span>
                    </div>
                    <svg class="chevron w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <ul id="form-submenu"
                    class="submenu ml-5 mt-2 space-y-1 {{ request()->routeIs('admin-events-create', 'admin-users-create', 'admin-roles-create') ? 'active' : '' }}">
                    <li>
                        <a href="{{ route('admin-events-create') }}"
                            class="submenu-item block p-2 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded {{ request()->routeIs('admin-events-create') ? 'font-bold text-indigo-600 bg-indigo-50' : '' }}">
                            {{ __('admin-sidebar.sidebar-add-event') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-users-create') }}"
                            class="submenu-item block p-2 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded {{ request()->routeIs('admin-users-create') ? 'font-bold text-indigo-600 bg-indigo-50' : '' }}">
                            {{ __('admin-sidebar.sidebar-add-user') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-roles-create') }}"
                            class="submenu-item block p-2 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded {{ request()->routeIs('admin-roles-create') ? 'font-bold text-indigo-600 bg-indigo-50' : '' }}">
                            {{ __('admin-sidebar.sidebar-add-role') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Logout Paling Bawah -->
        <div class="flex flex-col mt-8 pt-4">
            <div class="border-t border-gray-200">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" id="logoutBtn"
                        class="flex items-center p-3 rounded-lg text-red-600 hover:bg-red-50 font-medium w-full">
                        <div class="w-6 h-6 mr-3 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</aside>
<!-- Add this script to your existing script section -->
<script>
    document.querySelectorAll('.language-option').forEach(el => {
        el.addEventListener('click', async function(e) {
            e.preventDefault();
            const locale = this.getAttribute('data-locale');
            const currentLocale = localStorage.getItem('locale') || 'id';

            if (locale === currentLocale) {
                return;
            }

            // Simpan locale baru
            localStorage.setItem('locale', locale);

            try {
                // Panggil endpoint untuk set session
                await fetch(`/lang/${locale}`, {
                    method: 'GET',
                    credentials: 'same-origin'
                });

                const currentPath = window.location.pathname;

                // Cek apakah URL mengandung parameter dinamis
                const hasDynamicParam =
                    /\/(detail-blog|document\/id|course\/id|blog\/update|orders\/update|services\/update|services\/show|testimonial\/update)\/[^/]+$/
                    .test(currentPath);

                if (hasDynamicParam) {
                    // Simpan flag reload & mundur ke halaman sebelumnya
                    localStorage.setItem('forceReload', 'true');
                    window.history.go(-1);
                } else if (currentPath.startsWith("/document/") || currentPath.startsWith(
                        "/course/")) {
                    window.location.href = "/";
                } else {
                    // Reload langsung jika bukan halaman dengan parameter
                    location.reload();
                }
            } catch (error) {
                console.error('Gagal mengubah bahasa:', error);
            }
        });
    });

    // Reload otomatis jika datang dari history.go(-1)
    window.addEventListener('load', () => {
        const shouldForceReload = localStorage.getItem('forceReload');

        if (shouldForceReload === 'true') {
            localStorage.removeItem('forceReload');
            // Gunakan delay kecil agar semua asset termuat sebelum reload
            setTimeout(() => {
                location.reload();
            }, 100);
        }
    });
</script>
<script>
    // Sidebar functionality
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Open sidebar on mobile
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.add('sidebar-open');
        sidebarOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close sidebar
    function closeSidebar() {
        sidebar.classList.remove('sidebar-open');
        sidebarOverlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    sidebarClose.addEventListener('click', closeSidebar);
    sidebarOverlay.addEventListener('click', closeSidebar);

    // Close sidebar on window resize if desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            closeSidebar();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeSidebar();
        }
    });

    // Submenu toggle functionality
    document.querySelectorAll('.menu-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const submenu = document.getElementById(targetId);
            const chevron = this.querySelector('.chevron');

            // Close all other submenus
            document.querySelectorAll('.submenu').forEach(menu => {
                if (menu.id !== targetId && menu.classList.contains('active')) {
                    menu.classList.remove('active');
                    const otherChevron = document.querySelector(
                        `[data-target="${menu.id}"] .chevron`);
                    if (otherChevron) {
                        otherChevron.classList.remove('rotate');
                    }
                }
            });

            // Toggle current submenu
            submenu.classList.toggle('active');
            chevron.classList.toggle('rotate');
        });
    });

    // Automatically expand submenu if current route matches
    document.addEventListener('DOMContentLoaded', function() {
        const currentSubmenu = document.querySelector('.submenu-item.active');
        if (currentSubmenu) {
            const submenu = currentSubmenu.closest('.submenu');
            if (submenu) {
                submenu.classList.add('active');
                const toggleButton = document.querySelector(`[data-target="${submenu.id}"]`);
                if (toggleButton) {
                    const chevron = toggleButton.querySelector('.chevron');
                    if (chevron) {
                        chevron.classList.add('rotate');
                    }
                }
            }
        }
    });
</script>
