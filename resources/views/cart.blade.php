<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart — {{ config('app.name', 'AhmadStore') }}</title>
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
            --color-danger:         oklch(52% 0.19 25);
            --color-danger-surface: oklch(96% 0.05 25);

            --font-display: 'Gloock', Georgia, serif;
            --font-body:    'Epilogue', system-ui, sans-serif;
            --radius-sm: 6px; --radius-md: 10px; --radius-lg: 16px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--color-bg);
            color: var(--color-text);
            font-family: var(--font-body);
            font-size: 1rem; line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── HEADER ── */
        .site-header {
            position: sticky; top: 0; z-index: 100;
            background: var(--color-bg);
            border-bottom: 1px solid var(--color-border);
        }
        .header-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 0 32px; height: 64px;
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
        .header-nav { display: flex; align-items: center; gap: 4px; margin: 0 auto; }
        .header-nav a {
            padding: 6px 16px; font-size: 0.875rem; font-weight: 500;
            color: var(--color-text-muted); text-decoration: none;
            border-radius: var(--radius-sm); transition: color 0.15s, background 0.15s;
        }
        .header-nav a:hover { color: var(--color-text); background: var(--color-surface-alt); }
        .header-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .search-form { position: relative; }
        .search-input {
            width: 220px; height: 36px; padding: 0 16px 0 36px;
            background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: 999px;
            font-family: var(--font-body); font-size: 0.8125rem; color: var(--color-text);
            outline: none; transition: border-color 0.15s;
        }
        .search-input::placeholder { color: var(--color-text-subtle); }
        .search-input:focus { border-color: var(--color-accent); }
        .search-icon {
            position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
            color: var(--color-text-subtle); pointer-events: none;
        }
        .icon-btn {
            width: 36px; height: 36px; border: none; background: transparent;
            border-radius: var(--radius-sm); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted); transition: color 0.15s, background 0.15s;
            position: relative; text-decoration: none;
        }
        .icon-btn:hover { color: var(--color-text); background: var(--color-surface-alt); }
        .icon-btn.active { color: var(--color-accent); background: var(--color-accent-surface); }
        .cart-badge {
            position: absolute; top: 4px; right: 4px;
            width: 16px; height: 16px; background: var(--color-accent); color: #fff;
            font-size: 0.6rem; font-weight: 700; border-radius: 999px;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px; padding: 0 24px; height: 36px;
            background: var(--color-accent); color: #fff; border: none; border-radius: 999px;
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: background 0.15s;
        }
        .btn-primary:hover { background: var(--color-accent-hover); }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            max-width: 1280px; margin: 0 auto; padding: 16px 32px;
            display: flex; align-items: center; gap: 8px;
            font-size: 0.8125rem; color: var(--color-text-subtle);
        }
        .breadcrumb a { color: var(--color-text-muted); text-decoration: none; transition: color 0.15s; }
        .breadcrumb a:hover { color: var(--color-accent); }
        .breadcrumb-current { color: var(--color-text); font-weight: 500; }

        /* ── CART LAYOUT ── */
        .cart-wrapper {
            max-width: 1280px; margin: 0 auto;
            padding: 0 32px 80px;
        }

        .cart-page-header {
            display: flex; align-items: baseline; justify-content: space-between;
            margin-bottom: 32px;
        }
        .cart-title {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            letter-spacing: -0.02em; color: var(--color-text);
        }
        .cart-count {
            font-family: var(--font-body);
            font-size: 0.9375rem; font-weight: 400;
            color: var(--color-text-muted); margin-left: 8px;
        }
        .clear-btn {
            font-size: 0.8125rem; font-weight: 500;
            color: var(--color-text-subtle); background: none; border: none;
            cursor: pointer; text-decoration: none;
            transition: color 0.15s;
        }
        .clear-btn:hover { color: var(--color-danger); }

        .cart-columns {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 48px;
            align-items: start;
        }

        /* ── TOAST ── */
        .toast {
            display: flex; align-items: center; gap: 10px;
            background: oklch(96% 0.06 152); border: 1px solid oklch(84% 0.10 152);
            color: oklch(30% 0.10 152); font-size: 0.875rem; font-weight: 500;
            padding: 12px 16px; border-radius: var(--radius-md); margin-bottom: 24px;
        }

        /* ── ITEM LIST ── */
        .item-list { display: flex; flex-direction: column; gap: 1px; }

        .cart-item {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            padding: 20px 24px;
            display: grid;
            grid-template-columns: 88px 1fr auto auto;
            gap: 20px;
            align-items: center;
            transition: background 0.15s;
        }
        .cart-item:hover { background: var(--color-surface-alt); }

        /* first and last radius */
        .item-list > .cart-item:not(:last-child) { margin-bottom: 8px; }

        .item-thumb {
            width: 88px; height: 88px;
            background: var(--color-bg);
            border-radius: var(--radius-md);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; text-decoration: none;
        }
        .item-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .item-thumb svg { color: var(--color-border-strong); }

        .item-meta { min-width: 0; }
        .item-cat {
            font-size: 0.6875rem; font-weight: 600;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--color-accent); margin-bottom: 4px;
        }
        .item-name {
            font-size: 0.9375rem; font-weight: 600; color: var(--color-text);
            text-decoration: none; line-height: 1.4;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            transition: color 0.15s;
        }
        .item-name:hover { color: var(--color-accent); }
        .item-unit {
            font-size: 0.8125rem; color: var(--color-text-subtle); margin-top: 4px;
        }

        /* qty stepper */
        .qty-stepper {
            display: flex; align-items: center;
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm); overflow: hidden;
            flex-shrink: 0;
        }
        .qty-btn {
            width: 36px; height: 36px; border: none; background: transparent;
            cursor: pointer; font-size: 1rem; color: var(--color-text-muted);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.12s, color 0.12s;
        }
        .qty-btn:hover { background: var(--color-surface-alt); color: var(--color-text); }
        .qty-input {
            width: 40px; height: 36px; text-align: center;
            border: none;
            border-left: 1.5px solid var(--color-border);
            border-right: 1.5px solid var(--color-border);
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 600;
            color: var(--color-text); background: var(--color-bg); outline: none;
            -moz-appearance: textfield;
        }
        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }

        /* price + remove */
        .item-right {
            display: flex; flex-direction: column;
            align-items: flex-end; gap: 12px; flex-shrink: 0;
        }
        .item-subtotal {
            font-family: var(--font-display);
            font-size: 1.0625rem; color: var(--color-text);
            letter-spacing: -0.01em;
        }
        .remove-btn {
            width: 32px; height: 32px; border: none;
            background: transparent; border-radius: var(--radius-sm);
            cursor: pointer; color: var(--color-text-subtle);
            display: flex; align-items: center; justify-content: center;
            transition: color 0.15s, background 0.15s;
        }
        .remove-btn:hover { color: var(--color-danger); background: var(--color-danger-surface); }

        .continue-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.875rem; font-weight: 500;
            color: var(--color-text-muted); text-decoration: none;
            margin-top: 24px; transition: color 0.15s;
        }
        .continue-link:hover { color: var(--color-accent); }

        /* ── ORDER SUMMARY ── */
        .summary-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            padding: 28px;
            position: sticky; top: 80px;
        }
        .summary-title {
            font-family: var(--font-display);
            font-size: 1.25rem; letter-spacing: -0.02em;
            color: var(--color-text); margin-bottom: 24px;
        }

        .summary-lines { display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px; }
        .summary-line {
            display: flex; justify-content: space-between; align-items: baseline;
            font-size: 0.875rem;
        }
        .summary-line-label { color: var(--color-text-muted); flex: 1; padding-right: 12px; }
        .summary-line-name {
            font-size: 0.875rem; color: var(--color-text-muted);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 160px;
        }
        .summary-line-qty { color: var(--color-text-subtle); margin-left: 4px; }
        .summary-line-val { font-weight: 500; color: var(--color-text); flex-shrink: 0; }

        .summary-divider { border: none; border-top: 1px solid var(--color-border); margin: 16px 0; }

        .summary-shipping-note {
            font-size: 0.75rem; padding: 10px 12px;
            background: var(--color-accent-surface);
            color: oklch(35% 0.12 162);
            border-radius: var(--radius-sm); margin-top: 8px;
        }

        .summary-total {
            display: flex; justify-content: space-between; align-items: baseline;
            margin-bottom: 24px;
        }
        .summary-total-label { font-size: 0.875rem; font-weight: 600; color: var(--color-text); }
        .summary-total-val {
            font-family: var(--font-display);
            font-size: 1.5rem; color: var(--color-text); letter-spacing: -0.02em;
        }

        .checkout-btn {
            width: 100%; height: 52px;
            background: var(--color-accent); color: #fff; border: none;
            border-radius: var(--radius-md);
            font-family: var(--font-body); font-size: 0.9375rem; font-weight: 700;
            cursor: pointer; letter-spacing: 0.01em;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            text-decoration: none; transition: background 0.15s, transform 0.1s;
        }
        .checkout-btn:hover { background: var(--color-accent-hover); }
        .checkout-btn:active { transform: scale(0.98); }

        .summary-trust {
            display: flex; justify-content: center; gap: 20px;
            margin-top: 16px;
        }
        .trust-item {
            display: flex; align-items: center; gap: 5px;
            font-size: 0.75rem; color: var(--color-text-subtle);
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 96px 32px;
        }
        .empty-icon {
            width: 72px; height: 72px;
            background: var(--color-accent-surface);
            border-radius: var(--radius-lg);
            display: flex; align-items: center; justify-content: center;
            color: var(--color-accent);
            margin: 0 auto 24px;
        }
        .empty-state h2 {
            font-family: var(--font-display);
            font-size: 1.75rem; letter-spacing: -0.02em;
            color: var(--color-text); margin-bottom: 8px;
        }
        .empty-state p { font-size: 0.9375rem; color: var(--color-text-muted); max-width: 36ch; margin: 0 auto 32px; }

        .btn-go-shop {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0 28px; height: 48px;
            background: var(--color-accent); color: #fff; border: none;
            border-radius: 999px;
            font-family: var(--font-body); font-size: 0.9375rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: background 0.15s;
        }
        .btn-go-shop:hover { background: var(--color-accent-hover); }

        /* ── FOOTER ── */
        .site-footer { background: var(--color-text); color: oklch(65% 0.010 250); margin-top: 0; }
        .footer-main {
            max-width: 1280px; margin: 0 auto;
            padding: 48px 32px;
            display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 48px;
        }
        .footer-logo .logo-name { color: #fff; }
        .footer-tagline { font-size: 0.875rem; line-height: 1.65; margin-top: 12px; max-width: 34ch; }
        .footer-col-title {
            font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: #fff; margin-bottom: 16px;
        }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-links a { font-size: 0.875rem; color: oklch(60% 0.010 250); text-decoration: none; transition: color 0.15s; }
        .footer-links a:hover { color: #fff; }
        .footer-bottom { border-top: 1px solid oklch(22% 0.010 250); }
        .footer-bottom-inner {
            max-width: 1280px; margin: 0 auto; padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 12px; font-size: 0.75rem; color: oklch(42% 0.010 250);
        }
        .footer-legal { display: flex; gap: 24px; }
        .footer-legal a { color: oklch(42% 0.010 250); text-decoration: none; transition: color 0.15s; }
        .footer-legal a:hover { color: oklch(70% 0.010 250); }
        .pay-badge {
            padding: 2px 8px; background: oklch(22% 0.010 250);
            border: 1px solid oklch(30% 0.010 250); border-radius: 4px;
            font-size: 0.6875rem; font-weight: 600; color: oklch(52% 0.010 250); letter-spacing: 0.04em;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .cart-columns { grid-template-columns: 1fr; }
            .summary-card { position: static; }
            .footer-main { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .header-nav { display: none; }
            .header-inner { padding: 0 16px; }
            .cart-wrapper { padding: 0 16px 48px; }
            .breadcrumb { padding: 12px 16px; }
            .cart-item { grid-template-columns: 72px 1fr; gap: 12px; }
            .qty-stepper { display: none; }
            .item-right { flex-direction: row; align-items: center; gap: 12px; }
            .footer-main { grid-template-columns: 1fr; gap: 32px; padding: 40px 16px; }
            .footer-bottom-inner { padding: 16px; flex-direction: column; align-items: flex-start; }
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

        <nav class="header-nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('products.index') }}">Collections</a>
            <a href="{{ route('products.index') }}">Brands</a>
            <a href="{{ route('products.index', ['sort' => 'price_asc']) }}">Sale</a>
        </nav>

        <div class="header-actions">
            <div class="search-form">
                <svg class="search-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" class="search-input" placeholder="Search products…">
            </div>

            <button class="icon-btn" aria-label="Wishlist">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>

            <a href="{{ route('cart.index') }}" class="icon-btn active" aria-label="Cart">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
                @php $cartCount = \Cart::getTotalQuantity() @endphp
                @if ($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount > 9 ? '9+' : $cartCount }}</span>
                @endif
            </a>

            <a href="/admin" class="btn-primary" style="height:36px; font-size:0.8125rem;">Admin</a>
        </div>
    </div>
</header>

{{-- ═══ BREADCRUMB ═══ --}}
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
    <span class="breadcrumb-current">Shopping cart</span>
</nav>

{{-- ═══ MAIN ═══ --}}
<main class="cart-wrapper">

    @if (session('cart_success'))
        <div class="toast">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('cart_success') }}
        </div>
    @endif

    @if ($items->isEmpty())

        {{-- ═══ EMPTY STATE ═══ --}}
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
            </div>
            <h2>Your cart is empty</h2>
            <p>You haven't added anything yet. Browse our products and find something you love.</p>
            <a href="{{ route('home') }}" class="btn-go-shop">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                </svg>
                Continue shopping
            </a>
        </div>

    @else

        {{-- ═══ CART WITH ITEMS ═══ --}}
        <div class="cart-page-header">
            <h1 class="cart-title">
                Your cart
                <span class="cart-count">({{ $items->count() }} {{ $items->count() === 1 ? 'item' : 'items' }})</span>
            </h1>
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear your entire cart?')">
                @csrf @method('DELETE')
                <button type="submit" class="clear-btn">Clear all</button>
            </form>
        </div>

        <div class="cart-columns">

            {{-- ── ITEM LIST ── --}}
            <div>
                <div class="item-list">
                    @foreach ($items as $item)
                        <div class="cart-item">

                            {{-- Thumbnail --}}
                            <a href="{{ route('product.show', $item->attributes->slug) }}" class="item-thumb">
                                @if ($item->attributes->image)
                                    <img src="{{ Storage::url($item->attributes->image) }}" alt="{{ $item->name }}">
                                @else
                                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.75">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <path d="m3 9 4-4 4 4 4-4 4 4"/>
                                    </svg>
                                @endif
                            </a>

                            {{-- Info --}}
                            <div class="item-meta">
                                @if ($item->attributes->category)
                                    <div class="item-cat">{{ $item->attributes->category }}</div>
                                @endif
                                <a href="{{ route('product.show', $item->attributes->slug) }}" class="item-name">
                                    {{ $item->name }}
                                </a>
                                <div class="item-unit">${{ number_format($item->price, 2) }} each</div>
                            </div>

                            {{-- Qty stepper --}}
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" id="qty-form-{{ $item->id }}">
                                @csrf @method('PATCH')
                                <div class="qty-stepper">
                                    <button type="button" class="qty-btn" onclick="stepQty('{{ $item->id }}', -1)">−</button>
                                    <input class="qty-input" type="number" name="quantity"
                                           id="qty-{{ $item->id }}" value="{{ $item->quantity }}"
                                           min="1" max="99"
                                           onchange="document.getElementById('qty-form-{{ $item->id }}').submit()">
                                    <button type="button" class="qty-btn" onclick="stepQty('{{ $item->id }}', 1)">+</button>
                                </div>
                            </form>

                            {{-- Price + remove --}}
                            <div class="item-right">
                                <span class="item-subtotal">${{ number_format($item->getPriceSum(), 2) }}</span>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="remove-btn" aria-label="Remove item">
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                <a href="{{ route('home') }}" class="continue-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                    </svg>
                    Continue shopping
                </a>
            </div>

            {{-- ── ORDER SUMMARY ── --}}
            <div class="summary-card">
                <h2 class="summary-title">Order summary</h2>

                <div class="summary-lines">
                    @foreach ($items as $item)
                        <div class="summary-line">
                            <span class="summary-line-name">
                                {{ Str::limit($item->name, 28) }}
                                <span class="summary-line-qty">× {{ $item->quantity }}</span>
                            </span>
                            <span class="summary-line-val">${{ number_format($item->getPriceSum(), 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <hr class="summary-divider">

                <div class="summary-lines">
                    <div class="summary-line">
                        <span class="summary-line-label">Subtotal</span>
                        <span class="summary-line-val">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-line">
                        <span class="summary-line-label">Shipping</span>
                        @if ($total >= 50)
                            <span class="summary-line-val" style="color: oklch(38% 0.14 152)">Free</span>
                        @else
                            <span class="summary-line-val">${{ number_format(5.99, 2) }}</span>
                        @endif
                    </div>
                </div>

                @if ($total < 50)
                    <div class="summary-shipping-note">
                        Add <strong>${{ number_format(50 - $total, 2) }}</strong> more for free shipping
                    </div>
                @endif

                <hr class="summary-divider">

                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-val">
                        ${{ number_format($total + ($total < 50 ? 5.99 : 0), 2) }}
                    </span>
                </div>

                <a href="{{ route('checkout.index') }}" class="checkout-btn">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    Checkout
                </a>

                <div class="summary-trust">
                    <div class="trust-item">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--color-accent)">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        Secure checkout
                    </div>
                    <div class="trust-item">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--color-accent)">
                            <polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                        </svg>
                        Free returns
                    </div>
                </div>
            </div>

        </div>

    @endif

</main>

{{-- ═══ FOOTER ═══ --}}
<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-logo">
            <div class="logo">
                <span class="logo-mark">N</span>
                <span class="logo-name">AhmadStore</span>
            </div>
            <p class="footer-tagline">Thoughtfully curated products for people who care about quality.</p>
        </div>
        <div>
            <h4 class="footer-col-title">Shop</h4>
            <ul class="footer-links">
                @foreach (['All Products', 'New Arrivals', 'Best Sellers', 'Sale'] as $l)
                    <li><a href="#">{{ $l }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <h4 class="footer-col-title">Support</h4>
            <ul class="footer-links">
                @foreach (['Help Center', 'Track Order', 'Returns', 'Contact Us'] as $l)
                    <li><a href="#">{{ $l }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <span>&copy; {{ date('Y') }} AhmadStore. All rights reserved.</span>
            <div class="footer-legal">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
            <div style="display:flex; gap:8px;">
                @foreach (['VISA', 'MC', 'PayPal', 'AMEX'] as $p)
                    <span class="pay-badge">{{ $p }}</span>
                @endforeach
            </div>
        </div>
    </div>
</footer>

<script>
    function stepQty(rowId, delta) {
        const input = document.getElementById('qty-' + rowId);
        const next  = parseInt(input.value) + delta;
        if (next >= 1 && next <= 99) {
            input.value = next;
            document.getElementById('qty-form-' + rowId).submit();
        }
    }
</script>

</body>
</html>
