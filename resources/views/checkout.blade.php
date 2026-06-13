<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout — {{ config('app.name', 'AhmadStore') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Epilogue:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-bg:             oklch(98.2% 0.007 85);
            --color-surface:        oklch(97% 0.006 85);
            --color-surface-alt:    oklch(95% 0.010 85);
            --color-text:           oklch(16% 0.014 250);
            --color-text-muted:     oklch(50% 0.013 250);
            --color-text-subtle:    oklch(68% 0.010 250);
            --color-accent:         oklch(46% 0.14 162);
            --color-accent-hover:   oklch(38% 0.14 162);
            --color-accent-surface: oklch(95% 0.05 162);
            --color-border:         oklch(90% 0.008 85);
            --color-border-strong:  oklch(80% 0.010 85);
            --color-error:          oklch(52% 0.19 25);
            --color-error-surface:  oklch(97% 0.04 25);
            --color-error-border:   oklch(88% 0.08 25);

            --font-display: 'Gloock', Georgia, serif;
            --font-body:    'Epilogue', system-ui, sans-serif;
            --radius-sm: 6px; --radius-md: 10px; --radius-lg: 16px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--color-bg); color: var(--color-text);
            font-family: var(--font-body); font-size: 1rem; line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── HEADER ── */
        .site-header {
            position: sticky; top: 0; z-index: 100;
            background: var(--color-bg); border-bottom: 1px solid var(--color-border);
        }
        .header-inner {
            max-width: 1280px; margin: 0 auto; padding: 0 32px; height: 64px;
            display: flex; align-items: center; gap: 32px;
        }
        .logo { display: flex; align-items: center; gap: 8px; text-decoration: none; flex-shrink: 0; }
        .logo-mark {
            width: 32px; height: 32px; background: var(--color-accent); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.8rem; font-weight: 700;
            font-family: var(--font-display); letter-spacing: -0.02em;
        }
        .logo-name { font-family: var(--font-display); font-size: 1.25rem; color: var(--color-text); letter-spacing: -0.02em; }

        /* Checkout step progress in header */
        .checkout-steps {
            display: flex; align-items: center; gap: 0; margin: 0 auto;
        }
        .step {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.8125rem; font-weight: 500; color: var(--color-text-subtle);
        }
        .step.active { color: var(--color-text); }
        .step.done { color: var(--color-accent); }
        .step-num {
            width: 24px; height: 24px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.6875rem; font-weight: 700;
            background: var(--color-surface-alt); color: var(--color-text-subtle);
            flex-shrink: 0;
        }
        .step.active .step-num { background: var(--color-text); color: #fff; }
        .step.done .step-num { background: var(--color-accent); color: #fff; }
        .step-divider {
            width: 40px; height: 1px; background: var(--color-border); margin: 0 12px;
        }

        .header-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .icon-btn {
            width: 36px; height: 36px; border: none; background: transparent;
            border-radius: var(--radius-sm); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted); transition: color 0.15s, background 0.15s;
            position: relative; text-decoration: none;
        }
        .icon-btn:hover { color: var(--color-text); background: var(--color-surface-alt); }
        .cart-badge {
            position: absolute; top: 4px; right: 4px; width: 16px; height: 16px;
            background: var(--color-accent); color: #fff; font-size: 0.6rem; font-weight: 700;
            border-radius: 999px; display: flex; align-items: center; justify-content: center;
        }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            max-width: 1280px; margin: 0 auto; padding: 16px 32px;
            display: flex; align-items: center; gap: 8px;
            font-size: 0.8125rem; color: var(--color-text-subtle);
        }
        .breadcrumb a { color: var(--color-text-muted); text-decoration: none; transition: color 0.15s; }
        .breadcrumb a:hover { color: var(--color-accent); }
        .breadcrumb-current { color: var(--color-text); font-weight: 500; }

        /* ── LAYOUT ── */
        .checkout-layout {
            max-width: 1280px; margin: 0 auto;
            padding: 0 32px 80px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 48px;
            align-items: start;
        }

        /* ── FORM SECTIONS ── */
        .page-title { margin-bottom: 32px; }
        .page-title h1 {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            letter-spacing: -0.02em; color: var(--color-text);
        }
        .page-title p { font-size: 0.9375rem; color: var(--color-text-muted); margin-top: 4px; }

        /* Error banner */
        .error-banner {
            background: var(--color-error-surface);
            border: 1px solid var(--color-error-border);
            color: var(--color-error);
            border-radius: var(--radius-md);
            padding: 14px 16px; margin-bottom: 24px;
            font-size: 0.875rem;
        }
        .error-banner strong { display: block; margin-bottom: 6px; font-weight: 600; }
        .error-banner ul { padding-left: 16px; display: flex; flex-direction: column; gap: 3px; }

        /* Form card */
        .form-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            padding: 28px;
            margin-bottom: 12px;
        }

        .form-card-header {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 24px;
        }
        .step-badge {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--color-accent); color: #fff;
            font-size: 0.75rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .form-card-title {
            font-family: var(--font-display);
            font-size: 1.125rem; letter-spacing: -0.01em; color: var(--color-text);
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-grid.full { grid-template-columns: 1fr; }

        .field { display: flex; flex-direction: column; gap: 6px; }
        .field.span-2 { grid-column: 1 / -1; }

        label {
            font-size: 0.8125rem; font-weight: 600; color: var(--color-text-muted);
            letter-spacing: 0.01em;
        }
        .req { color: var(--color-error); margin-left: 2px; }

        .input, .textarea {
            width: 100%; height: 44px; padding: 0 14px;
            background: var(--color-bg); border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm); font-family: var(--font-body);
            font-size: 0.9375rem; color: var(--color-text); outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .textarea {
            height: auto; padding: 12px 14px; resize: none; line-height: 1.6;
        }
        .input::placeholder, .textarea::placeholder { color: var(--color-text-subtle); }
        .input:focus, .textarea:focus {
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px oklch(95% 0.05 162);
        }
        .input.error, .textarea.error {
            border-color: var(--color-error);
            background: var(--color-error-surface);
        }
        .input.error:focus, .textarea.error:focus {
            box-shadow: 0 0 0 3px oklch(96% 0.05 25);
        }
        .field-error { font-size: 0.75rem; color: var(--color-error); }

        /* Payment method (display only) */
        .payment-option {
            display: flex; align-items: center; gap: 12px;
            padding: 16px; border-radius: var(--radius-md);
            border: 1.5px solid var(--color-accent);
            background: var(--color-accent-surface);
        }
        .payment-radio {
            width: 18px; height: 18px; border-radius: 50%;
            border: 2px solid var(--color-accent);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .payment-radio-dot {
            width: 8px; height: 8px; border-radius: 50%; background: var(--color-accent);
        }
        .payment-label { font-size: 0.9375rem; font-weight: 600; color: var(--color-text); }
        .payment-sub { font-size: 0.8125rem; color: var(--color-text-muted); }

        /* Mobile CTA */
        .mobile-cta {
            display: none;
            margin-top: 16px;
        }

        /* ── ORDER SUMMARY PANEL ── */
        .summary-panel {
            position: sticky; top: 80px;
        }

        .summary-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .summary-header {
            padding: 20px 24px 0;
        }
        .summary-title {
            font-family: var(--font-display);
            font-size: 1.125rem; letter-spacing: -0.01em; color: var(--color-text);
            margin-bottom: 20px;
        }

        .summary-items { padding: 0 24px; display: flex; flex-direction: column; gap: 16px; margin-bottom: 20px; }

        .summary-item { display: flex; align-items: center; gap: 12px; }
        .summary-thumb {
            width: 52px; height: 52px; border-radius: var(--radius-md);
            background: var(--color-bg); overflow: hidden; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .summary-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .summary-thumb .qty-dot {
            position: absolute; top: -5px; right: -5px;
            width: 18px; height: 18px; background: var(--color-text); color: #fff;
            font-size: 0.6rem; font-weight: 700; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .summary-item-info { flex: 1; min-width: 0; }
        .summary-item-name {
            font-size: 0.875rem; font-weight: 500; color: var(--color-text);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .summary-item-meta { font-size: 0.75rem; color: var(--color-text-subtle); margin-top: 2px; }
        .summary-item-price {
            font-size: 0.875rem; font-weight: 600; color: var(--color-text); flex-shrink: 0;
        }

        .summary-divider { border: none; border-top: 1px solid var(--color-border); margin: 0 24px; }

        .summary-totals { padding: 16px 24px; display: flex; flex-direction: column; gap: 10px; }
        .totals-row { display: flex; justify-content: space-between; align-items: baseline; font-size: 0.875rem; }
        .totals-label { color: var(--color-text-muted); }
        .totals-val { font-weight: 500; color: var(--color-text); }
        .totals-val.free { color: oklch(38% 0.14 152); }

        .shipping-nudge {
            font-size: 0.75rem; padding: 9px 12px;
            background: var(--color-accent-surface); color: oklch(35% 0.12 162);
            border-radius: var(--radius-sm);
        }

        .summary-total-row {
            padding: 16px 24px;
            background: var(--color-surface-alt);
            display: flex; justify-content: space-between; align-items: center;
        }
        .total-label { font-size: 0.9375rem; font-weight: 600; color: var(--color-text); }
        .total-val {
            font-family: var(--font-display);
            font-size: 1.625rem; letter-spacing: -0.02em; color: var(--color-text);
        }

        .summary-cta { padding: 20px 24px; }

        .place-order-btn {
            width: 100%; height: 52px;
            background: var(--color-accent); color: #fff; border: none;
            border-radius: var(--radius-md); font-family: var(--font-body);
            font-size: 0.9375rem; font-weight: 700; letter-spacing: 0.01em;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: background 0.15s, transform 0.1s;
        }
        .place-order-btn:hover { background: var(--color-accent-hover); }
        .place-order-btn:active { transform: scale(0.98); }

        .summary-trust {
            display: flex; justify-content: center; gap: 20px; margin-top: 14px;
        }
        .trust-item { display: flex; align-items: center; gap: 5px; font-size: 0.75rem; color: var(--color-text-subtle); }

        .edit-cart-link {
            display: block; text-align: center; margin-top: 12px;
            font-size: 0.8125rem; color: var(--color-text-subtle);
            text-decoration: none; transition: color 0.15s;
        }
        .edit-cart-link:hover { color: var(--color-accent); }

        /* ── FOOTER ── */
        .site-footer { background: var(--color-text); color: oklch(65% 0.010 250); margin-top: 0; }
        .footer-bottom-strip {
            max-width: 1280px; margin: 0 auto; padding: 20px 32px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 16px; font-size: 0.75rem; color: oklch(42% 0.010 250);
        }
        .footer-legal { display: flex; gap: 20px; }
        .footer-legal a { color: oklch(42% 0.010 250); text-decoration: none; transition: color 0.15s; }
        .footer-legal a:hover { color: oklch(70% 0.010 250); }
        .pay-badges { display: flex; gap: 8px; }
        .pay-badge {
            padding: 2px 8px; background: oklch(22% 0.010 250); border: 1px solid oklch(30% 0.010 250);
            border-radius: 4px; font-size: 0.6875rem; font-weight: 600; color: oklch(52% 0.010 250);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .checkout-layout { grid-template-columns: 1fr; }
            .summary-panel { position: static; }
            .checkout-steps { display: none; }
            .mobile-cta { display: block; }
        }
        @media (max-width: 768px) {
            .header-inner { padding: 0 16px; }
            .breadcrumb { padding: 12px 16px; }
            .checkout-layout { padding: 0 16px 48px; }
            .form-grid { grid-template-columns: 1fr; }
            .field.span-2 { grid-column: 1; }
            .footer-bottom-strip { padding: 16px; flex-direction: column; align-items: flex-start; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition: none !important; }
        }
    </style>
</head>
<body>

{{-- ═══ HEADER ═══ --}}
<header class="site-header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">
            <span class="logo-mark">N</span>
            <span class="logo-name">AhmadStore</span>
        </a>

        {{-- Checkout progress --}}
        <div class="checkout-steps">
            <div class="step done">
                <span class="step-num">
                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </span>
                Cart
            </div>
            <div class="step-divider"></div>
            <div class="step active">
                <span class="step-num">2</span>
                Details
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <span class="step-num">3</span>
                Confirmation
            </div>
        </div>

        <div class="header-actions">
            <a href="{{ route('cart.index') }}" class="icon-btn" aria-label="Cart">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
                @php $cartCount = \Cart::getTotalQuantity() @endphp
                @if ($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount > 9 ? '9+' : $cartCount }}</span>
                @endif
            </a>
        </div>
    </div>
</header>

{{-- ═══ BREADCRUMB ═══ --}}
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('cart.index') }}">Cart</a>
    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
    <span class="breadcrumb-current">Checkout</span>
</nav>

{{-- ═══ MAIN ═══ --}}
<div class="checkout-layout">

    {{-- ── FORM ── --}}
    <div>
        <div class="page-title">
            <h1>Complete your order</h1>
            <p>Fill in your details below and we'll get your order on its way.</p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="error-banner">
                    <strong>Please fix the following:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Contact --}}
            <div class="form-card">
                <div class="form-card-header">
                    <span class="step-badge">1</span>
                    <h2 class="form-card-title">Contact information</h2>
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="name">Full name <span class="req">*</span></label>
                        <input type="text" id="name" name="name" class="input {{ $errors->has('name') ? 'error' : '' }}"
                               value="{{ old('name') }}" placeholder="Jane Smith">
                        @error('name') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email address <span class="req">*</span></label>
                        <input type="email" id="email" name="email" class="input {{ $errors->has('email') ? 'error' : '' }}"
                               value="{{ old('email') }}" placeholder="jane@example.com">
                        @error('email') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone number <span class="req">*</span></label>
                        <input type="tel" id="phone" name="phone" class="input {{ $errors->has('phone') ? 'error' : '' }}"
                               value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                        @error('phone') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label for="city">City <span class="req">*</span></label>
                        <input type="text" id="city" name="city" class="input {{ $errors->has('city') ? 'error' : '' }}"
                               value="{{ old('city') }}" placeholder="New York">
                        @error('city') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Shipping address --}}
            <div class="form-card">
                <div class="form-card-header">
                    <span class="step-badge">2</span>
                    <h2 class="form-card-title">Shipping address</h2>
                </div>

                <div class="field">
                    <label for="address">Street address <span class="req">*</span></label>
                    <textarea id="address" name="address" class="textarea {{ $errors->has('address') ? 'error' : '' }}"
                              rows="3" placeholder="123 Main Street, Apt 4B">{{ old('address') }}</textarea>
                    @error('address') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Payment --}}
            <div class="form-card">
                <div class="form-card-header">
                    <span class="step-badge">3</span>
                    <h2 class="form-card-title">Payment</h2>
                </div>

                <div class="payment-option">
                    <div class="payment-radio"><div class="payment-radio-dot"></div></div>
                    <div>
                        <div class="payment-label">Cash on delivery</div>
                        <div class="payment-sub">Pay when your order arrives</div>
                    </div>
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="margin-left:auto; color: var(--color-accent)">
                        <rect x="2" y="5" width="20" height="14" rx="2"/>
                        <path d="M2 10h20"/>
                    </svg>
                </div>
            </div>

            {{-- Mobile submit --}}
            <div class="mobile-cta">
                <button type="submit" class="place-order-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Place order
                </button>
            </div>

        </form>
    </div>

    {{-- ── ORDER SUMMARY ── --}}
    <div class="summary-panel">
        <div class="summary-card">

            <div class="summary-header">
                <h2 class="summary-title">Order summary</h2>
            </div>

            <div class="summary-items">
                @foreach ($items as $item)
                    <div class="summary-item">
                        <div class="summary-thumb">
                            @if ($item->attributes->image)
                                <img src="{{ Storage::url($item->attributes->image) }}" alt="{{ $item->name }}">
                            @else
                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.75" style="color: var(--color-border-strong)">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <path d="m3 9 4-4 4 4 4-4 4 4"/>
                                </svg>
                            @endif
                            <span class="qty-dot">{{ $item->quantity }}</span>
                        </div>
                        <div class="summary-item-info">
                            <div class="summary-item-name">{{ $item->name }}</div>
                            <div class="summary-item-meta">${{ number_format($item->price, 2) }} each</div>
                        </div>
                        <div class="summary-item-price">${{ number_format($item->getPriceSum(), 2) }}</div>
                    </div>
                @endforeach
            </div>

            <hr class="summary-divider">

            <div class="summary-totals">
                <div class="totals-row">
                    <span class="totals-label">Subtotal</span>
                    <span class="totals-val">${{ number_format($total, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span class="totals-label">Shipping</span>
                    @if ($total >= 50)
                        <span class="totals-val free">Free</span>
                    @else
                        <span class="totals-val">$5.99</span>
                    @endif
                </div>
                @if ($total < 50)
                    <div class="shipping-nudge">
                        Add <strong>${{ number_format(50 - $total, 2) }}</strong> more for free shipping
                    </div>
                @endif
            </div>

            <hr class="summary-divider">

            <div class="summary-total-row">
                <span class="total-label">Total</span>
                <span class="total-val">${{ number_format($total + ($total < 50 ? 5.99 : 0), 2) }}</span>
            </div>

            <div class="summary-cta">
                <button type="submit" form="checkout-form" class="place-order-btn">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Place order
                </button>

                <div class="summary-trust">
                    <div class="trust-item">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--color-accent)">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        SSL secure
                    </div>
                    <div class="trust-item">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--color-accent)">
                            <polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                        </svg>
                        Free returns
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="edit-cart-link">
                    ← Edit cart
                </a>
            </div>

        </div>
    </div>

</div>

{{-- ═══ FOOTER (minimal) ═══ --}}
<footer class="site-footer">
    <div class="footer-bottom-strip">
        <div class="logo">
            <span class="logo-mark">N</span>
            <span class="logo-name" style="color:#fff; font-size:1rem;">AhmadStore</span>
        </div>
        <div class="footer-legal">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Security</a>
        </div>
        <div class="pay-badges">
            @foreach (['VISA', 'MC', 'PayPal', 'AMEX'] as $p)
                <span class="pay-badge">{{ $p }}</span>
            @endforeach
        </div>
    </div>
</footer>

</body>
</html>
