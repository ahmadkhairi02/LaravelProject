<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AhmadStore') }}</title>
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

            --space-1: 4px;
            --space-2: 8px;
            --space-3: 12px;
            --space-4: 16px;
            --space-6: 24px;
            --space-8: 32px;
            --space-12: 48px;
            --space-16: 64px;
            --space-24: 96px;

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

        /* ─── HEADER ─── */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--color-bg);
            border-bottom: 1px solid var(--color-border);
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--space-8);
            height: 64px;
            display: flex;
            align-items: center;
            gap: var(--space-8);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo-mark {
            width: 32px;
            height: 32px;
            background: var(--color-accent);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: var(--font-display);
            letter-spacing: -0.02em;
        }

        .logo-name {
            font-family: var(--font-display);
            font-size: 1.25rem;
            color: var(--color-text);
            letter-spacing: -0.02em;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: var(--space-1);
            margin: 0 auto;
        }

        .header-nav a {
            padding: var(--space-2) var(--space-4);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-text-muted);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: color 0.15s, background 0.15s;
        }

        .header-nav a:hover,
        .header-nav a.active {
            color: var(--color-text);
            background: var(--color-surface-alt);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            flex-shrink: 0;
        }

        .search-form {
            position: relative;
        }

        .search-input {
            width: 220px;
            height: 36px;
            padding: 0 var(--space-4) 0 36px;
            background: var(--color-surface-alt);
            border: 1px solid var(--color-border);
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: 0.8125rem;
            color: var(--color-text);
            outline: none;
            transition: border-color 0.15s, width 0.2s;
        }

        .search-input::placeholder { color: var(--color-text-subtle); }
        .search-input:focus { border-color: var(--color-accent); width: 260px; }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-subtle);
            pointer-events: none;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-text-muted);
            transition: color 0.15s, background 0.15s;
            position: relative;
            text-decoration: none;
        }

        .icon-btn:hover { color: var(--color-text); background: var(--color-surface-alt); }

        .cart-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 16px;
            height: 16px;
            background: var(--color-accent);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: 0 var(--space-6);
            height: 36px;
            background: var(--color-accent);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s, transform 0.1s;
        }
        .btn-primary:hover { background: var(--color-accent-hover); }
        .btn-primary:active { transform: scale(0.97); }

        /* ─── HERO ─── */
        .hero {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-24) var(--space-8);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-16);
            align-items: center;
            min-height: 520px;
        }

        .hero-content { max-width: 560px; }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--color-accent);
            margin-bottom: var(--space-6);
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 24px;
            height: 2px;
            background: var(--color-accent);
        }

        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 4rem);
            line-height: 1.08;
            letter-spacing: -0.02em;
            color: var(--color-text);
            margin-bottom: var(--space-6);
        }

        .hero-title em {
            font-style: italic;
            color: var(--color-accent);
        }

        .hero-body {
            font-size: 1.0625rem;
            line-height: 1.7;
            color: var(--color-text-muted);
            max-width: 45ch;
            margin-bottom: var(--space-8);
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: 0 var(--space-6);
            height: 44px;
            background: transparent;
            color: var(--color-text);
            border: 1.5px solid var(--color-border-strong);
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.15s, background 0.15s;
        }
        .btn-ghost:hover { border-color: var(--color-accent); background: var(--color-accent-surface); color: var(--color-accent); }

        .btn-lg { height: 48px; padding: 0 var(--space-8); font-size: 0.9375rem; }

        /* Hero visual — product collage */
        .hero-visual {
            position: relative;
            height: 440px;
        }

        .hero-card {
            position: absolute;
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: 0 4px 24px oklch(16% 0.014 250 / 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px oklch(16% 0.014 250 / 0.12);
        }

        .hero-card-a {
            top: 0; left: 20px;
            width: 200px; height: 240px;
        }

        .hero-card-b {
            top: 60px; right: 0;
            width: 180px; height: 200px;
        }

        .hero-card-c {
            bottom: 0; left: 60px;
            width: 220px; height: 160px;
        }

        .hero-card-img {
            width: 100%; height: 65%;
            object-fit: cover;
            background: var(--color-surface-alt);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-card-img svg { color: var(--color-border-strong); }

        .hero-card-info {
            padding: var(--space-3) var(--space-4);
        }

        .hero-card-label {
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--color-accent);
            margin-bottom: 2px;
        }

        .hero-card-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--color-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hero-card-price {
            font-size: 0.8125rem;
            color: var(--color-text-muted);
            margin-top: 2px;
        }

        .hero-badge {
            position: absolute;
            background: var(--color-accent);
            color: #fff;
            font-size: 0.6875rem;
            font-weight: 700;
            padding: var(--space-1) var(--space-3);
            border-radius: 999px;
            top: -8px; right: -8px;
        }

        /* ─── STATS STRIP ─── */
        .stats-strip {
            background: var(--color-text);
        }

        .stats-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-6) var(--space-8);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-8);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-family: var(--font-display);
            font-size: 1.75rem;
            color: #fff;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: oklch(75% 0.012 250);
        }

        /* ─── CATEGORIES ─── */
        .section {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-16) var(--space-8);
        }

        .section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: var(--space-8);
        }

        .section-title {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            letter-spacing: -0.02em;
            color: var(--color-text);
        }

        .section-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-accent);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            transition: gap 0.15s;
        }

        .section-link:hover { gap: var(--space-2); }

        .categories-scroll {
            display: flex;
            gap: var(--space-3);
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: var(--space-2);
        }

        .categories-scroll::-webkit-scrollbar { display: none; }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-6);
            background: var(--color-surface);
            border: 1.5px solid var(--color-border);
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-text-muted);
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.15s;
            text-decoration: none;
        }

        .category-pill:hover,
        .category-pill.active {
            border-color: var(--color-accent);
            color: var(--color-accent);
            background: var(--color-accent-surface);
        }

        .category-pill .count {
            font-size: 0.6875rem;
            font-weight: 600;
            background: var(--color-border);
            color: var(--color-text-subtle);
            padding: 0 6px;
            border-radius: 999px;
            line-height: 1.8;
        }

        .category-pill.active .count,
        .category-pill:hover .count {
            background: var(--color-accent);
            color: #fff;
        }

        /* ─── PRODUCT GRID ─── */
        .products-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-6);
        }

        .products-count {
            font-size: 0.875rem;
            color: var(--color-text-muted);
        }

        .products-count strong { color: var(--color-text); }

        .sort-select {
            height: 36px;
            padding: 0 var(--space-4);
            background: var(--color-surface);
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: 0.8125rem;
            color: var(--color-text);
            cursor: pointer;
            outline: none;
            transition: border-color 0.15s;
        }

        .sort-select:focus { border-color: var(--color-accent); }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: var(--space-6);
        }

        /* ─── PRODUCT CARD ─── */
        .product-card {
            background: var(--color-bg);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s;
        }

        .product-card:hover {
            box-shadow: 0 8px 32px oklch(16% 0.014 250 / 0.09);
        }

        .product-card:hover .product-image-wrap { background: var(--color-surface-alt); }

        .product-image-wrap {
            position: relative;
            aspect-ratio: 1;
            background: var(--color-surface);
            overflow: hidden;
            border-radius: var(--radius-lg);
            transition: background 0.2s;
        }

        .product-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s ease;
        }

        .product-card:hover .product-image-wrap img { transform: scale(1.04); }

        .product-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-border-strong);
        }

        .product-actions-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: var(--space-4);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .product-card:hover .product-actions-overlay { opacity: 1; }

        .product-wishlist {
            position: absolute;
            top: var(--space-3);
            right: var(--space-3);
            width: 32px;
            height: 32px;
            background: var(--color-bg);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--color-text-muted);
            transition: color 0.15s, transform 0.15s;
            opacity: 0;
        }

        .product-card:hover .product-wishlist { opacity: 1; }
        .product-wishlist:hover { color: oklch(55% 0.19 25); transform: scale(1.1); }

        .product-add-btn {
            width: calc(100% - var(--space-6));
            height: 40px;
            background: var(--color-text);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            letter-spacing: 0.02em;
        }

        .product-add-btn:hover { background: var(--color-accent); }
        .product-add-btn:active { transform: scale(0.97); }

        .product-info {
            padding: var(--space-4) var(--space-1);
        }

        .product-category {
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--color-accent);
            margin-bottom: var(--space-1);
        }

        .product-name {
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--color-text);
            line-height: 1.4;
            margin-bottom: var(--space-2);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-name a { text-decoration: none; color: inherit; }
        .product-name a:hover { color: var(--color-accent); }

        .product-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 1.0625rem;
            color: var(--color-text);
            letter-spacing: -0.01em;
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: var(--space-24) var(--space-8);
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            background: var(--color-accent-surface);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-accent);
            margin: 0 auto var(--space-6);
        }

        .empty-state h3 {
            font-family: var(--font-display);
            font-size: 1.5rem;
            color: var(--color-text);
            margin-bottom: var(--space-2);
        }

        .empty-state p {
            font-size: 0.9375rem;
            color: var(--color-text-muted);
            max-width: 40ch;
            margin: 0 auto var(--space-6);
        }

        /* ─── FEATURES ─── */
        .features {
            background: var(--color-surface);
            border-top: 1px solid var(--color-border);
            border-bottom: 1px solid var(--color-border);
        }

        .features-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-12) var(--space-8);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-8);
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: var(--space-4);
        }

        .feature-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            background: var(--color-accent-surface);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-accent);
        }

        .feature-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 2px;
        }

        .feature-desc {
            font-size: 0.8125rem;
            color: var(--color-text-muted);
            line-height: 1.5;
        }

        /* ─── ALERT ─── */
        .alert-success {
            max-width: 1280px;
            margin: var(--space-6) auto 0;
            padding: 0 var(--space-8);
        }

        .alert-success-inner {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            background: oklch(96% 0.06 152);
            border: 1px solid oklch(84% 0.10 152);
            color: oklch(30% 0.10 152);
            padding: var(--space-4) var(--space-6);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* ─── FOOTER ─── */
        .site-footer {
            background: var(--color-text);
            color: oklch(72% 0.010 250);
            margin-top: var(--space-16);
        }

        .footer-main {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-16) var(--space-8);
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: var(--space-12);
        }

        .footer-brand .logo-name { color: #fff; font-size: 1.375rem; }
        .footer-brand .logo-mark { background: var(--color-accent); }

        .footer-tagline {
            font-size: 0.875rem;
            line-height: 1.65;
            margin-top: var(--space-4);
            max-width: 34ch;
        }

        .footer-social {
            display: flex;
            gap: var(--space-2);
            margin-top: var(--space-6);
        }

        .social-btn {
            width: 36px;
            height: 36px;
            background: oklch(25% 0.010 250);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: oklch(60% 0.010 250);
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }

        .social-btn:hover { background: var(--color-accent); color: #fff; }

        .footer-col-title {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: var(--space-4);
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .footer-links a {
            font-size: 0.875rem;
            color: oklch(65% 0.010 250);
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-links a:hover { color: #fff; }

        .footer-newsletter p {
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: var(--space-4);
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }

        .newsletter-input {
            height: 40px;
            padding: 0 var(--space-4);
            background: oklch(22% 0.010 250);
            border: 1px solid oklch(30% 0.010 250);
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: 0.8125rem;
            color: #fff;
            outline: none;
            transition: border-color 0.15s;
        }

        .newsletter-input::placeholder { color: oklch(45% 0.010 250); }
        .newsletter-input:focus { border-color: var(--color-accent); }

        .newsletter-btn {
            height: 40px;
            background: var(--color-accent);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        .newsletter-btn:hover { background: var(--color-accent-hover); }

        .footer-bottom {
            border-top: 1px solid oklch(22% 0.010 250);
        }

        .footer-bottom-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-4) var(--space-8);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: var(--space-4);
            font-size: 0.75rem;
        }

        .footer-legal {
            display: flex;
            gap: var(--space-6);
        }

        .footer-legal a {
            color: oklch(50% 0.010 250);
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-legal a:hover { color: oklch(75% 0.010 250); }

        .payment-badges {
            display: flex;
            gap: var(--space-2);
        }

        .pay-badge {
            padding: 2px 8px;
            background: oklch(22% 0.010 250);
            border: 1px solid oklch(30% 0.010 250);
            border-radius: 4px;
            font-size: 0.6875rem;
            font-weight: 600;
            color: oklch(60% 0.010 250);
            letter-spacing: 0.04em;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .hero { grid-template-columns: 1fr; min-height: auto; padding: var(--space-16) var(--space-6); }
            .hero-visual { display: none; }
            .hero-content { max-width: 100%; }
            .footer-main { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .header-nav { display: none; }
            .search-input { width: 160px; }
            .stats-inner { grid-template-columns: repeat(2, 1fr); }
            .footer-main { grid-template-columns: 1fr; gap: var(--space-8); }
            .footer-bottom-inner { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 480px) {
            .hero-title { font-size: 2rem; }
            .section { padding: var(--space-12) var(--space-4); }
            .hero { padding: var(--space-12) var(--space-4); }
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero-eyebrow { animation: fadeUp 0.5s ease both; }
        .hero-title   { animation: fadeUp 0.5s 0.1s ease both; }
        .hero-body    { animation: fadeUp 0.5s 0.2s ease both; }
        .hero-actions { animation: fadeUp 0.5s 0.3s ease both; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════════ --}}
{{-- HEADER                                          --}}
{{-- ═══════════════════════════════════════════════ --}}
<header class="site-header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">
            <span class="logo-mark">N</span>
            <span class="logo-name">AhmadStore</span>
        </a>

        <nav class="header-nav">
            <a href="{{ route('home') }}" class="active">Home</a>
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

            <a href="/admin" class="btn-primary" style="height:36px; font-size:0.8125rem;">
                Admin
            </a>
        </div>
    </div>
</header>

{{-- ═══════════════════════════════════════════════ --}}
{{-- ORDER SUCCESS ALERT                             --}}
{{-- ═══════════════════════════════════════════════ --}}
@if (session('order_success'))
<div class="alert-success">
    <div class="alert-success-inner">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('order_success') }}
    </div>
</div>
@endif

{{-- ═══════════════════════════════════════════════ --}}
{{-- HERO                                            --}}
{{-- ═══════════════════════════════════════════════ --}}
<section>
    <div class="hero">
        <div class="hero-content">
            <span class="hero-eyebrow">New arrivals · Spring 2025</span>

            <h1 class="hero-title">
                Discover<br>
                what you<br>
                <em>truly love</em>
            </h1>

            <p class="hero-body">
                Thoughtfully curated products for the way you live. Quality without compromise, delivered to your door.
            </p>

            <div class="hero-actions">
                <a href="#products" class="btn-primary btn-lg">
                    Shop now
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
                <a href="{{ route('products.index') }}" class="btn-ghost btn-lg">View collections</a>
            </div>
        </div>

        <div class="hero-visual" aria-hidden="true">
            {{-- Floating product cards --}}
            @php $heroProducts = $products->take(3); @endphp

            <div class="hero-card hero-card-a" style="animation: fadeUp 0.6s 0.2s ease both; opacity:0;">
                <div class="hero-card-img">
                    @if ($heroProducts->get(0)?->image)
                        <img src="{{ Storage::url($heroProducts->get(0)->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 9 4-4 4 4 4-4 4 4"/>
                        </svg>
                    @endif
                </div>
                <div class="hero-card-info">
                    <div class="hero-card-label">{{ $heroProducts->get(0)?->category?->name ?? 'Featured' }}</div>
                    <div class="hero-card-name">{{ $heroProducts->get(0)?->name ?? 'Premium Product' }}</div>
                    <div class="hero-card-price">${{ number_format($heroProducts->get(0)?->price ?? 0, 2) }}</div>
                </div>
            </div>

            <div class="hero-card hero-card-b" style="animation: fadeUp 0.6s 0.35s ease both; opacity:0;">
                <div class="hero-card-img">
                    @if ($heroProducts->get(1)?->image)
                        <img src="{{ Storage::url($heroProducts->get(1)->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>
                        </svg>
                    @endif
                </div>
                <div class="hero-card-info">
                    <div class="hero-card-label">{{ $heroProducts->get(1)?->category?->name ?? 'Trending' }}</div>
                    <div class="hero-card-name">{{ $heroProducts->get(1)?->name ?? 'Top Seller' }}</div>
                    <div class="hero-card-price">${{ number_format($heroProducts->get(1)?->price ?? 0, 2) }}</div>
                </div>
                <span class="hero-badge">NEW</span>
            </div>

            <div class="hero-card hero-card-c" style="animation: fadeUp 0.6s 0.5s ease both; opacity:0;">
                <div class="hero-card-img" style="height:60%">
                    @if ($heroProducts->get(2)?->image)
                        <img src="{{ Storage::url($heroProducts->get(2)->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        </svg>
                    @endif
                </div>
                <div class="hero-card-info">
                    <div class="hero-card-label">{{ $heroProducts->get(2)?->category?->name ?? 'Essentials' }}</div>
                    <div class="hero-card-name">{{ $heroProducts->get(2)?->name ?? 'Must Have' }}</div>
                </div>
            </div>

            {{-- Decorative dots --}}
            <div style="position:absolute;bottom:20px;right:20px;display:flex;gap:6px;align-items:flex-end;">
                <div style="width:8px;height:8px;background:var(--color-accent);border-radius:50%;opacity:0.4;"></div>
                <div style="width:10px;height:10px;background:var(--color-accent);border-radius:50%;opacity:0.65;"></div>
                <div style="width:8px;height:8px;background:var(--color-accent);border-radius:50%;opacity:0.4;"></div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════ --}}
{{-- STATS                                           --}}
{{-- ═══════════════════════════════════════════════ --}}
<div class="stats-strip">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-value">50K+</div>
            <div class="stat-label">Happy customers</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">4.9★</div>
            <div class="stat-label">Average rating</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">99%</div>
            <div class="stat-label">Satisfaction rate</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">24/7</div>
            <div class="stat-label">Customer support</div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════ --}}
{{-- PRODUCTS                                        --}}
{{-- ═══════════════════════════════════════════════ --}}
<div id="products" class="section">

    <div class="section-header">
        <h2 class="section-title">All products</h2>
        <a href="{{ route('products.index') }}" class="section-link">
            View all
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
            </svg>
        </a>
    </div>

    {{-- Category pills --}}
    <div class="categories-scroll" style="margin-bottom:var(--space-8);">
        <a href="{{ route('products.index') }}" class="category-pill active">
            All
            <span class="count">{{ $products->count() }}</span>
        </a>
        @foreach ($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="category-pill">
                {{ $cat->name }}
                <span class="count">{{ $cat->products_count }}</span>
            </a>
        @endforeach
    </div>

    {{-- Toolbar --}}
    <div class="products-toolbar">
        <p class="products-count">Showing <strong>{{ $products->count() }}</strong> {{ Str::plural('product', $products->count()) }}</p>
        <select class="sort-select">
            <option>Sort: Featured</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
            <option>Newest First</option>
        </select>
    </div>

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
                                <path d="M3 9l4-4 4 4 4-4 4 4M3 15l4 4 4-4 4 4"/>
                            </svg>
                        </div>
                    @endif

                    <button class="product-wishlist" aria-label="Add to wishlist">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </button>

                    <div class="product-actions-overlay">
                        <form action="{{ route('cart.add') }}" method="POST" style="width:calc(100% - 24px)">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="product-add-btn">Add to cart</button>
                        </form>
                    </div>
                </div>

                <div class="product-info">
                    @if ($product->category)
                        <div class="product-category">{{ $product->category->name }}</div>
                    @endif

                    <h3 class="product-name">
                        <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                    </h3>

                    <div class="product-meta">
                        <span class="product-price">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                    </svg>
                </div>
                <h3>No products yet</h3>
                <p>Your store is empty. Head to the admin panel to add your first products.</p>
                <a href="/admin/products/create" class="btn-primary">Add a product</a>
            </div>
        @endforelse
    </div>
</div>

{{-- ═══════════════════════════════════════════════ --}}
{{-- FEATURES                                        --}}
{{-- ═══════════════════════════════════════════════ --}}
<div class="features">
    <div class="features-inner">
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </div>
            <div>
                <div class="feature-title">Free shipping</div>
                <div class="feature-desc">On all orders over $50. Fast and reliable delivery.</div>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                </svg>
            </div>
            <div>
                <div class="feature-title">Easy returns</div>
                <div class="feature-desc">30-day hassle-free return policy. No questions asked.</div>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <div>
                <div class="feature-title">Secure checkout</div>
                <div class="feature-desc">256-bit SSL encryption on every transaction.</div>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.17 12a19.79 19.79 0 0 1-3-8.59A2 2 0 0 1 3.09 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 16.92z"/>
                </svg>
            </div>
            <div>
                <div class="feature-title">24/7 support</div>
                <div class="feature-desc">Our team is always here when you need help.</div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════ --}}
{{-- FOOTER                                          --}}
{{-- ═══════════════════════════════════════════════ --}}
<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-brand">
            <div class="logo">
                <span class="logo-mark">N</span>
                <span class="logo-name">AhmadStore</span>
            </div>
            <p class="footer-tagline">
                Thoughtfully curated products for people who care about quality and the way they live.
            </p>
            <div class="footer-social">
                <a href="#" class="social-btn" aria-label="Facebook">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                <a href="#" class="social-btn" aria-label="Twitter">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                    </svg>
                </a>
                <a href="#" class="social-btn" aria-label="Instagram">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </a>
            </div>
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

        <div class="footer-newsletter">
            <h4 class="footer-col-title">Stay in the loop</h4>
            <p>Get early access to new arrivals, exclusive offers, and style inspiration.</p>
            <div class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="your@email.com">
                <button class="newsletter-btn">Subscribe</button>
            </div>
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
            <div class="payment-badges">
                @foreach (['VISA', 'MC', 'PayPal', 'AMEX'] as $p)
                    <span class="pay-badge">{{ $p }}</span>
                @endforeach
            </div>
        </div>
    </div>
</footer>

</body>
</html>
