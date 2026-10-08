@extends('layouts.admin')

@section('title', 'Orders Management - Riva Nair')

@section('content')
<style>
    /* Base Container & Grid */
    .orders-page-wrapper {
        font-family: inherit;
        color: #111827;
        padding: 0px;
        background-color: #F5F2EA;
        min-height: calc(100vh - 72px);
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
    }

    @media (min-width: 640px) {
        .orders-page-wrapper { padding: 0px; }
    }
    @media (min-width: 1024px) {
        .orders-page-wrapper { padding: 0px; }
    }

    .orders-grid-container {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        align-items: start;
        box-sizing: border-box;
    }

    @media (min-width: 1280px) {
        .orders-grid-container {
            grid-template-columns: minmax(0, 1.45fr) minmax(0, 1fr);
        }
    }

    /* Panels Common */
    .orders-card {
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow: hidden;
    }

    .left-panel {
        background-color: #ffffff;
        padding: 16px;
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 640px) {
        .left-panel { padding: 20px; }
    }

    .right-panel {
        background-color: #FAFAF8;
    }

    /* Header Section */
    .orders-header {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 20px;
    }

    @media (min-width: 640px) {
        .orders-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
        }
    }

    .orders-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 24px;
        color: #111827;
        line-height: 1.1;
    }

    @media (min-width: 640px) {
        .orders-title { font-size: 28px; }
    }

    .orders-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .orders-header-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-export-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1px solid #E5E2D9;
        background-color: #ffffff;
        color: #374151;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .btn-export-sm:hover { background-color: #f9fafb; }

    .btn-create-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        background-color: #3B5240;
        color: #ffffff;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .btn-create-order:hover { background-color: #2A3C2E; }

    /* KPI Cards */
    .kpi-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        margin-bottom: 20px;
    }

    @media (min-width: 480px) {
        .kpi-row { grid-template-columns: repeat(3, 1fr); }
    }
    @media (min-width: 1024px) {
        .kpi-row { grid-template-columns: repeat(6, 1fr); }
    }

    .status-kpi-card {
        border-radius: 12px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .status-kpi-card:hover { transform: translateY(-2px); }

    .kpi-icon-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .kpi-count {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    .kpi-all { background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
    .kpi-pending { background-color: #ffffff; border: 1px solid #ffedd5; color: #ea580c; }
    .kpi-processing { background-color: #ffffff; border: 1px solid #f3e8ff; color: #9333ea; }
    .kpi-shipped { background-color: #ffffff; border: 1px solid #dbeafe; color: #2563eb; }
    .kpi-delivered { background-color: #ffffff; border: 1px solid #dcfce7; color: #16a34a; }
    .kpi-cancelled { background-color: #ffffff; border: 1px solid #fee2e2; color: #dc2626; }

    /* Filters Bar */
    .search-filter-area {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 16px;
    }

    .search-box-field {
        position: relative;
        width: 100%;
    }

    .search-box-field i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .search-input-field {
        width: 100%;
        background-color: #F8F6F0;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 9px 14px 9px 36px;
        font-size: 12px;
        color: #374151;
        outline: none;
        box-sizing: border-box;
    }

    .search-input-field:focus { border-color: #3B5240; }

    .filter-options-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .filter-dropdown-btn {
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 7px 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #ffffff;
        font-size: 11px;
        color: #4b5563;
        flex: 1 1 120px;
        min-width: 110px;
        cursor: pointer;
    }

    .filter-dropdown-btn:hover { background-color: #f9fafb; }

    .clear-filters-btn {
        border: none;
        background: transparent;
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        padding: 6px 4px;
    }

    .clear-filters-btn:hover { color: #111827; }

    /* Table Styles */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 8px;
        border: 1px solid #f3f4f6;
    }

    .orders-table {
        width: 100%;
        min-width: 640px;
        text-align: left;
        border-collapse: collapse;
        font-size: 12px;
    }

    .orders-table th {
        background-color: #F8F6F0;
        padding: 10px 8px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }

    .orders-table td {
        padding: 10px 8px;
        border-bottom: 1px solid #f9fafb;
        white-space: nowrap;
    }

    .orders-table tr {
        cursor: pointer;
        transition: background-color 0.15s;
    }

    .orders-table tr:hover { background-color: #f9fafb; }
    .orders-table tr.active-row { background-color: #F8F6F0 !important; }
    .orders-table tr.selected-row { background-color: #f3f4f6; }

    .customer-info-box {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .customer-init-avatar {
        width: 26px;
        height: 26px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 8px;
        border-radius: 9999px;
        font-size: 10px;
        font-weight: 700;
    }

    .status-badge .dot {
        width: 5px;
        height: 5px;
        border-radius: 9999px;
        margin-right: 5px;
    }

    .status-Processing { background-color: #f3e8ff; color: #9333ea; }
    .status-Processing .dot { background-color: #9333ea; }

    .status-Shipped { background-color: #dbeafe; color: #2563eb; }
    .status-Shipped .dot { background-color: #2563eb; }

    .status-Delivered { background-color: #dcfce7; color: #16a34a; }
    .status-Delivered .dot { background-color: #16a34a; }

    .status-Pending { background-color: #ffedd5; color: #ea580c; }
    .status-Pending .dot { background-color: #ea580c; }

    .status-Cancelled { background-color: #fee2e2; color: #dc2626; }
    .status-Cancelled .dot { background-color: #dc2626; }

    /* Bulk Footer Actions */
    .table-footer-controls {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #E5E2D9;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 12px;
    }

    @media (min-width: 640px) {
        .table-footer-controls {
            flex-direction: row;
            align-items: center;
        }
    }

    .bulk-action-btns {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .selected-count-badge {
        font-size: 11px;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .action-btn-sm {
        font-size: 11px;
        font-weight: 500;
        background: transparent;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        color: #4b5563;
        padding: 4px 6px;
    }

    .action-btn-sm:hover { color: #111827; }
    .action-btn-sm:disabled { color: #d1d5db; cursor: not-allowed; }

    /* Right Panel / Details */
    .right-panel-body {
        padding: 16px;
    }

    @media (min-width: 640px) {
        .right-panel-body { padding: 20px; }
    }

    .right-panel-header {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 8px;
    }

    @media (min-width: 480px) {
        .right-panel-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
        }
    }

    .detail-grid-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    @media (min-width: 640px) {
        .detail-grid-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    .detail-section-title {
        font-size: 13px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .items-order-box {
        border-right: none;
        padding-right: 0;
        border-bottom: 1px solid #E5E2D9;
        padding-bottom: 16px;
    }

    @media (min-width: 640px) {
        .items-order-box {
            border-right: 1px solid #E5E2D9;
            padding-right: 16px;
            border-bottom: none;
            padding-bottom: 0;
        }
    }

    .order-item-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        gap: 4px;
    }

    .order-item-avatar {
        width: 28px;
        height: 36px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 11px;
        margin-right: 6px;
        flex-shrink: 0;
    }

    /* Dynamic Order Timeline */
    .timeline-wrap {
        position: relative;
        border-left: 1px solid #e5e7eb;
        margin-left: 12px;
        padding-bottom: 8px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .timeline-step {
        position: relative;
        padding-left: 20px;
    }

    .timeline-icon-box {
        position: absolute;
        left: -9px;
        top: 2px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Notes Area */
    .note-input-container {
        position: relative;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        background: #ffffff;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .note-textarea {
        width: 100%;
        padding: 8px 50px 8px 8px;
        font-size: 11px;
        outline: none;
        resize: none;
        border: none;
        background: transparent;
        color: #4b5563;
        box-sizing: border-box;
    }

    .note-add-btn {
        position: absolute;
        bottom: 6px;
        right: 6px;
        background-color: #3B5240;
        color: #ffffff;
        padding: 3px 10px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 500;
        border: none;
        cursor: pointer;
    }

    .note-add-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .single-note-card {
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 8px 10px;
        position: relative;
        margin-bottom: 8px;
    }
</style>

@php
    $orders = [
        [
            'id' => '#RN10241', 'init' => 'P', 'name' => 'Priya Sharma', 'email' => 'priya@gmail.com', 'phone' => '+91 98765 43210', 
            'address' => "B-204, Green Park Apartment\nPatna, Bihar - 800020\nIndia",
            'payMethod' => 'UPI', 'status' => 'Processing', 'date' => '30 Sep 2026', 'time' => '10:42 AM', 'courier' => 'Delhivery', 'tracking' => '1234567890',
            'items' => [
                ['name' => 'Peri Peri Makhana', 'size' => '100g', 'price' => 249, 'qty' => 2, 'total' => 498, 'bgColor' => '#991b1b'],
                ['name' => 'Pudina Makhana', 'size' => '100g', 'price' => 249, 'qty' => 1, 'total' => 249, 'bgColor' => '#166534']
            ],
            'discount' => 75, 'shipping' => 0
        ],
        [
            'id' => '#RN10240', 'init' => 'R', 'name' => 'Rahul Kumar', 'email' => 'rahul@gmail.com', 'phone' => '+91 87654 32109', 
            'address' => "55, Lake View Road\nBhopal, MP - 462001\nIndia",
            'payMethod' => 'Card', 'status' => 'Shipped', 'date' => '30 Sep 2026', 'time' => '09:15 AM', 'courier' => 'BlueDart', 'tracking' => 'BD9876543',
            'items' => [
                ['name' => 'Salted Caramel Makhana', 'size' => '100g', 'price' => 249, 'qty' => 1, 'total' => 249, 'bgColor' => '#a16207'],
                ['name' => 'Cheese Makhana', 'size' => '100g', 'price' => 200, 'qty' => 1, 'total' => 200, 'bgColor' => '#ea580c']
            ],
            'discount' => 0, 'shipping' => 40
        ],
        [
            'id' => '#RN10239', 'init' => 'A', 'name' => 'Ananya Singh', 'email' => 'ananya@gmail.com', 'phone' => '+91 76543 21098', 
            'address' => "Sector 4, HSR Layout\nBangalore, KA - 560102\nIndia",
            'payMethod' => 'COD', 'status' => 'Delivered', 'date' => '29 Sep 2026', 'time' => '02:30 PM', 'courier' => 'Ecom Express', 'tracking' => 'EE1122334',
            'items' => [
                ['name' => 'Classic Salted Makhana', 'size' => '200g', 'price' => 249, 'qty' => 5, 'total' => 1245, 'bgColor' => '#1f2937']
            ],
            'discount' => 100, 'shipping' => 0
        ],
        [
            'id' => '#RN10238', 'init' => 'V', 'name' => 'Vikram Das', 'email' => 'vikram@gmail.com', 'phone' => '+91 65432 10987', 
            'address' => "12, C.R. Park\nNew Delhi, DL - 110019\nIndia",
            'payMethod' => 'UPI', 'status' => 'Pending', 'date' => '29 Sep 2026', 'time' => '11:20 AM', 'courier' => 'Pending', 'tracking' => 'Pending',
            'items' => [
                ['name' => 'Pudina Makhana', 'size' => '100g', 'price' => 249, 'qty' => 1, 'total' => 249, 'bgColor' => '#166534']
            ],
            'discount' => 0, 'shipping' => 50
        ],
        [
            'id' => '#RN10237', 'init' => 'N', 'name' => 'Neha Patel', 'email' => 'neha@gmail.com', 'phone' => '+91 54321 09876', 
            'address' => "Vastrapur\nAhmedabad, GJ - 380015\nIndia",
            'payMethod' => 'Card', 'status' => 'Processing', 'date' => '28 Sep 2026', 'time' => '04:45 PM', 'courier' => 'Delhivery', 'tracking' => '100200300',
            'items' => [
                ['name' => 'Peri Peri Makhana', 'size' => '100g', 'price' => 249, 'qty' => 4, 'total' => 996, 'bgColor' => '#991b1b']
            ],
            'discount' => 50, 'shipping' => 0
        ],
        [
            'id' => '#RN10236', 'init' => 'S', 'name' => 'Saurav Mehta', 'email' => 'saurav@gmail.com', 'phone' => '+91 99887 76655', 
            'address' => "Andheri West\nMumbai, MH - 400053\nIndia",
            'payMethod' => 'COD', 'status' => 'Cancelled', 'date' => '28 Sep 2026', 'time' => '01:10 PM', 'courier' => 'N/A', 'tracking' => 'N/A',
            'items' => [
                ['name' => 'Cheese Makhana', 'size' => '100g', 'price' => 249, 'qty' => 2, 'total' => 498, 'bgColor' => '#ea580c']
            ],
            'discount' => 0, 'shipping' => 0
        ]
    ];

    $kpis = [
        'all' => count($orders),
        'pending' => collect($orders)->where('status', 'Pending')->count(),
        'processing' => collect($orders)->where('status', 'Processing')->count(),
        'shipped' => collect($orders)->where('status', 'Shipped')->count(),
        'delivered' => collect($orders)->where('status', 'Delivered')->count(),
        'cancelled' => collect($orders)->where('status', 'Cancelled')->count(),
    ];
@endphp

<div class="orders-page-wrapper">
    <div class="orders-grid-container">

        <!-- ================= LEFT PANEL: ORDERS LIST ================= -->
        <div class="orders-card left-panel">
            <!-- Header -->
            <div class="orders-header">
                <div>
                    <h1 class="orders-title">Orders</h1>
                    <p class="orders-subtitle">Manage and track all customer orders.</p>
                </div>
                <div class="orders-header-actions">
                    <button type="button" class="btn-export-sm">
                        <i data-lucide="download" style="width: 14px; height: 14px;"></i> Export
                    </button>
                    <button type="button" class="btn-create-order">
                        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Create Order
                    </button>
                </div>
            </div>

            <!-- Status KPI Cards -->
            <div class="kpi-row">
                <div class="status-kpi-card kpi-all" onclick="filterByStatus('')">
                    <div class="kpi-icon-label"><i data-lucide="shopping-cart" style="width: 13px; height: 13px;"></i> All</div>
                    <span class="kpi-count">{{ $kpis['all'] }}</span>
                </div>
                <div class="status-kpi-card kpi-pending" onclick="filterByStatus('Pending')">
                    <div class="kpi-icon-label"><i data-lucide="clock" style="width: 13px; height: 13px;"></i> Pending</div>
                    <span class="kpi-count">{{ $kpis['pending'] }}</span>
                </div>
                <div class="status-kpi-card kpi-processing" onclick="filterByStatus('Processing')">
                    <div class="kpi-icon-label"><i data-lucide="refresh-cw" style="width: 13px; height: 13px;"></i> Processing</div>
                    <span class="kpi-count">{{ $kpis['processing'] }}</span>
                </div>
                <div class="status-kpi-card kpi-shipped" onclick="filterByStatus('Shipped')">
                    <div class="kpi-icon-label"><i data-lucide="truck" style="width: 13px; height: 13px;"></i> Shipped</div>
                    <span class="kpi-count">{{ $kpis['shipped'] }}</span>
                </div>
                <div class="status-kpi-card kpi-delivered" onclick="filterByStatus('Delivered')">
                    <div class="kpi-icon-label"><i data-lucide="check-circle-2" style="width: 13px; height: 13px;"></i> Delivered</div>
                    <span class="kpi-count">{{ $kpis['delivered'] }}</span>
                </div>
                <div class="status-kpi-card kpi-cancelled" onclick="filterByStatus('Cancelled')">
                    <div class="kpi-icon-label"><i data-lucide="x-circle" style="width: 13px; height: 13px;"></i> Cancelled</div>
                    <span class="kpi-count">{{ $kpis['cancelled'] }}</span>
                </div>
            </div>

            <!-- Search & Filter Controls -->
            <div class="search-filter-area">
                <div class="search-box-field">
                    <i data-lucide="search" style="width: 15px; height: 15px;"></i>
                    <input 
                        type="text" 
                        id="orderSearchInput" 
                        oninput="handleSearch(this.value)" 
                        placeholder="Search order ID, customer name, phone or email..." 
                        class="search-input-field"
                    />
                </div>
                <div class="filter-options-row">
                    <div class="filter-dropdown-btn">
                        <span>All Status</span> <i data-lucide="chevron-down" style="width: 13px; height: 13px;"></i>
                    </div>
                    <div class="filter-dropdown-btn">
                        <span>All Payments</span> <i data-lucide="chevron-down" style="width: 13px; height: 13px;"></i>
                    </div>
                    <div class="filter-dropdown-btn">
                        <span>Last 30 Days</span> <i data-lucide="chevron-down" style="width: 13px; height: 13px;"></i>
                    </div>
                    <button type="button" class="clear-filters-btn" onclick="clearFilters()">
                        <i data-lucide="refresh-cw" style="width: 12px; height: 12px;"></i> Clear
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th style="width: 32px; padding-left: 10px;">
                                <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" style="cursor: pointer;">
                            </th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                        @foreach($orders as $idx => $order)
                            @php
                                $totalQty = collect($order['items'])->sum('qty');
                                $sub = collect($order['items'])->sum('total');
                                $finalTotal = $sub - $order['discount'] + $order['shipping'];
                                
                                $initBg = [
                                    'P' => 'background:#ffedd5; color:#9a3412;',
                                    'R' => 'background:#dcfce7; color:#166534;',
                                    'A' => 'background:#f3e8ff; color:#6b21a8;',
                                    'V' => 'background:#fce7f3; color:#9d174d;',
                                    'N' => 'background:#dbeafe; color:#1e40af;',
                                    'S' => 'background:#fee2e2; color:#991b1b;',
                                ][$order['init']] ?? 'background:#e5e7eb; color:#374151;';
                            @endphp
                            <tr 
                                class="order-table-row {{ $idx === 0 ? 'active-row' : '' }}" 
                                id="row-{{ substr($order['id'], 1) }}"
                                onclick="selectOrder('{{ $order['id'] }}')"
                                data-id="{{ strtolower($order['id']) }}"
                                data-name="{{ strtolower($order['name']) }}"
                                data-email="{{ strtolower($order['email']) }}"
                                data-status="{{ $order['status'] }}"
                            >
                                <td onclick="event.stopPropagation()" style="padding-left: 10px;">
                                    <input 
                                        type="checkbox" 
                                        class="row-checkbox" 
                                        value="{{ $order['id'] }}" 
                                        onchange="handleRowCheck(this)"
                                        style="cursor: pointer;"
                                    >
                                </td>
                                <td style="font-weight: 700; color: #111827;">{{ $order['id'] }}</td>
                                <td>
                                    <div class="customer-info-box">
                                        <div class="customer-init-avatar" style="{{ $initBg }}">
                                            {{ $order['init'] }}
                                        </div>
                                        <div style="min-width: 0;">
                                            <p style="font-weight: 500; color: #111827; line-height: 1.2; overflow: hidden; text-overflow: ellipsis;">{{ $order['name'] }}</p>
                                            <p style="font-size: 10px; color: #6b7280; overflow: hidden; text-overflow: ellipsis;">{{ $order['email'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="color: #6b7280;">{{ $totalQty }} {{ $totalQty == 1 ? 'item' : 'items' }}</td>
                                <td style="font-weight: 700; color: #111827;">₹{{ number_format($finalTotal) }}</td>
                                <td>
                                    <span style="display: flex; align-items: center; gap: 4px; text-transform: uppercase; font-size: 10px; font-weight: 500;">
                                        @if($order['payMethod'] === 'UPI')
                                            <i data-lucide="smartphone" style="width: 13px; height: 13px; color: #9333ea;"></i>
                                        @elseif($order['payMethod'] === 'Card')
                                            <i data-lucide="credit-card" style="width: 13px; height: 13px; color: #2563eb;"></i>
                                        @else
                                            <i data-lucide="banknote" style="width: 13px; height: 13px; color: #16a34a;"></i>
                                        @endif
                                        {{ $order['payMethod'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $order['status'] }}">
                                        <span class="dot"></span>
                                        {{ $order['status'] }}
                                    </span>
                                </td>
                                <td style="color: #6b7280;">{{ $order['date'] }}</td>
                                <td style="text-align: center;">
                                    <button type="button" style="background: none; border: none; cursor: pointer; color: #9ca3af; padding: 2px;">
                                        <i data-lucide="more-vertical" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer / Bulk Actions -->
            <div class="table-footer-controls">
                <div class="bulk-action-btns">
                    <span class="selected-count-badge" id="selectedBadge" style="color: #9ca3af; background: #f3f4f6;">
                        <span id="selectedCountText">0 selected</span>
                    </span>
                    <button type="button" class="action-btn-sm" id="btnMarkProcessing" onclick="bulkUpdateStatus('Processing')" disabled>
                        <i data-lucide="refresh-cw" style="width: 12px; height: 12px;"></i> Processing
                    </button>
                    <button type="button" class="action-btn-sm" id="btnMarkShipped" onclick="bulkUpdateStatus('Shipped')" disabled>
                        <i data-lucide="truck" style="width: 12px; height: 12px;"></i> Shipped
                    </button>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; font-size: 11px; color: #6b7280;">
                    <span style="color: #9ca3af;">Showing {{ count($orders) }} orders</span>
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <button style="width: 22px; height: 22px; border: none; border-radius: 4px; background: #3B5240; color: #fff; font-weight: 500;">1</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= RIGHT PANEL: ORDER DETAILS ================= -->
        <div class="orders-card right-panel" id="orderDetailsPanel">
            <div class="right-panel-body">
                <!-- Top Back & Actions -->
                <div class="right-panel-header">
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <h2 class="orders-title" style="font-size: 20px;" id="detailOrderId">#RN10241</h2>
                            <span class="status-badge" id="detailStatusBadge">
                                <span class="dot"></span>
                                <span id="detailStatusText">Processing</span>
                            </span>
                        </div>
                        <p style="font-size: 11px; color: #6b7280; margin-top: 4px;" id="detailDateTime">Placed on 30 Sep 2026 at 10:42 AM</p>
                    </div>
                    <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                        <button type="button" class="btn-export-sm" style="padding: 6px 10px;">
                            <i data-lucide="printer" style="width: 12px; height: 12px;"></i> Print
                        </button>
                        <button type="button" class="btn-create-order" style="padding: 6px 10px;">
                            Status <i data-lucide="chevron-down" style="width: 12px; height: 12px;"></i>
                        </button>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #E5E2D9; margin: 12px 0;">

                <!-- Customer & Address Grid -->
                <div class="detail-grid-row">
                    <!-- Customer Information -->
                    <div>
                        <div class="detail-section-title">
                            Customer Information
                            <button style="border: none; background: none; color: #9ca3af; cursor: pointer; font-size: 10px; display: inline-flex; align-items: center; gap: 3px;">
                                <i data-lucide="edit" style="width: 10px; height: 10px;"></i> Edit
                            </button>
                        </div>
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <div class="customer-init-avatar" id="detailAvatar" style="width: 32px; height: 32px; font-size: 13px; background: #ffedd5; color: #9a3412;">
                                P
                            </div>
                            <div style="font-size: 11px; line-height: 1.4; min-width: 0; word-break: break-word;">
                                <p style="font-weight: 700; color: #111827;" id="detailCustName">Priya Sharma</p>
                                <p style="color: #4b5563;" id="detailCustEmail">priya@gmail.com</p>
                                <p style="color: #4b5563;" id="detailCustPhone">+91 98765 43210</p>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div>
                        <div class="detail-section-title">
                            Delivery Address
                            <button style="border: none; background: none; color: #9ca3af; cursor: pointer; font-size: 10px; display: inline-flex; align-items: center; gap: 3px;">
                                <i data-lucide="edit" style="width: 10px; height: 10px;"></i> Edit
                            </button>
                        </div>
                        <div style="font-size: 11px; line-height: 1.4; color: #4b5563; word-break: break-word;">
                            <p style="font-weight: 700; color: #111827;" id="detailShipName">Priya Sharma</p>
                            <p style="white-space: pre-line;" id="detailShipAddress">B-204, Green Park Apartment&#10;Patna, Bihar - 800020&#10;India</p>
                        </div>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #E5E2D9; margin: 12px 0;">

                <!-- Items Summary & Payment/Courier Grid -->
                <div class="detail-grid-row">
                    <!-- Left: Items List -->
                    <div class="items-order-box">
                        <div style="display: flex; justify-content: space-between; font-size: 9px; font-weight: 600; text-transform: uppercase; color: #9ca3af; border-bottom: 1px solid #E5E2D9; padding-bottom: 6px; margin-bottom: 8px;">
                            <span style="flex: 1;">Order Items</span>
                            <span style="width: 44px; text-align: center;">Price</span>
                            <span style="width: 32px; text-align: center;">Qty</span>
                            <span style="width: 48px; text-align: right;">Total</span>
                        </div>

                        <div id="detailItemsList"></div>

                        <div style="border-top: 1px solid #E5E2D9; padding-top: 10px; margin-top: 10px; font-size: 11px; line-height: 1.6;">
                            <div style="display: flex; justify-content: space-between; color: #4b5563;">
                                <span>Subtotal</span>
                                <span style="font-weight: 700; color: #111827;" id="detailSubtotal">₹747</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; color: #4b5563;" id="detailDiscountRow">
                                <span>Discount</span>
                                <span style="font-weight: 700; color: #3B5240;" id="detailDiscount">-₹75</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; color: #4b5563;">
                                <span>Shipping</span>
                                <span style="font-weight: 700; color: #111827;" id="detailShipping">Free</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 700; color: #111827; border-top: 1px solid #E5E2D9; margin-top: 6px; padding-top: 6px;">
                                <span>Total</span>
                                <span id="detailFinalAmount">₹672</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Payment & Courier Details -->
                    <div>
                        <!-- Payment -->
                        <div style="margin-bottom: 16px;">
                            <h3 class="detail-section-title">Payment Information</h3>
                            <div style="font-size: 11px; display: flex; flex-direction: column; gap: 6px;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #6b7280;">Method</span>
                                    <span style="font-weight: 700; color: #111827;" id="detailPayMethod">UPI</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #6b7280;">Status</span>
                                    <span style="font-weight: 700; color: #16a34a;" id="detailPayStatus">Paid</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #6b7280;">Txn ID</span>
                                    <span style="font-weight: 700; color: #111827;">TXN928374650</span>
                                </div>
                            </div>
                        </div>

                        <!-- Shipment -->
                        <div>
                            <h3 class="detail-section-title">Shipment Information</h3>
                            <div style="font-size: 11px; display: flex; flex-direction: column; gap: 6px;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #6b7280;">Courier</span>
                                    <span style="font-weight: 700; color: #111827;" id="detailCourier">Delhivery</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #6b7280;">Tracking</span>
                                    <span style="font-weight: 700; color: #111827;" id="detailTracking">1234567890</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: #6b7280;">Status</span>
                                    <span style="font-weight: 700; color: #2563eb;" id="detailShipStatus">In Transit</span>
                                </div>
                            </div>

                            <button type="button" class="btn-export-sm" style="width: 100%; margin-top: 12px; justify-content: center; padding: 6px 10px;">
                                Track Shipment <i data-lucide="external-link" style="width: 12px; height: 12px;"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #E5E2D9; margin: 12px 0;">

                <!-- Timeline & Internal Notes Grid -->
                <div class="detail-grid-row" style="margin-bottom: 0;">
                    <!-- Order Timeline -->
                    <div>
                        <h3 class="detail-section-title">Order Timeline</h3>
                        <div class="timeline-wrap" id="detailTimeline"></div>
                    </div>

                    <!-- Internal Notes -->
                    <div>
                        <h3 class="detail-section-title">Internal Notes</h3>
                        <div class="note-input-container">
                            <textarea id="noteInput" rows="2" class="note-textarea" placeholder="Add note..."></textarea>
                            <button type="button" class="note-add-btn" id="btnAddNote" onclick="addNote()">Add</button>
                        </div>
                        <div id="notesContainer"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const ordersData = @json($orders);
    let selectedOrderIds = [];
    let currentOrderId = ordersData[0].id;
    let internalNotes = {
        '#RN10241': [{ text: 'Customer requested delivery after 5 PM.', time: '30 Sep 2026, 11:20 AM' }]
    };

    function selectOrder(orderId) {
        currentOrderId = orderId;
        const order = ordersData.find(o => o.id === orderId);
        if (!order) return;

        document.querySelectorAll('.order-table-row').forEach(row => row.classList.remove('active-row'));
        const activeRow = document.getElementById('row-' + orderId.replace('#', ''));
        if (activeRow) activeRow.classList.add('active-row');

        document.getElementById('detailOrderId').innerText = order.id;
        document.getElementById('detailDateTime').innerText = `Placed on ${order.date} at ${order.time}`;
        
        const statusBadge = document.getElementById('detailStatusBadge');
        statusBadge.className = `status-badge status-${order.status}`;
        document.getElementById('detailStatusText').innerText = order.status;

        document.getElementById('detailAvatar').innerText = order.init;
        document.getElementById('detailCustName').innerText = order.name;
        document.getElementById('detailCustEmail').innerText = order.email;
        document.getElementById('detailCustPhone').innerText = order.phone;
        document.getElementById('detailShipName').innerText = order.name;
        document.getElementById('detailShipAddress').innerText = order.address;

        const itemsList = document.getElementById('detailItemsList');
        itemsList.innerHTML = '';
        let subtotal = 0;

        order.items.forEach(item => {
            subtotal += item.total;
            const row = document.createElement('div');
            row.className = 'order-item-row';
            row.innerHTML = `
                <div style="flex: 1; display: flex; align-items: center; overflow: hidden; padding-right: 4px; min-width: 0;">
                    <div class="order-item-avatar" style="background-color: ${item.bgColor};">
                        ${item.name.substring(0, 2).toUpperCase()}
                    </div>
                    <div style="min-width: 0; overflow: hidden;">
                        <p style="font-size: 11px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.name}</p>
                        <p style="font-size: 10px; color: #6b7280;">${item.size}</p>
                    </div>
                </div>
                <div style="width: 44px; text-align: center; font-size: 11px; font-weight: 700; color: #111827;">₹${item.price}</div>
                <div style="width: 32px; text-align: center; font-size: 11px; font-weight: 700; color: #111827;">${item.qty}</div>
                <div style="width: 48px; text-align: right; font-size: 11px; font-weight: 700; color: #111827;">₹${item.total}</div>
            `;
            itemsList.appendChild(row);
        });

        document.getElementById('detailSubtotal').innerText = '₹' + subtotal.toLocaleString('en-IN');
        if (order.discount > 0) {
            document.getElementById('detailDiscountRow').style.display = 'flex';
            document.getElementById('detailDiscount').innerText = '-₹' + order.discount;
        } else {
            document.getElementById('detailDiscountRow').style.display = 'none';
        }
        document.getElementById('detailShipping').innerText = order.shipping === 0 ? 'Free' : '₹' + order.shipping;
        document.getElementById('detailFinalAmount').innerText = '₹' + (subtotal - order.discount + order.shipping).toLocaleString('en-IN');

        document.getElementById('detailPayMethod').innerText = order.payMethod;
        const payStatus = document.getElementById('detailPayStatus');
        if (order.payMethod === 'COD' && order.status === 'Pending') {
            payStatus.innerText = 'Pending';
            payStatus.style.color = '#ea580c';
        } else {
            payStatus.innerText = 'Paid';
            payStatus.style.color = '#16a34a';
        }

        document.getElementById('detailCourier').innerText = order.courier;
        document.getElementById('detailTracking').innerText = order.tracking;
        const shipStatus = document.getElementById('detailShipStatus');
        if (order.status === 'Shipped' || order.status === 'Delivered') {
            shipStatus.innerText = 'In Transit';
            shipStatus.style.color = '#2563eb';
        } else {
            shipStatus.innerText = 'Awaiting Pickup';
            shipStatus.style.color = '#6b7280';
        }

        renderTimeline(order.status, order.date, order.time);
        renderNotes(order.id);

        if (window.lucide) lucide.createIcons();
    }

    function renderTimeline(status, date, time) {
        const levels = { 'Pending': 1, 'Processing': 2, 'Shipped': 3, 'Delivered': 4, 'Cancelled': -1 };
        const currentLevel = levels[status] || 1;
        const container = document.getElementById('detailTimeline');
        container.innerHTML = '';

        const steps = [
            { label: 'Order Placed', step: 1 },
            { label: 'Processing', step: 2 },
            { label: 'Shipped', step: 3 },
            { label: 'Delivered', step: 4 }
        ];

        steps.forEach(s => {
            const stepDiv = document.createElement('div');
            stepDiv.className = 'timeline-step';

            let iconHtml = '';
            let isCurrent = false;

            if (currentLevel === -1) {
                iconHtml = `<div class="timeline-icon-box" style="background: #dc2626; color: #fff; width: 15px; height: 15px;"><i data-lucide="x-circle" style="width: 11px; height: 11px;"></i></div>`;
            } else if (currentLevel > s.step || (currentLevel === 4 && s.step === 4)) {
                iconHtml = `<div class="timeline-icon-box" style="background: #16a34a; color: #fff; width: 15px; height: 15px;"><i data-lucide="check-circle-2" style="width: 11px; height: 11px;"></i></div>`;
            } else if (currentLevel === s.step) {
                isCurrent = true;
                iconHtml = `<div class="timeline-icon-box" style="background: #fff; border: 2px solid #9333ea; width: 13px; height: 13px;"><div style="width: 5px; height: 5px; border-radius: 9999px; background: #9333ea;"></div></div>`;
            } else {
                iconHtml = `<div class="timeline-icon-box" style="background: #fff; border: 2px solid #d1d5db; width: 9px; height: 9px;"></div>`;
            }

            stepDiv.innerHTML = `
                ${iconHtml}
                <div style="display: flex; align-items: center; gap: 6px;">
                    <p style="font-size: 11px; font-weight: ${s.step <= currentLevel ? '700' : '500'}; color: ${s.step <= currentLevel ? '#111827' : '#9ca3af'}; line-height: 1;">
                        ${s.label}
                    </p>
                    ${isCurrent ? `<span style="background: #f3e8ff; color: #9333ea; font-size: 8px; font-weight: 700; padding: 1px 4px; border-radius: 4px; text-transform: uppercase;">Current</span>` : ''}
                </div>
                ${s.step === 1 ? `<p style="font-size: 9px; color: #6b7280; margin-top: 3px;">${date},${time}</p>` : ''}
            `;
            container.appendChild(stepDiv);
        });
    }

    function renderNotes(orderId) {
        const container = document.getElementById('notesContainer');
        container.innerHTML = '';
        const list = internalNotes[orderId] || [];

        if (list.length === 0) {
            container.innerHTML = '<p style="font-size: 11px; color: #9ca3af; text-align: center; padding: 6px 0; font-style: italic;">No internal notes.</p>';
            return;
        }

        list.forEach(n => {
            const card = document.createElement('div');
            card.className = 'single-note-card';
            card.innerHTML = `
                <div style="display: flex; align-items: flex-start; gap: 6px;">
                    <div style="width: 18px; height: 18px; border-radius: 9999px; background: #ffedd5; color: #9a3412; font-weight: 700; font-size: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">A</div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: baseline; gap: 6px;">
                            <span style="font-size: 10px; font-weight: 700; color: #111827;">Admin</span>
                            <span style="font-size: 8px; color: #9ca3af;">${n.time}</span>
                        </div>
                        <p style="font-size: 10px; color: #4b5563; margin-top: 2px; word-break: break-word;">${n.text}</p>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function addNote() {
        const text = document.getElementById('noteInput').value.trim();
        if (!text) return;

        const dateStr = new Date().toLocaleString('en-GB', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        if (!internalNotes[currentOrderId]) internalNotes[currentOrderId] = [];
        internalNotes[currentOrderId].push({ text: text, time: dateStr });

        document.getElementById('noteInput').value = '';
        renderNotes(currentOrderId);
    }

    function handleSearch(val) {
        const query = val.toLowerCase();
        document.querySelectorAll('.order-table-row').forEach(row => {
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            if (id.includes(query) || name.includes(query) || email.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterByStatus(status) {
        document.querySelectorAll('.order-table-row').forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (!status || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function clearFilters() {
        document.getElementById('orderSearchInput').value = '';
        handleSearch('');
        filterByStatus('');
    }

    function handleRowCheck(checkbox) {
        const id = checkbox.value;
        const row = document.getElementById('row-' + id.replace('#', ''));
        if (checkbox.checked) {
            selectedOrderIds.push(id);
            if (row) row.classList.add('selected-row');
        } else {
            selectedOrderIds = selectedOrderIds.filter(i => i !== id);
            if (row) row.classList.remove('selected-row');
        }
        updateBulkUI();
    }

    function toggleSelectAll(masterCheckbox) {
        selectedOrderIds = [];
        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.checked = masterCheckbox.checked;
            const id = cb.value;
            const row = document.getElementById('row-' + id.replace('#', ''));
            if (masterCheckbox.checked) {
                selectedOrderIds.push(id);
                if (row) row.classList.add('selected-row');
            } else {
                if (row) row.classList.remove('selected-row');
            }
        });
        updateBulkUI();
    }

    function updateBulkUI() {
        const count = selectedOrderIds.length;
        const countText = document.getElementById('selectedCountText');
        const badge = document.getElementById('selectedBadge');
        const btnProc = document.getElementById('btnMarkProcessing');
        const btnShip = document.getElementById('btnMarkShipped');

        countText.innerText = `${count} selected`;
        if (count > 0) {
            badge.style.background = '#e5e7eb';
            badge.style.color = '#1f2937';
            btnProc.removeAttribute('disabled');
            btnShip.removeAttribute('disabled');
        } else {
            badge.style.background = '#f3f4f6';
            badge.style.color = '#9ca3af';
            btnProc.setAttribute('disabled', 'true');
            btnShip.setAttribute('disabled', 'true');
        }
    }

    function bulkUpdateStatus(newStatus) {
        selectedOrderIds.forEach(id => {
            const order = ordersData.find(o => o.id === id);
            if (order) {
                order.status = newStatus;
                const row = document.getElementById('row-' + id.replace('#', ''));
                if (row) {
                    row.setAttribute('data-status', newStatus);
                    const statusTd = row.children[6];
                    statusTd.innerHTML = `
                        <span class="status-badge status-${newStatus}">
                            <span class="dot"></span>
                            ${newStatus}
                        </span>
                    `;
                }
            }
        });
        if (selectedOrderIds.includes(currentOrderId)) {
            selectOrder(currentOrderId);
        }
        document.getElementById('selectAllCheckbox').checked = false;
        toggleSelectAll(document.getElementById('selectAllCheckbox'));
    }

    document.addEventListener("DOMContentLoaded", () => {
        selectOrder(ordersData[0].id);
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection