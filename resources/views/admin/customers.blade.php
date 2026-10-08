@extends('layouts.admin')

@section('title', 'Customers Management - Riva Nair')

@section('content')
<style>
    /* Reset & Page Layout */
    .customers-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F5F2EA;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .customers-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .customers-page-wrapper { margin: -32px; }
    }

    .customers-main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        align-items: start;
        width: 100%;
    }

    @media (min-width: 1536px) {
        .customers-main-grid {
            grid-template-columns: minmax(0, 1fr) 480px;
        }
    }

    /* Common Card Styling */
    .ui-panel-card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
    }

    /* Left Column Styles */
    .left-header-area {
        padding: 24px 24px 0 24px;
    }

    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .page-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 28px;
        color: #111827;
        line-height: 1.1;
    }

    .page-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .btn-export-dark {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #3B5240;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-export-dark:hover { background-color: #2A3C2E; }

    /* KPI Cards Grid */
    .kpi-row-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 24px;
    }

    @media (min-width: 1024px) {
        .kpi-row-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
    }

    .cus-kpi-card {
        background-color: #F8F6F0;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid #E5E2D9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kpi-label-block {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .kpi-val-row {
        display: flex;
        align-items: flex-end;
        gap: 8px;
    }

    .kpi-big-num {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .kpi-trend-pill {
        font-size: 10px;
        font-weight: 700;
        color: #16a34a;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
    }

    .trend-bars-mini {
        display: flex;
        align-items: flex-end;
        gap: 2px;
        height: 24px;
        margin-left: 8px;
    }

    .t-bar {
        width: 4px;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
    }

    /* Filters Section */
    .search-filter-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 16px;
    }

    .search-input-wrap {
        position: relative;
        flex: 1;
        max-width: 448px;
    }

    .search-input-wrap i {
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
        padding: 8px 16px 8px 36px;
        font-size: 12px;
        color: #374151;
        outline: none;
        box-sizing: border-box;
    }

    .search-input-field:focus { border-color: #3B5240; }

    .date-pill-btn {
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #ffffff;
        font-size: 12px;
        color: #4b5563;
        cursor: pointer;
    }

    .filter-dropdowns-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .filter-select-group {
        flex: 1;
    }

    .filter-select-label {
        display: block;
        font-size: 9px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .filter-select-wrap {
        position: relative;
    }

    .filter-select-wrap select {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 8px 32px 8px 12px;
        font-size: 12px;
        color: #111827;
        outline: none;
        appearance: none;
        cursor: pointer;
    }

    .clear-filter-btn {
        background: transparent;
        border: none;
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        padding-top: 14px;
    }

    .clear-filter-btn:hover { color: #111827; }

    /* Customers Table */
    .table-scroll-container {
        width: 100%;
        overflow-x: auto;
        border-top: 1px solid #E5E2D9;
    }

    .cus-table {
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        font-size: 11px;
    }

    .cus-table th {
        background-color: #F8F6F0;
        padding: 12px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.05em;
        white-space: nowrap;
        border-bottom: 1px solid #E5E2D9;
    }

    .cus-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #f9fafb;
        white-space: nowrap;
    }

    .cus-table tr {
        cursor: pointer;
        transition: background-color 0.15s;
    }

    .cus-table tr:hover { background-color: #f9fafb; }
    .cus-table tr.active-row { background-color: #F8F6F0 !important; }
    .cus-table tr.selected-row { background-color: #f3f4f6; }

    .cus-avatar-bubble {
        width: 32px;
        height: 32px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 6px;
        border-radius: 9999px;
        font-size: 9px;
        font-weight: 700;
    }

    .status-badge .dot {
        width: 4px;
        height: 4px;
        border-radius: 9999px;
        margin-right: 4px;
    }

    .st-Active { background-color: #dcfce7; color: #15803d; }
    .st-Active .dot { background-color: #22c55e; }

    .st-VIP { background-color: #fef9c3; color: #a16207; }
    .st-VIP .dot { background-color: #eab308; }

    .st-Inactive { background-color: #fee2e2; color: #b91c1c; }
    .st-Inactive .dot { background-color: #ef4444; }

    /* Table Footer & Bulk Controls */
    .table-footer-wrap {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 16px;
        border-top: 1px solid #E5E2D9;
        padding: 16px;
        background-color: #ffffff;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    @media (min-width: 1280px) {
        .table-footer-wrap {
            flex-direction: row;
            align-items: center;
        }
    }

    .bulk-action-bar {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-outline-sm {
        border: 1px solid #E5E2D9;
        border-radius: 6px;
        background-color: #ffffff;
        color: #374151;
        font-size: 12px;
        font-weight: 500;
        padding: 6px 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .btn-outline-sm:hover { background-color: #f9fafb; }

    /* Right Column / Customer Details */
    .right-details-card {
        position: sticky;
        top: 96px;
        max-height: calc(100vh - 120px);
        overflow: hidden;
    }

    .details-top-header {
        padding: 24px;
        border-bottom: 1px solid #E5E2D9;
    }

    .details-actions-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-hero-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .hero-avatar {
        width: 64px;
        height: 64px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        flex-shrink: 0;
        border: 1px solid #E5E2D9;
    }

    .hero-name {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 20px;
        font-weight: 700;
        color: #111827;
    }

    .details-quick-actions {
        display: flex;
        gap: 12px;
    }

    .details-scroll-content {
        overflow-y: auto;
        flex: 1;
    }

    /* Details KPIs */
    .details-kpis-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border-bottom: 1px solid #E5E2D9;
        background-color: #FAFAF8;
    }

    .strip-cell {
        padding: 16px;
        border-right: 1px solid #E5E2D9;
    }

    .strip-cell:last-child { border-right: none; }

    .strip-tag {
        font-size: 9px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 4px;
    }

    .strip-val {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    /* Customer Info & Address Grid */
    .info-address-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        padding: 24px;
        border-bottom: 1px solid #E5E2D9;
    }

    .sec-heading-sm {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .address-box-styled {
        background-color: #F8F6F0;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #E5E2D9;
        font-size: 12px;
        line-height: 1.6;
        color: #4b5563;
    }

    /* Tabs Bar */
    .tab-bar-strip {
        display: flex;
        gap: 24px;
        padding: 0 24px;
        border-bottom: 1px solid #E5E2D9;
    }

    .tab-btn {
        padding: 12px 0;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        background: transparent;
        border: none;
        border-bottom: 2px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
    }

    .tab-btn.active {
        border-bottom-color: #3B5240;
        color: #111827;
    }

    .tab-body-pane {
        padding: 24px;
    }
</style>

@php
    $customers = [
        ['id' => 'CUS1024', 'name' => 'Priya Sharma', 'email' => 'priya@gmail.com', 'phone' => '+91 98765 43210', 'orders' => 8, 'total' => 4892, 'avg' => 611, 'last' => '30 Sep 2026', 'joined' => '12 Mar 2026', 'status' => 'Active', 'type' => 'Returning Customer', 'initial' => 'P', 'color' => '#fed7aa', 'text' => '#9a3412'],
        ['id' => 'CUS1025', 'name' => 'Rahul Kumar', 'email' => 'rahul@gmail.com', 'phone' => '+91 87654 32109', 'orders' => 5, 'total' => 2340, 'avg' => 468, 'last' => '29 Sep 2026', 'joined' => '15 Mar 2026', 'status' => 'Active', 'type' => 'Standard', 'initial' => 'R', 'color' => '#bfdbfe', 'text' => '#1e40af'],
        ['id' => 'CUS1026', 'name' => 'Ananya Singh', 'email' => 'ananya@gmail.com', 'phone' => '+91 76543 21098', 'orders' => 12, 'total' => 8920, 'avg' => 743, 'last' => '28 Sep 2026', 'joined' => '10 Feb 2026', 'status' => 'VIP', 'type' => 'VIP Club', 'initial' => 'A', 'color' => '#fef08a', 'text' => '#854d0e'],
        ['id' => 'CUS1027', 'name' => 'Vikram Das', 'email' => 'vikram@gmail.com', 'phone' => '+91 65432 10987', 'orders' => 1, 'total' => 249, 'avg' => 249, 'last' => '20 Sep 2026', 'joined' => '18 Sep 2026', 'status' => 'Active', 'type' => 'First Time', 'initial' => 'V', 'color' => '#fecaca', 'text' => '#991b1b'],
        ['id' => 'CUS1028', 'name' => 'Neha Patel', 'email' => 'neha@gmail.com', 'phone' => '+91 54321 09876', 'orders' => 6, 'total' => 3120, 'avg' => 520, 'last' => '26 Sep 2026', 'joined' => '5 Mar 2026', 'status' => 'Active', 'type' => 'Returning Customer', 'initial' => 'N', 'color' => '#bfdbfe', 'text' => '#1e40af'],
        ['id' => 'CUS1029', 'name' => 'Saurav Mehta', 'email' => 'saurav@gmail.com', 'phone' => '+91 99887 76655', 'orders' => 3, 'total' => 1497, 'avg' => 499, 'last' => '24 Sep 2026', 'joined' => '28 Apr 2026', 'status' => 'Active', 'type' => 'Standard', 'initial' => 'S', 'color' => '#bbf7d0', 'text' => '#166534'],
        ['id' => 'CUS1030', 'name' => 'Pooja Verma', 'email' => 'pooja@gmail.com', 'phone' => '+91 99887 11223', 'orders' => 4, 'total' => 1976, 'avg' => 494, 'last' => '23 Sep 2026', 'joined' => '21 May 2026', 'status' => 'Active', 'type' => 'Standard', 'initial' => 'P', 'color' => '#fed7aa', 'text' => '#9a3412'],
        ['id' => 'CUS1031', 'name' => 'Amit Singh', 'email' => 'amit@gmail.com', 'phone' => '+91 99887 33445', 'orders' => 7, 'total' => 3849, 'avg' => 550, 'last' => '22 Sep 2026', 'joined' => '11 Mar 2026', 'status' => 'Active', 'type' => 'Returning Customer', 'initial' => 'A', 'color' => '#fed7aa', 'text' => '#9a3412'],
        ['id' => 'CUS1032', 'name' => 'Sneha Iyer', 'email' => 'sneha@gmail.com', 'phone' => '+91 99887 55667', 'orders' => 2, 'total' => 998, 'avg' => 499, 'last' => '21 Sep 2026', 'joined' => '2 Jun 2026', 'status' => 'Inactive', 'type' => 'Inactive', 'initial' => 'S', 'color' => '#e9d5ff', 'text' => '#6b21a8'],
        ['id' => 'CUS1033', 'name' => 'Karan Malhotra', 'email' => 'karan@gmail.com', 'phone' => '+91 99887 77889', 'orders' => 9, 'total' => 5370, 'avg' => 596, 'last' => '20 Sep 2026', 'joined' => '16 Jan 2026', 'status' => 'Active', 'type' => 'Returning Customer', 'initial' => 'K', 'color' => '#c7d2fe', 'text' => '#3730a3'],
    ];
@endphp

<div class="customers-page-wrapper">
    <main class="customers-main-grid">

        <!-- ================= LEFT COLUMN: CUSTOMERS LIST ================= -->
        <div class="ui-panel-card">
            
            <div class="left-header-area">
                <!-- Header -->
                <div class="header-row">
                    <div>
                        <h1 class="page-title">Customers</h1>
                        <p class="page-subtitle">Manage your customers and their purchase activity.</p>
                    </div>
                    <button type="button" class="btn-export-dark">
                        <i data-lucide="download" style="width: 14px; height: 14px;"></i> Export Customers
                    </button>
                </div>

                <!-- KPI Cards -->
                <div class="kpi-row-grid">
                    <!-- Total Customers -->
                    <div class="cus-kpi-card">
                        <div>
                            <div class="kpi-label-block" style="color: #15803d;">
                                <i data-lucide="users" style="width: 14px; height: 14px;"></i> Total Customers
                            </div>
                            <div class="kpi-val-row">
                                <span class="kpi-big-num">892</span>
                                <span class="kpi-trend-pill">↗ +12%</span>
                            </div>
                        </div>
                        <div class="trend-bars-mini">
                            <div class="t-bar" style="height: 8px; background: #22c55e; opacity: 0.4;"></div>
                            <div class="t-bar" style="height: 12px; background: #22c55e; opacity: 0.6;"></div>
                            <div class="t-bar" style="height: 8px; background: #22c55e; opacity: 0.3;"></div>
                            <div class="t-bar" style="height: 16px; background: #22c55e; opacity: 0.8;"></div>
                            <div class="t-bar" style="height: 20px; background: #22c55e; opacity: 1;"></div>
                        </div>
                    </div>

                    <!-- New Customers -->
                    <div class="cus-kpi-card">
                        <div>
                            <div class="kpi-label-block" style="color: #2563eb;">
                                <i data-lucide="user-plus" style="width: 14px; height: 14px;"></i> New Customers
                            </div>
                            <div class="kpi-val-row">
                                <span class="kpi-big-num">124</span>
                                <span class="kpi-trend-pill">↗ +8%</span>
                            </div>
                        </div>
                        <div class="trend-bars-mini">
                            <div class="t-bar" style="height: 8px; background: #4ade80; opacity: 0.4;"></div>
                            <div class="t-bar" style="height: 12px; background: #4ade80; opacity: 0.6;"></div>
                            <div class="t-bar" style="height: 8px; background: #4ade80; opacity: 0.3;"></div>
                            <div class="t-bar" style="height: 16px; background: #4ade80; opacity: 0.8;"></div>
                            <div class="t-bar" style="height: 20px; background: #4ade80; opacity: 1;"></div>
                        </div>
                    </div>

                    <!-- Returning -->
                    <div class="cus-kpi-card">
                        <div>
                            <div class="kpi-label-block" style="color: #16a34a;">
                                <i data-lucide="refresh-cw" style="width: 14px; height: 14px;"></i> Returning
                            </div>
                            <div class="kpi-val-row">
                                <span class="kpi-big-num">368</span>
                                <span class="kpi-trend-pill">↗ +15%</span>
                            </div>
                        </div>
                        <div class="trend-bars-mini">
                            <div class="t-bar" style="height: 8px; background: #facc15; opacity: 0.4;"></div>
                            <div class="t-bar" style="height: 12px; background: #facc15; opacity: 0.6;"></div>
                            <div class="t-bar" style="height: 8px; background: #facc15; opacity: 0.3;"></div>
                            <div class="t-bar" style="height: 16px; background: #facc15; opacity: 0.8;"></div>
                            <div class="t-bar" style="height: 20px; background: #facc15; opacity: 1;"></div>
                        </div>
                    </div>

                    <!-- High Value -->
                    <div class="cus-kpi-card">
                        <div>
                            <div class="kpi-label-block" style="color: #f97316;">
                                <i data-lucide="crown" style="width: 14px; height: 14px;"></i> High Value
                            </div>
                            <div class="kpi-val-row">
                                <span class="kpi-big-num">57</span>
                                <span class="kpi-trend-pill">↗ +20%</span>
                            </div>
                        </div>
                        <div class="trend-bars-mini">
                            <div class="t-bar" style="height: 8px; background: #fb923c; opacity: 0.4;"></div>
                            <div class="t-bar" style="height: 12px; background: #fb923c; opacity: 0.6;"></div>
                            <div class="t-bar" style="height: 8px; background: #fb923c; opacity: 0.3;"></div>
                            <div class="t-bar" style="height: 16px; background: #fb923c; opacity: 0.8;"></div>
                            <div class="t-bar" style="height: 20px; background: #fb923c; opacity: 1;"></div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="search-filter-row">
                    <div class="search-input-wrap">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input 
                            type="text" 
                            id="customerSearch" 
                            oninput="searchCustomers(this.value)" 
                            placeholder="Search name, email, phone or customer ID..." 
                            class="search-input-field"
                        >
                    </div>
                    <div class="date-pill-btn">
                        <i data-lucide="calendar" style="width: 14px; height: 14px; color: #9ca3af;"></i>
                        <span>Last 30 Days</span>
                        <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i>
                    </div>
                </div>

                <div class="filter-dropdowns-row">
                    <div class="filter-select-group">
                        <label class="filter-select-label">Customer Type</label>
                        <div class="filter-select-wrap">
                            <select><option>All</option></select>
                            <i data-lucide="chevron-down" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; color: #9ca3af; pointer-events: none;"></i>
                        </div>
                    </div>
                    <div class="filter-select-group">
                        <label class="filter-select-label">Status</label>
                        <div class="filter-select-wrap">
                            <select id="statusFilter" onchange="filterByStatus(this.value)">
                                <option value="All">All</option>
                                <option value="Active">Active</option>
                                <option value="VIP">VIP</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <i data-lucide="chevron-down" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; color: #9ca3af; pointer-events: none;"></i>
                        </div>
                    </div>
                    <div class="filter-select-group">
                        <label class="filter-select-label">Orders</label>
                        <div class="filter-select-wrap">
                            <select><option>All</option></select>
                            <i data-lucide="chevron-down" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; color: #9ca3af; pointer-events: none;"></i>
                        </div>
                    </div>
                    <div class="filter-select-group">
                        <label class="filter-select-label">Joined Date</label>
                        <div class="filter-select-wrap">
                            <select><option>All</option></select>
                            <i data-lucide="chevron-down" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; color: #9ca3af; pointer-events: none;"></i>
                        </div>
                    </div>
                    <button type="button" onclick="clearFilters()" class="clear-filter-btn">
                        <i data-lucide="refresh-cw" style="width: 12px; height: 12px;"></i> Clear Filters
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-scroll-container">
                <table class="cus-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input type="checkbox" id="masterCheckbox" onchange="toggleSelectAll(this)" style="cursor: pointer;">
                            </th>
                            <th>Customer</th>
                            <th>Orders</th>
                            <th>Total Spent</th>
                            <th>Avg. Order</th>
                            <th>Last Order</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customersTableBody">
                        @foreach($customers as $idx => $c)
                            <tr 
                                class="cus-row {{ $idx === 0 ? 'active-row' : '' }}" 
                                id="row-{{ $c['id'] }}"
                                onclick='selectCustomer(@json($c))'
                                data-id="{{ strtolower($c['id']) }}"
                                data-name="{{ strtolower($c['name']) }}"
                                data-email="{{ strtolower($c['email']) }}"
                                data-phone="{{ $c['phone'] }}"
                                data-status="{{ $c['status'] }}"
                            >
                                <td onclick="event.stopPropagation()">
                                    <input 
                                        type="checkbox" 
                                        class="cus-row-cb" 
                                        value="{{ $c['id'] }}" 
                                        onchange="handleRowCheck()" 
                                        style="cursor: pointer;"
                                        {{ $idx === 0 ? 'checked' : '' }}
                                    >
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div class="cus-avatar-bubble" style="background-color: {{ $c['color'] }}; color: {{ $c['text'] }};">
                                            {{ $c['initial'] }}
                                        </div>
                                        <div style="min-width: 0;">
                                            <p style="font-weight: 700; color: #111827;">{{ $c['name'] }}</p>
                                            <p style="font-size: 10px; color: #6b7280;">{{ $c['email'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="color: #4b5563;">{{ $c['orders'] }}</td>
                                <td style="font-weight: 700; color: #111827;">₹{{ number_format($c['total']) }}</td>
                                <td style="color: #4b5563;">₹{{ $c['avg'] }}</td>
                                <td style="color: #4b5563;">{{ $c['last'] }}</td>
                                <td style="color: #4b5563;">{{ $c['joined'] }}</td>
                                <td>
                                    <span class="status-badge st-{{ $c['status'] }}">
                                        <span class="dot"></span>
                                        {{ $c['status'] }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" style="background: none; border: none; cursor: pointer; color: #9ca3af;">
                                        <i data-lucide="more-vertical" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="table-footer-wrap">
                <div class="bulk-action-bar">
                    <span id="selectedCount" style="font-size: 12px; font-weight: 500; color: #6b7280;">
                        1 customer selected
                    </span>
                    <div id="bulkActions" style="display: inline-flex; gap: 8px;">
                        <button type="button" class="btn-outline-sm"><i data-lucide="mail" style="width: 12px; height: 12px;"></i> Send Email</button>
                        <button type="button" class="btn-outline-sm"><i data-lucide="edit-3" style="width: 12px; height: 12px;"></i> Add Note</button>
                        <button type="button" class="btn-outline-sm"><i data-lucide="download" style="width: 12px; height: 12px;"></i> Export</button>
                        <button type="button" class="btn-outline-sm">More <i data-lucide="chevron-down" style="width: 12px; height: 12px;"></i></button>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 24px;">
                    <span style="font-size: 10px; color: #9ca3af;">Showing 1-10 of 892 customers</span>
                    <div style="display: flex; align-items: center; gap: 4px; font-size: 12px;">
                        <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: #3B5240; color: #fff; font-weight: 500;">1</button>
                        <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: transparent; color: #4b5563;">2</button>
                        <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: transparent; color: #4b5563;">3</button>
                        <span style="color: #9ca3af; padding: 0 4px;">...</span>
                        <button style="border: none; background: transparent; color: #4b5563; cursor: pointer;"><i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i></button>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= RIGHT COLUMN: CUSTOMER DETAILS ================= -->
        <div class="ui-panel-card right-details-card">
            
            <!-- Details Header -->
            <div class="details-top-header">
                <div class="details-actions-top">
                    <button type="button" style="border: none; background: transparent; font-size: 12px; color: #6b7280; font-weight: 500; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                        <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i> Back to Customers
                    </button>
                    <button type="button" class="btn-outline-sm" style="padding: 4px 8px; font-size: 10px;">
                        <i data-lucide="edit-3" style="width: 10px; height: 10px;"></i> Edit
                    </button>
                </div>

                <div class="profile-hero-row">
                    <div class="hero-avatar" id="heroAvatar" style="background-color: #fed7aa; color: #9a3412;">
                        P
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <h2 class="hero-name" id="heroName">Priya Sharma</h2>
                            <span class="status-badge st-Active" id="heroStatusBadge">
                                <span class="dot"></span> <span id="heroStatusText">Active</span>
                            </span>
                        </div>
                        <div style="font-size: 12px; color: #6b7280; display: flex; gap: 8px; margin-bottom: 4px;">
                            <span id="heroEmail">priya@gmail.com</span>
                            <span style="color: #d1d5db;">|</span>
                            <span id="heroPhone">+91 98765 43210</span>
                        </div>
                        <div style="font-size: 10px; color: #9ca3af; font-weight: 500; display: flex; gap: 8px;">
                            <span>Customer Since <span id="heroJoined">12 Mar 2026</span></span>
                            <span style="color: #d1d5db;">|</span>
                            <span>Customer ID: <span id="heroId">CUS1024</span></span>
                        </div>
                    </div>
                </div>

                <div class="details-quick-actions">
                    <button type="button" class="btn-export-dark" style="flex: 1; justify-content: center;">
                        <i data-lucide="message-square" style="width: 14px; height: 14px;"></i> Contact Customer
                    </button>
                    <button type="button" class="btn-outline-sm" style="flex: 1; justify-content: center;">
                        <i data-lucide="mail" style="width: 14px; height: 14px;"></i> Send Email
                    </button>
                    <button type="button" class="btn-outline-sm" style="padding: 8px;">
                        <i data-lucide="chevron-down" style="width: 14px; height: 14px;"></i>
                    </button>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="details-scroll-content">
                
                <!-- KPIs Strip -->
                <div class="details-kpis-strip">
                    <div class="strip-cell">
                        <div class="strip-tag" style="color: #15803d;">
                            <i data-lucide="shopping-bag" style="width: 12px; height: 12px;"></i> Total Orders
                        </div>
                        <p class="strip-val" id="stripOrders">8</p>
                    </div>
                    <div class="strip-cell">
                        <div class="strip-tag" style="color: #ea580c;">
                            <i data-lucide="ticket" style="width: 12px; height: 12px;"></i> Total Spent
                        </div>
                        <p class="strip-val" id="stripTotal">₹4,892</p>
                    </div>
                    <div class="strip-cell">
                        <div class="strip-tag" style="color: #2563eb;">
                            <i data-lucide="bar-chart-2" style="width: 12px; height: 12px;"></i> Avg. Order
                        </div>
                        <p class="strip-val" id="stripAvg">₹611</p>
                    </div>
                    <div class="strip-cell">
                        <div class="strip-tag" style="color: #dc2626;">
                            <i data-lucide="calendar" style="width: 12px; height: 12px;"></i> Last Order
                        </div>
                        <p class="strip-val" style="font-size: 11px; margin-top: 4px;" id="stripLast">30 Sep 2026</p>
                    </div>
                </div>

                <!-- Info & Address Grid -->
                <div class="info-address-grid">
                    <div>
                        <div class="sec-heading-sm">
                            Customer Information
                            <button type="button" style="border: none; background: transparent; font-size: 9px; color: #6b7280; cursor: pointer; display: flex; align-items: center; gap: 2px;">
                                <i data-lucide="edit-3" style="width: 10px; height: 10px;"></i> Edit
                            </button>
                        </div>
                        <div style="font-size: 12px; display: flex; flex-direction: column; gap: 8px;">
                            <div style="display: flex;"><span style="width: 96px; color: #6b7280;">Name</span><span style="color: #111827; font-weight: 500;" id="infoName">Priya Sharma</span></div>
                            <div style="display: flex;"><span style="width: 96px; color: #6b7280;">Email</span><span style="color: #111827;" id="infoEmail">priya@gmail.com</span></div>
                            <div style="display: flex;"><span style="width: 96px; color: #6b7280;">Phone</span><span style="color: #111827;" id="infoPhone">+91 98765 43210</span></div>
                            <div style="display: flex;"><span style="width: 96px; color: #6b7280;">Since</span><span style="color: #111827;" id="infoJoined">12 Mar 2026</span></div>
                            <div style="display: flex;"><span style="width: 96px; color: #6b7280;">Type</span><span style="color: #111827;" id="infoType">Returning Customer</span></div>
                        </div>
                    </div>

                    <div>
                        <div class="sec-heading-sm">
                            Delivery Address
                            <button type="button" style="border: none; background: transparent; font-size: 9px; color: #6b7280; cursor: pointer; display: flex; align-items: center; gap: 2px;">
                                <i data-lucide="plus" style="width: 10px; height: 10px;"></i> Add
                            </button>
                        </div>
                        <div class="address-box-styled">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 4px;">
                                <span style="font-weight: 700; color: #111827;" id="addrName">Priya Sharma</span>
                                <span style="font-size: 8px; font-weight: 700; text-transform: uppercase; background: #dcfce7; color: #15803d; padding: 2px 4px; border-radius: 4px;">Default</span>
                            </div>
                            <p>B-204, Green Park Apartment</p>
                            <p>Kankarbagh</p>
                            <p>Patna, Bihar - 800020</p>
                            <p>India</p>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tab-bar-strip">
                    <button type="button" class="tab-btn active" onclick="switchTab(this, 'tabOrders')">Order History</button>
                    <button type="button" class="tab-btn" onclick="switchTab(this, 'tabProducts')">Frequently Purchased</button>
                    <button type="button" class="tab-btn" onclick="switchTab(this, 'tabNotes')">Notes</button>
                </div>

                <!-- Tab Panes -->
                <div class="tab-body-pane">
                    
                    <!-- 1. Order History -->
                    <div id="tabOrders">
                        <table style="width: 100%; border-collapse: collapse; font-size: 11px;">
                            <thead>
                                <tr style="font-size: 9px; color: #6b7280; text-transform: uppercase; border-bottom: 1px solid #E5E2D9; text-align: left;">
                                    <th style="padding-bottom: 8px;">Order ID</th>
                                    <th style="padding-bottom: 8px;">Date</th>
                                    <th style="padding-bottom: 8px;">Items</th>
                                    <th style="padding-bottom: 8px;">Total</th>
                                    <th style="padding-bottom: 8px;">Status</th>
                                    <th style="padding-bottom: 8px; text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="padding: 10px 0; font-weight: 700; color: #111827;">#RN10241</td>
                                    <td style="color: #6b7280;">30 Sep 2026</td>
                                    <td style="color: #4b5563;">3</td>
                                    <td style="font-weight: 700; color: #111827;">₹697</td>
                                    <td><span style="background: #f3e8ff; color: #9333ea; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 9999px;">Processing</span></td>
                                    <td style="text-align: right;"><a href="#" style="color: #6b7280; text-decoration: none; font-weight: 500;">View</a></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="padding: 10px 0; font-weight: 700; color: #111827;">#RN10198</td>
                                    <td style="color: #6b7280;">22 Sep 2026</td>
                                    <td style="color: #4b5563;">2</td>
                                    <td style="font-weight: 700; color: #111827;">₹449</td>
                                    <td><span style="background: #dcfce7; color: #15803d; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 9999px;">Delivered</span></td>
                                    <td style="text-align: right;"><a href="#" style="color: #6b7280; text-decoration: none; font-weight: 500;">View</a></td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-weight: 700; color: #111827;">#RN10072</td>
                                    <td style="color: #6b7280;">10 Sep 2026</td>
                                    <td style="color: #4b5563;">5</td>
                                    <td style="font-weight: 700; color: #111827;">₹1,249</td>
                                    <td><span style="background: #dcfce7; color: #15803d; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 9999px;">Delivered</span></td>
                                    <td style="text-align: right;"><a href="#" style="color: #6b7280; text-decoration: none; font-weight: 500;">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- 2. Frequently Purchased -->
                    <div id="tabProducts" style="display: none;">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                            <div style="border: 1px solid #E5E2D9; border-radius: 8px; padding: 8px; text-align: center;">
                                <div style="height: 64px; background: #991b1b; border-radius: 4px; margin-bottom: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 8px; font-weight: 700;">PER</div>
                                <p style="font-size: 10px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Peri Peri Makhana</p>
                                <p style="font-size: 9px; color: #6b7280; margin-top: 2px;">4 purchases</p>
                            </div>
                            <div style="border: 1px solid #E5E2D9; border-radius: 8px; padding: 8px; text-align: center;">
                                <div style="height: 64px; background: #166534; border-radius: 4px; margin-bottom: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 8px; font-weight: 700;">PUD</div>
                                <p style="font-size: 10px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Pudina Makhana</p>
                                <p style="font-size: 9px; color: #6b7280; margin-top: 2px;">3 purchases</p>
                            </div>
                            <div style="border: 1px solid #E5E2D9; border-radius: 8px; padding: 8px; text-align: center;">
                                <div style="height: 64px; background: #fed7aa; border-radius: 4px; margin-bottom: 8px; display: flex; align-items: center; justify-content: center; color: #9a3412; font-size: 8px; font-weight: 700;">CLA</div>
                                <p style="font-size: 10px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Classic Makhana</p>
                                <p style="font-size: 9px; color: #6b7280; margin-top: 2px;">2 purchases</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Notes -->
                    <div id="tabNotes" style="display: none;">
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <div style="display: flex; gap: 12px; align-items: flex-start;">
                                <div style="width: 24px; height: 24px; border-radius: 9999px; background: #fed7aa; color: #9a3412; font-size: 10px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">A</div>
                                <div style="flex: 1; background: #F8F6F0; border: 1px solid #E5E2D9; border-radius: 8px; padding: 12px;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                                        <span style="font-size: 10px; font-weight: 700; color: #111827;">Admin</span>
                                        <span style="font-size: 8px; color: #9ca3af;">25 Sep 2026, 11:20 AM</span>
                                    </div>
                                    <p style="font-size: 11px; color: #4b5563;">Customer prefers evening delivery after 5 PM.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
</div>

<script>
    // Live Search Function
    function searchCustomers(query) {
        const q = query.toLowerCase().trim();
        document.querySelectorAll('.cus-row').forEach(row => {
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            const id = row.getAttribute('data-id');
            const phone = row.getAttribute('data-phone');

            if (name.includes(q) || email.includes(q) || id.includes(q) || phone.includes(q)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterByStatus(status) {
        document.querySelectorAll('.cus-row').forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'All' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function clearFilters() {
        document.getElementById('customerSearch').value = '';
        document.getElementById('statusFilter').value = 'All';
        searchCustomers('');
        filterByStatus('All');
    }

    // Select Customer into Right Details Panel
    function selectCustomer(c) {
        document.querySelectorAll('.cus-row').forEach(r => r.classList.remove('active-row'));
        const row = document.getElementById('row-' + c.id);
        if (row) row.classList.add('active-row');

        // Hero Profile
        const heroAvatar = document.getElementById('heroAvatar');
        heroAvatar.innerText = c.initial;
        heroAvatar.style.backgroundColor = c.color;
        heroAvatar.style.color = c.text;

        document.getElementById('heroName').innerText = c.name;
        document.getElementById('heroEmail').innerText = c.email;
        document.getElementById('heroPhone').innerText = c.phone;
        document.getElementById('heroJoined').innerText = c.joined;
        document.getElementById('heroId').innerText = c.id;

        const badge = document.getElementById('heroStatusBadge');
        badge.className = `status-badge st-${c.status}`;
        document.getElementById('heroStatusText').innerText = c.status;

        // Strip KPIs
        document.getElementById('stripOrders').innerText = c.orders;
        document.getElementById('stripTotal').innerText = '₹' + c.total.toLocaleString();
        document.getElementById('stripAvg').innerText = '₹' + c.avg;
        document.getElementById('stripLast').innerText = c.last;

        // Info
        document.getElementById('infoName').innerText = c.name;
        document.getElementById('infoEmail').innerText = c.email;
        document.getElementById('infoPhone').innerText = c.phone;
        document.getElementById('infoJoined').innerText = c.joined;
        document.getElementById('infoType').innerText = c.type || 'Standard';
        document.getElementById('addrName').innerText = c.name;
    }

    // Tab Switcher
    function switchTab(btn, paneId) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.getElementById('tabOrders').style.display = 'none';
        document.getElementById('tabProducts').style.display = 'none';
        document.getElementById('tabNotes').style.display = 'none';

        document.getElementById(paneId).style.display = 'block';
    }

    // Selection & Bulk Logic
    function handleRowCheck() {
        const checked = document.querySelectorAll('.cus-row-cb:checked');
        const count = checked.length;
        const total = document.querySelectorAll('.cus-row-cb').length;

        document.getElementById('selectedCount').innerText = `${count} customer selected`;
        document.getElementById('bulkActions').style.display = count > 0 ? 'inline-flex' : 'none';
        document.getElementById('masterCheckbox').checked = count === total && total > 0;
    }

    function toggleSelectAll(master) {
        document.querySelectorAll('.cus-row-cb').forEach(cb => {
            cb.checked = master.checked;
        });
        handleRowCheck();
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection