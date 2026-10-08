@extends('layouts.admin')

@section('title', 'Help & Support - Riva Nair')

@section('content')
<style>
    /* Reset & Page Wrapper */
    .help-page-wrapper {
        font-family: inherit;
        color: #111827;
        margin: -16px;
        padding: 24px;
        background-color: #F8F7F4;
        min-height: calc(100vh - 72px);
    }

    @media (min-width: 640px) {
        .help-page-wrapper { margin: -24px; }
    }
    @media (min-width: 1024px) {
        .help-page-wrapper { margin: -32px; }
    }

    .help-container {
        max-width: 1300px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    /* Hero Banner with Search */
    .help-hero-banner {
        position: relative;
        background: linear-gradient(135deg, #EDE8D8 0%, #E2DDD0 100%);
        border: 1px solid #E5E2D9;
        border-radius: 20px;
        padding: 48px 24px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        color: #3B5240;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 4px 12px;
        border-radius: 9999px;
        margin-bottom: 16px;
    }

    .hero-heading {
        font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: 32px;
        color: #1F2A22;
        line-height: 1.2;
        margin-bottom: 8px;
    }

    @media (min-width: 768px) {
        .hero-heading { font-size: 40px; }
    }

    .hero-desc {
        font-size: 14px;
        color: #6b7280;
        max-width: 540px;
        margin-bottom: 28px;
        line-height: 1.5;
    }

    .hero-search-box {
        position: relative;
        width: 100%;
        max-width: 580px;
    }

    .hero-search-box i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .hero-search-input {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #D9D3C1;
        border-radius: 14px;
        padding: 14px 20px 14px 50px;
        font-size: 14px;
        color: #111827;
        outline: none;
        box-sizing: border-box;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .hero-search-input:focus {
        border-color: #3B5240;
        box-shadow: 0 0 0 3px rgba(59, 82, 64, 0.12);
    }

    /* Quick Cards Row */
    .quick-channels-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    @media (min-width: 640px) {
        .quick-channels-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 1024px) {
        .quick-channels-grid { grid-template-columns: repeat(4, 1fr); }
    }

    .quick-card {
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        color: inherit;
    }

    .quick-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.06);
    }

    .quick-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-weight: 700;
    }

    .quick-card-title {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }

    .quick-card-desc {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 16px;
        flex: 1;
    }

    .quick-card-link {
        font-size: 12px;
        font-weight: 600;
        color: #3B5240;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* 2 Column Split: FAQ + Contact Form */
    .help-split-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 28px;
    }

    @media (min-width: 1024px) {
        .help-split-grid {
            grid-template-columns: 7fr 5fr;
        }
    }

    .ui-support-panel {
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .panel-title-row {
        margin-bottom: 24px;
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 16px;
    }

    .panel-heading {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    .panel-sub {
        font-size: 13px;
        color: #6b7280;
        margin-top: 4px;
    }

    /* Accordion FAQ */
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .faq-item {
        border: 1px solid #E5E2D9;
        border-radius: 12px;
        overflow: hidden;
        transition: border-color 0.2s;
    }

    .faq-item.open {
        border-color: #3B5240;
    }

    .faq-question-btn {
        width: 100%;
        background-color: #FAF9F5;
        border: none;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        text-align: left;
        cursor: pointer;
    }

    .faq-item.open .faq-question-btn {
        background-color: #ffffff;
    }

    .faq-answer-body {
        padding: 0 20px 16px 20px;
        font-size: 13px;
        line-height: 1.6;
        color: #4b5563;
        display: none;
        background-color: #ffffff;
    }

    .faq-item.open .faq-answer-body {
        display: block;
    }

    .faq-icon-arrow {
        transition: transform 0.2s ease;
        color: #9ca3af;
        flex-shrink: 0;
    }

    .faq-item.open .faq-icon-arrow {
        transform: rotate(180deg);
        color: #3B5240;
    }

    /* Support Ticket Form */
    .form-group-field {
        margin-bottom: 18px;
    }

    .form-lbl {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-in {
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

    .form-in:focus {
        border-color: #3B5240;
    }

    .btn-submit-ticket {
        width: 100%;
        background-color: #3B5240;
        color: #ffffff;
        padding: 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-submit-ticket:hover {
        background-color: #2A3C2E;
    }

    /* System Status Footnote */
    .system-status-strip {
        background-color: #ffffff;
        border: 1px solid #E5E2D9;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 13px;
    }

    .status-indicator-dot {
        width: 10px;
        height: 10px;
        border-radius: 9999px;
        background-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
    }
</style>

@php
    $faqs = [
        [
            'q' => 'How do I add or update inventory stock counts?',
            'a' => 'Navigate to the Inventory section from the sidebar. You can either click on "Stock Adjustment" to manually add or remove batch stock, or update individual product variants directly.'
        ],
        [
            'q' => 'How are shipping rates and free delivery thresholds configured?',
            'a' => 'Head over to Settings > Shipping & Delivery. There you can customize the default shipping charges (e.g., ₹50) and specify minimum order amounts for automated Free Delivery.'
        ],
        [
            'q' => 'What payment gateways are supported for orders?',
            'a' => 'The store natively supports Razorpay (Cards, Netbanking, UPI QR, and Wallets) along with automated Cash on Delivery (COD) verification flags.'
        ],
        [
            'q' => 'How can I print shipping invoices and packing slips?',
            'a' => 'Open the Orders menu and select any specific order. In the top-right corner of the details card, click the "Print Invoice" button to generate a clean, printable PDF format.'
        ],
        [
            'q' => 'Can I export orders and customer data into Excel or CSV?',
            'a' => 'Yes! Both the Orders and Customers tables include an "Export" action button located at the top right of their respective table views.'
        ],
    ];
@endphp

<div class="help-page-wrapper">
    <div class="help-container">

        <!-- ================= HERO SEARCH BANNER ================= -->
        <section class="help-hero-banner">
            <span class="hero-badge">
                <i data-lucide="life-buoy" style="width: 14px; height: 14px;"></i> Knowledge Base & Help Desk
            </span>
            <h1 class="hero-heading">How can we assist you today?</h1>
            <p class="hero-desc">
                Find helpful guides, system documentation, shipping policies, or submit a support ticket to our technical desk.
            </p>

            <div class="hero-search-box">
                <i data-lucide="search" style="width: 18px; height: 18px;"></i>
                <input 
                    type="text" 
                    id="faqSearchInput" 
                    oninput="searchFaqs(this.value)" 
                    placeholder="Search articles, orders help, payment FAQs..." 
                    class="hero-search-input"
                >
            </div>
        </section>

        <!-- ================= QUICK CHANNELS GRID ================= -->
        <section class="quick-channels-grid">
            <!-- Documentation -->
            <a href="#" class="quick-card">
                <div class="quick-card-icon" style="background-color: #EBF0EC; color: #3B5240;">
                    <i data-lucide="book-open" style="width: 20px; height: 20px;"></i>
                </div>
                <h3 class="quick-card-title">User Manual</h3>
                <p class="quick-card-desc">Detailed step-by-step guides on product variations, SEO metadata, and category structuring.</p>
                <span class="quick-card-link">Explore Guides <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i></span>
            </a>

            <!-- Direct WhatsApp / Phone -->
            <a href="tel:+919876543210" class="quick-card">
                <div class="quick-card-icon" style="background-color: #ECFDF5; color: #047857;">
                    <i data-lucide="phone-call" style="width: 20px; height: 20px;"></i>
                </div>
                <h3 class="quick-card-title">Dedicated Helpline</h3>
                <p class="quick-card-desc">Need urgent logistics or technical assistance? Speak directly to our Patna operations center.</p>
                <span class="quick-card-link">+91 98765 43210 <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i></span>
            </a>

            <!-- Email Support -->
            <a href="mailto:support@rivanair.com" class="quick-card">
                <div class="quick-card-icon" style="background-color: #EFF6FF; color: #2563EB;">
                    <i data-lucide="mail" style="width: 20px; height: 20px;"></i>
                </div>
                <h3 class="quick-card-title">Email Inquiries</h3>
                <p class="quick-card-desc">Drop detailed queries or file attachments. Our desk responds typically within 2-4 business hours.</p>
                <span class="quick-card-link">support@rivanair.com <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i></span>
            </a>

            <!-- System Status -->
            <div class="quick-card" style="cursor: default;">
                <div class="quick-card-icon" style="background-color: #FEF3C7; color: #B45309;">
                    <i data-lucide="server" style="width: 20px; height: 20px;"></i>
                </div>
                <h3 class="quick-card-title">System Health</h3>
                <p class="quick-card-desc">Database clusters, Razorpay webhooks, and courier APIs are running with 99.98% uptime.</p>
                <span class="quick-card-link" style="color: #16A34A;">All Services Operational</span>
            </div>
        </section>

        <!-- ================= 2 COLUMN SPLIT: FAQ + CONTACT FORM ================= -->
        <div class="help-split-grid">
            
            <!-- LEFT: FAQ ACCORDION -->
            <section class="ui-support-panel">
                <div class="panel-title-row">
                    <h2 class="panel-heading">Frequently Asked Questions</h2>
                    <p class="panel-sub">Quick answers to common questions regarding store management and settings.</p>
                </div>

                <div class="faq-list" id="faqAccordionList">
                    @foreach($faqs as $idx => $f)
                        <div class="faq-item {{ $idx === 0 ? 'open' : '' }}">
                            <button type="button" class="faq-question-btn" onclick="toggleFaq(this)">
                                <span>{{ $f['q'] }}</span>
                                <i data-lucide="chevron-down" class="faq-icon-arrow" style="width: 18px; height: 18px;"></i>
                            </button>
                            <div class="faq-answer-body">
                                {{ $f['a'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- RIGHT: TICKET SUBMISSION FORM -->
            <section class="ui-support-panel">
                <div class="panel-title-row">
                    <h2 class="panel-heading">Submit Support Ticket</h2>
                    <p class="panel-sub">Encountering an issue? Let our admin tech team resolve it for you.</p>
                </div>

                <form onsubmit="handleTicketSubmit(event)">
                    <div class="form-group-field">
                        <label class="form-lbl">Issue Subject *</label>
                        <input type="text" required placeholder="e.g., Courier tracking webhook delayed" class="form-in">
                    </div>

                    <div class="form-group-field">
                        <label class="form-lbl">Category *</label>
                        <select class="form-in">
                            <option>Order & Fulfillment Issue</option>
                            <option>Payment Gateway & Refunds</option>
                            <option>Inventory Discrepancy</option>
                            <option>Platform Bug / Technical Defect</option>
                            <option>General Question</option>
                        </select>
                    </div>

                    <div class="form-group-field">
                        <label class="form-lbl">Priority Level</label>
                        <select class="form-in">
                            <option>Normal - Standard query</option>
                            <option>High - Affecting customers</option>
                            <option>Critical - Checkout blocked</option>
                        </select>
                    </div>

                    <div class="form-group-field">
                        <label class="form-lbl">Detailed Description *</label>
                        <textarea rows="4" required placeholder="Please describe what happened, order IDs involved, or steps to reproduce..." class="form-in" style="resize: none;"></textarea>
                    </div>

                    <button type="submit" class="btn-submit-ticket">
                        <i data-lucide="send" style="width: 16px; height: 16px;"></i> Send Ticket to Support
                    </button>
                </form>
            </section>

        </div>

        <!-- ================= SYSTEM STATUS FOOTNOTE ================= -->
        <footer class="system-status-strip">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div class="status-indicator-dot"></div>
                <span style="font-weight: 600; color: #111827;">Riva Nair Makhana Admin Core: v2.4.0</span>
                <span style="color: #9ca3af;">• Last updated October 2026</span>
            </div>
            <div style="display: flex; align-items: center; gap: 16px; color: #6b7280; font-size: 12px;">
                <span>Timezone: IST (+05:30)</span>
                <a href="{{ route('admin.dashboard') }}" style="color: #3B5240; font-weight: 600; text-decoration: none;">Back to Dashboard</a>
            </div>
        </footer>

    </div>
</div>

<script>
    // Accordion Interaction
    function toggleFaq(btn) {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');

        // Close other FAQs
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));

        if (!isOpen) {
            item.classList.add('open');
        }
    }

    // Live Search for FAQs
    function searchFaqs(query) {
        const q = query.toLowerCase().trim();
        const items = document.querySelectorAll('.faq-item');

        items.forEach(item => {
            const question = item.querySelector('.faq-question-btn').innerText.toLowerCase();
            const answer = item.querySelector('.faq-answer-body').innerText.toLowerCase();

            if (question.includes(q) || answer.includes(q)) {
                item.style.display = 'block';
                if (q.length > 2) item.classList.add('open');
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Form Submit Mock
    function handleTicketSubmit(e) {
        e.preventDefault();
        alert("Your support ticket has been logged successfully! Ticket ID #RN-TKT-" + Math.floor(1000 + Math.random() * 9000));
        e.target.reset();
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
@endsection