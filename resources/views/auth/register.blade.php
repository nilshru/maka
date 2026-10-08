<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Riva Nair</title>

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f6ef;
            color: #111827;
        }

        .reg-wrapper {
            height: 100vh;
            width: 100%;
            overflow: hidden;
            background-color: #f8f6ef;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
        }

        @media (min-width: 640px) {
            .reg-wrapper { padding: 16px; }
        }
        @media (min-width: 1024px) {
            .reg-wrapper { padding: 20px; }
        }

        .reg-card {
            width: 100%;
            max-width: 1024px;
            height: 100%;
            max-height: calc(100vh - 2.5rem);
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.10);
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 1024px) {
            .reg-card {
                flex-direction: row;
            }
        }

        /* Left Side Image */
        .reg-visual-panel {
            display: none;
            height: 100%;
            background-color: #f4f5e8;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        @media (min-width: 1024px) {
            .reg-visual-panel {
                display: flex;
                width: 45%;
            }
        }

        .reg-hero-img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Right Form Panel */
        .reg-form-panel {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px 20px;
            overflow-y: auto;
        }

        @media (min-width: 640px) {
            .reg-form-panel { padding: 20px 32px; }
        }
        @media (min-width: 768px) {
            .reg-form-panel { padding: 20px 40px; }
        }
        @media (min-width: 1024px) {
            .reg-form-panel { width: 55%; padding: 20px 32px; }
        }
        @media (min-width: 1280px) {
            .reg-form-panel { padding: 20px 48px; }
        }

        .back-home-link {
            position: absolute;
            top: 16px;
            left: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }

        @media (min-width: 640px) {
            .back-home-link {
                top: 24px;
                left: 24px;
                font-size: 14px;
            }
        }

        .back-home-link:hover { color: #006b45; }

        .reg-inner-box {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-header-wrap {
            text-align: center;
            margin-bottom: 16px;
        }

        .brand-logo-img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            margin: 0 auto 8px auto;
            display: block;
        }

        @media (min-width: 640px) {
            .brand-logo-img { width: 48px; height: 48px; }
        }

        .auth-heading {
            font-size: 20px;
            font-weight: 700;
            color: #10251d;
            line-height: 1.2;
        }

        @media (min-width: 640px) {
            .auth-heading { font-size: 24px; }
        }

        .auth-subtext {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        @media (min-width: 640px) {
            .auth-subtext { font-size: 14px; }
        }

        /* Form Controls */
        .form-fields-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .grid-2-fields {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        @media (min-width: 640px) {
            .grid-2-fields {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #172820;
            margin-bottom: 4px;
        }

        @media (min-width: 640px) {
            .form-label { font-size: 14px; }
        }

        .form-input-text {
            width: 100%;
            height: 40px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            font-size: 14px;
            color: #1f2937;
            outline: none;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        .form-input-text::placeholder { color: #9ca3af; }

        .form-input-text:focus {
            background-color: #ffffff;
            border-color: #006b45;
            box-shadow: 0 0 0 4px rgba(0, 107, 69, 0.1);
        }

        .terms-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 11px;
            color: #4b5563;
            line-height: 1.4;
            cursor: pointer;
            padding-top: 2px;
        }

        @media (min-width: 640px) {
            .terms-row { font-size: 12px; }
        }

        .terms-row a {
            font-weight: 600;
            color: #006b45;
            text-decoration: none;
        }

        .terms-row a:hover { text-decoration: underline; }

        .btn-submit-green {
            width: 100%;
            height: 40px;
            border-radius: 8px;
            background-color: #006b45;
            color: #ffffff;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0, 107, 69, 0.2);
            margin-top: 4px;
        }

        .btn-submit-green:hover { background-color: #00563a; }
        .btn-submit-green:active { transform: scale(0.99); }

        .divider-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 12px 0;
        }

        .divider-line {
            height: 1px;
            background-color: #e5e7eb;
            flex: 1;
        }

        .divider-txt {
            font-size: 10px;
            color: #9ca3af;
            font-weight: 600;
        }

        .btn-google-auth {
            width: 100%;
            height: 40px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            background-color: #ffffff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-google-auth:hover {
            background-color: #f9fafb;
            border-color: #d1d5db;
        }

        .bottom-switch-text {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 12px;
        }

        @media (min-width: 640px) {
            .bottom-switch-text { font-size: 14px; }
        }

        .bottom-switch-text a {
            font-weight: 600;
            color: #006b45;
            text-decoration: none;
        }

        .bottom-switch-text a:hover { text-decoration: underline; }

        .auth-copyright {
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            margin-top: 8px;
        }
    </style>
</head>
<body>

    <div class="reg-wrapper">
        <div class="reg-card">

            <!-- LEFT SIDE - IMAGE -->
            <div class="reg-visual-panel">
                <img 
                    src="{{ asset('assets/login/loginside.png') }}" 
                    alt="Rivanair" 
                    class="reg-hero-img"
                    onerror="this.src='https://placehold.co/600x900/f4f5e8/006b45?text=Rivanair+Makhana'"
                >
            </div>

            <!-- RIGHT SIDE - REGISTER -->
            <div class="reg-form-panel">
                <a href="{{ url('/') }}" class="back-home-link">
                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>

                <div class="reg-inner-box">
                    <!-- LOGO / HEADING -->
                    <div class="brand-header-wrap">
                        <img 
                            src="{{ asset('assets/login/brand_logo.png') }}" 
                            alt="Rivanair Logo" 
                            class="brand-logo-img"
                            onerror="this.src='https://placehold.co/80x80/006b45/ffffff?text=R'"
                        >
                        <h2 class="auth-heading">Create Account</h2>
                        <p class="auth-subtext">Create your Rivanair account</p>
                    </div>

                    <!-- REGISTER FORM -->
                    <form class="form-fields-stack" action="{{ url('/login') }}" method="GET">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="form-label">Full Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                autocomplete="name"
                                placeholder="Enter your full name"
                                class="form-input-text"
                                required
                            >
                        </div>

                        <!-- Email + Mobile -->
                        <div class="grid-2-fields">
                            <div>
                                <label for="email" class="form-label">Email Address</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    placeholder="Enter email"
                                    class="form-input-text"
                                    required
                                >
                            </div>
                            <div>
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input
                                    id="mobile"
                                    name="mobile"
                                    type="tel"
                                    autocomplete="tel"
                                    placeholder="Mobile number"
                                    class="form-input-text"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password + Confirm Password -->
                        <div class="grid-2-fields">
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="Create password"
                                    class="form-input-text"
                                    required
                                >
                            </div>
                            <div>
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input
                                    id="confirmPassword"
                                    name="confirmPassword"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="Confirm password"
                                    class="form-input-text"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Terms -->
                        <div>
                            <label for="terms" class="terms-row">
                                <input
                                    id="terms"
                                    type="checkbox"
                                    style="margin-top: 2px; width: 14px; height: 14px; accent-color: #006b45; cursor: pointer; flex-shrink: 0;"
                                    required
                                >
                                <span>
                                    I agree to 
                                    <a href="#">Terms & Conditions</a> and 
                                    <a href="#">Privacy Policy</a>.
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit-green">
                            Create Account →
                        </button>
                    </form>

                    <!-- DIVIDER -->
                    <div class="divider-row">
                        <div class="divider-line"></div>
                        <span class="divider-txt">OR</span>
                        <div class="divider-line"></div>
                    </div>

                    <!-- GOOGLE AUTH -->
                    <button type="button" class="btn-google-auth">
                        <span style="font-weight: 700; font-size: 18px; color: #4285F4;">G</span>
                        Continue with Google
                    </button>

                    <!-- LOGIN LINK -->
                    <p class="bottom-switch-text">
                        Already have an account? 
                        <a href="{{ url('/login') }}">Login</a>
                    </p>

                    <p class="auth-copyright">
                        © 2026 Rivanair · Taste of Bihar
                    </p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>