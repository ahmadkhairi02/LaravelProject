<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} — {{ config('app.name', 'AhmadStore') }}</title>
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

            --font-display: 'Gloock', Georgia, serif;
            --font-body:    'Epilogue', system-ui, sans-serif;

            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            background: var(--color-bg);
            color: var(--color-text);
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.6;
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
        .logo {
            display: flex; align-items: center; gap: 8px;
            text-decoration: none; flex-shrink: 0;
        }
        .logo-mark {
            width: 32px; height: 32px;
            background: var(--color-accent); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.8rem; font-weight: 700;
            font-family: var(--font-display); letter-spacing: -0.02em;
        }
        .logo-name {
            font-family: var(--font-display);
            font-size: 1.25rem; color: var(--color-text);
            letter-spacing: -0.02em;
        }
        .header-nav {
            display: flex; align-items: center; gap: 4px; margin: 0 auto;
        }
        .header-nav a {
            padding: 6px 16px; font-size: 0.875rem; font-weight: 500;
            color: var(--color-text-muted); text-decoration: none;
            border-radius: var(--radius-sm);
            transition: color 0.15s, background 0.15s;
        }
        .header-nav a:hover { color: var(--color-text); background: var(--color-surface-alt); }
        .header-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .search-form { position: relative; }
        .search-input {
            width: 220px; height: 36px;
            padding: 0 16px 0 36px;
            background: var(--color-surface-alt);
            border: 1px solid var(--color-border); border-radius: 999px;
            font-family: var(--font-body); font-size: 0.8125rem;
            color: var(--color-text); outline: none;
            transition: border-color 0.15s;
        }
        .search-input::placeholder { color: var(--color-text-subtle); }
        .search-input:focus { border-color: var(--color-accent); }
        .search-icon {
            position: absolute; left: 10px; top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-subtle); pointer-events: none;
        }
        .icon-btn {
            width: 36px; height: 36px; border: none; background: transparent;
            border-radius: var(--radius-sm); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted);
            transition: color 0.15s, background 0.15s;
            position: relative; text-decoration: none;
        }
        .icon-btn:hover { color: var(--color-text); background: var(--color-surface-alt); }
        .cart-badge {
            position: absolute; top: 4px; right: 4px;
            width: 16px; height: 16px;
            background: var(--color-accent); color: #fff;
            font-size: 0.6rem; font-weight: 700;
            border-radius: 999px;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0 24px; height: 36px;
            background: var(--color-accent); color: #fff;
            border: none; border-radius: 999px;
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: background 0.15s, transform 0.1s;
        }
        .btn-primary:hover { background: var(--color-accent-hover); }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            max-width: 1280px; margin: 0 auto;
            padding: 16px 32px;
            display: flex; align-items: center; gap: 8px;
            font-size: 0.8125rem; color: var(--color-text-subtle);
        }
        .breadcrumb a { color: var(--color-text-muted); text-decoration: none; transition: color 0.15s; }
        .breadcrumb a:hover { color: var(--color-accent); }
        .breadcrumb svg { flex-shrink: 0; }
        .breadcrumb-current { color: var(--color-text); font-weight: 500; }

        /* ── MAIN PRODUCT LAYOUT ── */
        .product-layout {
            max-width: 1280px; margin: 0 auto;
            padding: 0 32px 64px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: start;
        }

        /* ── IMAGE PANEL ── */
        .image-panel { position: sticky; top: 80px; }

        .main-image-wrap {
            aspect-ratio: 1;
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }

        .main-image-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.4s ease;
            cursor: zoom-in;
        }
        .main-image-wrap:hover img { transform: scale(1.04); }

        .image-placeholder {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 12px; color: var(--color-border-strong);
        }
        .image-placeholder span { font-size: 0.875rem; color: var(--color-text-subtle); }

        .wishlist-float {
            position: absolute; top: 16px; right: 16px;
            width: 40px; height: 40px;
            background: var(--color-bg); border: 1px solid var(--color-border);
            border-radius: 50%; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted);
            transition: color 0.15s, border-color 0.15s, transform 0.15s;
        }
        .wishlist-float:hover {
            color: oklch(52% 0.19 25);
            border-color: oklch(52% 0.19 25);
            transform: scale(1.08);
        }

        /* ── INFO PANEL ── */
        .info-panel { padding-top: 8px; }

        .product-category-tag {
            display: inline-block;
            font-size: 0.6875rem; font-weight: 600;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--color-accent);
            margin-bottom: 12px;
        }

        .product-title {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            line-height: 1.1; letter-spacing: -0.02em;
            color: var(--color-text);
            margin-bottom: 20px;
        }

        .price-row {
            display: flex; align-items: center; gap: 16px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--color-border);
            margin-bottom: 24px;
        }
        .price-main {
            font-family: var(--font-display);
            font-size: 2.25rem; letter-spacing: -0.02em;
            color: var(--color-text);
        }
        .stock-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.75rem; font-weight: 600;
            color: oklch(35% 0.12 152);
            background: oklch(95% 0.06 152);
            padding: 4px 10px; border-radius: 999px;
        }
        .stock-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: oklch(52% 0.16 152);
        }

        .desc-section { margin-bottom: 28px; }
        .desc-label {
            font-size: 0.6875rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--color-text-subtle);
            margin-bottom: 10px;
        }
        .desc-body {
            font-size: 0.9375rem; line-height: 1.75;
            color: var(--color-text-muted);
            max-width: 60ch;
        }
        .desc-empty { font-size: 0.875rem; color: var(--color-text-subtle); font-style: italic; }

        /* Specs grid */
        .specs-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 1px; background: var(--color-border);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 28px;
        }
        .spec-cell {
            background: var(--color-surface);
            padding: 12px 16px;
        }
        .spec-key {
            font-size: 0.6875rem; font-weight: 600;
            letter-spacing: 0.07em; text-transform: uppercase;
            color: var(--color-text-subtle);
            margin-bottom: 3px;
        }
        .spec-val {
            font-size: 0.875rem; font-weight: 600;
            color: var(--color-text);
        }
        .spec-val.green { color: oklch(38% 0.14 152); }

        /* Cart success toast */
        .toast-success {
            display: flex; align-items: center; gap: 10px;
            background: oklch(96% 0.06 152);
            border: 1px solid oklch(84% 0.10 152);
            color: oklch(30% 0.10 152);
            font-size: 0.875rem; font-weight: 500;
            padding: 12px 16px; border-radius: var(--radius-md);
            margin-bottom: 20px;
        }
        .toast-success a {
            margin-left: auto; font-weight: 600;
            color: oklch(38% 0.14 152); text-decoration: none;
            white-space: nowrap;
        }
        .toast-success a:hover { text-decoration: underline; }

        /* Quantity + cart form */
        .cart-form { margin-bottom: 24px; }
        .cart-row {
            display: flex; align-items: center; gap: 12px;
        }
        .qty-stepper {
            display: flex; align-items: center;
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm);
            overflow: hidden; flex-shrink: 0;
        }
        .qty-btn {
            width: 40px; height: 48px; border: none; background: transparent;
            cursor: pointer; font-size: 1.125rem; font-weight: 400;
            color: var(--color-text-muted);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.12s, color 0.12s;
        }
        .qty-btn:hover { background: var(--color-surface-alt); color: var(--color-text); }
        .qty-input {
            width: 48px; height: 48px; text-align: center;
            border: none; border-left: 1.5px solid var(--color-border);
            border-right: 1.5px solid var(--color-border);
            font-family: var(--font-body); font-size: 0.9375rem; font-weight: 600;
            color: var(--color-text); background: var(--color-bg);
            outline: none;
            -moz-appearance: textfield;
        }
        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }

        .add-btn {
            flex: 1; height: 48px;
            background: var(--color-text); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-family: var(--font-body); font-size: 0.9375rem; font-weight: 600;
            cursor: pointer; letter-spacing: 0.01em;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: background 0.15s, transform 0.1s;
        }
        .add-btn:hover { background: var(--color-accent); }
        .add-btn:active { transform: scale(0.98); }

        .buy-btn {
            height: 48px; padding: 0 24px;
            background: transparent;
            border: 1.5px solid var(--color-border-strong);
            border-radius: var(--radius-sm);
            font-family: var(--font-body); font-size: 0.875rem; font-weight: 600;
            color: var(--color-text); cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
            white-space: nowrap;
        }
        .buy-btn:hover { border-color: var(--color-accent); background: var(--color-accent-surface); color: var(--color-accent); }

        /* Trust strip */
        .trust-strip {
            display: flex; flex-wrap: wrap; gap: 20px;
            padding-top: 24px;
            border-top: 1px solid var(--color-border);
        }
        .trust-item {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.8125rem; color: var(--color-text-muted);
        }
        .trust-icon {
            width: 32px; height: 32px; flex-shrink: 0;
            background: var(--color-accent-surface);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            color: var(--color-accent);
        }
        .trust-label { font-weight: 500; color: var(--color-text); display: block; line-height: 1.2; }
        .trust-sub { font-size: 0.75rem; color: var(--color-text-subtle); }

        /* ── RELATED ── */
        .related-section {
            max-width: 1280px; margin: 0 auto;
            padding: 0 32px 80px;
        }
        .related-header {
            display: flex; align-items: baseline; justify-content: space-between;
            margin-bottom: 32px;
        }
        .related-title {
            font-family: var(--font-display);
            font-size: clamp(1.25rem, 2vw, 1.75rem);
            letter-spacing: -0.02em; color: var(--color-text);
        }
        .related-link {
            font-size: 0.875rem; font-weight: 500;
            color: var(--color-accent); text-decoration: none;
            display: inline-flex; align-items: center; gap: 4px;
            transition: gap 0.15s;
        }
        .related-link:hover { gap: 8px; }
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }
        .related-card {
            text-decoration: none; display: flex; flex-direction: column;
            border-radius: var(--radius-lg); overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .related-card:hover { box-shadow: 0 8px 28px oklch(16% 0.014 250 / 0.09); }
        .related-img {
            aspect-ratio: 1; background: var(--color-surface);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            border-radius: var(--radius-lg);
        }
        .related-img img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.3s ease;
        }
        .related-card:hover .related-img img { transform: scale(1.05); }
        .related-info { padding: 12px 4px; }
        .related-cat {
            font-size: 0.6875rem; font-weight: 600;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--color-accent); margin-bottom: 4px;
        }
        .related-name {
            font-size: 0.875rem; font-weight: 500; color: var(--color-text);
            line-height: 1.4; margin-bottom: 6px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .related-price {
            font-family: var(--font-display);
            font-size: 1rem; color: var(--color-text);
        }

        /* ── FOOTER ── */
        .site-footer { background: var(--color-text); color: oklch(65% 0.010 250); }
        .footer-main {
            max-width: 1280px; margin: 0 auto;
            padding: 64px 32px;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px;
        }
        .footer-logo .logo-name { color: #fff; font-size: 1.375rem; }
        .footer-tagline { font-size: 0.875rem; line-height: 1.65; margin-top: 16px; max-width: 34ch; }
        .footer-col-title {
            font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: #fff; margin-bottom: 16px;
        }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .footer-links a { font-size: 0.875rem; color: oklch(65% 0.010 250); text-decoration: none; transition: color 0.15s; }
        .footer-links a:hover { color: #fff; }
        .footer-bottom { border-top: 1px solid oklch(22% 0.010 250); }
        .footer-bottom-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 16px; font-size: 0.75rem; color: oklch(45% 0.010 250);
        }
        .footer-legal { display: flex; gap: 24px; }
        .footer-legal a { color: oklch(45% 0.010 250); text-decoration: none; transition: color 0.15s; }
        .footer-legal a:hover { color: oklch(70% 0.010 250); }
        .pay-badge {
            padding: 2px 8px; background: oklch(22% 0.010 250);
            border: 1px solid oklch(30% 0.010 250);
            border-radius: 4px; font-size: 0.6875rem; font-weight: 600;
            color: oklch(55% 0.010 250); letter-spacing: 0.04em;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .product-layout { grid-template-columns: 1fr; gap: 40px; padding: 0 24px 48px; }
            .image-panel { position: static; }
            .footer-main { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .header-nav { display: none; }
            .header-inner { padding: 0 16px; }
            .breadcrumb { padding: 12px 16px; }
            .product-layout { padding: 0 16px 40px; }
            .related-section { padding: 0 16px 48px; }
            .footer-main { grid-template-columns: 1fr; gap: 32px; padding: 48px 16px; }
            .footer-bottom-inner { padding: 16px; }
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

            <a href="/admin" class="btn-primary" style="height:36px; font-size:0.8125rem;">Admin</a>
        </div>
    </div>
</header>

{{-- ═══ BREADCRUMB ═══ --}}
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
    @if ($product->category)
        <a href="#">{{ $product->category->name }}</a>
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
    @endif
    <span class="breadcrumb-current">{{ Str::limit($product->name, 40) }}</span>
</nav>

{{-- ═══ PRODUCT ═══ --}}
<main class="product-layout">

    {{-- IMAGE --}}
    <div class="image-panel">
        <div class="main-image-wrap">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
            @else
                <div class="image-placeholder">
                    <svg width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.75">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <path d="m3 9 4-4 4 4 4-4 4 4M3 15l4 4 4-4 4 4"/>
                    </svg>
                    <span>No image available</span>
                </div>
            @endif

            <button class="wishlist-float" aria-label="Add to wishlist">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- INFO --}}
    <div class="info-panel">

        @if ($product->category)
            <span class="product-category-tag">{{ $product->category->name }}</span>
        @endif

        <h1 class="product-title">{{ $product->name }}</h1>

        <div class="price-row">
            <span class="price-main">${{ number_format($product->price, 2) }}</span>
            <span class="stock-badge">
                <span class="stock-dot"></span>
                In stock
            </span>
        </div>

        <div class="desc-section">
            <div class="desc-label">Description</div>
            @if ($product->description)
                <div class="desc-body">{!! nl2br(e($product->description)) !!}</div>
            @else
                <p class="desc-empty">No description provided.</p>
            @endif
        </div>

        <div class="specs-grid">
            <div class="spec-cell">
                <div class="spec-key">Category</div>
                <div class="spec-val">{{ $product->category?->name ?? '—' }}</div>
            </div>
            <div class="spec-cell">
                <div class="spec-key">SKU</div>
                <div class="spec-val">{{ strtoupper(Str::limit($product->slug, 10, '')) }}</div>
            </div>
            <div class="spec-cell">
                <div class="spec-key">Availability</div>
                <div class="spec-val green">In Stock</div>
            </div>
            <div class="spec-cell">
                <div class="spec-key">Shipping</div>
                <div class="spec-val">Free over $50</div>
            </div>
        </div>

        @if (session('cart_success'))
            <div class="toast-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('cart_success') }}
                <a href="{{ route('cart.index') }}">View cart →</a>
            </div>
        @endif

        <div class="cart-form">
            <form action="{{ route('cart.add') }}" method="POST" id="cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="cart-row">
                    <div class="qty-stepper">
                        <button type="button" class="qty-btn" id="qty-minus">−</button>
                        <input id="qty-input" class="qty-input" type="number" name="quantity" value="1" min="1" max="99">
                        <button type="button" class="qty-btn" id="qty-plus">+</button>
                    </div>

                    <button type="submit" class="add-btn">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                        </svg>
                        Add to cart
                    </button>

                    <button type="button" class="buy-btn"
                        onclick="document.getElementById('cart-form').submit()">
                        Buy now
                    </button>
                </div>
            </form>
        </div>

        <div class="trust-strip">
            <div class="trust-item">
                <div class="trust-icon">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <div>
                    <span class="trust-label">Secure checkout</span>
                    <span class="trust-sub">SSL encrypted</span>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                    </svg>
                </div>
                <div>
                    <span class="trust-label">Easy returns</span>
                    <span class="trust-sub">30-day policy</span>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </div>
                <div>
                    <span class="trust-label">Fast shipping</span>
                    <span class="trust-sub">Free over $50</span>
                </div>
            </div>
        </div>

    </div>
</main>

{{-- ═══ RELATED PRODUCTS ═══ --}}
@if ($related->isNotEmpty())
<section class="related-section">
    <div class="related-header">
        <h2 class="related-title">More from this category</h2>
        <a href="{{ route('home') }}" class="related-link">
            See all
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
            </svg>
        </a>
    </div>

    <div class="related-grid">
        @foreach ($related as $item)
            <a href="{{ route('product.show', $item->slug) }}" class="related-card">
                <div class="related-img">
                    @if ($item->image)
                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" loading="lazy">
                    @else
                        <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.75" style="color: var(--color-border-strong)">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <path d="m3 9 4-4 4 4 4-4 4 4"/>
                        </svg>
                    @endif
                </div>
                <div class="related-info">
                    @if ($item->category)
                        <div class="related-cat">{{ $item->category->name }}</div>
                    @endif
                    <div class="related-name">{{ $item->name }}</div>
                    <div class="related-price">${{ number_format($item->price, 2) }}</div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- ═══ FOOTER ═══ --}}
<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-logo">
            <div class="logo">
                <span class="logo-mark">N</span>
                <span class="logo-name">AhmadStore</span>
            </div>
            <p class="footer-tagline">Thoughtfully curated products for people who care about quality and the way they live.</p>
        </div>
        <div>
            <h4 class="footer-col-title">Shop</h4>
            <ul class="footer-links">
                @foreach (['All Products', 'New Arrivals', 'Best Sellers', 'Sale', 'Collections'] as $link)
                    <li><a href="#">{{ $link }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <h4 class="footer-col-title">Support</h4>
            <ul class="footer-links">
                @foreach (['Help Center', 'Track Order', 'Returns', 'Shipping Info', 'Contact Us'] as $link)
                    <li><a href="#">{{ $link }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <h4 class="footer-col-title">Legal</h4>
            <ul class="footer-links">
                @foreach (['Privacy Policy', 'Terms of Service', 'Cookie Policy', 'Accessibility'] as $link)
                    <li><a href="#">{{ $link }}</a></li>
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
                <a href="#">Cookies</a>
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
    const input = document.getElementById('qty-input');
    document.getElementById('qty-minus').addEventListener('click', () => {
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    });
    document.getElementById('qty-plus').addEventListener('click', () => {
        if (parseInt(input.value) < 99) input.value = parseInt(input.value) + 1;
    });
</script>

</body>
</html>
