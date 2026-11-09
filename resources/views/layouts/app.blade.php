<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Google Fonts: Inter sebagai substitusi open-source resmi untuk FerrariSans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ==========================================================================
           FERRARI DESIGN SYSTEM TOKENS (DESIGN.md)
           ========================================================================== */
        :root {
            /* Colors - Brand & Accent */
            --color-primary: #da291c;
            --color-primary-active: #b01e0a;
            --color-primary-hover: #9d2211;

            /* Colors - Surface & Canvas */
            --color-canvas: #181818;
            --color-canvas-elevated: #303030;
            --color-canvas-light: #ffffff;
            --color-surface-card: #303030;
            --color-surface-soft-light: #f7f7f7;
            --color-surface-strong-light: #ebebeb;

            /* Colors - Hairlines */
            --color-hairline: #303030;
            --color-hairline-on-light: #d2d2d2;
            --color-hairline-soft: #ebebeb;

            /* Colors - Text */
            --color-ink: #ffffff;
            --color-body: #969696;
            --color-body-strong: #ffffff;
            --color-body-on-light: #181818;
            --color-muted: #666666;
            --color-muted-soft: #8f8f8f;
            --color-on-primary: #ffffff;

            /* Colors - Semantic */
            --color-semantic-info: #4c98b9;
            --color-semantic-success: #03904a;
            --color-semantic-warning: #f13a2c;

            /* Typography Family */
            --font-sans: 'FerrariSans', 'Inter', -apple-system, BlinkMacSystemFont, system-ui, sans-serif;

            /* Spacing Ladder (8px Base System) */
            --space-xxxs: 4px;
            --space-xxs: 8px;
            --space-xs: 16px;
            --space-sm: 24px;
            --space-md: 32px;
            --space-lg: 48px;
            --space-xl: 64px;
            --space-xxl: 96px;
            --space-super: 128px;

            /* Border Radius Scale */
            --rounded-none: 0px;
            --rounded-xs: 2px;
            --rounded-sm: 4px;
            --rounded-md: 8px;
            --rounded-lg: 12px;
            --rounded-full: 9999px;
        }

        /* ==========================================================================
           BASE & RESET
           ========================================================================== */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background-color: var(--color-canvas);
            color: var(--color-body);
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            color: var(--color-ink);
            text-decoration: none;
            transition: color 0.15s ease, border-color 0.15s ease, background-color 0.15s ease;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* ==========================================================================
           TYPOGRAPHY HIERARCHY
           ========================================================================== */
        .display-mega {
            font-size: 80px;
            font-weight: 500;
            line-height: 1.05;
            letter-spacing: -1.6px;
            color: var(--color-ink);
            margin: 0;
        }

        .display-xl {
            font-size: 56px;
            font-weight: 500;
            line-height: 1.1;
            letter-spacing: -1.12px;
            color: var(--color-ink);
            margin: 0;
        }

        .display-lg {
            font-size: 36px;
            font-weight: 500;
            line-height: 1.2;
            letter-spacing: -0.36px;
            color: var(--color-ink);
            margin: 0;
        }

        .display-md {
            font-size: 26px;
            font-weight: 500;
            line-height: 1.5;
            letter-spacing: 0.195px;
            color: var(--color-ink);
            margin: 0;
        }

        .title-md {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: 0;
            color: var(--color-ink);
            margin: 0;
        }

        .title-sm {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.4;
            letter-spacing: 0.08px;
            color: var(--color-ink);
            margin: 0;
        }

        .caption-uppercase {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            display: inline-block;
        }

        .number-display {
            font-size: 64px;
            font-weight: 700;
            line-height: 1.0;
            letter-spacing: -1.6px;
            color: var(--color-ink);
        }

        .number-display--rosso {
            color: var(--color-primary);
        }

        /* ==========================================================================
           TOP NAVIGATION (top-nav-on-dark)
           ========================================================================== */
        .top-nav {
            background-color: var(--color-canvas);
            color: var(--color-ink);
            height: 64px;
            border-bottom: 1px solid var(--color-hairline);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-nav__container {
            max-width: 1280px;
            height: 100%;
            margin: 0 auto;
            padding: 0 var(--space-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .top-nav__brand {
            display: flex;
            align-items: center;
            gap: var(--space-xs);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.65px;
            text-transform: uppercase;
            color: var(--color-ink);
        }

        .brand-shield {
            width: 12px;
            height: 24px;
            background-color: var(--color-primary);
            display: inline-block;
        }

        .top-nav__links {
            display: flex;
            align-items: center;
            gap: var(--space-md);
        }

        .top-nav__link {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 0.65px;
            text-transform: uppercase;
            color: var(--color-body);
            padding: var(--space-xs) 0;
        }

        .top-nav__link--active {
            color: var(--color-ink);
        }

        /* ==========================================================================
           HERO BAND CINEMA (hero-band-cinema)
           ========================================================================== */
        .hero-cinema {
            position: relative;
            background-color: var(--color-canvas);
            border-bottom: 1px solid var(--color-hairline);
            overflow: hidden;
        }

        .hero-cinema__backdrop {
            position: relative;
            min-height: 440px;
            display: flex;
            align-items: flex-end;
            background:
                linear-gradient(180deg, rgba(24, 24, 24, 0.25) 0%, rgba(24, 24, 24, 0.85) 65%, #181818 100%),
                radial-gradient(circle at 80% 20%, rgba(218, 41, 28, 0.22), transparent 50%),
                url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat;
        }

        .hero-cinema__content {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: var(--space-xxl) var(--space-md) var(--space-lg);
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: var(--space-lg);
        }

        .hero-cinema__headline-group {
            max-width: 720px;
        }

        .hero-cinema__subtitle {
            margin-top: var(--space-xs);
            font-size: 16px;
            color: var(--color-body);
            max-width: 540px;
        }

        /* ==========================================================================
           LAYOUT & CONTAINERS
           ========================================================================== */
        main {
            flex: 1;
            width: 100%;
        }

        .editorial-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-xl) var(--space-md);
        }

        .editorial-band {
            margin-bottom: var(--space-xxl);
            scroll-margin-top: 80px;
        }

        .editorial-band:last-child {
            margin-bottom: 0;
        }

        .band-header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: var(--space-sm);
            padding-bottom: var(--space-sm);
            margin-bottom: var(--space-lg);
            border-bottom: 1px solid var(--color-hairline);
        }

        .band-header__eyebrow {
            color: var(--color-body);
            margin-bottom: var(--space-xxs);
            display: block;
        }

        /* ==========================================================================
           COMPONENTS: BADGES, SPEC CELLS, BUTTONS
           ========================================================================== */
        .badge-pill {
            background-color: var(--color-canvas-elevated);
            color: var(--color-ink);
            font-size: 11px;
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            border-radius: var(--rounded-full);
            padding: 4px 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-pill__dot {
            width: 6px;
            height: 6px;
            border-radius: var(--rounded-full);
            background-color: var(--color-primary);
        }

        /* Spec Cells */
        .spec-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: var(--space-lg);
            padding: var(--space-md) 0;
            border-bottom: 1px solid var(--color-hairline);
            margin-bottom: var(--space-xl);
        }

        .spec-cell {
            padding: var(--space-xs) 0;
        }

        .spec-cell__label {
            color: var(--color-body);
            margin-top: var(--space-xxs);
            display: block;
        }

        /* Buttons (Sharp 0px corners per DESIGN.md) */
        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-on-primary);
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.0;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            border: 0;
            border-radius: var(--rounded-none);
            padding: 14px 32px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-xs);
            cursor: pointer;
        }

        .btn-primary:active {
            background-color: var(--color-primary-active);
        }

        .btn-outline-dark {
            background-color: transparent;
            color: var(--color-ink);
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.0;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            border: 1px solid var(--color-ink);
            border-radius: var(--rounded-none);
            padding: 13px 31px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-xs);
            cursor: pointer;
        }

        .btn-tertiary {
            background-color: transparent;
            color: var(--color-ink);
            font-size: 13px;
            font-weight: 700;
            line-height: 1.0;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: var(--space-xxs);
            padding: var(--space-xxs) 0;
            border-bottom: 1px solid var(--color-primary);
        }

        /* ==========================================================================
           EQUIPMENT GRID (feature-card-photo & driver-card style)
           ========================================================================== */
        .equipment-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-sm);
        }

        .equipment-card {
            background-color: var(--color-canvas);
            border: 1px solid var(--color-hairline);
            border-radius: var(--rounded-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .equipment-card__media {
            background-color: var(--color-surface-card);
            aspect-ratio: 4 / 3;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-md);
            position: relative;
            border-bottom: 1px solid var(--color-hairline);
        }

        .equipment-card__index {
            position: absolute;
            top: var(--space-xs);
            left: var(--space-xs);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.1px;
            color: var(--color-body);
        }

        .equipment-thumb {
            width: 100%;
            height: 100%;
            max-height: 140px;
            object-fit: contain;
        }

        .equipment-card__body {
            padding: var(--space-sm);
            display: flex;
            flex-direction: column;
            gap: var(--space-xs);
            flex: 1;
        }

        .equipment-card__meta {
            color: var(--color-muted);
        }

        .equipment-card__footer {
            padding: 0 var(--space-sm) var(--space-sm);
        }

        .equipment-card__footer .btn-outline-dark,
        .equipment-card__footer .btn-primary {
            width: 100%;
            border-radius: var(--rounded-sm);
        }

        /* ==========================================================================
           RACE CALENDAR ROW (Riwayat Peminjaman)
           ========================================================================== */
        .race-calendar-list {
            border-top: 1px solid var(--color-hairline);
        }

        .race-calendar-row {
            display: grid;
            grid-template-columns: 72px 1.2fr 1.5fr auto;
            align-items: center;
            gap: var(--space-md);
            padding: var(--space-sm) 0;
            border-bottom: 1px solid var(--color-hairline);
        }

        .race-position-num {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.0;
            letter-spacing: -0.5px;
            color: var(--color-primary);
        }

        .race-row__group {
            color: var(--color-ink);
            font-size: 18px;
            font-weight: 700;
        }

        .race-row__equipment {
            color: var(--color-body);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: var(--space-xs);
        }

        .race-row__qty {
            text-align: right;
            font-size: 16px;
            font-weight: 700;
            color: var(--color-ink);
        }

        /* ==========================================================================
           FORM PEMINJAMAN (2-up Hero Split & text-input-on-dark)
           ========================================================================== */
        .form-split-layout {
            display: grid;
            grid-template-columns: 5fr 7fr;
            gap: var(--space-xl);
            align-items: start;
        }

        .driver-showcase-card {
            background-color: var(--color-surface-card);
            border: 1px solid var(--color-hairline);
            border-radius: var(--rounded-none);
            padding: var(--space-lg);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .driver-showcase-card__badge {
            align-self: flex-start;
            margin-bottom: var(--space-md);
        }

        .equipment-image-large {
            width: 100%;
            max-width: 240px;
            height: 240px;
            object-fit: contain;
            margin: var(--space-sm) 0 var(--space-lg);
        }

        .driver-showcase-card__footer {
            width: 100%;
            padding-top: var(--space-sm);
            border-top: 1px solid var(--color-canvas);
            display: flex;
            justify-content: space-between;
            color: var(--color-body);
        }

        .form-panel {
            background-color: var(--color-canvas);
            border: 1px solid var(--color-hairline);
            padding: var(--space-lg);
        }

        .form-group {
            margin-bottom: var(--space-md);
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            color: var(--color-ink);
            margin-bottom: var(--space-xxs);
        }

        .text-input-dark {
            display: block;
            width: 100%;
            height: 48px;
            padding: 14px 16px;
            background-color: var(--color-canvas);
            color: var(--color-ink);
            font-family: var(--font-sans);
            font-size: 14px;
            border: 1px solid var(--color-hairline);
            border-radius: var(--rounded-sm);
            outline: none;
        }

        .text-input-dark::placeholder {
            color: var(--color-muted);
        }

        .text-input-dark:focus {
            border-color: var(--color-ink);
        }

        .form-actions {
            margin-top: var(--space-lg);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: var(--space-sm);
        }

        /* ==========================================================================
           ALERTS & EMPTY STATES
           ========================================================================== */
        .alert-banner {
            padding: var(--space-sm) var(--space-md);
            margin-bottom: var(--space-lg);
            border-left: 4px solid var(--color-semantic-success);
            background-color: var(--color-canvas-elevated);
            color: var(--color-ink);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .error-message {
            color: var(--color-semantic-warning);
            font-size: 12px;
            margin-top: var(--space-xxs);
            margin-bottom: 0;
            font-weight: 500;
        }

        .empty-state {
            background-color: var(--color-canvas-elevated);
            padding: var(--space-lg);
            text-align: center;
            color: var(--color-body);
            border-radius: var(--rounded-none);
        }

        /* ==========================================================================
           FOOTER (footer-dark)
           ========================================================================== */
        .footer-dark {
            background-color: var(--color-canvas);
            color: var(--color-body);
            border-top: 1px solid var(--color-hairline);
            padding: var(--space-xl) var(--space-md);
            font-size: 13px;
        }

        .footer-dark__container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: var(--space-sm);
        }

        /* ==========================================================================
           RESPONSIVE BREAKPOINTS (DESIGN.md Specs)
           ========================================================================== */
        @media (max-width: 1024px) {
            .display-mega { font-size: 56px; }
            .equipment-list { grid-template-columns: repeat(2, 1fr); }
            .form-split-layout { grid-template-columns: 1fr; gap: var(--space-lg); }
        }

        @media (max-width: 640px) {
            .display-mega { font-size: 32px; letter-spacing: -0.5px; }
            .display-xl { font-size: 32px; }
            .display-lg { font-size: 26px; }
            .number-display { font-size: 48px; }
            .editorial-container { padding: var(--space-lg) var(--space-xs); }
            .top-nav__container { padding: 0 var(--space-xs); }
            .hero-cinema__content { padding: var(--space-xl) var(--space-xs) var(--space-md); }
            .equipment-list { grid-template-columns: 1fr; }
            .race-calendar-row {
                grid-template-columns: 48px 1fr;
                gap: var(--space-xs);
            }
            .race-row__equipment { grid-column: 2; }
            .race-row__qty { grid-column: 2; text-align: left; }
            .form-panel { padding: var(--space-sm); }
        }
    </style>
</head>
<body>
    <!-- Top Navigation on Dark -->
    <header class="top-nav">
        <div class="top-nav__container">
            <a href="{{ route('borrowing.index') }}" class="top-nav__brand">
                <span class="brand-shield"></span>
                <span>Posko Perlengkapan Domestic Backpacker</span>
            </a>

            <nav class="top-nav__links">
                <a href="{{ route('borrowing.index') }}#katalog-alat" class="top-nav__link top-nav__link--active">Inventaris</a>
            </nav>
        </div>
    </header>

    @yield('hero')

    <main>
        <div class="editorial-container">
            @yield('content')
        </div>
    </main>

    <footer class="footer-dark">
        <div class="footer-dark__container">
            <span>&copy; {{ date('Y') }} Posko Perlengkapan Domestic Backpacker &mdash; Official Race Logistics System</span>
            <span class="caption-uppercase" style="color: var(--color-muted);">Rosso Corsa Telemetry Edition</span>
        </div>
    </footer>
</body>
</html>
