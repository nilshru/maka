@extends('layouts.admin')

@section('title', 'Notifications - Riva Nair')

@section('content')
<style>
    /* Reset & Page Wrapper */
    .notif-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F8F7F4;
        min-height: calc(100vh - 72px);
        position: relative;
        overflow: hidden;
    }

    @media (min-width: 640px) {
        .notif-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .notif-page-wrapper { margin: -32px; }
    }

    .notif-bg-glow {
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 256px;
        background: linear-gradient(to bottom left, #EBE7DF, transparent);
        opacity: 0.5;
        pointer-events: none;
    }

    .notif-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Header */
    .notif-header {
        display: flex;
        flex-direction: column;
        gap: 16px;
        justify-content: space-between;
        align-items: flex-start;
    }

    @media (min-width: 640px) {
        .notif-header {
            flex-direction: row;
            align-items: center;
        }
    }

    .notif-title {
        font-size: 28px;
        font-weight: 600;
        color: #111827;
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .notif-subtitle {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
        margin-top: 4px;
    }

    .btn-mark-read {
        background-color: #3A5340;
        color: #ffffff;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: background-color 0.2s;
    }

    .btn-mark-read:hover {
        background-color: #2C4031;
    }

    /* Summary Cards */
    .summary-cards-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    @media (min-width: 768px) {
        .summary-cards-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .summary-card {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .summary-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        flex-shrink: 0;
    }

    .summary-card-title {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 2px;
    }

    .summary-card-count {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }

    .mini-chart {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 32px;
    }

    .mini-bar {
        width: 6px;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
    }

    /* Main Grid Split */
    .notif-main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 1024px) {
        .notif-main-grid {
            grid-template-columns: 2fr 1fr;
        }
    }

    /* Panel Containers */
    .ui-panel {
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
    }

    .left-list-panel {
        height: 800px;
    }

    .right-panels-column {
        display: flex;
        flex-direction: column;
        gap: 24px;
        height: 800px;
    }

    /* Search & Filter Toolbar */
    .toolbar-row {
        padding: 16px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        flex-direction: column;
        gap: 16px;
        justify-content: space-between;
    }

    @media (min-width: 640px) {
        .toolbar-row {
            flex-direction: row;
            align-items: center;
        }
    }

    .search-input-box {
        position: relative;
        width: 100%;
        max-width: 380px;
    }

    .search-input-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .search-field {
        width: 100%;
        background-color: #F9F9F9;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px 16px 8px 36px;
        font-size: 14px;
        color: #111827;
        outline: none;
        box-sizing: border-box;
    }

    .search-field:focus {
        border-color: #3A5340;
    }

    .date-filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        background: transparent;
        cursor: pointer;
        white-space: nowrap;
    }

    .date-filter-btn:hover {
        background-color: #f9fafb;
    }

    .filter-tabs-row {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        overflow-x: auto;
    }

    .filter-pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        border: 1px solid transparent;
        background: transparent;
        color: #4b5563;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s;
    }

    .filter-pill-btn:hover {
        background-color: #f9fafb;
        border-color: #e5e7eb;
    }

    .filter-pill-btn.active {
        background-color: #EBF0EC;
        color: #3A5340;
    }

    .filter-count-badge {
        background-color: #f3f4f6;
        color: #6b7280;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 11px;
    }

    /* Toggle Switch */
    .toggle-switch-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #4b5563;
        padding-left: 16px;
        border-left: 1px solid #e5e7eb;
        flex-shrink: 0;
        cursor: pointer;
        user-select: none;
    }

    .switch-pill {
        width: 32px;
        height: 18px;
        border-radius: 9999px;
        background-color: #e5e7eb;
        position: relative;
        cursor: pointer;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
        padding: 2px;
    }

    .switch-pill.active {
        background-color: #3A5340;
    }

    .switch-knob {
        width: 14px;
        height: 14px;
        border-radius: 9999px;
        background-color: #ffffff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        transform: translateX(0);
        transition: transform 0.2s;
    }

    .switch-pill.active .switch-knob {
        transform: translateX(14px);
    }

    /* Notifications List Items */
    .notifications-list-container {
        flex: 1;
        overflow-y: auto;
    }

    .notif-list-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px;
        border-bottom: 1px solid #f9fafb;
        cursor: pointer;
        transition: background-color 0.15s;
    }

    .notif-list-item:hover {
        background-color: rgba(249, 250, 251, 0.6);
    }

    .notif-list-item.active {
        background-color: #F4F7F5;
    }

    .notif-icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notif-item-title {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 2px;
    }

    .notif-item-desc {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.4;
        white-space: pre-line;
    }

    .unread-indicator-dot {
        width: 8px;
        height: 8px;
        border-radius: 9999px;
        background-color: #3A5340;
        flex-shrink: 0;
    }

    /* Pagination */
    .pagination-bar {
        padding: 16px;
        border-top: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        color: #6b7280;
    }

    .page-btn {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: none;
        background: transparent;
        font-weight: 500;
        color: #4b5563;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .page-btn.active {
        background-color: #3A5340;
        color: #ffffff;
    }

    .page-btn:hover:not(.active) {
        background-color: #f3f4f6;
    }

    /* Right Panel Details */
    .panel-card-header {
        padding: 20px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-card-body {
        padding: 20px;
        flex: 1;
        overflow-y: auto;
    }

    .order-badge-tag {
        font-size: 11px;
        font-weight: 600;
        color: #16a34a;
        background-color: #f0fdf4;
        padding: 2px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .customer-profile-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #f3f4f6;
        margin-bottom: 20px;
    }

    .customer-avatar-img {
        width: 40px;
        height: 40px;
        border-radius: 9999px;
        object-fit: cover;
        background-color: #e5e7eb;
    }

    .order-thumbs-strip {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #f3f4f6;
        margin-bottom: 24px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .order-thumbs-strip:hover {
        background-color: #f9fafb;
    }

    .thumb-mini-box {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
    }

    .info-kv-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .btn-full-action {
        width: 100%;
        background-color: #3A5340;
        color: #ffffff;
        padding: 10px 0;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: background-color 0.2s;
    }

    .btn-full-action:hover {
        background-color: #2C4031;
    }

    /* Preferences Table */
    .pref-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        text-align: left;
    }

    .pref-table th {
        font-weight: 500;
        color: #6b7280;
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
    }

    .pref-table td {
        padding: 10px 16px;
        border-bottom: 1px solid #f9fafb;
    }

    .pref-table tr:hover {
        background-color: rgba(249, 250, 251, 0.5);
    }
</style>

@php
    $summaryCards = [
        ['id' => 'all', 'title' => 'All Notifications', 'count' => '48', 'icon' => 'bell', 'bg' => '#3A5340', 'bars' => [4, 7, 5, 8, 6, 9, 5]],
        ['id' => 'unread', 'title' => 'Unread', 'count' => '12', 'icon' => 'mail', 'bg' => '#F9A826', 'bars' => [2, 4, 3, 5, 2, 6, 3]],
        ['id' => 'important', 'title' => 'Important', 'count' => '5', 'icon' => 'star', 'bg' => '#EF4444', 'bars' => [1, 2, 1, 3, 1, 4, 2]],
    ];

    $filters = [
        ['label' => 'All', 'count' => null, 'active' => true],
        ['label' => 'Orders', 'count' => 12],
        ['label' => 'Inventory', 'count' => 6],
        ['label' => 'Customers', 'count' => 8],
        ['label' => 'Payments', 'count' => 4],
        ['label' => 'Reviews', 'count' => 5],
        ['label' => 'System', 'count' => 3],
    ];

    $notifications = [
        ['id' => 1, 'type' => 'order', 'title' => 'New Order Received', 'desc' => "Order #RN10245 from Priya Sharma\n₹697 · 3 items", 'time' => '2 min ago', 'icon' => 'shopping-bag', 'iconColor' => '#16a34a', 'iconBg' => '#f0fdf4', 'unread' => true, 'active' => true],
        ['id' => 2, 'type' => 'alert', 'title' => 'Low Stock Alert', 'desc' => 'Achari Makhana has only 7 units remaining.', 'time' => '18 min ago', 'icon' => 'alert-triangle', 'iconColor' => '#f97316', 'iconBg' => '#fff7ed', 'unread' => true, 'active' => false],
        ['id' => 3, 'type' => 'payment', 'title' => 'Payment Received', 'desc' => 'Payment for order #RN10241 has been confirmed.', 'time' => '32 min ago', 'icon' => 'credit-card', 'iconColor' => '#3b82f6', 'iconBg' => '#eff6ff', 'unread' => true, 'active' => false],
        ['id' => 4, 'type' => 'review', 'title' => 'New Product Review', 'desc' => 'Priya Sharma rated Peri Peri Makhana 5 stars.', 'time' => '1 hour ago', 'icon' => 'star', 'iconColor' => '#f43f5e', 'iconBg' => '#fff1f2', 'unread' => true, 'active' => false],
        ['id' => 5, 'type' => 'shipping', 'title' => 'Order Shipped', 'desc' => 'Order #RN10238 has been shipped.', 'time' => '2 hours ago', 'icon' => 'truck', 'iconColor' => '#a855f7', 'iconBg' => '#faf5ff', 'unread' => false, 'active' => false],
        ['id' => 6, 'type' => 'customer', 'title' => 'New Customer Registered', 'desc' => 'A new customer Aman Kumar has registered.', 'time' => '3 hours ago', 'icon' => 'user', 'iconColor' => '#10b981', 'iconBg' => '#ecfdf5', 'unread' => false, 'active' => false],
        ['id' => 7, 'type' => 'cancelled', 'title' => 'Order Cancelled', 'desc' => 'Order #RN10237 has been cancelled by the customer.', 'time' => '5 hours ago', 'icon' => 'x-circle', 'iconColor' => '#ef4444', 'iconBg' => '#fef2f2', 'unread' => false, 'active' => false],
        ['id' => 8, 'type' => 'system', 'title' => 'System Update', 'desc' => 'Product catalog was successfully updated.', 'time' => '6 hours ago', 'icon' => 'settings', 'iconColor' => '#4b5563', 'iconBg' => '#f3f4f6', 'unread' => false, 'active' => false],
        ['id' => 9, 'type' => 'inventory', 'title' => 'Out of Stock Alert', 'desc' => 'Classic Makhana 500g is out of stock.', 'time' => '8 hours ago', 'icon' => 'package', 'iconColor' => '#d97706', 'iconBg' => '#fffbeb', 'unread' => false, 'active' => false],
        ['id' => 10, 'type' => 'review', 'title' => 'New Review', 'desc' => 'Rohit Verma rated Pudina Makhana 4 stars.', 'time' => '1 day ago', 'icon' => 'star', 'iconColor' => '#8b5cf6', 'iconBg' => '#f5f3ff', 'unread' => false, 'active' => false],
    ];

    $preferences = [
        ['label' => 'New Order', 'icon' => 'shopping-bag', 'color' => '#f43f5e', 'inApp' => true, 'email' => true, 'wa' => false],
        ['label' => 'Order Status Updates', 'icon' => 'check', 'color' => '#f43f5e', 'inApp' => true, 'email' => true, 'wa' => true],
        ['label' => 'Low Stock Alert', 'icon' => 'alert-triangle', 'color' => '#f97316', 'inApp' => true, 'email' => true, 'wa' => false],
        ['label' => 'New Customer', 'icon' => 'user', 'color' => '#10b981', 'inApp' => true, 'email' => false, 'wa' => false],
        ['label' => 'New Review', 'icon' => 'star', 'color' => '#3b82f6', 'inApp' => true, 'email' => true, 'wa' => false],
        ['label' => 'Payment Updates', 'icon' => 'credit-card', 'color' => '#3b82f6', 'inApp' => true, 'email' => true, 'wa' => false],
        ['label' => 'System Alerts', 'icon' => 'settings', 'color' => '#6b7280', 'inApp' => true, 'email' => false, 'wa' => false],
    ];
@endphp

<div class="notif-page-wrapper">
    <!-- Top-Right Ambient Background Glow -->
    <div class="notif-bg-glow"></div>

    <div class="notif-container">

        <!-- ================= HEADER ================= -->
        <header class="notif-header">
            <div>
                <h1 class="notif-title">Notifications</h1>
                <p class="notif-subtitle">Stay updated with orders, inventory, customers and store activity.</p>
            </div>
            <button type="button" class="btn-mark-read" onclick="markAllRead()">
                <i data-lucide="bell" style="width: 16px; height: 16px;"></i> Mark All as Read
            </button>
        </header>

        <!-- ================= SUMMARY CARDS ================= -->
        <div class="summary-cards-grid">
            @foreach($summaryCards as $card)
                <div class="summary-card">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div class="summary-icon-wrap" style="background-color: {{ $card['bg'] }};">
                            <i data-lucide="{{ $card['icon'] }}" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div>
                            <p class="summary-card-title">{{ $card['title'] }}</p>
                            <p class="summary-card-count">{{ $card['count'] }}</p>
                        </div>
                    </div>

                    <div class="mini-chart">
                        @foreach($card['bars'] as $i => $val)
                            @php
                                $heightPct = ($val / 10) * 100;
                                $isLast = $i === count($card['bars']) - 1;
                            @endphp
                            <div 
                                class="mini-bar" 
                                style="height: {{ $heightPct }}%; background-color: {{ $card['bg'] }}; opacity: {{ $isLast ? '1' : '0.2' }};"
                            ></div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ================= MAIN CONTENT GRID ================= -->
        <div class="notif-main-grid">

            <!-- LEFT PANEL: NOTIFICATIONS LIST -->
            <div class="ui-panel left-list-panel">
                
                <!-- Toolbar Search & Date -->
                <div class="toolbar-row">
                    <div class="search-input-box">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input 
                            type="text" 
                            id="notifSearch" 
                            oninput="filterNotifications(this.value)" 
                            placeholder="Search notifications..." 
                            class="search-field"
                        >
                    </div>
                    <button type="button" class="date-filter-btn">
                        <i data-lucide="calendar" style="width: 14px; height: 14px; color: #6b7280;"></i>
                        <span>All Time</span>
                        <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #6b7280;"></i>
                    </button>
                </div>

                <!-- Tabs & Unread Toggle -->
                <div class="filter-tabs-row">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        @foreach($filters as $f)
                            <button 
                                type="button" 
                                class="filter-pill-btn {{ isset($f['active']) ? 'active' : '' }}" 
                                onclick="switchFilter(this, '{{ $f['label'] }}')"
                            >
                                {{ $f['label'] }}
                                @if(isset($f['count']))
                                    <span class="filter-count-badge">{{ $f['count'] }}</span>
                                @endif
                            </button>
                        @endforeach
                    </div>

                    <div class="toggle-switch-wrapper" onclick="toggleUnreadOnly(this)">
                        <div class="switch-pill" id="unreadToggleSwitch">
                            <div class="switch-knob"></div>
                        </div>
                        <span>Unread Only</span>
                    </div>
                </div>

                <!-- Notifications Scroll List -->
                <div class="notifications-list-container" id="notifListContainer">
                    @foreach($notifications as $n)
                        <div 
                            class="notif-list-item {{ $n['active'] ? 'active' : '' }}" 
                            id="notif-item-{{ $n['id'] }}"
                            onclick="selectNotification({{ $n['id'] }})"
                            data-title="{{ strtolower($n['title']) }}"
                            data-desc="{{ strtolower($n['desc']) }}"
                            data-type="{{ $n['type'] }}"
                            data-unread="{{ $n['unread'] ? 'true' : 'false' }}"
                        >
                            <div class="notif-icon-circle" style="background-color: {{ $n['iconBg'] }}; color: {{ $n['iconColor'] }};">
                                <i data-lucide="{{ $n['icon'] }}" style="width: 18px; height: 18px;"></i>
                            </div>

                            <div style="flex: 1; min-width: 0;">
                                <h4 class="notif-item-title">{{ $n['title'] }}</h4>
                                <p class="notif-item-desc">{{ $n['desc'] }}</p>
                            </div>

                            <div style="display: flex; align-items: center; gap: 12px; flex-shrink: 0;">
                                <span style="font-size: 11px; font-weight: 500; color: #9ca3af;">{{ $n['time'] }}</span>
                                <div style="width: 8px; height: 8px;">
                                    @if($n['unread'])
                                        <div class="unread-indicator-dot"></div>
                                    @endif
                                </div>
                                <button type="button" style="background: none; border: none; cursor: pointer; color: #9ca3af;">
                                    <i data-lucide="more-vertical" style="width: 16px; height: 16px;"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-bar">
                    <span>Showing 1–10 of 48 notifications</span>
                    <div style="display: flex; align-items: center; gap: 24px;">
                        <div style="display: flex; align-items: center; gap: 4px;">
                            <button type="button" class="page-btn"><i data-lucide="chevron-left" style="width: 16px; height: 16px;"></i></button>
                            <button type="button" class="page-btn active">1</button>
                            <button type="button" class="page-btn">2</button>
                            <button type="button" class="page-btn">3</button>
                            <button type="button" class="page-btn">4</button>
                            <button type="button" class="page-btn">5</button>
                            <button type="button" class="page-btn"><i data-lucide="chevron-right" style="width: 16px; height: 16px;"></i></button>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span>Rows per page</span>
                            <button type="button" style="border: 1px solid #e5e7eb; border-radius: 6px; padding: 4px 8px; background: #fff; display: flex; align-items: center; gap: 4px; font-size: 12px; cursor: pointer;">
                                10 <i data-lucide="chevron-down" style="width: 14px; height: 14px;"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT PANELS: DETAILS & PREFERENCES -->
            <div class="right-panels-column">
                
                <!-- Notification Details Card -->
                <div class="ui-panel" style="flex: 1;">
                    <div class="panel-card-header">
                        <h2 style="font-size: 15px; font-weight: 600; color: #111827;">Notification Details</h2>
                        <button type="button" style="background: none; border: none; cursor: pointer; color: #9ca3af;">
                            <i data-lucide="x" style="width: 18px; height: 18px;"></i>
                        </button>
                    </div>

                    <div class="panel-card-body">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div class="notif-icon-circle" style="background-color: #f0fdf4; color: #16a34a;">
                                    <i data-lucide="shopping-bag" style="width: 18px; height: 18px;"></i>
                                </div>
                                <span class="order-badge-tag">New Order</span>
                            </div>
                            <span style="font-size: 12px; color: #9ca3af; margin-top: 4px;">2 min ago</span>
                        </div>

                        <h3 style="font-size: 16px; font-weight: 700; color: #111827; margin-bottom: 4px;">New Order Received</h3>
                        <p style="font-size: 13px; color: #6b7280; margin-bottom: 24px;">Order #RN10245 has been placed successfully.</p>

                        <!-- Customer Profile Box -->
                        <div class="customer-profile-card">
                            <img src="https://i.pravatar.cc/150?u=priya" alt="Priya Sharma" class="customer-avatar-img">
                            <div>
                                <h4 style="font-size: 13px; font-weight: 600; color: #111827;">Priya Sharma</h4>
                                <p style="font-size: 12px; color: #6b7280; margin-top: 2px;">priya@gmail.com <span style="margin: 0 4px; color: #d1d5db;">|</span> +91 98765 43210</p>
                            </div>
                        </div>

                        <!-- Order Items Summary Mock -->
                        <div class="order-thumbs-strip">
                            <div style="display: flex; gap: 6px;">
                                <div class="thumb-mini-box" style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b;">Peri</div>
                                <div class="thumb-mini-box" style="background: #dcfce7; border: 1px solid #bbf7d0; color: #166534;">Pudi</div>
                                <div class="thumb-mini-box" style="background: #ffedd5; border: 1px solid #fed7aa; color: #9a3412;">Salt</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: #4b5563;">
                                3 items <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #9ca3af;"></i>
                            </div>
                        </div>

                        <!-- Info KV table -->
                        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
                            <div class="info-kv-row">
                                <span style="color: #6b7280;">Total Amount</span>
                                <span style="font-weight: 600; color: #111827;">₹697</span>
                            </div>
                            <div class="info-kv-row">
                                <span style="color: #6b7280;">Payment Method</span>
                                <span style="font-weight: 500; color: #111827;">UPI</span>
                            </div>
                            <div class="info-kv-row">
                                <span style="color: #6b7280;">Order Date</span>
                                <span style="font-weight: 500; color: #111827;">30 Sep 2026, 11:18 AM</span>
                            </div>
                            <div class="info-kv-row">
                                <span style="color: #6b7280;">Status</span>
                                <span style="font-size: 11px; font-weight: 600; color: #ea580c; background-color: #fff7ed; padding: 2px 8px; border-radius: 4px; border: 1px solid #ffedd5;">Processing</span>
                            </div>
                        </div>

                        <button type="button" class="btn-full-action">
                            View Order Details <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Notification Preferences Card -->
                <div class="ui-panel" style="flex: 1;">
                    <div class="panel-card-header" style="padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="settings" style="width: 16px; height: 16px; color: #4b5563;"></i>
                            <h2 style="font-size: 14px; font-weight: 600; color: #111827;">Notification Preferences</h2>
                        </div>
                        <button type="button" class="btn-mark-read" style="padding: 6px 12px; font-size: 12px;">
                            Save Changes
                        </button>
                    </div>

                    <div style="flex: 1; overflow-y: auto;">
                        <table class="pref-table">
                            <thead>
                                <tr>
                                    <th style="padding-left: 16px;">Notification Type</th>
                                    <th style="text-align: center;">In-App</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center; padding-right: 16px;">WhatsApp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($preferences as $pref)
                                    <tr>
                                        <td style="padding-left: 16px;">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <i data-lucide="{{ $pref['icon'] }}" style="width: 14px; height: 14px; color: {{ $pref['color'] }};"></i>
                                                <span style="font-weight: 500; color: #374151;">{{ $pref['label'] }}</span>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: inline-flex;" onclick="toggleCell(this)">
                                                <div class="switch-pill {{ $pref['inApp'] ? 'active' : '' }}">
                                                    <div class="switch-knob"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: inline-flex;" onclick="toggleCell(this)">
                                                <div class="switch-pill {{ $pref['email'] ? 'active' : '' }}">
                                                    <div class="switch-knob"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center; padding-right: 16px;">
                                            <div style="display: inline-flex;" onclick="toggleCell(this)">
                                                <div class="switch-pill {{ $pref['wa'] ? 'active' : '' }}">
                                                    <div class="switch-knob"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    let isUnreadOnly = false;

    // Search Filtering
    function filterNotifications(query) {
        const q = query.toLowerCase().trim();
        document.querySelectorAll('.notif-list-item').forEach(item => {
            const title = item.getAttribute('data-title');
            const desc = item.getAttribute('data-desc');
            const matchesText = title.includes(q) || desc.includes(q);
            const matchesUnread = !isUnreadOnly || item.getAttribute('data-unread') === 'true';

            if (matchesText && matchesUnread) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Unread Filter Toggle
    function toggleUnreadOnly(wrapper) {
        const sw = document.getElementById('unreadToggleSwitch');
        isUnreadOnly = !isUnreadOnly;
        if (isUnreadOnly) {
            sw.classList.add('active');
        } else {
            sw.classList.remove('active');
        }
        filterNotifications(document.getElementById('notifSearch').value);
    }

    // Switch Category Tabs
    function switchFilter(btn, label) {
        document.querySelectorAll('.filter-pill-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.notif-list-item').forEach(item => {
            const type = item.getAttribute('data-type');
            if (label === 'All' || type.toLowerCase().includes(label.toLowerCase())) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Select List Item
    function selectNotification(id) {
        document.querySelectorAll('.notif-list-item').forEach(item => item.classList.remove('active'));
        const activeItem = document.getElementById('notif-item-' + id);
        if (activeItem) {
            activeItem.classList.add('active');
        }
    }

    // Mark All Read
    function markAllRead() {
        document.querySelectorAll('.unread-indicator-dot').forEach(dot => dot.remove());
        document.querySelectorAll('.notif-list-item').forEach(item => item.setAttribute('data-unread', 'false'));
    }

    // Generic cell toggle for preferences
    function toggleCell(wrap) {
        const pill = wrap.querySelector('.switch-pill');
        pill.classList.toggle('active');
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection