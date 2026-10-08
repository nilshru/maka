@extends('layouts.admin')

@section('title', 'Products Management - Riva Nair')

@section('content')
<style>
    /* Base Container */
    .products-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F5F2EA;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .products-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .products-page-wrapper { margin: -32px; }
    }

    .products-container {
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Common Card Styling */
    .ui-panel {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        padding: 24px;
    }

    /* Header Section */
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .panel-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 28px;
        color: #111827;
        line-height: 1.1;
    }

    .panel-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .header-actions-group {
        display: flex;
        gap: 12px;
    }

    .btn-secondary {
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

    .btn-secondary:hover {
        background-color: #f9fafb;
    }

    .btn-primary {
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

    .btn-primary:hover {
        background-color: #2A3C2E;
    }

    /* KPI Grid Cards */
    .kpi-cards-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (min-width: 640px) {
        .kpi-cards-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 1024px) {
        .kpi-cards-grid { grid-template-columns: repeat(4, 1fr); }
    }

    .product-kpi-card {
        border-radius: 12px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .product-kpi-card:hover {
        transform: translateY(-2px);
    }

    .kpi-heading {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .kpi-val {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
    }

    .kpi-all-box { background-color: #f0fdf4; border: 1px solid #dcfce7; color: #166534; }
    .kpi-active-box { background-color: #ffffff; border: 1px solid #dcfce7; color: #16a34a; }
    .kpi-low-box { background-color: #ffffff; border: 1px solid #ffedd5; color: #ea580c; }
    .kpi-out-box { background-color: #ffffff; border: 1px solid #fee2e2; color: #dc2626; }

    /* Mini Bar Chart inside KPI */
    .mini-bar-chart {
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

    /* Filters Bar */
    .products-filters-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
    }

    .search-wrap {
        position: relative;
        flex: 1;
        max-width: 448px;
    }

    .search-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .search-input {
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

    .search-input:focus {
        border-color: #3B5240;
    }

    .dropdown-pill {
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #ffffff;
        font-size: 12px;
        color: #4b5563;
        width: 144px;
        cursor: pointer;
    }

    .dropdown-pill:hover { background-color: #f9fafb; }

    .clear-link {
        border: none;
        background: transparent;
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        margin-left: 8px;
    }

    .clear-link:hover { color: #111827; }

    /* Table */
    .table-container {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
    }

    .products-table {
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        font-size: 12px;
    }

    .products-table th {
        background-color: #F8F6F0;
        padding: 12px 16px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.05em;
        white-space: nowrap;
        border-bottom: 1px solid #E5E2D9;
    }

    .products-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #E5E2D9;
        white-space: nowrap;
    }

    .products-table tr:hover { background-color: #f9fafb; }

    .prod-avatar {
        width: 32px;
        height: 40px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8px;
        font-weight: 700;
        color: #ffffff;
        flex-shrink: 0;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 9999px;
        font-size: 10px;
        font-weight: 700;
    }

    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        margin-right: 6px;
    }

    .st-Active { background-color: #dcfce7; color: #15803d; }
    .st-Active .dot { background-color: #22c55e; }

    .st-LowStock { background-color: #ffedd5; color: #c2410c; }
    .st-LowStock .dot { background-color: #f97316; }

    .st-OutOfStock { background-color: #fee2e2; color: #b91c1c; }
    .st-OutOfStock .dot { background-color: #ef4444; }

    /* Footer & Bulk */
    .table-footer {
        margin-top: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 16px;
    }

    @media (min-width: 768px) {
        .table-footer { flex-direction: row; align-items: center; }
    }

    .bulk-btns-list {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .bulk-btn-action {
        font-size: 12px;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* ================= ADD PRODUCT VIEW ================= */
    .add-product-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-top: 24px;
    }

    @media (min-width: 1024px) {
        .add-product-grid {
            grid-template-columns: 2fr 6fr 4fr;
        }
    }

    /* Left Step Nav */
    .step-nav-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 12px;
        border: none;
        background: transparent;
        cursor: pointer;
        text-align: left;
        color: #4b5563;
        font-weight: 500;
    }

    .step-nav-btn.active {
        background-color: #f0fdf4;
        color: #3B5240;
        font-weight: 700;
    }

    .step-nav-btn:hover:not(.active) {
        background-color: #f9fafb;
    }

    /* Forms Elements */
    .form-group-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 4px;
    }

    .form-ctrl {
        width: 100%;
        background-color: #F8F6F0;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        color: #111827;
        outline: none;
        box-sizing: border-box;
    }

    .form-ctrl:focus {
        border-color: #3B5240;
    }

    /* Rich Text Toolbar Mock */
    .editor-wrapper {
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        overflow: hidden;
        background: #ffffff;
    }

    .editor-toolbar {
        background-color: #F8F6F0;
        border-bottom: 1px solid #E5E2D9;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #6b7280;
    }

    .editor-toolbar i {
        cursor: pointer;
    }

    .editor-toolbar i:hover { color: #111827; }

    /* Dropzone Upload */
    .dropzone-upload {
        border: 2px dashed #E5E2D9;
        border-radius: 12px;
        background-color: #F8F6F0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 16px;
        margin-bottom: 20px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .dropzone-upload:hover {
        background-color: #f9fafb;
    }

    /* Live Preview Card */
    .preview-phone-card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        padding: 20px;
    }

    .preview-header-images {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .preview-thumbnail-stack {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .thumb-preview-box {
        width: 40px;
        height: 48px;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
    }

    .main-pack-mock {
        width: 192px;
        height: 256px;
        background: linear-gradient(to bottom, #b91c1c, #7f1d1d);
        border-radius: 8px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        padding: 16px;
        text-align: center;
    }
</style>

@php
    $products = [
        ['id' => '1', 'name' => 'Peri Peri Makhana', 'size' => '100g', 'sku' => 'RN-PP100', 'category' => 'Flavoured', 'flavour' => 'Peri Peri', 'price' => 249, 'stock' => 42, 'status' => 'Active', 'date' => '30 Sep 2026', 'color' => '#991b1b'],
        ['id' => '2', 'name' => 'Pudina Makhana', 'size' => '100g', 'sku' => 'RN-PD100', 'category' => 'Flavoured', 'flavour' => 'Pudina', 'price' => 249, 'stock' => 35, 'status' => 'Active', 'date' => '29 Sep 2026', 'color' => '#166534'],
        ['id' => '3', 'name' => 'Himalayan Salt Makhana', 'size' => '100g', 'sku' => 'RN-HS100', 'category' => 'Flavoured', 'flavour' => 'Himalayan Salt', 'price' => 229, 'stock' => 12, 'status' => 'Low Stock', 'date' => '29 Sep 2026', 'color' => '#f9a8d4'],
        ['id' => '4', 'name' => 'Classic Makhana', 'size' => '100g', 'sku' => 'RN-CL100', 'category' => 'Classic', 'flavour' => 'Classic', 'price' => 199, 'stock' => 120, 'status' => 'Active', 'date' => '28 Sep 2026', 'color' => '#6b7280'],
        ['id' => '5', 'name' => 'Achari Makhana', 'size' => '100g', 'sku' => 'RN-AC100', 'category' => 'Flavoured', 'flavour' => 'Achari', 'price' => 249, 'stock' => 7, 'status' => 'Low Stock', 'date' => '27 Sep 2026', 'color' => '#c2410c'],
        ['id' => '6', 'name' => 'Cheese Makhana', 'size' => '100g', 'sku' => 'RN-CH100', 'category' => 'Flavoured', 'flavour' => 'Cheese', 'price' => 249, 'stock' => 0, 'status' => 'Out of Stock', 'date' => '26 Sep 2026', 'color' => '#eab308'],
    ];

    $kpiCounts = [
        'all' => 24,
        'active' => 21,
        'low' => 3,
        'out' => 1,
    ];
@endphp

<div class="products-page-wrapper">
    <div class="products-container">

        <!-- ================= PRODUCT LIST VIEW ================= -->
        <div class="ui-panel" id="productListView">
            <!-- Header -->
            <div class="panel-header">
                <div>
                    <h1 class="panel-title">Products</h1>
                    <p class="panel-subtitle">Manage your makhana products, pricing and availability.</p>
                </div>
                <div class="header-actions-group">
                    <button type="button" class="btn-secondary">
                        <i data-lucide="upload" style="width: 14px; height: 14px;"></i> Import
                    </button>
                    <button type="button" class="btn-primary" onclick="switchView('add')">
                        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Add Product
                    </button>
                </div>
            </div>

            <!-- KPI Cards Grid -->
            <div class="kpi-cards-grid">
                <!-- All Products -->
                <div class="product-kpi-card kpi-all-box">
                    <div>
                        <div class="kpi-heading">
                            <i data-lucide="package" style="width: 14px; height: 14px;"></i> All Products
                        </div>
                        <span class="kpi-val">{{ $kpiCounts['all'] }}</span>
                    </div>
                    <div class="mini-bar-chart">
                        <div class="mini-bar" style="height: 8px; background: #16a34a; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 14px; background: #16a34a; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 6px; background: #16a34a; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 20px; background: #16a34a; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 16px; background: #16a34a; opacity: 1;"></div>
                    </div>
                </div>

                <!-- Active Products -->
                <div class="product-kpi-card kpi-active-box">
                    <div>
                        <div class="kpi-heading" style="color: #16a34a;">
                            <i data-lucide="check-circle-2" style="width: 14px; height: 14px;"></i> Active Products
                        </div>
                        <span class="kpi-val">{{ $kpiCounts['active'] }}</span>
                    </div>
                    <div class="mini-bar-chart">
                        <div class="mini-bar" style="height: 8px; background: #22c55e; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 14px; background: #22c55e; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 6px; background: #22c55e; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 20px; background: #22c55e; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 16px; background: #22c55e; opacity: 1;"></div>
                    </div>
                </div>

                <!-- Low Stock -->
                <div class="product-kpi-card kpi-low-box">
                    <div>
                        <div class="kpi-heading" style="color: #ea580c;">
                            <i data-lucide="alert-triangle" style="width: 14px; height: 14px;"></i> Low Stock
                        </div>
                        <span class="kpi-val">{{ $kpiCounts['low'] }}</span>
                    </div>
                    <div class="mini-bar-chart">
                        <div class="mini-bar" style="height: 8px; background: #fb923c; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 14px; background: #fb923c; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 6px; background: #fb923c; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 20px; background: #fb923c; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 16px; background: #fb923c; opacity: 1;"></div>
                    </div>
                </div>

                <!-- Out of Stock -->
                <div class="product-kpi-card kpi-out-box">
                    <div>
                        <div class="kpi-heading" style="color: #dc2626;">
                            <i data-lucide="x-circle" style="width: 14px; height: 14px;"></i> Out of Stock
                        </div>
                        <span class="kpi-val">{{ $kpiCounts['out'] }}</span>
                    </div>
                    <div class="mini-bar-chart">
                        <div class="mini-bar" style="height: 8px; background: #f87171; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 14px; background: #f87171; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 6px; background: #f87171; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 20px; background: #f87171; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 16px; background: #f87171; opacity: 1;"></div>
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="products-filters-row">
                <div class="search-wrap">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    <input 
                        type="text" 
                        id="prodSearchInput" 
                        oninput="filterProducts(this.value)" 
                        placeholder="Search products, SKU, flavour..." 
                        class="search-input"
                    >
                </div>
                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <div class="dropdown-pill"><span>All Categories</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                    <div class="dropdown-pill"><span>All Flavours</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                    <div class="dropdown-pill"><span>All Status</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                    <div class="dropdown-pill"><span>All Stock Status</span> <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #9ca3af;"></i></div>
                    
                    <button type="button" class="clear-link" onclick="clearProductSearch()">
                        <i data-lucide="refresh-cw" style="width: 12px; height: 12px;"></i> Clear Filters
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input type="checkbox" id="masterCheckbox" onchange="toggleSelectAll(this)" style="cursor: pointer;">
                            </th>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Flavour</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @foreach($products as $p)
                            @php
                                $statusClass = str_replace(' ', '', $p['status']);
                            @endphp
                            <tr 
                                class="prod-row" 
                                data-name="{{ strtolower($p['name']) }}"
                                data-sku="{{ strtolower($p['sku']) }}"
                                data-flavour="{{ strtolower($p['flavour']) }}"
                            >
                                <td>
                                    <input 
                                        type="checkbox" 
                                        class="prod-item-check" 
                                        value="{{ $p['id'] }}" 
                                        onchange="handleRowCheck()" 
                                        style="cursor: pointer;"
                                    >
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div class="prod-avatar" style="background-color: {{ $p['color'] }};">
                                            {{ strtoupper(substr($p['name'], 0, 3)) }}
                                        </div>
                                        <div>
                                            <p style="font-weight: 700; color: #111827; line-height: 1.2;">{{ $p['name'] }}</p>
                                            <p style="font-size: 10px; color: #6b7280;">{{ $p['size'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="color: #4b5563; font-weight: 500;">{{ $p['sku'] }}</td>
                                <td style="color: #4b5563;">{{ $p['category'] }}</td>
                                <td style="color: #4b5563;">{{ $p['flavour'] }}</td>
                                <td style="font-weight: 700; color: #111827;">₹{{ $p['price'] }}</td>
                                <td style="color: #111827;">{{ $p['stock'] }}</td>
                                <td>
                                    <span class="status-badge st-{{ $statusClass }}">
                                        <span class="dot"></span>
                                        {{ $p['status'] }}
                                    </span>
                                </td>
                                <td style="color: #6b7280;">{{ $p['date'] }}</td>
                                <td style="text-align: center;">
                                    <button type="button" style="background: none; border: none; cursor: pointer; color: #9ca3af;">
                                        <i data-lucide="more-vertical" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="table-footer">
                <div class="bulk-btns-list">
                    <span id="selectedCount" style="font-size: 12px; font-weight: 500; color: #6b7280;">
                        0 products selected
                    </span>

                    <div id="bulkActionsGroup" style="display: none; align-items: center; gap: 8px;">
                        <button type="button" class="bulk-btn-action" style="background: #3B5240; color: #fff; border: none;">
                            <i data-lucide="check-circle-2" style="width: 12px; height: 12px;"></i> Activate
                        </button>
                        <button type="button" class="bulk-btn-action" style="background: #fff; border: 1px solid #E5E2D9; color: #374151;">
                            <i data-lucide="x-circle" style="width: 12px; height: 12px;"></i> Deactivate
                        </button>
                        <button type="button" class="bulk-btn-action" style="background: #fff; border: 1px solid #E5E2D9; color: #374151;">
                            <i data-lucide="package" style="width: 12px; height: 12px;"></i> Update Stock
                        </button>
                        <button type="button" class="bulk-btn-action" style="background: #fff; border: 1px solid #E5E2D9; color: #374151;">
                            <i data-lucide="download" style="width: 12px; height: 12px;"></i> Export
                        </button>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 24px;">
                    <span style="font-size: 10px; color: #9ca3af;">Showing 1-{{ count($products) }} of {{ count($products) }} products</span>
                    <div style="display: flex; align-items: center; gap: 4px; font-size: 12px;">
                        <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: #3B5240; color: #fff; font-weight: 500;">1</button>
                        <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: transparent; color: #4b5563;">2</button>
                        <button style="width: 24px; height: 24px; border: none; border-radius: 4px; background: transparent; color: #4b5563;">3</button>
                        <span style="color: #9ca3af; padding: 0 4px;">...</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #4b5563;">
                        <span>Rows per page</span>
                        <div style="border: 1px solid #E5E2D9; border-radius: 6px; padding: 4px 8px; background: #fff; display: flex; align-items: center; gap: 4px;">
                            <span>10</span> <i data-lucide="chevron-down" style="width: 12px; height: 12px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= ADD PRODUCT VIEW ================= -->
        <div id="productAddView" style="display: none;">
            <!-- Top Actions -->
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
                <div>
                    <button type="button" onclick="switchView('list')" style="border: none; background: transparent; display: flex; align-items: center; gap: 4px; font-size: 12px; color: #6b7280; font-weight: 500; cursor: pointer; margin-bottom: 8px;">
                        <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i> Back to Products
                    </button>
                    <h1 class="panel-title">Add Product</h1>
                    <p class="panel-subtitle">Fill in the product details to add a new makhana product.</p>
                </div>
                <div class="header-actions-group">
                    <button type="button" class="btn-secondary" style="padding: 10px 24px;">
                        <i data-lucide="image" style="width: 14px; height: 14px;"></i> Save Draft
                    </button>
                    <button type="button" class="btn-primary" style="padding: 10px 24px;">
                        Publish Product
                    </button>
                </div>
            </div>

            <!-- Layout Grid -->
            <div class="add-product-grid">
                
                <!-- Left Nav Tabs -->
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <button type="button" class="step-nav-btn active">
                        <i data-lucide="type" style="width: 14px; height: 14px;"></i> Basic Information
                    </button>
                    <button type="button" class="step-nav-btn">
                        <i data-lucide="image" style="width: 14px; height: 14px;"></i> Images
                    </button>
                    <button type="button" class="step-nav-btn">
                        <i data-lucide="shield-check" style="width: 14px; height: 14px;"></i> Pricing & Variants
                    </button>
                    <button type="button" class="step-nav-btn">
                        <i data-lucide="package" style="width: 14px; height: 14px;"></i> Inventory
                    </button>
                    <button type="button" class="step-nav-btn">
                        <i data-lucide="list" style="width: 14px; height: 14px;"></i> Product Details
                    </button>
                    <button type="button" class="step-nav-btn">
                        <i data-lucide="check-circle-2" style="width: 14px; height: 14px;"></i> Nutrition
                    </button>
                    <button type="button" class="step-nav-btn">
                        <i data-lucide="search" style="width: 14px; height: 14px;"></i> SEO
                    </button>
                </div>

                <!-- Center: Main Form Content -->
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <!-- Basic Info Box -->
                    <div class="ui-panel">
                        <h2 style="font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 2px;">Basic Information</h2>
                        <p style="font-size: 11px; color: #6b7280; margin-bottom: 20px;">Add the basic details of your product.</p>

                        <div class="form-group-row">
                            <div>
                                <label class="form-label">Product Name *</label>
                                <input type="text" value="Peri Peri Makhana" class="form-ctrl">
                            </div>
                            <div>
                                <label class="form-label">SKU *</label>
                                <input type="text" value="RN-PP100" class="form-ctrl">
                            </div>
                        </div>

                        <div class="form-group-row">
                            <div>
                                <label class="form-label">Category *</label>
                                <div style="position: relative;">
                                    <select class="form-ctrl" style="appearance: none;">
                                        <option>Flavoured Makhana</option>
                                    </select>
                                    <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Flavour *</label>
                                <div style="position: relative;">
                                    <select class="form-ctrl" style="appearance: none;">
                                        <option>Peri Peri</option>
                                    </select>
                                    <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                                </div>
                            </div>
                        </div>

                        <div style="position: relative; margin-bottom: 16px;">
                            <label class="form-label">Short Description</label>
                            <textarea rows="2" class="form-ctrl" style="resize: none;">Spicy and tangy peri peri flavoured roasted makhana. A healthy and crunchy snack for every occasion.</textarea>
                            <span style="position: absolute; bottom: 8px; right: 8px; font-size: 9px; color: #9ca3af;">80/200</span>
                        </div>

                        <div>
                            <label class="form-label">Full Description</label>
                            <div class="editor-wrapper">
                                <div class="editor-toolbar">
                                    <i data-lucide="bold" style="width: 14px; height: 14px;"></i>
                                    <i data-lucide="italic" style="width: 14px; height: 14px;"></i>
                                    <span style="color: #d1d5db;">|</span>
                                    <i data-lucide="list" style="width: 14px; height: 14px;"></i>
                                    <span style="color: #d1d5db;">|</span>
                                    <i data-lucide="link-2" style="width: 14px; height: 14px;"></i>
                                </div>
                                <textarea rows="4" style="width: 100%; border: none; padding: 12px; font-size: 12px; outline: none; resize: none; box-sizing: border-box;">Riva Nair Peri Peri Makhana is a delicious, healthy and crunchy snack made from premium quality fox nuts, seasoned with a special peri peri spice blend. Perfect for guilt-free snacking.</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Images Upload Box -->
                    <div class="ui-panel">
                        <h2 style="font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 2px;">Product Images</h2>
                        <p style="font-size: 11px; color: #6b7280; margin-bottom: 20px;">Upload high quality images of your product.</p>

                        <div class="dropzone-upload">
                            <i data-lucide="upload" style="width: 24px; height: 24px; color: #9ca3af; margin-bottom: 8px;"></i>
                            <p style="font-size: 12px; font-weight: 500; color: #374151;">Click to upload or drag and drop</p>
                            <p style="font-size: 10px; color: #9ca3af; margin-top: 2px;">PNG, JPG (Max 5MB)</p>
                        </div>

                        <div style="display: flex; gap: 16px; overflow-x: auto; padding-bottom: 8px;">
                            <div style="width: 80px; height: 96px; border-radius: 8px; background: #991b1b; border: 2px solid #3B5240; padding: 4px; flex-shrink: 0; position: relative;">
                                <div style="width: 100%; height: 100%; border: 1px solid #7f1d1d; border-radius: 4px; background: #b91c1c; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 8px;">
                                    Main Image
                                </div>
                            </div>
                            <div style="width: 80px; height: 96px; border-radius: 8px; background: rgba(153, 27, 27, 0.8); border: 1px solid #E5E2D9; padding: 4px; flex-shrink: 0;">
                                <div style="width: 100%; height: 100%; border: 1px solid #7f1d1d; border-radius: 4px; background: rgba(185, 28, 28, 0.8);"></div>
                            </div>
                            <div style="width: 80px; height: 96px; border-radius: 8px; background: rgba(153, 27, 27, 0.6); border: 1px solid #E5E2D9; padding: 4px; flex-shrink: 0;">
                                <div style="width: 100%; height: 100%; border: 1px solid #7f1d1d; border-radius: 4px; background: rgba(185, 28, 28, 0.6);"></div>
                            </div>
                            <div style="width: 80px; height: 96px; border-radius: 8px; border: 1px solid #E5E2D9; background: #F8F6F0; display: flex; align-items: center; justify-content: center; flex-shrink: 0; cursor: pointer;">
                                <i data-lucide="plus" style="width: 16px; height: 16px; color: #9ca3af;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Live Preview Panel -->
                <div>
                    <h2 style="font-size: 14px; font-weight: 700; color: #111827; margin-bottom: 2px;">Product Preview</h2>
                    <p style="font-size: 11px; color: #6b7280; margin-bottom: 16px;">This is how your product will appear on the website.</p>

                    <div class="preview-phone-card">
                        <!-- Top visual mock -->
                        <div class="preview-header-images">
                            <div class="preview-thumbnail-stack">
                                <div class="thumb-preview-box" style="background: #991b1b;"></div>
                                <div class="thumb-preview-box" style="background: rgba(153, 27, 27, 0.8);"></div>
                                <div class="thumb-preview-box" style="background: rgba(153, 27, 27, 0.6);"></div>
                            </div>

                            <div class="main-pack-mock">
                                <div style="width: 32px; height: 32px; border-radius: 9999px; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 8px; display: flex; align-items: center; justify-content: center;">
                                    <svg viewBox="0 0 24 24" style="width: 16px; height: 16px; color: #fde047;" fill="currentColor"><path d="M17 8C8 10 5.9 16 5.9 16C5.9 16 9 10 17 8Z"/></svg>
                                </div>
                                <h3 style="font-family: Georgia, serif; font-size: 18px; color: #fefce8; font-weight: 700; letter-spacing: 0.05em;">Riva Nair</h3>
                                <p style="font-size: 8px; text-transform: uppercase; letter-spacing: 0.2em; color: #fef08a; margin-bottom: 8px;">Makhana</p>
                                
                                <div style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 4px; font-size: 10px; font-weight: 700; letter-spacing: 0.1em; border: 1px solid rgba(255,255,255,0.2); margin-bottom: 24px;">
                                    PERI PERI
                                </div>

                                <div style="width: 96px; height: 64px; background: rgba(254, 243, 199, 0.2); border-top-left-radius: 9999px; border-top-right-radius: 9999px; border-top: 1px solid rgba(255,255,255,0.3); position: absolute; bottom: 16px;"></div>
                            </div>
                        </div>

                        <!-- Product Specs -->
                        <div>
                            <div style="color: #16a34a; margin-bottom: 4px;">
                                <svg viewBox="0 0 24 24" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 22C2 22 8 20 12 12C16 20 22 22 22 22"/></svg>
                            </div>
                            <h2 style="font-family: Georgia, serif; font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 4px;">Peri Peri Makhana</h2>

                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                                <div style="display: flex; color: #facc15;">
                                    <i data-lucide="star" style="width: 10px; height: 10px; fill: currentColor;"></i>
                                    <i data-lucide="star" style="width: 10px; height: 10px; fill: currentColor;"></i>
                                    <i data-lucide="star" style="width: 10px; height: 10px; fill: currentColor;"></i>
                                    <i data-lucide="star" style="width: 10px; height: 10px; fill: currentColor;"></i>
                                    <i data-lucide="star" style="width: 10px; height: 10px; fill: currentColor;"></i>
                                </div>
                                <span style="font-size: 9px; color: #6b7280;">(120 reviews)</span>
                            </div>

                            <div style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 4px;">₹249</div>
                            <p style="font-size: 10px; color: #6b7280; margin-bottom: 16px;">100g Pack</p>

                            <ul style="list-style: none; display: flex; flex-direction: column; gap: 6px; margin-bottom: 24px; font-size: 10px; color: #374151;">
                                <li style="display: flex; align-items: center; gap: 8px;">
                                    <i data-lucide="check" style="width: 10px; height: 10px; color: #16a34a;"></i> <span>Crunchy & Healthy</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 8px;">
                                    <i data-lucide="check" style="width: 10px; height: 10px; color: #16a34a;"></i> <span>Rich in Nutrients</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 8px;">
                                    <i data-lucide="check" style="width: 10px; height: 10px; color: #16a34a;"></i> <span>No Preservatives</span>
                                </li>
                                <li style="display: flex; align-items: center; gap: 8px;">
                                    <i data-lucide="check" style="width: 10px; height: 10px; color: #16a34a;"></i> <span>Perfect for Snacking</span>
                                </li>
                            </ul>

                            <div style="display: flex; gap: 12px;">
                                <div style="border: 1px solid #E5E2D9; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; width: 96px; padding: 0 12px; background: #F8F6F0;">
                                    <button type="button" style="border: none; background: none; color: #6b7280; cursor: pointer; padding-bottom: 4px;">-</button>
                                    <span style="font-size: 12px; font-weight: 700; color: #111827;">1</span>
                                    <button type="button" style="border: none; background: none; color: #6b7280; cursor: pointer; padding-bottom: 4px;">+</button>
                                </div>
                                <button type="button" style="flex: 1; border: none; background: #3B5240; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 700; padding: 10px 0; cursor: pointer;">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    // View Switcher (List vs Add Product)
    function switchView(viewName) {
        const listView = document.getElementById('productListView');
        const addView = document.getElementById('productAddView');

        if (viewName === 'add') {
            listView.style.display = 'none';
            addView.style.display = 'block';
        } else {
            addView.style.display = 'none';
            listView.style.display = 'block';
        }
        if (window.lucide) lucide.createIcons();
    }

    // Filter Products by Search
    function filterProducts(query) {
        const q = query.toLowerCase();
        document.querySelectorAll('.prod-row').forEach(row => {
            const name = row.getAttribute('data-name');
            const sku = row.getAttribute('data-sku');
            const flavour = row.getAttribute('data-flavour');
            if (name.includes(q) || sku.includes(q) || flavour.includes(q)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function clearProductSearch() {
        document.getElementById('prodSearchInput').value = '';
        filterProducts('');
    }

    // Selection & Bulk Actions
    function handleRowCheck() {
        const checkedBoxes = document.querySelectorAll('.prod-item-check:checked');
        const count = checkedBoxes.length;
        const total = document.querySelectorAll('.prod-item-check').length;

        document.getElementById('selectedCount').innerText = `${count} products selected`;
        document.getElementById('bulkActionsGroup').style.display = count > 0 ? 'inline-flex' : 'none';
        document.getElementById('masterCheckbox').checked = count === total && total > 0;
    }

    function toggleSelectAll(masterCb) {
        document.querySelectorAll('.prod-item-check').forEach(cb => {
            cb.checked = masterCb.checked;
        });
        handleRowCheck();
    }

    // Icons Render
    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection