@extends('layouts.admin')

@section('title', 'Categories Management - Riva Nair')

@section('content')
<style>
    /* Reset & Container */
    .categories-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F5F2EA;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .categories-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .categories-page-wrapper { margin: -32px; }
    }

    .categories-main-container {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 24px;
    }

    @media (min-width: 1536px) {
        .categories-main-container {
            flex-direction: row;
        }
    }

    .left-content-area {
        width: 100%;
        min-width: 0;
        flex: 1;
    }

    /* Header */
    .cat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .cat-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 28px;
        color: #111827;
        line-height: 1.1;
    }

    .cat-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .btn-add-cat {
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

    .btn-add-cat:hover {
        background-color: #2A3C2E;
    }

    /* KPI Cards */
    .cat-kpi-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (min-width: 768px) {
        .cat-kpi-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .cat-kpi-card {
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #E5E2D9;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .kpi-left-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kpi-round-icon {
        width: 40px;
        height: 40px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        flex-shrink: 0;
    }

    .kpi-tag-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
    }

    .kpi-big-num {
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

    /* Search & Filter Bar */
    .filter-search-box {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 24px;
    }

    @media (min-width: 640px) {
        .filter-search-box {
            flex-direction: row;
            align-items: center;
        }
    }

    .search-input-wrap {
        position: relative;
        flex: 1;
    }

    .search-input-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .cat-search-field {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 10px 16px 10px 38px;
        font-size: 12px;
        color: #374151;
        outline: none;
        box-sizing: border-box;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }

    .cat-search-field:focus {
        border-color: #3B5240;
    }

    .status-select-wrap {
        width: 192px;
        position: relative;
    }

    .status-select {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 10px 32px 10px 12px;
        font-size: 12px;
        color: #374151;
        outline: none;
        appearance: none;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }

    /* Categories Grid */
    .categories-cards-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    @media (min-width: 768px) {
        .categories-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1280px) {
        .categories-cards-grid.has-panel {
            grid-template-columns: repeat(3, 1fr);
        }
        .categories-cards-grid.full-width {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .category-item-card {
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
    }

    .category-item-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .cat-image-banner {
        height: 128px;
        background-color: #F8F6F0;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cat-main-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px;
    }

    .badge-corner {
        position: absolute;
        top: 8px;
        right: 8px;
    }

    .badge-best-seller {
        width: 32px;
        height: 32px;
        border-radius: 9999px;
        background-color: #fb923c;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .badge-new {
        background-color: #ffffff;
        color: #111827;
        font-size: 10px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 9999px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .cat-details-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .cat-name-title {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }

    .cat-desc-text {
        font-size: 11px;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 12px;
        min-height: 32px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .cat-prod-count {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 10px;
        color: #4b5563;
        font-weight: 500;
        margin-bottom: 16px;
    }

    .cat-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 9999px;
        font-size: 10px;
        font-weight: 700;
    }

    .status-pill .dot {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        margin-right: 6px;
    }

    .status-Active { background-color: #dcfce7; color: #15803d; }
    .status-Active .dot { background-color: #22c55e; }

    .status-Inactive { background-color: #ffedd5; color: #c2410c; }
    .status-Inactive .dot { background-color: #f97316; }

    .status-Draft { background-color: #f3f4f6; color: #4b5563; }
    .status-Draft .dot { background-color: #9ca3af; }

    /* Right Panel (Add / Edit Form) */
    .right-form-panel {
        width: 100%;
        flex-shrink: 0;
    }

    @media (min-width: 1536px) {
        .right-form-panel {
            width: 400px;
        }
    }

    .form-panel-card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 96px;
    }

    .form-panel-header {
        padding: 20px 24px;
        border-bottom: 1px solid #E5E2D9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-panel-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-label-title {
        display: block;
        font-size: 12px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-field-input {
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

    .form-field-input:focus {
        border-color: #3B5240;
    }

    .image-drop-area {
        border: 2px dashed #E5E2D9;
        border-radius: 12px;
        background-color: #F8F6F0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .image-drop-area:hover {
        background-color: #f9fafb;
    }

    .thumb-picker-row {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .thumb-picker-btn {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        background-color: #F8F6F0;
        border: 1px solid #E5E2D9;
        padding: 4px;
        flex-shrink: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thumb-picker-btn.active {
        border: 2px solid #3B5240;
    }

    .thumb-picker-btn img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .form-panel-footer {
        padding: 16px;
        border-top: 1px solid #E5E2D9;
        background-color: rgba(249, 250, 251, 0.5);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .empty-state-box {
        grid-column: 1 / -1;
        border-radius: 12px;
        border: 1px dashed #D9D3C1;
        background-color: #ffffff;
        padding: 32px;
        text-align: center;
        font-size: 14px;
        color: #6b7280;
    }
</style>

@php
    $img1 = asset('assets/home/product1.png');
    $img2 = asset('assets/home/product2.png');$img3 = asset('assets/home/product3.png');
    $img4 = asset('assets/home/product4.png');$img5 = asset('assets/home/product5.png');

    $categories = [
        ['id' => 1, 'name' => 'Classic Makhana', 'desc' => 'Traditional roasted makhana for everyday snacking.', 'products' => 4, 'status' => 'Active', 'badge' => null, 'image' => $img2],
        ['id' => 2, 'name' => 'Flavoured Makhana', 'desc' => 'Bold and delicious flavours for every mood.', 'products' => 12, 'status' => 'Active', 'badge' => null, 'image' => $img1],
        ['id' => 3, 'name' => 'Combos', 'desc' => 'Curated packs with multiple flavours.', 'products' => 3, 'status' => 'Active', 'badge' => null, 'image' => $img5],
        ['id' => 4, 'name' => 'Gift Boxes', 'desc' => 'Premium gifting options for your loved ones.', 'products' => 3, 'status' => 'Active', 'badge' => null, 'image' => $img3],
        ['id' => 5, 'name' => 'Best Sellers', 'desc' => 'Our most loved makhana products.', 'products' => 6, 'status' => 'Active', 'badge' => 'best-seller', 'image' => $img4],
        ['id' => 6, 'name' => 'New Arrivals', 'desc' => 'Latest additions to our makhana range.', 'products' => 2, 'status' => 'Active', 'badge' => 'new', 'image' => $img3],
        ['id' => 7, 'name' => 'Healthy Snacking', 'desc' => 'Nutritious, guilt-free snacking options.', 'products' => 2, 'status' => 'Inactive', 'badge' => null, 'image' => $img2],
        ['id' => 8, 'name' => 'Seasonal Specials', 'desc' => 'Limited time flavours and festive packs.', 'products' => 0, 'status' => 'Draft', 'badge' => null, 'image' => $img5],
    ];

    $productImages = [$img1, $img2,$img3, $img4,$img5];
    $totalProducts = collect($categories)->sum('products');
    $activeCount = collect($categories)->where('status', 'Active')->count();
@endphp

<div class="categories-page-wrapper">
    <div class="categories-main-container">

        <!-- ================= LEFT: CATEGORIES LIST ================= -->
        <div class="left-content-area">
            
            <!-- Header -->
            <div class="cat-header">
                <div>
                    <h1 class="cat-title">Categories</h1>
                    <p class="cat-subtitle">Organize your products into clear collections.</p>
                </div>
                <button type="button" class="btn-add-cat" id="topAddBtn" onclick="openCreatePanel()" style="display: none;">
                    <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Add Category
                </button>
            </div>

            <!-- KPI Cards -->
            <div class="cat-kpi-grid">
                <!-- Total -->
                <div class="cat-kpi-card">
                    <div class="kpi-left-group">
                        <div class="kpi-round-icon" style="background-color: #3B5240;">
                            <i data-lucide="layout-grid" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <p class="kpi-tag-label">Total Categories</p>
                            <p class="kpi-big-num" id="kpiTotal">{{ count($categories) }}</p>
                        </div>
                    </div>
                    <div class="mini-chart">
                        <div class="mini-bar" style="height: 12px; background: #3B5240; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 16px; background: #3B5240; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 8px; background: #3B5240; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 24px; background: #3B5240; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 20px; background: #3B5240; opacity: 1;"></div>
                    </div>
                </div>

                <!-- Active -->
                <div class="cat-kpi-card">
                    <div class="kpi-left-group">
                        <div class="kpi-round-icon" style="background-color: #16a34a;">
                            <i data-lucide="check-circle-2" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <p class="kpi-tag-label">Active Categories</p>
                            <p class="kpi-big-num">{{ $activeCount }}</p>
                        </div>
                    </div>
                    <div class="mini-chart">
                        <div class="mini-bar" style="height: 12px; background: #16a34a; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 16px; background: #16a34a; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 8px; background: #16a34a; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 24px; background: #16a34a; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 20px; background: #16a34a; opacity: 1;"></div>
                    </div>
                </div>

                <!-- Products -->
                <div class="cat-kpi-card">
                    <div class="kpi-left-group">
                        <div class="kpi-round-icon" style="background-color: #fb923c;">
                            <i data-lucide="box" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <p class="kpi-tag-label">Total Products</p>
                            <p class="kpi-big-num">{{ $totalProducts }}</p>
                        </div>
                    </div>
                    <div class="mini-chart">
                        <div class="mini-bar" style="height: 12px; background: #fb923c; opacity: 0.4;"></div>
                        <div class="mini-bar" style="height: 16px; background: #fb923c; opacity: 0.6;"></div>
                        <div class="mini-bar" style="height: 8px; background: #fb923c; opacity: 0.3;"></div>
                        <div class="mini-bar" style="height: 24px; background: #fb923c; opacity: 0.8;"></div>
                        <div class="mini-bar" style="height: 20px; background: #fb923c; opacity: 1;"></div>
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="filter-search-box">
                <div class="search-input-wrap">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    <input 
                        type="text" 
                        id="categorySearch" 
                        oninput="filterCategories()" 
                        placeholder="Search categories..." 
                        class="cat-search-field"
                    >
                </div>
                <div class="status-select-wrap">
                    <select id="statusFilter" onchange="filterCategories()" class="status-select">
                        <option value="All Status">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Draft">Draft</option>
                    </select>
                    <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                </div>
            </div>

            <!-- Categories Cards Grid -->
            <div class="categories-cards-grid has-panel" id="categoriesGrid">
                @foreach($categories as $cat)
                    <div 
                        class="category-item-card cat-card-item" 
                        id="cat-card-{{ $cat['id'] }}"
                        data-name="{{ strtolower($cat['name']) }}"
                        data-desc="{{ strtolower($cat['desc']) }}"
                        data-status="{{ $cat['status'] }}"
                    >
                        <!-- Banner Image -->
                        <div class="cat-image-banner">
                            <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}" class="cat-main-img" onerror="this.src='https://placehold.co/240x120/f8f6f0/3B5240?text={{ urlencode($cat['name']) }}'">

                            <!-- Badges -->
                            @if($cat['badge'] === 'best-seller')
                                <div class="badge-corner">
                                    <div class="badge-best-seller">
                                        <i data-lucide="crown" style="width: 14px; height: 14px;"></i>
                                    </div>
                                </div>
                            @elseif($cat['badge'] === 'new')
                                <div class="badge-corner">
                                    <span class="badge-new">NEW</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="cat-details-body">
                            <h3 class="cat-name-title">{{ $cat['name'] }}</h3>
                            <p class="cat-desc-text">{{ $cat['desc'] }}</p>

                            <div class="cat-prod-count">
                                <i data-lucide="package" style="width: 12px; height: 12px;"></i>
                                <span>{{ $cat['products'] }} Products</span>
                            </div>

                            <div class="cat-card-footer">
                                <span class="status-pill status-{{ $cat['status'] }}">
                                    <span class="dot"></span>
                                    {{ $cat['status'] }}
                                </span>

                                <button 
                                    type="button" 
                                    onclick='editCategory(@json($cat))' 
                                    style="background: none; border: none; cursor: pointer; color: #9ca3af;"
                                    aria-label="Edit category"
                                >
                                    <i data-lucide="more-vertical" style="width: 14px; height: 14px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="empty-state-box" id="emptyState" style="display: none;">
                    No categories match your search or status filter.
                </div>
            </div>
        </div>

        <!-- ================= RIGHT: ADD / EDIT PANEL ================= -->
        <div class="right-form-panel" id="sideFormPanel">
            <div class="form-panel-card">
                
                <!-- Panel Header -->
                <div class="form-panel-header">
                    <h2 class="cat-title" style="font-size: 18px;" id="panelHeading">Add Category</h2>
                    <button type="button" onclick="closeSidePanel()" style="background: none; border: none; cursor: pointer; color: #9ca3af;">
                        <i data-lucide="x" style="width: 18px; height: 18px;"></i>
                    </button>
                </div>

                <!-- Panel Form -->
                <form id="categoryForm" onsubmit="handleFormSubmit(event)">
                    <div class="form-panel-body">
                        <input type="hidden" id="editingId" value="">

                        <!-- Category Name -->
                        <div>
                            <label class="form-label-title">Category Name <span style="color: #ef4444;">*</span></label>
                            <input 
                                type="text" 
                                id="catNameInput" 
                                required 
                                maxlength="60"
                                oninput="handleNameInput(this.value)" 
                                class="form-field-input"
                            >
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="form-label-title">Slug <span style="color: #ef4444;">*</span></label>
                            <input 
                                type="text" 
                                id="catSlugInput" 
                                required 
                                class="form-field-input"
                            >
                        </div>

                        <!-- Description -->
                        <div style="position: relative;">
                            <label class="form-label-title">Description</label>
                            <textarea 
                                id="catDescInput" 
                                rows="4" 
                                maxlength="200" 
                                oninput="updateCharCount(this.value)"
                                class="form-field-input" 
                                style="resize: none;"
                            ></textarea>
                            <span id="charCounter" style="position: absolute; bottom: 8px; right: 8px; font-size: 10px; color: #9ca3af;">0/200</span>
                        </div>

                        <!-- Image Selector -->
                        <div>
                            <label class="form-label-title">Category Image <span style="color: #ef4444;">*</span></label>
                            
                            <label class="image-drop-area">
                                <img id="previewImg" src="{{ $img1 }}" alt="Preview" style="height: 96px; width: 100%; object-fit: contain; padding: 0 12px;">
                                <span style="margin-top: 8px; display: flex; align-items: center; gap: 6px; font-size: 11px; color: #4b5563;">
                                    <i data-lucide="image" style="width: 14px; height: 14px;"></i> Click to upload an image
                                </span>
                                <span style="font-size: 9px; color: #9ca3af; margin-top: 2px;">PNG, JPG (Max 5MB)</span>
                                <input type="file" accept="image/png,image/jpeg,image/webp" onchange="previewUploadedImage(event)" style="display: none;">
                            </label>

                            <p id="imageError" style="display: none; color: #dc2626; font-size: 12px; margin-bottom: 8px;"></p>

                            <!-- Thumbnails row -->
                            <div class="thumb-picker-row">
                                @foreach($productImages as $index =>$img)
                                    <button 
                                        type="button" 
                                        class="thumb-picker-btn {{ $index === 0 ? 'active' : '' }}" 
                                        onclick="pickPresetImage(this, '{{ $img }}')"
                                    >
                                        <img src="{{ $img }}" alt="Preset">
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="form-label-title">Status</label>
                            <div style="position: relative;">
                                <select id="catStatusInput" class="form-field-input" style="appearance: none; cursor: pointer;">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Draft">Draft</option>
                                </select>
                                <i data-lucide="chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #9ca3af; pointer-events: none;"></i>
                            </div>
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label class="form-label-title">Sort Order</label>
                            <input 
                                type="number" 
                                id="catOrderInput" 
                                min="0" 
                                value="9" 
                                class="form-field-input"
                            >
                            <p style="font-size: 10px; color: #9ca3af; margin-top: 6px;">Lower number will appear first.</p>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="form-panel-footer">
                        <button 
                            type="button" 
                            onclick="closeSidePanel()" 
                            style="padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: 500; border: 1px solid #E5E2D9; background: #fff; color: #374151; cursor: pointer;"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            id="submitBtnText"
                            style="padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: 500; border: none; background: #3B5240; color: #fff; cursor: pointer;"
                        >
                            Create Category
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
    let selectedImageSrc = "{{ $img1 }}";

    // Live search & status filter
    function filterCategories() {
        const query = document.getElementById('categorySearch').value.toLowerCase().trim();
        const status = document.getElementById('statusFilter').value;
        const cards = document.querySelectorAll('.cat-card-item');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const desc = card.getAttribute('data-desc');
            const catStatus = card.getAttribute('data-status');

            const matchesSearch = !query || name.includes(query) || desc.includes(query);
            const matchesStatus = status === 'All Status' || catStatus === status;

            if (matchesSearch && matchesStatus) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('emptyState').style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Slug Generator
    function handleNameInput(val) {
        document.getElementById('catSlugInput').value = val.toLowerCase().trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-|-$/g, '');
    }

    function updateCharCount(val) {
        document.getElementById('charCounter').innerText = `${val.length}/200`;
    }

    // Image Handlers
    function pickPresetImage(btn, src) {
        document.querySelectorAll('.thumb-picker-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        selectedImageSrc = src;
        document.getElementById('previewImg').src = src;
        document.getElementById('imageError').style.display = 'none';
    }

    function previewUploadedImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showImageError('Choose an image file.');
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            showImageError('Image must be 5 MB or smaller.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            selectedImageSrc = e.target.result;
            document.getElementById('previewImg').src = selectedImageSrc;
            document.getElementById('imageError').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function showImageError(msg) {
        const err = document.getElementById('imageError');
        err.innerText = msg;
        err.style.display = 'block';
    }

    // Panel Open / Close Logic
    function openCreatePanel() {
        document.getElementById('sideFormPanel').style.display = 'block';
        document.getElementById('topAddBtn').style.display = 'none';
        document.getElementById('categoriesGrid').classList.add('has-panel');
        document.getElementById('categoriesGrid').classList.remove('full-width');

        // Reset fields
        document.getElementById('editingId').value = '';
        document.getElementById('panelHeading').innerText = 'Add Category';
        document.getElementById('submitBtnText').innerText = 'Create Category';
        document.getElementById('catNameInput').value = '';
        document.getElementById('catSlugInput').value = '';
        document.getElementById('catDescInput').value = '';
        document.getElementById('catStatusInput').value = 'Active';
        document.getElementById('charCounter').innerText = '0/200';
    }

    function closeSidePanel() {
        document.getElementById('sideFormPanel').style.display = 'none';
        document.getElementById('topAddBtn').style.display = 'inline-flex';
        document.getElementById('categoriesGrid').classList.remove('has-panel');
        document.getElementById('categoriesGrid').classList.add('full-width');
    }

    // Edit Category
    function editCategory(cat) {
        openCreatePanel();
        document.getElementById('editingId').value = cat.id;
        document.getElementById('panelHeading').innerText = 'Edit Category';
        document.getElementById('submitBtnText').innerText = 'Save Changes';
        document.getElementById('catNameInput').value = cat.name;
        handleNameInput(cat.name);
        document.getElementById('catDescInput').value = cat.desc;
        updateCharCount(cat.desc);
        document.getElementById('catStatusInput').value = cat.status;
        document.getElementById('previewImg').src = cat.image;
        selectedImageSrc = cat.image;
    }

    // Handle Form Submit
    function handleFormSubmit(e) {
        e.preventDefault();
        const editingId = document.getElementById('editingId').value;
        const name = document.getElementById('catNameInput').value;
        const desc = document.getElementById('catDescInput').value;
        const status = document.getElementById('catStatusInput').value;

        if (editingId) {
            // Update Card on the fly
            const card = document.getElementById('cat-card-' + editingId);
            if (card) {
                card.querySelector('.cat-name-title').innerText = name;
                card.querySelector('.cat-desc-text').innerText = desc;
                card.querySelector('.cat-main-img').src = selectedImageSrc;
                card.setAttribute('data-name', name.toLowerCase());
                card.setAttribute('data-desc', desc.toLowerCase());
                card.setAttribute('data-status', status);

                const pill = card.querySelector('.status-pill');
                pill.className = `status-pill status-${status}`;
                pill.innerHTML = `<span class="dot"></span> ${status}`;
            }
        }
        closeSidePanel();
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection