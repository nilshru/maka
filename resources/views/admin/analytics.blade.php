@extends('layouts.admin')

@section('title', 'Analytics & Overview - Riva Nair')

@section('content')
<style>
    /* Reset & Page Wrapper */
    .analytics-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F4F1E8;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .analytics-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .analytics-page-wrapper { margin: -32px; }
    }

    .analytics-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Common Card Styling */
    .analytics-card {
        border-radius: 16px;
        border: 1px solid #E7E2D5;
        background-color: #F9F7F2;
        padding: 24px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .analytics-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .analytics-card-title {
        font-size: 15px;
        font-weight: 600;
        color: #1F2A22;
        letter-spacing: -0.01em;
    }

    /* Top Banner Header */
    .analytics-top-header {
        display: flex;
        flex-direction: column;
        gap: 16px;
        border-radius: 16px;
        border: 1px solid #E7E2D5;
        background-color: #EDE8D8;
        padding: 20px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    @media (min-width: 640px) {
        .analytics-top-header {
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
        }
    }

    .header-main-title {
        font-size: 24px;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #1F2A22;
        line-height: 1.1;
    }

    .header-main-subtitle {
        font-size: 14px;
        color: #6b7280;
        margin-top: 4px;
    }

    .header-controls-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-period-picker {
        height: 36px;
        padding: 0 16px;
        background-color: #F9F7F2;
        border: 1px solid #E7E2D5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #4b5563;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        transition: color 0.2s;
    }

    .btn-period-picker:hover { color: #111827; }

    .btn-analytics-export {
        height: 36px;
        padding: 0 16px;
        background-color: #3B5240;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        transition: background-color 0.2s;
    }

    .btn-analytics-export:hover { background-color: #2F4234; }

    /* ROW 1: KPIs */
    .kpi-four-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 768px) {
        .kpi-four-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 1024px) {
        .kpi-four-grid { grid-template-columns: repeat(4, 1fr); }
    }

    .kpi-mini-card {
        padding: 20px !important;
    }

    .kpi-top-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .kpi-meta-label {
        font-size: 13px;
        font-weight: 500;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .delta-pill-badge {
        display: inline-flex;
        align-items: center;
        font-size: 11px;
        font-weight: 600;
        color: #047857;
        background-color: #ecfdf5;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .kpi-value-chart-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }

    .kpi-primary-val {
        font-size: 28px;
        font-weight: 700;
        line-height: 1;
        letter-spacing: -0.02em;
        font-variant-numeric: tabular-nums;
        color: #111827;
    }

    .sparkline-svg {
        width: 80px;
        height: 32px;
        flex-shrink: 0;
        overflow: visible;
    }

    /* ROW 2: Main Chart + Status */
    .split-chart-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 1024px) {
        .split-chart-row {
            grid-template-columns: 2fr 1fr;
        }
    }

    /* Area Chart Component */
    .area-chart-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .chart-inner-canvas {
        position: relative;
        width: 100%;
        height: 220px;
    }

    .chart-grid-line {
        position: absolute;
        width: 100%;
        display: flex;
        align-items: center;
        transform: translateY(-50%);
    }

    .y-axis-label {
        font-size: 11px;
        font-weight: 500;
        color: #9ca3af;
        width: 40px;
        flex-shrink: 0;
        background-color: transparent;
        z-index: 10;
    }

    .horizontal-grid-hairline {
        height: 1px;
        width: 100%;
        background-color: #E5E2D9;
    }

    .area-svg-render {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        padding-top: 8px;
        padding-left: 40px;
        overflow: visible;
        z-index: 1;
        box-sizing: border-box;
    }

    .x-axis-row {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        font-weight: 500;
        color: #9ca3af;
        margin-top: 16px;
        padding-left: 40px;
    }

    /* Donut Chart Component */
    .donut-layout-wrap {
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: space-between;
        padding-top: 8px;
    }

    .donut-svg-center-wrap {
        position: relative;
        width: 144px;
        height: 144px;
        flex-shrink: 0;
        margin: 0 auto;
    }

    .donut-svg {
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }

    .donut-center-kpi {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .donut-total-num {
        font-size: 30px;
        font-weight: 700;
        color: #111827;
        letter-spacing: -0.02em;
        line-height: 1;
    }

    .donut-total-lbl {
        font-size: 10px;
        font-weight: 500;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-top: 2px;
    }

    .donut-legend-list {
        margin-top: 32px;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .donut-legend-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
    }

    .legend-color-dot {
        width: 8px;
        height: 8px;
        border-radius: 9999px;
    }

    /* ROW 3: Tables & Funnel */
    .split-tables-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 1024px) {
        .split-tables-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    .view-all-link-btn {
        font-size: 12px;
        font-weight: 500;
        color: #6b7280;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: color 0.2s;
    }

    .view-all-link-btn:hover { color: #111827; }

    /* Top Products Table */
    .top-prod-header-row {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 16px;
        margin-bottom: 12px;
        padding: 0 8px;
        font-size: 11px;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .top-prod-data-row {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 16px;
        align-items: center;
        padding: 10px 8px;
        border-radius: 8px;
        transition: background-color 0.2s;
    }

    .top-prod-data-row:hover {
        background-color: rgba(255, 255, 255, 0.7);
    }

    /* Funnel Bars */
    .funnel-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        gap: 20px;
        padding-bottom: 8px;
    }

    .funnel-step-bar-bg {
        height: 6px;
        width: 100%;
        background-color: #E5E2D9;
        border-radius: 9999px;
        overflow: hidden;
    }

    .funnel-step-bar-fill {
        height: 100%;
        background-color: #18181B;
        border-radius: 9999px;
        transition: width 0.3s ease;
    }
</style>

@php
    // KPIs Data
    $kpis = [
        ['label' => 'Net Revenue', 'value' => '₹1,88,550', 'delta' => '12.5%', 'icon' => 'trending-up', 'pts' => [12, 18, 15, 24, 20, 30, 27, 38]],
        ['label' => 'Total Orders', 'value' => '428', 'delta' => '8.2%', 'icon' => 'shopping-bag', 'pts' => [20, 16, 24, 21, 30, 26, 34, 36]],
        ['label' => 'Avg. Order', 'value' => '₹440', 'delta' => '4.3%', 'icon' => 'credit-card', 'pts' => [10, 14, 13, 18, 17, 22, 24, 28]],
        ['label' => 'Conversion', 'value' => '2.3%', 'delta' => '0.4%', 'icon' => 'percent', 'pts' => [18, 14, 20, 17, 25, 22, 28, 30]],
    ];

    // Main Chart Points (1000 width, 200 height, max: 60)
    $revenueSeries = [22, 26, 24, 30, 28, 34, 31, 38, 36, 33, 40, 44, 41, 39, 46, 50, 47, 45, 52, 55, 48, 53, 57, 54];
    $count = count($revenueSeries);
    $maxVal = 60;
    $chartW = 1000;
    $chartH = 200;

    $areaPoints = [];
    foreach ($revenueSeries as $i => $val) {
        $x = round(($i / ($count - 1)) * $chartW, 1);
        $y = round($chartH - ($val / $maxVal) * $chartH, 1);
        $areaPoints[] = "$x,$y";
    }
    $pointsString = implode(' ', $areaPoints);
    $polygonString = "0,$chartH $pointsString $chartW,$chartH";

    // Donut Status Breakdown
    $orderStatus = [
        ['label' => 'Delivered', 'val' => 318, 'color' => '#18181B'],
        ['label' => 'Shipped', 'val' => 56, 'color' => '#A1A1AA'],
        ['label' => 'Processing', 'val' => 24, 'color' => '#D4D4D8'],
        ['label' => 'Cancelled', 'val' => 10, 'color' => '#F87171'],
    ];
    $totalOrders = collect($orderStatus)->sum('val');

    // Products & Funnel
    $topProducts = [
        ['name' => 'Peri Peri Makhana', 'units' => 328, 'revenue' => '₹81,672', 'share' => 43],
        ['name' => 'Pudina Makhana', 'units' => 267, 'revenue' => '₹66,483', 'share' => 35],
        ['name' => 'Himalayan Salt', 'units' => 231, 'revenue' => '₹53,649', 'share' => 28],
        ['name' => 'Classic Salted', 'units' => 198, 'revenue' => '₹45,342', 'share' => 24],
    ];

    $funnel = [
        ['step' => 'Store Visitors', 'value' => 18420, 'pct' => 100],
        ['step' => 'Product Views', 'value' => 9840, 'pct' => 53.4],
        ['step' => 'Added to Cart', 'value' => 2140, 'pct' => 11.6],
        ['step' => 'Successful Orders', 'value' => 428, 'pct' => 2.3],
    ];
@endphp

<div class="analytics-page-wrapper">
    <div class="analytics-container">

        <!-- ================= TOP HEADER BANNER ================= -->
        <header class="analytics-top-header">
            <div>
                <h1 class="header-main-title">Overview</h1>
                <p class="header-main-subtitle">Your store's performance at a glance.</p>
            </div>
            <div class="header-controls-group">
                <button type="button" class="btn-period-picker">
                    <i data-lucide="calendar" style="width: 14px; height: 14px; color: #9ca3af;"></i> Sep 1 – 30
                </button>
                <button type="button" class="btn-analytics-export">
                    <i data-lucide="download" style="width: 14px; height: 14px;"></i> Export
                </button>
            </div>
        </header>

        <!-- ================= ROW 1: 4 KPIS WITH SPARKLINES ================= -->
        <div class="kpi-four-grid">
            @foreach($kpis as $kpi)
                @php
                    $pts = $kpi['pts'];
                    $minPt = min($pts);
                    $maxPt = max($pts);
                    $sparkW = 100;
                    $sparkH = 30;
                    $sparkArr = [];
                    foreach ($pts as $idx => $pt) {
                        $sx = round(($idx / (count($pts) - 1)) * $sparkW, 1);
                        $sy = round($sparkH - (($pt - $minPt) / ($maxPt - $minPt)) * $sparkH, 1);
                        $sparkArr[] = "$sx,$sy";
                    }
                    $sparkString = implode(' ', $sparkArr);
                @endphp
                <div class="analytics-card kpi-mini-card">
                    <div class="kpi-top-meta">
                        <span class="kpi-meta-label">
                            <i data-lucide="{{ $kpi['icon'] }}" style="width: 14px; height: 14px; color: #9ca3af;"></i>
                            {{ $kpi['label'] }}
                        </span>
                        <span class="delta-pill-badge">
                            <i data-lucide="arrow-up-right" style="width: 12px; height: 12px; margin-right: 2px;"></i>
                            {{ $kpi['delta'] }}
                        </span>
                    </div>

                    <div class="kpi-value-chart-row">
                        <p class="kpi-primary-val">{{ $kpi['value'] }}</p>
                        
                        <!-- SVG Sparkline -->
                        <svg viewBox="0 0 100 32" class="sparkline-svg" preserveAspectRatio="none">
                            <polyline 
                                fill="none" 
                                stroke="#18181B" 
                                stroke-width="2" 
                                stroke-linecap="round" 
                                stroke-linejoin="round"
                                points="{{ $sparkString }}" 
                            />
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ================= ROW 2: MAIN CHART & ORDER STATUS ================= -->
        <div class="split-chart-row">
            <!-- Area Chart (2 Cols) -->
            <section class="analytics-card" style="min-height: 340px;">
                <div class="analytics-card-header">
                    <h2 class="analytics-card-title">Revenue Over Time</h2>
                </div>

                <div class="area-chart-container">
                    <div class="chart-inner-canvas">
                        <!-- Y-Axis Grid Lines & Labels -->
                        <div class="chart-grid-line" style="top: 0%;">
                            <span class="y-axis-label">60k</span>
                            <div class="horizontal-grid-hairline"></div>
                        </div>
                        <div class="chart-grid-line" style="top: 33.3%;">
                            <span class="y-axis-label">40k</span>
                            <div class="horizontal-grid-hairline"></div>
                        </div>
                        <div class="chart-grid-line" style="top: 66.6%;">
                            <span class="y-axis-label">20k</span>
                            <div class="horizontal-grid-hairline"></div>
                        </div>
                        <div class="chart-grid-line" style="top: 100%;">
                            <span class="y-axis-label">0</span>
                            <div class="horizontal-grid-hairline"></div>
                        </div>

                        <!-- SVG Area Path -->
                        <svg viewBox="0 0 1000 200" preserveAspectRatio="none" class="area-svg-render">
                            <defs>
                                <linearGradient id="revenueFade" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#18181B" stop-opacity="0.08" />
                                    <stop offset="100%" stop-color="#18181B" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <polygon points="{{ $polygonString }}" fill="url(#revenueFade)" />
                            <polyline points="{{ $pointsString }}" fill="none" stroke="#18181B" stroke-width="2.5" stroke-linejoin="round" vector-effect="non-scaling-stroke" />
                        </svg>
                    </div>

                    <!-- X-Axis Labels -->
                    <div class="x-axis-row">
                        <span>Sep 1</span>
                        <span>Sep 8</span>
                        <span>Sep 15</span>
                        <span>Sep 22</span>
                        <span>Sep 30</span>
                    </div>
                </div>
            </section>

            <!-- Order Status Donut (1 Col) -->
            <section class="analytics-card">
                <div class="analytics-card-header">
                    <h2 class="analytics-card-title">Order Status</h2>
                </div>

                <div class="donut-layout-wrap">
                    <!-- SVG Donut -->
                    <div class="donut-svg-center-wrap">
                        <svg viewBox="0 0 36 36" class="donut-svg">
                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#E4E4E7" stroke-width="4" />
                            @php $runningOffset = 0; @endphp
                            @foreach($orderStatus as $d)
                                @php
                                    $pct = ($d['val'] / $totalOrders) * 100;
                                    $drawLength = max(0, $pct - 1.5);
                                @endphp
                                <circle 
                                    cx="18" cy="18" r="15.915" 
                                    fill="none" 
                                    stroke="{{ $d['color'] }}" 
                                    stroke-width="4"
                                    stroke-dasharray="{{ $drawLength }} {{ 100 - $drawLength }}" 
                                    stroke-dashoffset="{{ -$runningOffset }}" 
                                    stroke-linecap="round"
                                />
                                @php $runningOffset += $pct; @endphp
                            @endforeach
                        </svg>

                        <div class="donut-center-kpi">
                            <span class="donut-total-num">{{ $totalOrders }}</span>
                            <span class="donut-total-lbl">Orders</span>
                        </div>
                    </div>

                    <!-- Donut Legend Breakdown -->
                    <ul class="donut-legend-list">
                        @foreach($orderStatus as $d)
                            <li class="donut-legend-item">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span class="legend-color-dot" style="background-color: {{ $d['color'] }};"></span>
                                    <span style="color: #4b5563; font-weight: 500;">{{ $d['label'] }}</span>
                                </div>
                                <span style="font-weight: 600; color: #111827; font-variant-numeric: tabular-nums;">{{ $d['val'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>

        <!-- ================= ROW 3: TOP PRODUCTS & CONVERSION FUNNEL ================= -->
        <div class="split-tables-row">
            <!-- Top Selling Products -->
            <section class="analytics-card">
                <div class="analytics-card-header">
                    <h2 class="analytics-card-title">Top Selling Products</h2>
                    <button type="button" class="view-all-link-btn">
                        View All <i data-lucide="arrow-right" style="width: 12px; height: 12px;"></i>
                    </button>
                </div>

                <div style="margin-top: 8px;">
                    <div class="top-prod-header-row">
                        <div>Product</div>
                        <div style="width: 64px; text-align: right;">Units</div>
                        <div style="width: 96px; text-align: right;">Revenue</div>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        @foreach($topProducts as $p)
                            <div class="top-prod-data-row">
                                <div style="font-size: 13px; font-weight: 500; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $p['name'] }}
                                </div>
                                <div style="font-size: 13px; color: #6b7280; width: 64px; text-align: right; font-variant-numeric: tabular-nums;">
                                    {{ $p['units'] }}
                                </div>
                                <div style="font-size: 13px; font-weight: 600; color: #111827; width: 96px; text-align: right; font-variant-numeric: tabular-nums;">
                                    {{ $p['revenue'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Conversion Funnel -->
            <section class="analytics-card">
                <div class="analytics-card-header">
                    <h2 class="analytics-card-title">Conversion Funnel</h2>
                </div>

                <div class="funnel-container">
                    @foreach($funnel as $idx => $f)
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                                <span style="font-size: 13px; font-weight: 500; color: #4b5563; display: flex; align-items: center; gap: 8px;">
                                    <span style="color: #9ca3af; font-family: monospace; font-size: 10px;">0{{ $idx + 1 }}</span>
                                    {{ $f['step'] }}
                                </span>
                                <span style="font-size: 13px; font-variant-numeric: tabular-nums;">
                                    <strong style="font-weight: 600; color: #111827;">{{ number_format($f['value']) }}</strong>
                                    <span style="color: #9ca3af; margin-left: 8px;">({{ $f['pct'] }}%)</span>
                                </span>
                            </div>
                            <div class="funnel-step-bar-bg">
                                <div class="funnel-step-bar-fill" style="width: {{ max($f['pct'], 1) }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection