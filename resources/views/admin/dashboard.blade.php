@extends('layouts.admin')

@section('title', 'Admin Dashboard - Riva Nair')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-container {
        font-family: inherit;
        color: #111827;
        margin: -16px; /* Layout की padding offset करने के लिए */
    }

    @media (min-width: 640px) {
        .dashboard-container {
            margin: -24px;
        }
    }
    @media (min-width: 1024px) {
        .dashboard-container {
            margin: -32px;
        }
    }

    /* Top Greeting Banner */
    .dash-banner {
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid #E7E2D5;
        background-color: #EDE8D8;
    }

    .dash-banner-img {
        position: absolute;
        right: 0;
        top: 0;
        display: none;
        height: 100%;
        width: 50%;
        object-fit: cover;
        opacity: 0.7;
        mix-blend-mode: multiply;
        -webkit-mask-image: linear-gradient(to right, transparent, black 60%);
        mask-image: linear-gradient(to right, transparent, black 60%);
        pointer-events: none;
    }

    .dash-banner-inner {
        position: relative;
        max-width: 1280px;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        padding: 40px 16px 64px 16px;
    }

    .banner-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 32px;
        color: #1F2A22;
        line-height: 1.1;
    }

    .banner-desc {
        margin-top: 8px;
        max-width: 440px;
        font-size: 15px;
        line-height: 1.6;
        color: #4b5563;
    }

    .banner-actions {
        display: flex;
        gap: 12px;
    }

    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 12px;
        border: 1px solid #D9D3C1;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .btn-export:hover {
        background-color: #ffffff;
    }

    .btn-add-prod {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 12px;
        border: none;
        background-color: #3B5240;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 500;
        color: #ffffff;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .btn-add-prod:hover {
        background-color: #2F4234;
    }

    /* Content Area */
    .dash-main-content {
        position: relative;
        z-index: 10;
        max-width: 1280px;
        margin: -40px auto 56px auto;
        padding: 0 16px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* KPI Cards Grid */
    .kpi-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .kpi-card {
        border-radius: 16px;
        border: 1px solid #E7E2D5;
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    }

    .kpi-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kpi-title {
        font-size: 14px;
        color: #6b7280;
    }

    .kpi-icon-wrap {
        display: flex;
        height: 36px;
        width: 36px;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        color: #ffffff;
    }

    .kpi-value {
        margin-top: 12px;
        font-size: 30px;
        font-weight: 600;
        letter-spacing: -0.02em;
        color: #1F2A22;
        line-height: 1.1;
    }

    .kpi-growth {
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #6b7280;
    }

    .growth-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border-radius: 9999px;
        background-color: #ecfdf5;
        padding: 2px 8px;
        font-weight: 600;
        color: #047857;
    }

    /* Grid Split 8:4 */
    .dash-split-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    /* Reusable Card */
    .ui-card {
        border-radius: 16px;
        border: 1px solid #E7E2D5;
        background-color: #ffffff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    }

    .ui-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding: 24px 24px 0 24px;
    }

    .ui-card-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 18px;
        color: #1F2A22;
        line-height: 1.2;
    }

    .ui-card-subtitle {
        margin-top: 2px;
        font-size: 14px;
        color: #6b7280;
    }

    .ui-card-body {
        padding: 20px 24px 24px 24px;
    }

    .view-all-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 14px;
        font-weight: 500;
        color: #3B5240;
        text-decoration: none;
    }

    .view-all-link:hover {
        text-decoration: underline;
    }

    /* Range Pill Tabs */
    .pill-tabs {
        display: flex;
        gap: 4px;
        border-radius: 8px;
        background-color: #F4F1E8;
        padding: 4px;
    }

    .pill-tab-btn {
        border: none;
        background: transparent;
        border-radius: 6px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .pill-tab-btn:hover {
        background-color: #ffffff;
    }

    .pill-tab-btn.active {
        background-color: #3B5240;
        color: #ffffff;
    }

    /* SVG Sales Chart */
    .chart-layout {
        display: flex;
        gap: 12px;
    }

    .chart-y-axis {
        display: flex;
        height: 220px;
        flex-direction: column;
        justify-content: space-between;
        font-size: 12px;
        color: #9ca3af;
        user-select: none;
    }

    .chart-area-wrap {
        min-width: 0;
        flex: 1;
    }

    .chart-svg-container {
        position: relative;
        height: 220px;
        width: 100%;
    }

    .chart-svg {
        height: 220px;
        width: 100%;
        overflow: visible;
        display: block;
    }

    .chart-active-dot {
        pointer-events: none;
        position: absolute;
        height: 12px;
        width: 12px;
        transform: translate(-50%, -50%);
        border-radius: 9999px;
        border: 2px solid #ffffff;
        background-color: #3B5240;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        transition: left 0.1s ease, top 0.1s ease;
    }

    .chart-tooltip {
        pointer-events: none;
        position: absolute;
        transform: translate(-50%, -100%);
        border-radius: 8px;
        background-color: #1F2A22;
        padding: 8px 12px;
        font-size: 12px;
        color: #ffffff;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        white-space: nowrap;
        transition: left 0.1s ease, top 0.1s ease;
    }

    .chart-tooltip-sub {
        color: rgba(255, 255, 255, 0.6);
    }

    .chart-tooltip-val {
        font-weight: 600;
        margin-top: 2px;
    }

    .chart-x-axis {
        margin-top: 12px;
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #9ca3af;
        user-select: none;
    }

    /* Top Products List */
    .top-products-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .top-prod-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .top-prod-img {
        height: 44px;
        width: 44px;
        flex-shrink: 0;
        border-radius: 8px;
        background-color: #F4F1E8;
        object-fit: cover;
    }

    .top-prod-info {
        min-width: 0;
        flex: 1;
    }

    .top-prod-title-row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 8px;
    }

    .top-prod-name {
        font-size: 14px;
        font-weight: 500;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .top-prod-rev {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }

    .progress-bar-bg {
        margin-top: 6px;
        height: 6px;
        border-radius: 9999px;
        background-color: #f3f4f6;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 9999px;
        background-color: #5B7963;
    }

    .top-prod-units {
        margin-top: 4px;
        font-size: 12px;
        color: #6b7280;
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
        margin: 0 -8px;
    }

    .custom-table {
        width: 100%;
        min-width: 560px;
        text-align: left;
        font-size: 14px;
        border-collapse: collapse;
    }

    .custom-table th {
        padding: 0 8px 12px 8px;
        font-size: 12px;
        font-weight: 500;
        color: #9ca3af;
    }

    .custom-table td {
        padding: 14px 8px;
        border-top: 1px solid #f3f4f6;
    }

    .custom-table tbody tr:hover {
        background-color: #FAF8F2;
    }

    .cust-avatar {
        display: flex;
        height: 28px;
        width: 28px;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        background-color: #E5EBE3;
        font-size: 12px;
        font-weight: 600;
        color: #3B5240;
        flex-shrink: 0;
    }

    .cust-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .action-icon-btn {
        background: transparent;
        border: none;
        border-radius: 4px;
        padding: 4px;
        color: #9ca3af;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .action-icon-btn:hover {
        background-color: #f3f4f6;
        color: #111827;
    }

    /* Order Status Pill */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 9999px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pill::before {
        content: "";
        height: 6px;
        width: 6px;
        border-radius: 9999px;
    }

    .status-processing {
        background-color: #eff6ff;
        color: #1d4ed8;
    }
    .status-processing::before { background-color: #3b82f6; }

    .status-shipped {
        background-color: #f5f3ff;
        color: #6d28d9;
    }
    .status-shipped::before { background-color: #8b5cf6; }

    .status-delivered {
        background-color: #ecfdf5;
        color: #047857;
    }
    .status-delivered::before { background-color: #10b981; }

    .status-pending {
        background-color: #fffbeb;
        color: #b45309;
    }
    .status-pending::before { background-color: #f59e0b; }

    /* Low Stock List */
    .low-stock-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .low-stock-item {
        display: flex;
        align-items: center;
        gap: 12px;
        border-radius: 12px;
        border: 1px solid #f3f4f6;
        padding: 12px;
    }

    .stock-badge-critical {
        margin-top: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border-radius: 9999px;
        background-color: #fef2f2;
        padding: 2px 8px;
        font-size: 11px;
        font-weight: 600;
        color: #dc2626;
    }

    .stock-badge-low {
        margin-top: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border-radius: 9999px;
        background-color: #fffbeb;
        padding: 2px 8px;
        font-size: 11px;
        font-weight: 600;
        color: #b45309;
    }

    /* Responsive Queries */
    @media (min-width: 640px) {
        .dash-banner-inner {
            padding-left: 24px;
            padding-right: 24px;
        }
        .dash-main-content {
            padding: 0 24px;
        }
        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 768px) {
        .dash-banner-img {
            display: block;
        }
        .banner-title {
            font-size: 36px;
        }
    }

    @media (min-width: 1024px) {
        .dash-banner-inner {
            padding-left: 32px;
            padding-right: 32px;
        }
        .dash-main-content {
            padding: 0 32px;
        }
        .kpi-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        .dash-split-grid {
            grid-template-columns: repeat(12, 1fr);
        }
        .col-span-8 {
            grid-column: span 8 / span 8;
        }
        .col-span-4 {
            grid-column: span 4 / span 4;
        }
    }
</style>

@php
    $hour = date('H');$greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

    $stats = [
        ['title' => 'Revenue', 'value' => '₹1,84,650', 'change' => '12.5%', 'icon' => 'indian-rupee', 'tint' => '#3B5240'],
        ['title' => 'Orders', 'value' => '428', 'change' => '8.2%', 'icon' => 'shopping-bag', 'tint' => '#B98A4E'],
        ['title' => 'Products sold', 'value' => '1,284', 'change' => '15.4%', 'icon' => 'package', 'tint' => '#B4644F'],
        ['title' => 'Customers', 'value' => '892', 'change' => '10.8%', 'icon' => 'users', 'tint' => '#5F7FAE'],
    ];

    $topProducts = [
        ['name' => 'Peri Peri Makhana', 'units' => 328, 'revenue' => '₹81,672', 'share' => 80],
        ['name' => 'Pudina Makhana', 'units' => 267, 'revenue' => '₹66,483', 'share' => 65],
        ['name' => 'Himalayan Salt Makhana', 'units' => 231, 'revenue' => '₹53,649', 'share' => 55],
        ['name' => 'Classic Makhana', 'units' => 198, 'revenue' => '₹45,342', 'share' => 45],
        ['name' => 'Achari Makhana', 'units' => 162, 'revenue' => '₹38,921', 'share' => 35],
    ];

    $recentOrders = [
        ['id' => 'RN10241', 'customer' => 'Priya Sharma', 'items' => 3, 'total' => '₹697', 'status' => 'Processing', 'date' => '29 Sep'],
        ['id' => 'RN10240', 'customer' => 'Rahul Kumar', 'items' => 2, 'total' => '₹449', 'status' => 'Shipped', 'date' => '29 Sep'],
        ['id' => 'RN10239', 'customer' => 'Ananya Singh', 'items' => 5, 'total' => '₹1,249', 'status' => 'Delivered', 'date' => '28 Sep'],
        ['id' => 'RN10238', 'customer' => 'Vikram Das', 'items' => 1, 'total' => '₹249', 'status' => 'Pending', 'date' => '28 Sep'],
    ];

    $lowStock = [
        ['name' => 'Achari Makhana', 'weight' => '100g', 'units' => 7, 'level' => 'Critical'],
        ['name' => 'Himalayan Salt Makhana', 'weight' => '100g', 'units' => 12, 'level' => 'Low'],
        ['name' => 'Peri Peri Makhana', 'weight' => '100g', 'units' => 18, 'level' => 'Low'],
        ['name' => 'Cheese Makhana', 'weight' => '100g', 'units' => 22, 'level' => 'Low'],
    ];

    $ranges = ['7D', '30D', '3M', '6M', '1Y'];$bowlImgUrl = asset('assets/home/bowl.png');
@endphp

<div class="dashboard-container">
    <!-- Top Greeting Banner -->
    <div class="dash-banner">
        <img src="{{ $bowlImgUrl }}" alt="" class="dash-banner-img" onerror="this.style.display='none'">
        
        <div class="dash-banner-inner">
            <div>
                <h1 class="banner-title">{{ $greeting }}, Admin</h1>
                <p class="banner-desc">
                    Here's how Riva Nair Makhana is doing this month. Sales are up 12.5% and Achari Makhana needs restocking.
                </p>
            </div>
            <div class="banner-actions">
                <button type="button" class="btn-export">
                    <i data-lucide="download" style="width: 16px; height: 16px;"></i> Export report
                </button>
                <button type="button" class="btn-add-prod">
                    <i data-lucide="plus" style="width: 16px; height: 16px;"></i> Add product
                </button>
            </div>
        </div>
    </div>

    <!-- Main Analytics Body -->
    <div class="dash-main-content">
        <!-- KPIs Grid -->
        <div class="kpi-grid">
            @foreach($stats as $s)
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">{{ $s['title'] }}</span>
                        <span class="kpi-icon-wrap" style="background-color: {{ $s['tint'] }};">
                            <i data-lucide="{{ $s['icon'] }}" style="width: 18px; height: 18px;"></i>
                        </span>
                    </div>
                    <p class="kpi-value">{{ $s['value'] }}</p>
                    <p class="kpi-growth">
                        <span class="growth-badge">
                            <i data-lucide="trending-up" style="width: 12px; height: 12px;"></i> {{ $s['change'] }}
                        </span>
                        vs last month
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Sales Chart + Top Products -->
        <div class="dash-split-grid">
            <!-- Chart Section (8 cols) -->
            <section class="ui-card col-span-8">
                <header class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">Sales overview</h2>
                        <p class="ui-card-subtitle">Daily revenue, September 2026</p>
                    </div>
                    <div class="pill-tabs" role="tablist">
                        @foreach($ranges as $r)
                            <button 
                                type="button" 
                                class="pill-tab-btn {{ $r === '30D' ? 'active' : '' }}" 
                                onclick="switchRange(this, '{{ $r }}')"
                            >
                                {{ $r }}
                            </button>
                        @endforeach
                    </div>
                </header>

                <div class="ui-card-body">
                    <div class="chart-layout">
                        <!-- Y Ticks -->
                        <div class="chart-y-axis">
                            <span>₹80K</span>
                            <span>₹60K</span>
                            <span>₹40K</span>
                            <span>₹20K</span>
                            <span>0</span>
                        </div>

                        <!-- Graph Area -->
                        <div class="chart-area-wrap">
                            <div class="chart-svg-container" id="chartContainer">
                                <svg id="salesSvg" viewBox="0 0 600 220" preserveAspectRatio="none" class="chart-svg">
                                    <defs>
                                        <linearGradient id="chartFill" x1="0" x2="0" y1="0" y2="1">
                                            <stop offset="0%" stop-color="#3B5240" stop-opacity="0.22" />
                                            <stop offset="100%" stop-color="#3B5240" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <!-- Grid lines rendered via JS -->
                                    <g id="gridLines"></g>
                                    <!-- Area Path -->
                                    <path id="chartArea" fill="url(#chartFill)"></path>
                                    <!-- Line Path -->
                                    <path id="chartLine" fill="none" stroke="#3B5240" stroke-width="2.5" stroke-linejoin="round" vector-effect="non-scaling-stroke"></path>
                                    <!-- Active Guide Line -->
                                    <line id="guideLine" x1="0" x2="0" y1="0" y2="220" stroke="#3B5240" stroke-dasharray="3 4" opacity="0.4" vector-effect="non-scaling-stroke"></line>
                                    <!-- Interactive hit zones -->
                                    <g id="hoverColumns"></g>
                                </svg>

                                <!-- Active Dot Marker -->
                                <span class="chart-active-dot" id="activeDot"></span>

                                <!-- Tooltip -->
                                <div class="chart-tooltip" id="chartTooltip">
                                    <p class="chart-tooltip-sub" id="tooltipDay">25 Sep</p>
                                    <p class="chart-tooltip-val" id="tooltipRevenue">₹42,000</p>
                                </div>
                            </div>

                            <!-- X Axis -->
                            <div class="chart-x-axis">
                                <span>1 Sep</span>
                                <span>5 Sep</span>
                                <span>10 Sep</span>
                                <span>15 Sep</span>
                                <span>20 Sep</span>
                                <span>25 Sep</span>
                                <span>30 Sep</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Top Products (4 cols) -->
            <section class="ui-card col-span-4">
                <header class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">Top products</h2>
                        <p class="ui-card-subtitle">By units sold this month</p>
                    </div>
                    <a href="#" class="view-all-link">
                        View all <i data-lucide="arrow-up-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </header>

                <div class="ui-card-body">
                    <ul class="top-products-list">
                        @foreach($topProducts as $p)
                            <li class="top-prod-item">
                                <img src="{{ $bowlImgUrl }}" alt="" class="top-prod-img" onerror="this.src='https://placehold.co/88x88/f4f1e8/3B5240?text=Makhana'">
                                <div class="top-prod-info">
                                    <div class="top-prod-title-row">
                                        <h3 class="top-prod-name">{{ $p['name'] }}</h3>
                                        <span class="top-prod-rev">{{ $p['revenue'] }}</span>
                                    </div>
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill" style="width: {{ $p['share'] }}%;"></div>
                                    </div>
                                    <p class="top-prod-units">{{ $p['units'] }} units</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>

        <!-- Orders Table + Low Stock Alerts -->
        <div class="dash-split-grid">
            <!-- Recent Orders (8 cols) -->
            <section class="ui-card col-span-8">
                <header class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">Recent orders</h2>
                        <p class="ui-card-subtitle">Latest activity from your store</p>
                    </div>
                    <a href="#" class="view-all-link">
                        View all <i data-lucide="arrow-up-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </header>

                <div class="ui-card-body">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $o)
                                    <tr>
                                        <td style="font-weight: 600;">#{{ $o['id'] }}</td>
                                        <td>
                                            <div class="cust-wrapper">
                                                <span class="cust-avatar">{{ substr($o['customer'], 0, 1) }}</span>
                                                <span>{{ $o['customer'] }}</span>
                                            </div>
                                        </td>
                                        <td style="color: #6b7280;">{{ $o['items'] }} {{$o['items'] == 1 ? 'item' : 'items' }}</td>
                                        <td style="font-weight: 600;">{{ $o['total'] }}</td>
                                        <td>
                                            <span class="status-pill status-{{ strtolower($o['status']) }}">
                                                {{ $o['status'] }}
                                            </span>
                                        </td>
                                        <td style="color: #6b7280;">{{ $o['date'] }}</td>
                                        <td style="text-align: right;">
                                            <button type="button" class="action-icon-btn" aria-label="Order Options">
                                                <i data-lucide="more-vertical" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Low Stock (4 cols) -->
            <section class="ui-card col-span-4">
                <header class="ui-card-header">
                    <div>
                        <h2 class="ui-card-title">Low stock</h2>
                        <p class="ui-card-subtitle">Restock these soon</p>
                    </div>
                    <a href="#" class="view-all-link">
                        View all <i data-lucide="arrow-up-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </header>

                <div class="ui-card-body">
                    <ul class="low-stock-list">
                        @foreach($lowStock as $item)
                            @php $isCritical =$item['level'] === 'Critical'; @endphp
                            <li class="low-stock-item">
                                <img src="{{ $bowlImgUrl }}" alt="" class="top-prod-img" style="height: 40px; width: 40px;" onerror="this.src='https://placehold.co/80x80/f4f1e8/3B5240?text=Item'">
                                <div class="top-prod-info">
                                    <h3 class="top-prod-name">{{ $item['name'] }}</h3>
                                    <p class="top-prod-units">{{ $item['weight'] }} pack</p>
                                </div>
                                <div style="text-align: right;">
                                    <p style="font-size: 14px; font-weight: 600;">{{ $item['units'] }} left</p>
                                    <span class="{{ $isCritical ? 'stock-badge-critical' : 'stock-badge-low' }}">
                                        @if($isCritical)
                                            <i data-lucide="alert-triangle" style="width: 10px; height: 10px;"></i>
                                        @endif
                                        {{ $item['level'] }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    // Sales Chart Data
    const rawSales = [3, 4, 6, 8, 9, 10, 11, 12, 10, 9, 13, 15, 17, 19, 17, 16, 18, 22, 28, 30, 29, 32, 28, 35, 33, 42, 40, 48, 52, 58];
    const salesData = rawSales.map((v, i) => ({ day: i + 1, revenue: v * 1000 }));

    const W = 600, H = 220, maxRevenue = 80000;
    const getX = (i) => (i / (salesData.length - 1)) * W;
    const getY = (val) => H - (val / maxRevenue) * H;

    // Build Static Paths
    const points = salesData.map((d, i) => `${i === 0 ? 'M' : 'L'}${getX(i).toFixed(1)},${getY(d.revenue).toFixed(1)}`);
    const linePathStr = points.join(' ');
    const areaPathStr = `${linePathStr} L${W},${H} L0,${H} Z`;

    document.getElementById('chartLine').setAttribute('d', linePathStr);
    document.getElementById('chartArea').setAttribute('d', areaPathStr);

    // Draw horizontal grid lines
    const gridContainer = document.getElementById('gridLines');
    for (let i = 0; i <= 4; i++) {
        const yPos = (i / 4) * H;
        const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        line.setAttribute('x1', '0');
        line.setAttribute('x2', W.toString());
        line.setAttribute('y1', yPos.toString());
        line.setAttribute('y2', yPos.toString());
        line.setAttribute('stroke', '#EEEAE0');
        line.setAttribute('vector-effect', 'non-scaling-stroke');
        gridContainer.appendChild(line);
    }

    // Draw invisible hit zones for hover
    const hoverColsGroup = document.getElementById('hoverColumns');
    salesData.forEach((d, i) => {
        const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        rect.setAttribute('x', (getX(i) - W / 60).toString());
        rect.setAttribute('y', '0');
        rect.setAttribute('width', (W / 30).toString());
        rect.setAttribute('height', H.toString());
        rect.setAttribute('fill', 'transparent');
        rect.style.cursor = 'pointer';
        rect.addEventListener('mouseenter', () => updateChartHighlight(i));
        hoverColsGroup.appendChild(rect);
    });

    function updateChartHighlight(index) {
        const point = salesData[index];
        const pctX = (index / (salesData.length - 1)) * 100;
        const pctY = (getY(point.revenue) / H) * 100;

        // Position Marker Dot
        const dot = document.getElementById('activeDot');
        dot.style.left = `${pctX}%`;
        dot.style.top = `${pctY}%`;

        // Position Guide Line
        const guide = document.getElementById('guideLine');
        guide.setAttribute('x1', getX(index).toString());
        guide.setAttribute('x2', getX(index).toString());

        // Update Tooltip
        const tooltip = document.getElementById('chartTooltip');
        document.getElementById('tooltipDay').innerText = `${point.day} Sep`;
        document.getElementById('tooltipRevenue').innerText = `₹${point.revenue.toLocaleString('en-IN')}`;

        // Constrain tooltip horizontally so it stays inside parent
        const boundedLeft = Math.min(90, Math.max(10, pctX));
        tooltip.style.left = `${boundedLeft}%`;
        tooltip.style.top = `calc(${pctY}% - 14px)`;
    }

    // Default position (index length - 5)
    updateChartHighlight(salesData.length - 5);

    // Range Switcher interaction
    function switchRange(btn, val) {
        document.querySelectorAll('.pill-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    // Icons Render
    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection