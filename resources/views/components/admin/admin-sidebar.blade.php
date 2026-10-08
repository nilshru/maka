{{--- admin-sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Riva Nair</title>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Base reset & typography */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f3f4f6;
            color: #24251F;
        }

        /* Mobile Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 40;
            background-color: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Sidebar Container */
        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
            display: flex;
            height: 100vh;
            width: 270px;
            flex-direction: column;
            border-right: 1px solid #e7e5e4; /* stone-200 */
            background-color: #F8F7F2;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }

        .admin-sidebar.open {
            transform: translateX(0);
        }

        /* Brand / Header */
        .sidebar-brand-container {
            display: flex;
            height: 76px;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e7e5e4; /* stone-200 */
            padding-left: 24px;
            padding-right: 24px;
        }

        .sidebar-brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .brand-logo-icon {
            display: flex;
            height: 40px;
            width: 40px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background-color: #29452A;
            color: #ffffff;
            font-family: Georgia, Cambria, "Times New Roman", Times, serif;
            font-size: 18px;
            flex-shrink: 0;
        }

        .brand-text-block {
            text-align: left;
        }

        .brand-title {
            font-family: Georgia, Cambria, "Times New Roman", Times, serif;
            font-size: 18px;
            font-weight: 600;
            line-height: 1;
            color: #24251F;
        }

        .brand-subtitle {
            margin-top: 4px;
            font-size: 9px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.22em;
            color: #78716c; /* stone-500 */
        }

        .mobile-close-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #78716c; /* stone-500 */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .mobile-close-btn:hover {
            background-color: #e7e5e4;
        }

        /* Navigation Area */
        .sidebar-navigation {
            flex: 1;
            overflow-y: auto;
            padding: 20px 16px;
        }

        .menu-section {
            margin-bottom: 28px;
        }

        .menu-section-title {
            margin-bottom: 8px;
            padding: 0 12px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.18em;
            color: #a8a29e; /* stone-400 */
            text-transform: uppercase;
        }

        .menu-items-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Nav Item / Links */
        .nav-item-btn {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            background: transparent;
            cursor: pointer;
            color: #57534e; /* stone-600 */
            transition: all 0.2s ease;
            box-sizing: border-box;
            text-align: left;
        }

        .nav-item-btn:hover {
            background-color: rgba(231, 229, 228, 0.7); /* stone-200/70 */
            color: #29452A;
        }

        .nav-item-btn.active {
            background-color: #e4ebdf;
            color: #29452A;
        }

        .nav-item-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-item-btn i,
        .nav-item-btn svg {
            transition: transform 0.2s ease;
            stroke-width: 1.8;
            flex-shrink: 0;
        }

        .nav-item-btn:hover i,
        .nav-item-btn:hover svg {
            transform: scale(1.05);
        }

        /* Badges */
        .nav-badge {
            border-radius: 9999px;
            padding: 2px 8px;
            font-size: 10px;
            font-weight: 600;
        }

        .badge-inventory {
            background-color: #fee2e2; /* red-100 */
            color: #dc2626; /* red-600 */
        }

        .badge-default {
            background-color: #e7e5e4; /* stone-200 */
            color: #57534e; /* stone-600 */
        }

        /* Submenus */
        .submenu-container {
            margin-left: 36px;
            margin-top: 4px;
            border-left: 1px solid #e7e5e4;
            padding-left: 12px;
            display: none;
            flex-direction: column;
            gap: 4px;
        }

        .submenu-container.open {
            display: flex;
        }

        .submenu-link {
            display: block;
            width: 100%;
            border-radius: 8px;
            padding: 8px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            color: #78716c; /* stone-500 */
            transition: all 0.2s ease;
        }

        .submenu-link:hover {
            background-color: rgba(231, 229, 228, 0.7);
            color: #29452A;
        }

        .submenu-link.active {
            background-color: #e4ebdf;
            color: #29452A;
        }

        /* Bottom Footer */
        .sidebar-bottom {
            border-top: 1px solid #e7e5e4;
            padding: 16px;
        }

        .sidebar-bottom-btn {
            display: flex;
            width: 100%;
            align-items: center;
            gap: 12px;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
            background: transparent;
        }

        .btn-help {
            margin-bottom: 4px;
            color: #57534e;
        }

        .btn-help:hover {
            background-color: rgba(231, 229, 228, 0.7);
        }

        .btn-logout {
            color: #dc2626; /* red-600 */
        }

        .btn-logout:hover {
            background-color: #fef2f2; /* red-50 */
        }

        /* Large screens (Desktop) */
        @media (min-width: 1024px) {
            .admin-sidebar {
                transform: translateX(0);
            }
            .sidebar-overlay {
                display: none !important;
            }
            .mobile-close-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    @php
        $menuSections = [
            [
                'title' => 'MAIN',
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'layout-dashboard',
                        'route' => 'admin.dashboard',
                    ],
                    [
                        'label' => 'Orders',
                        'icon' => 'shopping-bag',
                        'route' => 'admin.orders',
                        'badge' => '12',
                    ],
                    [
                        'label' => 'Products',
                        'icon' => 'package',
                        'route' => 'admin.products',
                    ],
                    [
                        'label' => 'Categories',
                        'icon' => 'tags',
                        'route' => 'admin.categories',
                    ],
                    [
                        'label' => 'Inventory',
                        'icon' => 'warehouse',
                        'route' => 'admin.inventory',
                        'badge' => '3',
                    ],
                    [
                        'label' => 'Customers',
                        'icon' => 'users',
                        'route' => 'admin.customers',
                    ],
                ],
            ],
            [
                'title' => 'ANALYTICS',
                'items' => [
                    [
                        'label' => 'Analytics',
                        'icon' => 'bar-chart-3',
                        'route' => 'admin.analytics',
                    ],
                ],
            ],
            [
                'title' => 'SYSTEM',
                'items' => [
                    [
                        'label' => 'Notifications',
                        'icon' => 'bell',
                        'route' => 'admin.notifications',
                    ],
                    [
                        'label' => 'Settings',
                        'icon' => 'settings',
                        'route' => 'admin.settings',
                    ],
                ],
            ],
        ];
    @endphp

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- Aside Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Brand -->
        <div class="sidebar-brand-container">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-link">
                <div class="brand-logo-icon">
                    <span>R</span>
                </div>

                <div class="brand-text-block">
                    <p class="brand-title">Riva Nair</p>
                    <p class="brand-subtitle">Admin</p>
                </div>
            </a>

            <button class="mobile-close-btn" onclick="closeSidebar()" aria-label="Close sidebar">
                <i data-lucide="x" style="width: 20px; height: 20px;"></i>
            </button>
        </div>

        <!-- Navigation -->
        <div class="sidebar-navigation">
            @foreach($menuSections as $section)
                <div class="menu-section">
                    <p class="menu-section-title">{{ $section['title'] }}</p>

                    <div class="menu-items-group">
                        @foreach($section['items'] as $item)
                            @php
                                $itemUrl = route($item['route']);
                                $itemPath = ltrim(parse_url($itemUrl, PHP_URL_PATH) ?? '', '/');
                                $isActive = request()->is($itemPath) || request()->is($itemPath . '/*');
                            @endphp

                            @if(isset($item['children']) && count($item['children']) > 0)
                                @php
                                    $hasActiveChild = collect($item['children'])->some(function($child) {
                                        $childUrl = route($child['route']);
                                        $childPath = ltrim(parse_url($childUrl, PHP_URL_PATH) ?? '', '/');
                                        return request()->is($childPath) || request()->is($childPath . '/*');
                                    });
                                @endphp
                                <div>
                                    <button 
                                        type="button" 
                                        class="nav-item-btn {{ $hasActiveChild ? 'active' : '' }}" 
                                        onclick="toggleSubmenu('{{ \Illuminate\Support\Str::slug($item['label']) }}', this)"
                                    >
                                        <span class="nav-item-left">
                                            <i data-lucide="{{ $item['icon'] }}" style="width: 18px; height: 18px;"></i>
                                            {{ $item['label'] }}
                                        </span>
                                        <i data-lucide="chevron-right" class="arrow-icon" style="width: 16px; height: 16px;"></i>
                                    </button>

                                    <div class="submenu-container {{ $hasActiveChild ? 'open' : '' }}" id="submenu-{{ \Illuminate\Support\Str::slug($item['label']) }}">
                                        @foreach($item['children'] as $child)
                                            @php
                                                $childUrl = route($child['route']);
                                                $childPath = ltrim(parse_url($childUrl, PHP_URL_PATH) ?? '', '/');
                                                $isChildActive = request()->is($childPath) || request()->is($childPath . '/*');
                                            @endphp
                                            <a 
                                                href="{{ route($child['route']) }}" 
                                                class="submenu-link {{ $isChildActive ? 'active' : '' }}"
                                            >
                                                {{ $child['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a 
                                    href="{{ route($item['route']) }}" 
                                    class="nav-item-btn {{ $isActive ? 'active' : '' }}"
                                >
                                    <span class="nav-item-left">
                                        <i data-lucide="{{ $item['icon'] }}" style="width: 18px; height: 18px;"></i>
                                        {{ $item['label'] }}
                                    </span>

                                    @if(isset($item['badge']))
                                        <span class="nav-badge {{ $item['label'] === 'Inventory' ? 'badge-inventory' : 'badge-default' }}">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bottom -->
        <div class="sidebar-bottom">
            <a href="{{ route('admin.helpandsupport') }}" class="sidebar-bottom-btn btn-help">
                <i data-lucide="circle-help" style="width: 18px; height: 18px;"></i>
                Help & Support
            </a>

            <form action="{{ route('logout') ?? '#' }}" method="POST" id="logout-form" style="display: none;">
                @csrf
            </form>

            <button 
                type="button" 
                onclick="document.getElementById('logout-form').submit();" 
                class="sidebar-bottom-btn btn-logout"
            >
                <i data-lucide="log-out" style="width: 18px; height: 18px;"></i>
                Logout
            </button>
        </div>
    </aside>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile Sidebar Controls
        function openSidebar() {
            document.getElementById('adminSidebar').classList.add('open');
            document.getElementById('sidebarOverlay').classList.add('active');
        }

        function closeSidebar() {
            document.getElementById('adminSidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('active');
        }

        // Submenu toggling logic
        function toggleSubmenu(id, buttonEl) {
            const submenu = document.getElementById('submenu-' + id);
            if (!submenu) return;

            const isOpen = submenu.classList.toggle('open');
            const arrowIcon = buttonEl.querySelector('.arrow-icon');

            if (arrowIcon) {
                arrowIcon.setAttribute('data-lucide', isOpen ? 'chevron-down' : 'chevron-right');
                lucide.createIcons();
            }
        }
    </script>
</body>
</html>