<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Riva Nair')</title>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* CSS Reset & Defaults */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #F3F2ED;
            color: #24251F;
        }

        .admin-layout-wrapper {
            min-height: 100vh;
            background-color: #F3F2ED;
        }

        /* Main Content Container */
        .admin-main {
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* Header Styles */
        .admin-header {
            position: sticky;
            top: 0;
            z-index: 30;
            display: flex;
            height: 72px;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e7e5e4; /* stone-200 */
            background-color: rgba(248, 247, 242, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding-left: 16px;
            padding-right: 16px;
        }

        /* Header Left */
        .header-left {
            display: flex;
            min-width: 0;
            align-items: center;
            gap: 12px;
        }

        .mobile-toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            border-radius: 12px;
            padding: 8px;
            color: #57534e; /* stone-600 */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .mobile-toggle-btn:hover {
            background-color: #e7e5e4; /* stone-200 */
        }

        /* Search Bar */
        .search-box-wrapper {
            position: relative;
            display: none;
            width: 320px;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #a8a29e; /* stone-400 */
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .search-input {
            height: 44px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid #e7e5e4;
            background-color: rgba(255, 255, 255, 0.7);
            padding-left: 44px;
            padding-right: 16px;
            font-size: 14px;
            color: #44403c; /* stone-700 */
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .search-input::placeholder {
            color: #a8a29e;
        }

        .search-input:focus {
            border-color: #29452A;
            box-shadow: 0 0 0 2px rgba(41, 69, 42, 0.1);
        }

        /* Mobile Brand Info */
        .mobile-brand-info {
            display: block;
        }

        .mobile-brand-title {
            font-family: Georgia, Cambria, "Times New Roman", Times, serif;
            font-size: 18px;
            font-weight: 600;
            color: #24251F;
            line-height: 1.2;
        }

        .mobile-brand-sub {
            font-size: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #78716c; /* stone-500 */
        }

        /* Header Right */
        .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Date Filter Button */
        .date-filter-btn {
            display: none;
            height: 44px;
            align-items: center;
            gap: 8px;
            border-radius: 12px;
            border: 1px solid #e7e5e4;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 0 12px;
            font-size: 14px;
            font-weight: 500;
            color: #44403c;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .date-filter-btn:hover {
            background-color: #ffffff;
        }

        /* Notifications */
        .notification-btn {
            position: relative;
            display: flex;
            height: 44px;
            width: 44px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: 1px solid #e7e5e4;
            background-color: rgba(255, 255, 255, 0.7);
            color: #57534e;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .notification-btn:hover {
            background-color: #ffffff;
        }

        .notification-badge {
            position: absolute;
            right: 4px;
            top: 4px;
            display: flex;
            height: 17px;
            min-width: 17px;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background-color: #E76F51;
            padding: 0 4px;
            font-size: 9px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1;
        }

        /* Divider */
        .header-divider {
            display: none;
            height: 32px;
            width: 1px;
            background-color: #e7e5e4;
        }

        /* Admin Profile Button */
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 12px;
            padding: 6px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .profile-btn:hover {
            background-color: rgba(231, 229, 228, 0.6);
        }

        .profile-avatar {
            display: flex;
            height: 40px;
            width: 40px;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background-color: #29452A;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            flex-shrink: 0;
        }

        .profile-info {
            display: none;
            text-align: left;
        }

        .profile-name {
            font-size: 14px;
            font-weight: 600;
            color: #24251F;
            line-height: 1.2;
        }

        .profile-role {
            font-size: 11px;
            color: #78716c;
        }

        .profile-chevron {
            display: none;
            color: #a8a29e;
        }

        /* Page Content Slot */
        .admin-page-content {
            padding: 16px;
        }

        /* Responsive Breakpoints */
        @media (min-width: 640px) {
            .admin-header {
                padding-left: 24px;
                padding-right: 24px;
            }
            .header-right {
                gap: 16px;
            }
            .date-filter-btn {
                display: flex;
            }
            .header-divider {
                display: block;
            }
            .profile-info {
                display: block;
            }
            .profile-chevron {
                display: block;
            }
            .admin-page-content {
                padding: 24px;
            }
        }

        @media (min-width: 768px) {
            .search-box-wrapper {
                display: block;
            }
            .mobile-brand-info {
                display: none;
            }
        }

        @media (min-width: 1024px) {
            .admin-sidebar {
                transform: translateX(0) !important;
            }
            .sidebar-overlay {
                display: none !important;
            }
            .mobile-close-btn,
            .mobile-toggle-btn {
                display: none !important;
            }
            .admin-main {
                margin-left: 270px;
            }
            .admin-header {
                padding-left: 32px;
                padding-right: 32px;
            }
            .search-box-wrapper {
                width: 400px;
            }
            .admin-page-content {
                padding: 32px;
            }
        }
    </style>
</head>
<body>

    <div class="admin-layout-wrapper">

        {{-- Sidebar Component --}}
        @include('components.admin.admin-sidebar')

        <!-- Main Content Area -->
        <main class="admin-main">

            <!-- ================= HEADER ================= -->
            <header class="admin-header">

                <!-- Left Side -->
                <div class="header-left">
                    <!-- Mobile Menu Toggle Button -->
                    <button type="button" class="mobile-toggle-btn" onclick="openSidebar()" aria-label="Open Menu">
                        <i data-lucide="menu" style="width: 22px; height: 22px;"></i>
                    </button>

                    <!-- Search Input -->
                    <div class="search-box-wrapper">
                        <div class="search-icon">
                            <i data-lucide="search" style="width: 18px; height: 18px;"></i>
                        </div>
                        <input
                            type="text"
                            placeholder="Search orders, products, customers..."
                            class="search-input"
                        />
                    </div>

                    <!-- Mobile Brand -->
                    <div class="mobile-brand-info">
                        <p class="mobile-brand-title">Riva Nair</p>
                        <p class="mobile-brand-sub">Makhana Admin</p>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="header-right">

                    <!-- Date Filter -->
                    <button type="button" class="date-filter-btn">
                        <i data-lucide="calendar-days" style="width: 17px; height: 17px; color: #78716c;"></i>
                        <span>Last 30 Days</span>
                        <i data-lucide="chevron-down" style="width: 15px; height: 15px; color: #a8a29e; margin-left: 4px;"></i>
                    </button>

                    <!-- Notifications Button -->
                    <button type="button" class="notification-btn" aria-label="Notifications">
                        <i data-lucide="bell" style="width: 19px; height: 19px;"></i>
                        <span class="notification-badge">3</span>
                    </button>

                    <!-- Divider -->
                    <div class="header-divider"></div>

                    <!-- Admin Profile Button -->
                    <button type="button" class="profile-btn">
                        <div class="profile-avatar">A</div>

                        <div class="profile-info">
                            <p class="profile-name">Admin</p>
                            <p class="profile-role">Super Admin</p>
                        </div>

                        <i data-lucide="chevron-down" class="profile-chevron" style="width: 16px; height: 16px;"></i>
                    </button>
                </div>
            </header>

            <!-- ================= PAGE CONTENT ================= -->
            <div class="admin-page-content">
                @yield('content')
            </div>

        </main>
    </div>

    <script>
        // Icons Render
        lucide.createIcons();
    </script>
</body>
</html>