<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Products — {{ config('app.name', 'AhmadStore') }}</title>
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
        .header-nav a:hover, .header-nav a.active { color: var(--color-text); background: var(--color-surface-alt); }
        .header-nav a.active { color: var(--color-accent); background: var(--color-accent-surface); }
        .header-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .search-form { position: relative; }
        .search-input {
            width: 220px; height: 36px; padding: 0 16px 0 36px;
            background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: 999px;
            font-family: var(--font-body); font-size: 0.8125rem; color: var(--color-text);
            outline: none; transition: border-color 0.15s, width 0.2s;
        }
        .search-input::placeholder { color: var(--color-text-subtle); }
        .search-input:focus { border-color: var(--color-accent); width: 260px; }
        .search-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--color-text-subtle); pointer-events: none; }
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

        /* ── PAGE LAYOUT ── */
        .page-layout {
            max-width: 1280px; margin: 0 auto;
            padding: 0 32px 80px;
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 40px;
            align-items: start;
        }

        /* ── SIDEBAR ── */
        .sidebar { position: sticky; top: 80px; display: flex; flex-direction: column; gap: 8px; }

        .filter-group {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .filter-group-header {
            padding: 14px 16px;
            font-size: 0.6875rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--color-text-subtle);
            display: flex; align-items: center; justify-content: space-between;
            cursor: pointer; user-select: none;
        }
        .filter-group-header svg { color: var(--color-text-subtle); transition: transform 0.2s; }
        .filter-group.open .filter-group-header svg { transform: rotate(180deg); }

        .filter-group-body { padding: 4px 8px 12px; display: flex; flex-direction: column; gap: 2px; }
        .filter-group.closed .filter-group-body { display: none; }

        .filter-link {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 8px; border-radius: var(--radius-sm);
            font-size: 0.875rem; color: var(--color-text-muted);
            text-decoration: none; transition: color 0.12s, background 0.12s;
        }
        .filter-link:hover { color: var(--color-text); background: var(--color-surface-alt); }
        .filter-link.active { color: var(--color-accent); background: var(--color-accent-surface); font-weight: 600; }
        .filter-count {
            font-size: 0.6875rem; font-weight: 600;
            padding: 1px 7px; border-radius: 999px;
            background: var(--color-border); color: var(--color-text-subtle);
        }
        .filter-link.active .filter-count { background: var(--color-accent); color: #fff; }

        /* price range */
        .price-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 4px 8px 8px; }
        .price-input {
            height: 36px; padding: 0 10px;
            background: var(--color-bg); border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm); font-family: var(--font-body);
            font-size: 0.8125rem; color: var(--color-text); outline: none;
            transition: border-color 0.15s; width: 100%;
        }
        .price-input:focus { border-color: var(--color-accent); }
        .apply-btn {
            margin: 0 8px 8px;
            width: calc(100% - 16px);
            height: 36px; background: var(--color-accent); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-family: var(--font-body); font-size: 0.8125rem; font-weight: 600;
            cursor: pointer; transition: background 0.15s;
        }
        .apply-btn:hover { background: var(--color-accent-hover); }

        .clear-filters {
            display: block; text-align: center; padding: 10px;
            font-size: 0.8125rem; font-weight: 500;
            color: var(--color-text-muted); text-decoration: none;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--color-border);
            transition: color 0.15s, border-color 0.15s;
        }
        .clear-filters:hover { color: var(--color-accent); border-color: var(--color-accent); }

        /* ── MAIN AREA ── */
        .main-area { min-width: 0; }

        .toolbar {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
        }
        .toolbar-left { display: flex; flex-direction: column; gap: 2px; }
        .toolbar-heading {
            font-family: var(--font-display);
            font-size: 1.5rem; letter-spacing: -0.02em; color: var(--color-text);
        }
        .toolbar-count { font-size: 0.8125rem; color: var(--color-text-muted); }

        .toolbar-right { display: flex; align-items: center; gap: 10px; }
        .sort-select {
            height: 36px; padding: 0 12px;
            background: var(--color-surface); border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm); font-family: var(--font-body);
            font-size: 0.8125rem; color: var(--color-text); cursor: pointer;
            outline: none; transition: border-color 0.15s;
        }
        .sort-select:focus { border-color: var(--color-accent); }

        /* active filters strip */
        .active-filters {
            display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px;
        }
        .filter-tag {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px;
            background: var(--color-accent-surface);
            border: 1.5px solid oklch(85% 0.07 162);
            border-radius: 999px;
            font-size: 0.8125rem; font-weight: 500; color: var(--color-accent);
            text-decoration: none;
        }
        .filter-tag svg { width: 12px; height: 12px; flex-shrink: 0; }
        .filter-tag:hover { background: oklch(90% 0.08 162); }

        /* ── PRODUCT GRID ── */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            display: flex; flex-direction: column;
            border-radius: var(--radius-lg); overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .product-card:hover { box-shadow: 0 8px 32px oklch(16% 0.014 250 / 0.09); }

        .product-image-wrap {
            position: relative; aspect-ratio: 1;
            background: var(--color-surface); border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .product-image-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.35s ease;
        }
        .product-card:hover .product-image-wrap img { transform: scale(1.04); }
        .product-placeholder { color: var(--color-border-strong); }

        .product-overlay {
            position: absolute; inset: 0;
            display: flex; align-items: flex-end; justify-content: center;
            padding: 12px; opacity: 0; transition: opacity 0.2s;
        }
        .product-card:hover .product-overlay { opacity: 1; }

        .wishlist-btn {
            position: absolute; top: 10px; right: 10px;
            width: 32px; height: 32px; background: var(--color-bg);
            border: none; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted); cursor: pointer;
            opacity: 0; transition: opacity 0.2s, color 0.15s, transform 0.15s;
        }
        .product-card:hover .wishlist-btn { opacity: 1; }
        .wishlist-btn:hover { color: oklch(52% 0.19 25); transform: scale(1.1); }

        .add-cart-btn {
            width: calc(100% - 24px); height: 40px;
            background: var(--color-text); color: #fff; border: none;
            border-radius: 999px; font-family: var(--font-body);
            font-size: 0.8125rem; font-weight: 600;
            cursor: pointer; transition: background 0.15s, transform 0.1s;
            letter-spacing: 0.01em;
        }
        .add-cart-btn:hover { background: var(--color-accent); }
        .add-cart-btn:active { transform: scale(0.97); }

        .product-info { padding: 12px 4px 4px; }
        .product-cat {
            font-size: 0.6875rem; font-weight: 600;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--color-accent); margin-bottom: 4px;
        }
        .product-name {
            font-size: 0.9375rem; font-weight: 500; color: var(--color-text);
            line-height: 1.4; margin-bottom: 8px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .product-name a { text-decoration: none; color: inherit; }
        .product-name a:hover { color: var(--color-accent); }
        .product-footer { display: flex; align-items: center; justify-content: space-between; }
        .product-price { font-family: var(--font-display); font-size: 1rem; color: var(--color-text); }
        .product-brand { font-size: 0.75rem; color: var(--color-text-subtle); }

        /* ── EMPTY STATE ── */
        .empty-state {
            grid-column: 1 / -1; text-align: center; padding: 80px 32px;
        }
        .empty-icon {
            width: 64px; height: 64px; background: var(--color-accent-surface);
            border-radius: var(--radius-lg); color: var(--color-accent);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
        }
        .empty-state h3 {
            font-family: var(--font-display); font-size: 1.5rem; color: var(--color-text); margin-bottom: 8px;
        }
        .empty-state p { font-size: 0.9375rem; color: var(--color-text-muted); margin-bottom: 24px; }

        /* ── PAGINATION ── */
        .pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 40px; flex-wrap: wrap; gap: 12px;
        }
        .pagination-info { font-size: 0.875rem; color: var(--color-text-muted); }
        .pagination-links { display: flex; align-items: center; gap: 4px; }
        .page-btn {
            width: 36px; height: 36px; border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.875rem; font-weight: 500; text-decoration: none;
            color: var(--color-text-muted);
            border: 1.5px solid var(--color-border);
            transition: all 0.15s;
        }
        .page-btn:hover { border-color: var(--color-accent); color: var(--color-accent); background: var(--color-accent-surface); }
        .page-btn.active { background: var(--color-accent); border-color: var(--color-accent); color: #fff; font-weight: 700; }
        .page-btn.disabled { opacity: 0.4; pointer-events: none; }
        .page-ellipsis { width: 36px; text-align: center; color: var(--color-text-subtle); font-size: 0.875rem; }

        /* ── FOOTER ── */
        .site-footer { background: var(--color-text); color: oklch(65% 0.010 250); }
        .footer-main {
            max-width: 1280px; margin: 0 auto; padding: 56px 32px;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px;
        }
        .footer-logo .logo-name { color: #fff; font-size: 1.375rem; }
        .footer-tagline { font-size: 0.875rem; line-height: 1.65; margin-top: 16px; max-width: 34ch; }
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
            padding: 2px 8px; background: oklch(22% 0.010 250); border: 1px solid oklch(30% 0.010 250);
            border-radius: 4px; font-size: 0.6875rem; font-weight: 600; color: oklch(52% 0.010 250);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .page-layout { grid-template-columns: 200px 1fr; gap: 24px; }
        }
        @media (max-width: 768px) {
            .header-nav { display: none; }
            .header-inner, .breadcrumb { padding-left: 16px; padding-right: 16px; }
            .page-layout { grid-template-columns: 1fr; padding: 0 16px 48px; }
            .sidebar { position: static; flex-direction: row; flex-wrap: wrap; gap: 8px; }
            .filter-group { flex: 1; min-width: 140px; }
            .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; padding: 40px 16px; }
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
            <a href="{{ route('products.index') }}" class="active">Products</a>
            <a href="{{ route('products.index') }}">Collections</a>
            <a href="{{ route('products.index') }}">Brands</a>
            <a href="{{ route('products.index', ['sort' => 'price_asc']) }}">Sale</a>
        </nav>

        <div class="header-actions">
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                <svg class="search-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" name="q" class="search-input" placeholder="Search products…" value="{{ request('q') }}">
            </form>

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
    <span class="breadcrumb-current">
        @if($activeCategory)
            {{ $categories->firstWhere('slug', $activeCategory)?->name ?? 'Products' }}
        @else
            All products
        @endif
    </span>
</nav>

{{-- ═══ LAYOUT ═══ --}}
<div class="page-layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">

        {{-- Categories --}}
        <div class="filter-group open" id="fg-categories">
            <div class="filter-group-header" onclick="toggleGroup('fg-categories')">
                Categories
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 15l-6-6-6 6"/></svg>
            </div>
            <div class="filter-group-body">
                <a href="{{ route('products.index', array_filter(['sort' => request('sort'), 'q' => request('q')])) }}"
                   class="filter-link {{ !$activeCategory ? 'active' : '' }}">
                    All categories
                    <span class="filter-count">{{ $products->total() }}</span>
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('products.index', array_filter(['category' => $cat->slug, 'sort' => request('sort'), 'q' => request('q')])) }}"
                       class="filter-link {{ $activeCategory === $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                        <span class="filter-count">{{ $cat->products_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Brands --}}
        @if ($brands->isNotEmpty())
        <div class="filter-group open" id="fg-brands">
            <div class="filter-group-header" onclick="toggleGroup('fg-brands')">
                Brands
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 15l-6-6-6 6"/></svg>
            </div>
            <div class="filter-group-body">
                @foreach ($brands as $brand)
                    <a href="{{ route('products.index', array_filter(['brand' => $brand->slug, 'category' => request('category'), 'sort' => request('sort'), 'q' => request('q')])) }}"
                       class="filter-link {{ request('brand') === $brand->slug ? 'active' : '' }}">
                        {{ $brand->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Price range --}}
        <div class="filter-group open" id="fg-price">
            <div class="filter-group-header" onclick="toggleGroup('fg-price')">
                Price range
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 15l-6-6-6 6"/></svg>
            </div>
            <form action="{{ route('products.index') }}" method="GET">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort'))     <input type="hidden" name="sort"     value="{{ request('sort') }}"> @endif
                @if(request('q'))        <input type="hidden" name="q"        value="{{ request('q') }}"> @endif
                <div class="price-inputs">
                    <input type="number" name="min_price" class="price-input" placeholder="Min $"
                           value="{{ request('min_price') }}" min="0">
                    <input type="number" name="max_price" class="price-input" placeholder="Max $"
                           value="{{ request('max_price') }}" min="0">
                </div>
                <button type="submit" class="apply-btn">Apply</button>
            </form>
        </div>

        {{-- Clear filters --}}
        @if(request()->hasAny(['category','brand','min_price','max_price','q']))
            <a href="{{ route('products.index') }}" class="clear-filters">
                Clear all filters
            </a>
        @endif

    </aside>

    {{-- ── MAIN ── --}}
    <div class="main-area">

        {{-- Toolbar --}}
        <div class="toolbar">
            <div class="toolbar-left">
                <h1 class="toolbar-heading">
                    @if(request('q'))
                        Results for "{{ request('q') }}"
                    @elseif($activeCategory)
                        {{ $categories->firstWhere('slug', $activeCategory)?->name ?? 'Products' }}
                    @else
                        All products
                    @endif
                </h1>
                <span class="toolbar-count">{{ $products->total() }} {{ Str::plural('product', $products->total()) }}</span>
            </div>

            <div class="toolbar-right">
                <form action="{{ route('products.index') }}" method="GET" id="sort-form">
                    @if(request('category'))  <input type="hidden" name="category"  value="{{ request('category') }}"> @endif
                    @if(request('brand'))     <input type="hidden" name="brand"     value="{{ request('brand') }}"> @endif
                    @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
                    @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
                    @if(request('q'))         <input type="hidden" name="q"         value="{{ request('q') }}"> @endif
                    <select name="sort" class="sort-select" onchange="document.getElementById('sort-form').submit()">
                        <option value="latest"     {{ request('sort','latest') === 'latest'     ? 'selected' : '' }}>Newest first</option>
                        <option value="price_asc"  {{ request('sort') === 'price_asc'           ? 'selected' : '' }}>Price: low → high</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc'          ? 'selected' : '' }}>Price: high → low</option>
                        <option value="name_asc"   {{ request('sort') === 'name_asc'            ? 'selected' : '' }}>Name A–Z</option>
                    </select>
                </form>
            </div>
        </div>

        {{-- Active filter tags --}}
        @php
            $hasFilters = request()->hasAny(['category','brand','min_price','max_price','q']);
        @endphp
        @if($hasFilters)
        <div class="active-filters">
            @if(request('q'))
                <a href="{{ route('products.index', array_filter(['category' => request('category'), 'brand' => request('brand'), 'min_price' => request('min_price'), 'max_price' => request('max_price'), 'sort' => request('sort')])) }}" class="filter-tag">
                    "{{ request('q') }}"
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </a>
            @endif
            @if(request('category'))
                <a href="{{ route('products.index', array_filter(['brand' => request('brand'), 'min_price' => request('min_price'), 'max_price' => request('max_price'), 'sort' => request('sort'), 'q' => request('q')])) }}" class="filter-tag">
                    {{ $categories->firstWhere('slug', request('category'))?->name }}
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </a>
            @endif
            @if(request('brand'))
                <a href="{{ route('products.index', array_filter(['category' => request('category'), 'min_price' => request('min_price'), 'max_price' => request('max_price'), 'sort' => request('sort'), 'q' => request('q')])) }}" class="filter-tag">
                    {{ $brands->firstWhere('slug', request('brand'))?->name }}
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </a>
            @endif
            @if(request('min_price') || request('max_price'))
                <a href="{{ route('products.index', array_filter(['category' => request('category'), 'brand' => request('brand'), 'sort' => request('sort'), 'q' => request('q')])) }}" class="filter-tag">
                    ${{ request('min_price', '0') }} – ${{ request('max_price', '∞') }}
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </a>
            @endif
        </div>
        @endif

        {{-- Grid --}}
        <div class="products-grid">
            @forelse ($products as $product)
                <article class="product-card">
                    <div class="product-image-wrap">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <div class="product-placeholder">
                                <svg width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.75">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <path d="m3 9 4-4 4 4 4-4 4 4M3 15l4 4 4-4 4 4"/>
                                </svg>
                            </div>
                        @endif

                        <button class="wishlist-btn" aria-label="Wishlist">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </button>

                        <div class="product-overlay">
                            <form action="{{ route('cart.add') }}" method="POST" style="width:100%">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-cart-btn">Add to cart</button>
                            </form>
                        </div>
                    </div>

                    <div class="product-info">
                        @if ($product->category)
                            <div class="product-cat">{{ $product->category->name }}</div>
                        @endif
                        <h3 class="product-name">
                            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                        </h3>
                        <div class="product-footer">
                            <span class="product-price">${{ number_format($product->price, 2) }}</span>
                            @if ($product->brand)
                                <span class="product-brand">{{ $product->brand->name }}</span>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <h3>No products found</h3>
                    <p>Try adjusting your filters or search term.</p>
                    <a href="{{ route('products.index') }}" class="btn-primary">Clear filters</a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
        <div class="pagination-wrap">
            <span class="pagination-info">
                Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
            </span>
            <div class="pagination-links">
                {{-- Prev --}}
                @if ($products->onFirstPage())
                    <span class="page-btn disabled">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 19l-7-7 7-7"/></svg>
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="page-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 19l-7-7 7-7"/></svg>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if ($page === 1 || $page === $products->lastPage() || abs($page - $products->currentPage()) <= 1)
                        <a href="{{ $url }}" class="page-btn {{ $page === $products->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @elseif ($page === 2 || $page === $products->lastPage() - 1)
                        <span class="page-ellipsis">…</span>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="page-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <span class="page-btn disabled">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                    </span>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

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
        <div>
            <h4 class="footer-col-title">Legal</h4>
            <ul class="footer-links">
                @foreach (['Privacy Policy', 'Terms of Service', 'Cookie Policy'] as $l)
                    <li><a href="#">{{ $l }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <span>&copy; {{ date('Y') }} AhmadStore. All rights reserved.</span>
            <div class="footer-legal">
                <a href="#">Privacy</a><a href="#">Terms</a><a href="#">Cookies</a>
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
    function toggleGroup(id) {
        const el = document.getElementById(id);
        el.classList.toggle('open');
        el.classList.toggle('closed');
    }
</script>

</body>
</html>
