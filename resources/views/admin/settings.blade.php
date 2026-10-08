@extends('layouts.admin')

@section('title', 'Admin Settings - Riva Nair')

@section('content')
<style>
    /* Reset & Page Wrapper */
    .settings-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F8F7F4;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .settings-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .settings-page-wrapper { margin: -32px; }
    }

    .settings-container {
        max-width: 1300px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Header */
    .settings-header {
        display: flex;
        flex-direction: column;
        gap: 16px;
        justify-content: space-between;
        align-items: flex-start;
    }

    @media (min-width: 640px) {
        .settings-header {
            flex-direction: row;
            align-items: center;
        }
    }

    .settings-title {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 28px;
        color: #111827;
        line-height: 1.1;
    }

    .settings-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-top: 4px;
    }

    .btn-save-main {
        background-color: #3A5340;
        color: #ffffff;
        padding: 10px 20px;
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

    .btn-save-main:hover {
        background-color: #2C4031;
    }

    /* Main Grid: Left Nav + Right Form */
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 1024px) {
        .settings-grid {
            grid-template-columns: 260px 1fr;
        }
    }

    /* Left Sidebar Tabs */
    .settings-tabs-list {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }

    .tab-nav-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        color: #4b5563;
        background: transparent;
        border: none;
        cursor: pointer;
        text-align: left;
        transition: all 0.2s;
    }

    .tab-nav-btn:hover {
        background-color: #F8F7F4;
        color: #111827;
    }

    .tab-nav-btn.active {
        background-color: #EBF0EC;
        color: #3A5340;
        font-weight: 600;
    }

    /* Right Content Panel */
    .settings-content-card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #E5E2D9;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        padding: 24px;
    }

    .section-title-wrap {
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 16px;
        margin-bottom: 24px;
    }

    .section-heading {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }

    .section-desc {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }

    /* Form Fields */
    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    @media (min-width: 640px) {
        .form-row-2 {
            grid-template-columns: 1fr 1fr;
        }
    }

    .field-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .field-input {
        width: 100%;
        background-color: #F8F6F0;
        border: 1px solid #E5E2D9;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        color: #111827;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.2s;
    }

    .field-input:focus {
        border-color: #3A5340;
    }

    .field-hint {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
    }

    /* Switch Toggles Inside Form */
    .setting-toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #f3f4f6;
        margin-bottom: 12px;
        background-color: #fafaf9;
    }

    .switch-pill {
        width: 36px;
        height: 20px;
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
        width: 16px;
        height: 16px;
        border-radius: 9999px;
        background-color: #ffffff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        transform: translateX(0);
        transition: transform 0.2s;
    }

    .switch-pill.active .switch-knob {
        transform: translateX(16px);
    }
</style>

<div class="settings-page-wrapper">
    <div class="settings-container">

        <!-- ================= TOP HEADER ================= -->
        <header class="settings-header">
            <div>
                <h1 class="settings-title">Store Settings</h1>
                <p class="settings-subtitle">Manage store information, payment preferences, shipping and security.</p>
            </div>
            <button type="button" class="btn-save-main" onclick="saveSettings()">
                <i data-lucide="check" style="width: 16px; height: 16px;"></i> Save Changes
            </button>
        </header>

        <!-- ================= MAIN SETTINGS GRID ================= -->
        <div class="settings-grid">

            <!-- LEFT TABS -->
            <nav class="settings-tabs-list">
                <button type="button" class="tab-nav-btn active" onclick="switchSettingTab(this, 'tabGeneral')">
                    <i data-lucide="store" style="width: 16px; height: 16px;"></i> General Settings
                </button>
                <button type="button" class="tab-nav-btn" onclick="switchSettingTab(this, 'tabPayments')">
                    <i data-lucide="credit-card" style="width: 16px; height: 16px;"></i> Payments & Gateways
                </button>
                <button type="button" class="tab-nav-btn" onclick="switchSettingTab(this, 'tabShipping')">
                    <i data-lucide="truck" style="width: 16px; height: 16px;"></i> Shipping & Delivery
                </button>
                <button type="button" class="tab-nav-btn" onclick="switchSettingTab(this, 'tabSecurity')">
                    <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i> Security & Password
                </button>
            </nav>

            <!-- RIGHT TAB PANELS -->
            <div class="settings-content-card">

                <!-- 1. GENERAL SETTINGS -->
                <div id="tabGeneral" class="tab-pane">
                    <div class="section-title-wrap">
                        <h2 class="section-heading">Store Information</h2>
                        <p class="section-desc">Details shown on order invoices, checkout, and store footer.</p>
                    </div>

                    <div class="form-row-2">
                        <div>
                            <label class="field-label">Store Brand Name</label>
                            <input type="text" class="field-input" value="Riva Nair Makhana">
                        </div>
                        <div>
                            <label class="field-label">Support Email</label>
                            <input type="email" class="field-input" value="support@rivanair.com">
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div>
                            <label class="field-label">Contact Phone</label>
                            <input type="text" class="field-input" value="+91 98765 43210">
                        </div>
                        <div>
                            <label class="field-label">Store Currency</label>
                            <input type="text" class="field-input" value="INR (₹)" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label class="field-label">Registered Office Address</label>
                        <textarea rows="3" class="field-input" style="resize: none;">Plot No. 42, Patliputra Industrial Area, Patna, Bihar - 800013, India</textarea>
                    </div>

                    <div class="section-title-wrap" style="margin-top: 32px;">
                        <h2 class="section-heading">Preferences</h2>
                        <p class="section-desc">Enable or disable general storefront features.</p>
                    </div>

                    <div class="setting-toggle-row">
                        <div>
                            <p style="font-size: 13px; font-weight: 600; color: #111827;">Enable Customer Reviews</p>
                            <p style="font-size: 11px; color: #6b7280;">Allow verified customers to leave star ratings and comments.</p>
                        </div>
                        <div class="switch-pill active" onclick="this.classList.toggle('active')">
                            <div class="switch-knob"></div>
                        </div>
                    </div>

                    <div class="setting-toggle-row">
                        <div>
                            <p style="font-size: 13px; font-weight: 600; color: #111827;">Maintenance Mode</p>
                            <p style="font-size: 11px; color: #6b7280;">Temporarily take down the storefront with a maintenance notice.</p>
                        </div>
                        <div class="switch-pill" onclick="this.classList.toggle('active')">
                            <div class="switch-knob"></div>
                        </div>
                    </div>
                </div>

                <!-- 2. PAYMENTS & GATEWAYS -->
                <div id="tabPayments" class="tab-pane" style="display: none;">
                    <div class="section-title-wrap">
                        <h2 class="section-heading">Payment Gateways</h2>
                        <p class="section-desc">Manage Razorpay, UPI QR, and Cash on Delivery (COD) options.</p>
                    </div>

                    <!-- Razorpay Toggle Box -->
                    <div class="setting-toggle-row" style="margin-bottom: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 8px; background-color: #02042b; color: #528FF0; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px;">R</div>
                            <div>
                                <p style="font-size: 14px; font-weight: 600; color: #111827;">Razorpay (Cards, Netbanking, UPI)</p>
                                <p style="font-size: 11px; color: #6b7280;">Direct payment collection via Razorpay Gateway.</p>
                            </div>
                        </div>
                        <div class="switch-pill active" onclick="this.classList.toggle('active')">
                            <div class="switch-knob"></div>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div>
                            <label class="field-label">Razorpay Key ID</label>
                            <input type="text" class="field-input" value="rzp_live_8938hskd932849">
                        </div>
                        <div>
                            <label class="field-label">Razorpay Key Secret</label>
                            <input type="password" class="field-input" value="••••••••••••••••••••••••">
                        </div>
                    </div>

                    <!-- COD Toggle Box -->
                    <div class="setting-toggle-row" style="margin-top: 24px; margin-bottom: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 8px; background-color: #ecfdf5; color: #047857; display: flex; align-items: center; justify-content: center;">
                                <i data-lucide="banknote" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <p style="font-size: 14px; font-weight: 600; color: #111827;">Cash on Delivery (COD)</p>
                                <p style="font-size: 11px; color: #6b7280;">Accept cash upon delivery at customer doorstep.</p>
                            </div>
                        </div>
                        <div class="switch-pill active" onclick="this.classList.toggle('active')">
                            <div class="switch-knob"></div>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div>
                            <label class="field-label">COD Extra Handling Fee (₹)</label>
                            <input type="number" class="field-input" value="40">
                            <p class="field-hint">Keep 0 if COD is free.</p>
                        </div>
                        <div>
                            <label class="field-label">Max Order Value for COD (₹)</label>
                            <input type="number" class="field-input" value="2500">
                        </div>
                    </div>
                </div>

                <!-- 3. SHIPPING & DELIVERY -->
                <div id="tabShipping" class="tab-pane" style="display: none;">
                    <div class="section-title-wrap">
                        <h2 class="section-heading">Shipping Rules & Couriers</h2>
                        <p class="section-desc">Configure standard shipping costs, free delivery rules, and logistics partners.</p>
                    </div>

                    <div class="form-row-2">
                        <div>
                            <label class="field-label">Default Shipping Charge (₹)</label>
                            <input type="number" class="field-input" value="50">
                        </div>
                        <div>
                            <label class="field-label">Free Delivery Threshold (₹)</label>
                            <input type="number" class="field-input" value="499">
                            <p class="field-hint">Orders above this amount qualify for Free Shipping.</p>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div>
                            <label class="field-label">Primary Courier Partner</label>
                            <select class="field-input">
                                <option>Delhivery Express</option>
                                <option>BlueDart</option>
                                <option>Ecom Express</option>
                                <option>Shiprocket</option>
                            </select>
                        </div>
                        <div>
                            <label class="field-label">Estimated Delivery Days</label>
                            <input type="text" class="field-input" value="3 - 5 Business Days">
                        </div>
                    </div>
                </div>

                <!-- 4. SECURITY & PASSWORD -->
                <div id="tabSecurity" class="tab-pane" style="display: none;">
                    <div class="section-title-wrap">
                        <h2 class="section-heading">Security & Credentials</h2>
                        <p class="section-desc">Change your admin password and manage account security.</p>
                    </div>

                    <div style="max-width: 480px; display: flex; flex-direction: column; gap: 16px;">
                        <div>
                            <label class="field-label">Current Password</label>
                            <input type="password" class="field-input" placeholder="Enter current password">
                        </div>
                        <div>
                            <label class="field-label">New Password</label>
                            <input type="password" class="field-input" placeholder="Minimum 8 characters">
                        </div>
                        <div>
                            <label class="field-label">Confirm New Password</label>
                            <input type="password" class="field-input" placeholder="Repeat new password">
                        </div>
                        <button type="button" class="btn-save-main" style="align-self: flex-start; margin-top: 8px;">
                            Update Password
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    // Tab Switcher
    function switchSettingTab(btn, tabId) {
        document.querySelectorAll('.tab-nav-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.tab-pane').forEach(p => p.style.display = 'none');
        document.getElementById(tabId).style.display = 'block';

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    // Save Toast Mock
    function saveSettings() {
        alert("Settings saved successfully!");
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection