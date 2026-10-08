@extends('layouts.admin')

@section('title', 'Inventory Management - Riva Nair')

@section('content')
<style>
    /* Reset & Container */
    .inventory-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F5F2EA;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .inventory-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .inventory-page-wrapper { margin: -32px; }
    }

    .inventory-container {
        max-width: 1600px;
        margin: 0 auto;
        display: flex;
        gap: 24px;
        align-items: flex-start;
    }

    /* Common Card */
    .ui-inv-card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        padding: 24px;
    }

    .left-inv-panel {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 24px;
        min-width: 0;
        transition: all 0.3s ease;
    }

    /* Top Section & Header */
    .inv-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .inv-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 28px;
        color: #111827;
        line-height: 1.1;
    }

    .inv-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .btn-inv-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #E5E2D9;
        background-color: #ffffff;
        color: #374151;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-inv-secondary:hover { background-color: #f9fafb; }

    .btn-inv-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        background-color: #3B5240;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-inv-primary:hover { background-color: #2A3C2E; }

    /* KPI Grid */
    .inv-kpi-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 768px) {
        .inv-kpi-grid { grid-template-columns: repeat(4, 1fr); }
    }

    .inv-kpi-card {
        border-radius: 12px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #E5E2D9;
        background-color: #ffffff;
    }

    .kpi-total-box { border-color: #E5E2D9; background-color: #ffffff; }
    .kpi-instock-box { border-color: #bbf7d0; background-color: #f0fdf4; }
    .kpi-lowstock-box { border-color: #ffedd5; background-color: #fff7ed; }
    .kpi-outstock-box { border-color: #fee2e2; background-color: #fef2f2; }

    .kpi-icon-heading {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .kpi-number-stat {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        line-height: 1.1;
    }

    .mini-chart {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 24px;
    }

    .mini-bar {
        width: 6px;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
    }

    /* Alert Notice Banner */
    .inv-alert-banner {
        background-color: #FFFDF5;
        border: 1px solid #fed7aa;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .mini-prod-bubble {
        background: #ffffff;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 6px 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        width: 144px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }

    /* Search Filters */
    .filter-ctrls-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
    }

    .inv-search-field {
        position: relative;
        flex: 1;
        min-width: 240px;
    }

    .inv-search-field i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .inv-input-box {
        width: 100%;
        background-color: #F8F6F0;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 10px 16px 10px 38px;
        font-size: 12px;
        color: #374151;
        outline: none;
        box-sizing: border-box;
    }

    .inv-input-box:focus { border-color: #3B5240; }

    .dropdown-pill {
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #ffffff;
        font-size: 12px;
        color: #4b5563;
        width: 144px;
        cursor: pointer;
    }

    /* Table Styles */
    .inv-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
    }

    .inv-table {
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        font-size: 11px;
    }

    .inv-table th {
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

    .inv-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #E5E2D9;
        white-space: nowrap;
    }

    .inv-table tr:hover { background-color: #f9fafb; }

    .prod-mini-badge {
        width: 28px;
        height: 36px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 7px;
        font-weight: 700;
        color: #ffffff;
        flex-shrink: 0;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Progress bar */
    .stock-meter-bg {
        width: 100%;
        background-color: #e5e7eb;
        height: 4px;
        border-radius: 9999px;
        overflow: hidden;
        margin-top: 4px;
    }

    .status-tag {
        display: inline-flex;
        align-items: center;
        padding: 2px 6px;
        border-radius: 9999px;
        font-size: 9px;
        font-weight: 700;
    }

    .status-tag .dot {
        width: 4px;
        height: 4px;
        border-radius: 9999px;
        margin-right: 4px;
    }

    .tag-Healthy { background-color: #dcfce7; color: #15803d; }
    .tag-Healthy .dot { background-color: #22c55e; }

    .tag-LowStock { background-color: #fef9c3; color: #a16207; }
    .tag-LowStock .dot { background-color: #eab308; }

    .tag-Critical { background-color: #ffedd5; color: #c2410c; }
    .tag-Critical .dot { background-color: #f97316; }

    .tag-OutOfStock { background-color: #fee2e2; color: #b91c1c; }
    .tag-OutOfStock .dot { background-color: #ef4444; }

    /* Right Panel (Stock Adjustment) */
    .right-inv-panel {
        width: 100%;
        flex-shrink: 0;
    }

    @media (min-width: 1280px) {
        .right-inv-panel { width: 420px; }
    }

    .drawer-card {
        background-color: #FAFAF8;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 24px;
        max-height: calc(100vh - 48px);
    }

    .drawer-header {
        padding: 20px 24px;
        border-bottom: 1px solid #E5E2D9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #ffffff;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .drawer-scroll-body {
        padding: 24px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .input-label {
        display: block;
        font-size: 11px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .drawer-ctrl {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 12px;
        color: #111827;
        outline: none;
        box-sizing: border-box;
    }

    .drawer-ctrl:focus { border-color: #3B5240; }

    .radio-pill-group {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .radio-lbl {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #374151;
        cursor: pointer;
    }

    .radio-dot-circle {
        width: 14px;
        height: 14px;
        border-radius: 9999px;
        border: 1px solid #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .radio-dot-circle.checked {
        border-color: #3B5240;
    }

    .radio-dot-inner {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        background-color: #3B5240;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10px;
    }

    .history-table th {
        font-size: 9px;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        padding-bottom: 8px;
        border-bottom: 1px solid #E5E2D9;
        text-align: left;
    }

    .history-table td {
        padding: 8px 0;
        border-bottom: 1px solid #f3f4f6;
    }
</style>

@php
    $inventoryItems = [
        ['id' => '1', 'name' => 'Peri Peri Makhana', 'size' => '100g', 'sku' => 'RN-PP100', 'category' => 'Flavoured', 'variant' => '100g', 'current' => 42, 'max' => 50, 'threshold' => 10, 'status' => 'Healthy', 'date' => "30 Sep 2026\n10:24 AM", 'color' => '#991b1b'],
        ['id' => '2', 'name' => 'Pudina Makhana', 'size' => '100g', 'sku' => 'RN-PD100', 'category' => 'Flavoured', 'variant' => '100g', 'current' => 35, 'max' => 50, 'threshold' => 10, 'status' => 'Healthy', 'date' => "29 Sep 2026\n04:12 PM", 'color' => '#166534'],
        ['id' => '3', 'name' => 'Himalayan Salt Makhana', 'size' => '100g', 'sku' => 'RN-HS100', 'category' => 'Flavoured', 'variant' => '100g', 'current' => 12, 'max' => 50, 'threshold' => 15, 'status' => 'Low Stock', 'date' => "29 Sep 2026\n11:03 AM", 'color' => '#f9a8d4'],
        ['id' => '4', 'name' => 'Classic Makhana', 'size' => '100g', 'sku' => 'RN-CL100', 'category' => 'Classic', 'variant' => '100g', 'current' => 120, 'max' => 150, 'threshold' => 20, 'status' => 'Healthy', 'date' => "28 Sep 2026\n02:41 PM", 'color' => '#6b7280'],
        ['id' => '5', 'name' => 'Achari Makhana', 'size' => '100g', 'sku' => 'RN-AC100', 'category' => 'Flavoured', 'variant' => '100g', 'current' => 7, 'max' => 50, 'threshold' => 15, 'status' => 'Critical', 'date' => "27 Sep 2026\n09:15 AM", 'color' => '#c2410c'],
        ['id' => '6', 'name' => 'Cheese Makhana', 'size' => '100g', 'sku' => 'RN-CH100', 'category' => 'Flavoured', 'variant' => '100g', 'current' => 28, 'max' => 50, 'threshold' => 15, 'status' => 'Low Stock', 'date' => "27 Sep 2026\n01:20 PM", 'color' => '#eab308'],
        ['id' => '7', 'name' => 'Makhana Combo Pack', 'size' => '300g', 'sku' => 'RN-CB300', 'category' => 'Combos', 'variant' => '300g', 'current' => 18, 'max' => 50, 'threshold' => 10, 'status' => 'Low Stock', 'date' => "26 Sep 2026\n06:30 PM", 'color' => '#14532d'],
        ['id' => '8', 'name' => 'Gift Box - Premium', 'size' => '500g', 'sku' => 'RN-GB500', 'category' => 'Gift Boxes', 'variant' => '500g', 'current' => 0, 'max' => 20, 'threshold' => 5, 'status' => 'Out of Stock', 'date' => "26 Sep 2026\n03:11 PM", 'color' => '#292524'],
        ['id' => '9', 'name' => 'Classic Makhana', 'size' => '200g', 'sku' => 'RN-CL200', 'category' => 'Classic', 'variant' => '200g', 'current' => 62, 'max' => 100, 'threshold' => 20, 'status' => 'Healthy', 'date' => "25 Sep 2026\n10:05 AM", 'color' => '#6b7280'],
        ['id' => '10', 'name' => 'Peri Peri Makhana', 'size' => '200g', 'sku' => 'RN-PP200', 'category' => 'Flavoured', 'variant' => '200g', 'current' => 14, 'max' => 50, 'threshold' => 15, 'status' => 'Low Stock', 'date' => "25 Sep 2026\n05:43 PM", 'color' => '#991b1b'],
    ];

    $barColors = [
        'Healthy' => '#22c55e',
        'Low Stock' => '#eab308',
        'Critical' => '#ef4444',
        'Out of Stock' => '#ef4444'
    ];
@endphp

<div class="inventory-page-wrapper">
    <div class="inventory-container">

        <!-- ================= LEFT AREA ================= -->
        <div class="left-inv-panel" id="leftPanel">
            
            <!-- Top Controls & KPIs -->
            <div class="ui-inv-card">
                <div class="inv-header">
                    <div>
                        <h1 class="inv-title">Inventory</h1>
                        <p class="inv-subtitle">Monitor stock levels and manage product availability.</p>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <button type="button" class="btn-inv-secondary">
                            <i data-lucide="download" style="width: 14px; height: 14px;"></i> Export
                        </button>
                        <button type="button" class="btn-inv-primary" onclick="openDrawer()">
                            <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Stock Adjustment
                        </button>
                    </div>
                </div>

                <!-- KPI Cards -->
                <div class="inv-kpi-grid">
                    <!-- Total Items -->
                    <div class="inv-kpi-card kpi-total-box">
                        <div>
                            <div class="kpi-icon-heading" style="color: #4b5563;">
                                <i data-lucide="package" style="width: 14px; height: 14px;"></i> Total Items
                            </div>
                            <span class="kpi-number-stat">1,284</span>
                        </div>
                        <div class="mini-chart">
                            <div class="mini-bar" style="height: 12px; background: #9ca3af; opacity: 0.4;"></div>
                            <div class="mini-bar" style="height: 16px; background: #9ca3af; opacity: 0.6;"></div>
                            <div class="mini-bar" style="height: 8px; background: #9ca3af; opacity: 0.3;"></div>
                            <div class="mini-bar" style="height: 24px; background: #9ca3af; opacity: 0.8;"></div>
                            <div class="mini-bar" style="height: 20px; background: #9ca3af; opacity: 1;"></div>
                        </div>
                    </div>

                    <!-- In Stock -->
                    <div class="inv-kpi-card kpi-instock-box">
                        <div>
                            <div class="kpi-icon-heading" style="color: #166534;">
                                <div style="width: 16px; height: 16px; border-radius: 9999px; background: #16a34a; color: #fff; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="package" style="width: 10px; height: 10px;"></i>
                                </div>
                                In Stock
                            </div>
                            <span class="kpi-number-stat">1,196</span>
                        </div>
                        <div class="mini-chart">
                            <div class="mini-bar" style="height: 12px; background: #22c55e; opacity: 0.4;"></div>
                            <div class="mini-bar" style="height: 16px; background: #22c55e; opacity: 0.6;"></div>
                            <div class="mini-bar" style="height: 8px; background: #22c55e; opacity: 0.3;"></div>
                            <div class="mini-bar" style="height: 24px; background: #22c55e; opacity: 0.8;"></div>
                            <div class="mini-bar" style="height: 20px; background: #22c55e; opacity: 1;"></div>
                        </div>
                    </div>

                    <!-- Low Stock -->
                    <div class="inv-kpi-card kpi-lowstock-box">
                        <div>
                            <div class="kpi-icon-heading" style="color: #9a3412;">
                                <i data-lucide="alert-triangle" style="width: 14px; height: 14px;"></i> Low Stock
                            </div>
                            <span class="kpi-number-stat">72</span>
                        </div>
                        <div class="mini-chart">
                            <div class="mini-bar" style="height: 12px; background: #fb923c; opacity: 0.4;"></div>
                            <div class="mini-bar" style="height: 16px; background: #fb923c; opacity: 0.6;"></div>
                            <div class="mini-bar" style="height: 8px; background: #fb923c; opacity: 0.3;"></div>
                            <div class="mini-bar" style="height: 24px; background: #fb923c; opacity: 0.8;"></div>
                            <div class="mini-bar" style="height: 20px; background: #fb923c; opacity: 1;"></div>
                        </div>
                    </div>

                    <!-- Out of Stock -->
                    <div class="inv-kpi-card kpi-outstock-box">
                        <div>
                            <div class="kpi-icon-heading" style="color: #991b1b;">
                                <i data-lucide="x-circle" style="width: 14px; height: 14px;"></i> Out of Stock
                            </div>
                            <span class="kpi-number-stat">16</span>
                        </div>
                        <div class="mini-chart">
                            <div class="mini-bar" style="height: 12px; background: #f87171; opacity: 0.4;"></div>
                            <div class="mini-bar" style="height: 16px; background: #f87171; opacity: 0.6;"></div>
                            <div class="mini-bar" style="height: 8px; background: #f87171; opacity: 0.3;"></div>
                            <div class="mini-bar" style="height: 24px; background: #f87171; opacity: 0.8;"></div>
                            <div class="mini-bar" style="height: 20px; background: #f87171; opacity: 1;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table & Alert Section -->
            <div class="ui-inv-card">
                <!-- Alert Banner -->
                <div class="inv-alert-banner">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i data-lucide="alert-triangle" style="width: 20px; height: 20px; color: #f97316;"></i>
                        <div>
                            <h3 style="font-size: 14px; font-weight: 700; color: #111827;">16 products need attention</h3>
                            <p style="font-size: 11px; color: #6b7280; margin-top: 2px;">These products are low in stock or out of stock.</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="display: flex; gap: 8px;">
                            <div class="mini-prod-bubble">
                                <div style="width: 24px; height: 32px; background: #c2410c; border-radius: 4px; color: #fff; font-size: 6px; font-weight: 700; display: flex; align-items: center; justify-content: center;">Ach</div>
                                <div style="min-width: 0;">
                                    <p style="font-size: 9px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Achari Makhana</p>
                                    <p style="font-size: 9px; font-weight: 700; color: #dc2626;">7 units remaining</p>
                                </div>
                            </div>

                            <div class="mini-prod-bubble">
                                <div style="width: 24px; height: 32px; background: #f9a8d4; border-radius: 4px; color: #fff; font-size: 6px; font-weight: 700; display: flex; align-items: center; justify-content: center;">Him</div>
                                <div style="min-width: 0;">
                                    <p style="font-size: 9px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Himalayan Salt...</p>
                                    <p style="font-size: 9px; font-weight: 700; color: #ea580c;">12 units remaining</p>
                                </div>
                            </div>
                        </div>

                        <button type="button" style="border: none; background: transparent; font-size: 11px; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                            View All Low Stock <i data-lucide="arrow-right" style="width: 12px; height: 12px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-ctrls-row">
                    <div class="inv-search-field">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input 
                            type="text" 
                            id="searchInv" 
                            oninput="searchInventory(this.value)" 
                            placeholder="Search product, SKU, or flavour..." 
                            class="inv-input-box"
                        >
                    </div>
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <div class="dropdown-pill"><span>All Categories</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                        <div class="dropdown-pill"><span>All Stock Status</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                        <div class="dropdown-pill"><span>All Pack Sizes</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                        <button type="button" onclick="clearFilters()" style="border: none; background: transparent; color: #6b7280; font-size: 12px; font-weight: 500; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                            <i data-lucide="refresh-cw" style="width: 12px; height: 12px;"></i> Clear Filters
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="inv-table-wrap">
                    <table class="inv-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" id="masterCb" onchange="toggleSelectAll(this)" style="cursor: pointer;">
                                </th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Variant</th>
                                <th style="width: 128px;">Current Stock</th>
                                <th style="text-align: center;">Threshold</th>
                                <th>Stock Status</th>
                                <th>Last Updated</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTbody">
                            @foreach($inventoryItems as $item)
                                @php
                                    $pct = ($item['current'] / $item['max']) * 100;
                                    $statusClass = str_replace(' ', '', $item['status']);
                                @endphp
                                <tr 
                                    class="inv-row" 
                                    data-name="{{ strtolower($item['name']) }}"
                                    data-sku="{{ strtolower($item['sku']) }}"
                                >
                                    <td>
                                        <input 
                                            type="checkbox" 
                                            class="inv-item-cb" 
                                            value="{{ $item['id'] }}" 
                                            onchange="handleRowCheck()" 
                                            style="cursor: pointer;"
                                        >
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div class="prod-mini-badge" style="background-color: {{ $item['color'] }};">
                                                {{ strtoupper(substr($item['name'], 0, 3)) }}
                                            </div>
                                            <div style="min-width: 0;">
                                                <p style="font-weight: 700; color: #111827;">{{ $item['name'] }}</p>
                                                <p style="font-size: 10px; color: #6b7280;">{{ $item['size'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="color: #4b5563; font-weight: 500;">{{ $item['sku'] }}</td>
                                    <td style="color: #4b5563;">{{ $item['category'] }}</td>
                                    <td style="color: #4b5563;">{{ $item['variant'] }}</td>
                                    <td>
                                        <div>
                                            <span style="font-size: 10px; font-weight: 700; color: #111827;">
                                                {{ $item['current'] }} <span style="color: #9ca3af; font-weight: 400;">/ {{ $item['max'] }}</span>
                                            </span>
                                            <div class="stock-meter-bg">
                                                <div style="height: 100%; width: {{ $pct }}%; background-color: {{ $barColors[$item['status']] }};"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center; color: #111827; font-weight: 600;">{{ $item['threshold'] }}</td>
                                    <td>
                                        <span class="status-tag tag-{{ $statusClass }}">
                                            <span class="dot"></span>
                                            {{ $item['status'] }}
                                        </span>
                                    </td>
                                    <td style="color: #6b7280; white-space: pre-line; font-size: 10px;">{{ $item['date'] }}</td>
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

                <!-- Footer Controls -->
                <div style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span id="selectedCount" style="font-size: 12px; font-weight: 500; color: #6b7280;">
                            0 products selected
                        </span>
                        <div id="bulkActions" style="display: none; gap: 8px;">
                            <button type="button" class="btn-inv-secondary" style="padding: 6px 12px;">
                                <i data-lucide="package" style="width: 12px; height: 12px;"></i> Update Stock
                            </button>
                            <button type="button" class="btn-inv-secondary" style="padding: 6px 12px;">
                                <i data-lucide="download" style="width: 12px; height: 12px;"></i> Export
                            </button>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 24px;">
                        <span style="font-size: 10px; color: #9ca3af;">Showing 1-{{ count($inventoryItems) }} of 86 variants</span>
                        <div style="display: flex; align-items: center; gap: 4px; font-size: 12px;">
                            <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: #3B5240; color: #fff; font-weight: 500;">1</button>
                            <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: transparent; color: #4b5563;">2</button>
                            <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: transparent; color: #4b5563;">3</button>
                            <span style="color: #9ca3af; padding: 0 4px;">...</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= RIGHT PANEL: STOCK ADJUSTMENT ================= -->
        <div class="right-inv-panel" id="rightPanel">
            <div class="drawer-card">
                
                <!-- Drawer Header -->
                <div class="drawer-header">
                    <h2 class="inv-title" style="font-size: 18px;">Stock Adjustment</h2>
                    <button type="button" onclick="closeDrawer()" style="background: none; border: none; cursor: pointer; color: #9ca3af;">
                        <i data-lucide="x" style="width: 18px; height: 18px;"></i>
                    </button>
                </div>

                <!-- Drawer Body Form -->
                <div class="drawer-scroll-body">
                    
                    <!-- Form Controls -->
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <div>
                            <label class="input-label">Product *</label>
                            <div style="position: relative;">
                                <div style="width: 100%; background: #fff; border: 1px solid #E5E2D9; border-radius: 8px; padding: 8px 12px; font-size: 12px; display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <div style="width: 20px; height: 24px; background: #991b1b; border-radius: 2px;"></div>
                                    <span style="font-weight: 500; color: #111827;">Peri Peri Makhana</span>
                                </div>
                                <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                            </div>
                        </div>

                        <div>
                            <label class="input-label">Variant *</label>
                            <div style="position: relative;">
                                <select class="drawer-ctrl" style="appearance: none; cursor: pointer;">
                                    <option>100g (RN-PP100)</option>
                                </select>
                                <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                            </div>
                        </div>

                        <div style="display: flex; gap: 24px; padding: 8px 0; border-bottom: 1px solid #E5E2D9;">
                            <div>
                                <p style="font-size: 10px; color: #6b7280;">Current Stock</p>
                                <p style="font-size: 14px; font-weight: 700; color: #111827;">42 units</p>
                            </div>
                            <div>
                                <p style="font-size: 10px; color: #6b7280;">Available Stock</p>
                                <p style="font-size: 14px; font-weight: 700; color: #111827;">42 units</p>
                            </div>
                        </div>

                        <div>
                            <label class="input-label">Adjustment Type *</label>
                            <div class="radio-pill-group">
                                <label class="radio-lbl" onclick="setAdjustmentType('Add Stock')">
                                    <div class="radio-dot-circle checked" id="dot-Add">
                                        <div class="radio-dot-inner" id="inner-Add"></div>
                                    </div>
                                    Add Stock
                                </label>
                                <label class="radio-lbl" onclick="setAdjustmentType('Remove Stock')">
                                    <div class="radio-dot-circle" id="dot-Remove">
                                        <div class="radio-dot-inner" id="inner-Remove" style="display: none;"></div>
                                    </div>
                                    Remove Stock
                                </label>
                                <label class="radio-lbl" onclick="setAdjustmentType('Set Stock')">
                                    <div class="radio-dot-circle" id="dot-Set">
                                        <div class="radio-dot-inner" id="inner-Set" style="display: none;"></div>
                                    </div>
                                    Set Stock
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="input-label">Quantity *</label>
                            <input type="number" value="50" class="drawer-ctrl" style="font-weight: 600;">
                        </div>

                        <div>
                            <label class="input-label">Reason *</label>
                            <div style="position: relative;">
                                <select class="drawer-ctrl" style="appearance: none; cursor: pointer;">
                                    <option>New stock received</option>
                                    <option>Damaged stock</option>
                                    <option>Inventory reconciliation</option>
                                </select>
                                <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                            </div>
                        </div>

                        <div style="border: 1px solid #E5E2D9; border-radius: 8px; background: #fff; padding: 8px; position: relative;">
                            <label style="font-size: 11px; font-weight: 500; color: #6b7280; display: block; margin-bottom: 4px;">Note</label>
                            <textarea rows="2" placeholder="Add a note (optional)..." style="width: 100%; border: none; font-size: 12px; outline: none; resize: none; background: transparent;"></textarea>
                            <span style="position: absolute; bottom: 6px; right: 8px; font-size: 9px; color: #9ca3af;">0/200</span>
                        </div>

                        <div style="display: flex; gap: 12px; margin-top: 4px;">
                            <button type="button" onclick="closeDrawer()" class="btn-inv-secondary" style="flex: 1; justify-content: center;">Cancel</button>
                            <button type="button" class="btn-inv-primary" style="flex: 1; justify-content: center;">Update Stock</button>
                        </div>
                    </div>

                    <hr style="border: none; border-top: 1px solid #E5E2D9;">

                    <!-- Product Detail Mini Profile -->
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                            <h3 style="font-size: 14px; font-weight: 700; color: #111827;">Product Detail</h3>
                            <button type="button" style="border: none; background: transparent; font-size: 10px; color: #6b7280; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                                <i data-lucide="edit-3" style="width: 10px; height: 10px;"></i> Edit Product
                            </button>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px;">
                            <div style="width: 48px; height: 56px; background: #991b1b; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 8px; font-weight: 700; flex-shrink: 0;">
                                PER
                            </div>
                            <div>
                                <h4 style="font-size: 14px; font-weight: 700; color: #111827;">Peri Peri Makhana</h4>
                                <p style="font-size: 10px; color: #6b7280;">100g</p>
                                <p style="font-size: 10px; color: #6b7280;">SKU: RN-PP100</p>
                            </div>
                            <span class="status-tag tag-Healthy" style="margin-left: auto;">
                                <span class="dot"></span> Active
                            </span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; font-size: 12px;">
                            <div>
                                <p style="font-size: 9px; color: #6b7280;">Current Stock</p>
                                <p style="font-weight: 700; color: #111827;">42</p>
                            </div>
                            <div>
                                <p style="font-size: 9px; color: #6b7280;">Reserved</p>
                                <p style="font-weight: 700; color: #111827;">5</p>
                            </div>
                            <div>
                                <p style="font-size: 9px; color: #6b7280;">Available</p>
                                <p style="font-weight: 700; color: #111827;">37</p>
                            </div>
                            <div>
                                <p style="font-size: 9px; color: #6b7280;">Threshold</p>
                                <p style="font-weight: 700; color: #111827;">10</p>
                            </div>
                        </div>
                    </div>

                    <hr style="border: none; border-top: 1px solid #E5E2D9;">

                    <!-- Stock History -->
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <h3 style="font-size: 14px; font-weight: 700; color: #111827;">Stock History</h3>
                            <button type="button" style="border: none; background: transparent; font-size: 10px; color: #6b7280; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                                View All <i data-lucide="arrow-right" style="width: 10px; height: 10px;"></i>
                            </button>
                        </div>

                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Change</th>
                                    <th>Reason</th>
                                    <th>Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>30 Sep 2026</td>
                                    <td style="font-weight: 700; color: #16a34a;">+50</td>
                                    <td style="color: #6b7280;">New stock received</td>
                                    <td style="color: #6b7280;">Admin</td>
                                </tr>
                                <tr>
                                    <td>28 Sep 2026</td>
                                    <td style="font-weight: 700; color: #dc2626;">-2</td>
                                    <td style="color: #6b7280;">Order #RN10241</td>
                                    <td style="color: #6b7280;">System</td>
                                </tr>
                                <tr>
                                    <td>27 Sep 2026</td>
                                    <td style="font-weight: 700; color: #dc2626;">-5</td>
                                    <td style="color: #6b7280;">Order #RN10235</td>
                                    <td style="color: #6b7280;">System</td>
                                </tr>
                                <tr>
                                    <td>25 Sep 2026</td>
                                    <td style="font-weight: 700; color: #16a34a;">+20</td>
                                    <td style="color: #6b7280;">Manual adjustment</td>
                                    <td style="color: #6b7280;">Admin</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function openDrawer() {
        document.getElementById('rightPanel').style.display = 'block';
    }

    function closeDrawer() {
        document.getElementById('rightPanel').style.display = 'none';
    }

    function searchInventory(query) {
        const q = query.toLowerCase().trim();
        document.querySelectorAll('.inv-row').forEach(row => {
            const name = row.getAttribute('data-name');
            const sku = row.getAttribute('data-sku');
            if (name.includes(q) || sku.includes(q)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function clearFilters() {
        document.getElementById('searchInv').value = '';
        searchInventory('');
    }

    function handleRowCheck() {
        const checked = document.querySelectorAll('.inv-item-cb:checked');
        const count = checked.length;
        const total = document.querySelectorAll('.inv-item-cb').length;

        document.getElementById('selectedCount').innerText = `${count} products selected`;
        document.getElementById('bulkActions').style.display = count > 0 ? 'inline-flex' : 'none';
        document.getElementById('masterCb').checked = count === total && total > 0;
    }

    function toggleSelectAll(master) {
        document.querySelectorAll('.inv-item-cb').forEach(cb => {
            cb.checked = master.checked;
        });
        handleRowCheck();
    }

    function setAdjustmentType(type) {
        const types = ['Add', 'Remove', 'Set'];
        types.forEach(t => {
            const dot = document.getElementById(`dot-${t}`);
            const inner = document.getElementById(`inner-${t}`);
            if (`${t} Stock` === type) {
                dot.classList.add('checked');
                inner.style.display = 'block';
            } else {
                dot.classList.remove('checked');
                inner.style.display = 'none';
            }
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection