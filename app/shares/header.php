<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Store – Cửa hàng Trái cây tươi sạch</title>
    <meta name="description" content="Hệ thống quản lý cửa hàng trái cây tươi sạch, chất lượng cao. Theo dõi kho hàng, danh mục và đơn hàng hiệu quả.">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* =====================================================
           GLOBAL DESIGN SYSTEM – FRUIT STORE PREMIUM
        ===================================================== */
        :root {
            --primary:        #00d084;
            --primary-dark:   #00a86b;
            --primary-glow:   rgba(0, 208, 132, 0.25);
            --accent:         #fbbf24;
            --accent-glow:    rgba(251, 191, 36, 0.3);
            --danger:         #f87171;
            --danger-dark:    #dc2626;
            --info:           #38bdf8;

            --bg-base:        #060d0a;
            --bg-surface:     #0d1f16;
            --bg-card:        #111f18;
            --bg-glass:       rgba(13, 31, 22, 0.75);
            --bg-glass-lite:  rgba(255, 255, 255, 0.04);

            --border-glass:   rgba(0, 208, 132, 0.12);
            --border-card:    rgba(0, 208, 132, 0.08);

            --text-primary:   #e8f5f0;
            --text-secondary: #8fb8a4;
            --text-muted:     #4d7a63;

            --shadow-card:    0 4px 24px rgba(0,0,0,0.45);
            --shadow-glow:    0 0 30px rgba(0,208,132,0.12);
            --shadow-hover:   0 12px 40px rgba(0,0,0,0.55), 0 0 0 1px rgba(0,208,132,0.15);

            --radius-card:    16px;
            --radius-pill:    999px;
            --radius-sm:      10px;

            --font-main:      'Inter', system-ui, sans-serif;
            --font-heading:   'Space Grotesk', 'Inter', sans-serif;

            --transition:     all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ── Reset & Base ── */
        *, *::before, *::after { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Animated mesh background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(0,208,132,0.06) 0%, transparent 55%),
                radial-gradient(ellipse 60% 50% at 80% 85%, rgba(0,168,107,0.05) 0%, transparent 50%),
                radial-gradient(ellipse 40% 40% at 55% 45%, rgba(251,191,36,0.03) 0%, transparent 40%);
            pointer-events: none;
            z-index: 0;
        }

        .content-wrapper {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        /* ── Typography ── */
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            color: var(--text-primary);
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-surface); }
        ::-webkit-scrollbar-thumb { background: rgba(0,208,132,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* ─────────────────────────────────────────
           NAVBAR
        ───────────────────────────────────────── */
        .navbar-custom {
            background: rgba(6, 13, 10, 0.92);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border-glass);
            box-shadow: 0 2px 30px rgba(0,0,0,0.5), 0 1px 0 rgba(0,208,132,0.08);
            padding: 0.65rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-brand {
            font-family: var(--font-heading);
            font-weight: 800 !important;
            font-size: 1.35rem;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }
        .navbar-brand .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), #00ff9d);
            border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 15px var(--primary-glow);
            flex-shrink: 0;
        }
        .navbar-brand:hover {
            color: #39e75f !important;
            filter: drop-shadow(0 0 12px rgba(0,208,132,0.4));
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.88rem;
            color: var(--text-secondary) !important;
            padding: 0.45rem 0.85rem !important;
            border-radius: var(--radius-pill);
            transition: var(--transition);
            letter-spacing: 0.01em;
            display: flex; align-items: center; gap: 5px;
        }
        .nav-link:hover {
            color: var(--text-primary) !important;
            background: var(--bg-glass-lite);
        }
        .nav-item.active .nav-link,
        .nav-link.active {
            color: var(--primary) !important;
            background: var(--primary-glow);
        }

        /* Cart badge */
        .nav-cart-badge {
            background: var(--accent);
            color: #000;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: var(--radius-pill);
            line-height: 1.4;
        }

        /* Pill button in nav */
        .nav-btn-add {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: #000 !important;
            font-weight: 700 !important;
            padding: 0.45rem 1.1rem !important;
            border-radius: var(--radius-pill) !important;
            box-shadow: 0 4px 14px var(--primary-glow) !important;
            transition: var(--transition) !important;
        }
        .nav-btn-add:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(0,208,132,0.4) !important;
            color: #000 !important;
        }

        /* User chip */
        .nav-user-chip {
            background: var(--bg-glass-lite);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius-pill);
            padding: 0.35rem 1rem;
            font-size: 0.82rem;
            color: var(--text-secondary) !important;
            cursor: default;
        }

        /* Logout link */
        .nav-link-logout {
            color: var(--danger) !important;
        }
        .nav-link-logout:hover {
            background: rgba(248, 113, 113, 0.1) !important;
            color: #ff8989 !important;
        }

        /* ─────────────────────────────────────────
           CARDS & SURFACES
        ───────────────────────────────────────── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            transition: var(--transition);
        }
        .card:hover {
            border-color: rgba(0,208,132,0.2);
            box-shadow: var(--shadow-hover);
        }

        /* Glass panel */
        .glass-panel {
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius-card);
        }

        /* ─────────────────────────────────────────
           FORM CONTROLS
        ───────────────────────────────────────── */
        .form-control {
            background: rgba(255,255,255,0.04) !important;
            border: 1px solid rgba(0,208,132,0.15) !important;
            border-radius: var(--radius-sm) !important;
            color: var(--text-primary) !important;
            font-size: 0.92rem;
            transition: var(--transition);
        }
        .form-control::placeholder { color: var(--text-muted); }
        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px var(--primary-glow) !important;
            background: rgba(0,208,132,0.04) !important;
            outline: none;
        }

        select.form-control option {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        textarea.form-control { resize: vertical; }

        /* Custom file input */
        .custom-file-label {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(0,208,132,0.15);
            border-radius: var(--radius-sm);
            color: var(--text-muted);
        }
        .custom-file-input:focus ~ .custom-file-label {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .input-group-text {
            background: var(--primary-glow);
            border: 1px solid rgba(0,208,132,0.2);
            color: var(--primary);
            font-weight: 600;
        }

        .form-label, label {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.84rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        /* ─────────────────────────────────────────
           BUTTONS
        ───────────────────────────────────────── */
        .btn {
            font-weight: 600;
            font-size: 0.87rem;
            border-radius: var(--radius-pill);
            transition: var(--transition);
            letter-spacing: 0.02em;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: #052010 !important;
            box-shadow: 0 4px 15px var(--primary-glow);
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,208,132,0.4);
            color: #000 !important;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--accent) 0%, #f59e0b 100%);
            border: none;
            color: #1a0e00 !important;
            box-shadow: 0 4px 15px var(--accent-glow);
        }
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--accent-glow);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, var(--danger-dark) 100%);
            border: none;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(248,113,113,0.25);
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(248,113,113,0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, var(--info) 0%, #0ea5e9 100%);
            border: none;
            color: #001827 !important;
            box-shadow: 0 4px 15px rgba(56,189,248,0.2);
        }
        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(56,189,248,0.35);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-secondary) !important;
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            color: var(--text-primary) !important;
            transform: translateY(-1px);
        }

        .btn-outline-success {
            border: 1px solid rgba(0,208,132,0.4);
            color: var(--primary) !important;
            background: transparent;
        }
        .btn-outline-success:hover, .btn-outline-success.active {
            background: var(--primary-glow);
            border-color: var(--primary);
            color: var(--primary) !important;
        }
        .btn-outline-success.btn-success.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: #000 !important;
            border: none;
        }

        /* ─────────────────────────────────────────
           ALERTS
        ───────────────────────────────────────── */
        .alert {
            border-radius: var(--radius-card);
            border: 1px solid;
            font-size: 0.9rem;
        }
        .alert-danger {
            background: rgba(248,113,113,0.08);
            border-color: rgba(248,113,113,0.25);
            color: #fca5a5;
        }
        .alert-success {
            background: rgba(0,208,132,0.08);
            border-color: rgba(0,208,132,0.25);
            color: #6ee7b7;
        }
        .alert-warning {
            background: rgba(251,191,36,0.08);
            border-color: rgba(251,191,36,0.2);
            color: #fcd34d;
        }

        /* ─────────────────────────────────────────
           BADGES
        ───────────────────────────────────────── */
        .badge-success, .badge.badge-success {
            background: var(--primary-glow) !important;
            color: var(--primary) !important;
            border: 1px solid rgba(0,208,132,0.3);
        }
        .badge-warning, .badge.badge-warning {
            background: var(--accent-glow) !important;
            color: var(--accent) !important;
            border: 1px solid rgba(251,191,36,0.3);
        }

        /* ─────────────────────────────────────────
           UTILITY CLASSES
        ───────────────────────────────────────── */
        .text-primary   { color: var(--primary) !important; }
        .text-success   { color: var(--primary) !important; }
        .text-accent    { color: var(--accent) !important; }
        .text-muted     { color: var(--text-muted) !important; }
        .text-secondary { color: var(--text-secondary) !important; }
        .text-dark      { color: var(--text-primary) !important; }

        .bg-success { background-color: var(--primary) !important; }
        .bg-dark    { background: var(--bg-surface) !important; }

        .border-success { border-color: rgba(0,208,132,0.3) !important; }

        .rounded-lg { border-radius: var(--radius-card) !important; }
        .rounded-pill { border-radius: var(--radius-pill) !important; }

        .shadow-sm  { box-shadow: var(--shadow-card) !important; }
        .shadow-lg  { box-shadow: var(--shadow-hover) !important; }

        /* Glow divider */
        hr {
            border-color: rgba(0,208,132,0.1);
        }

        /* Hover lift */
        .hover-up:hover {
            transform: translateY(-3px);
        }

        /* ─────────────────────────────────────────
           FOOTER SURFACE
        ───────────────────────────────────────── */
        footer {
            background: var(--bg-surface) !important;
            border-top: 1px solid var(--border-glass);
        }
        footer a {
            color: var(--text-muted) !important;
            text-decoration: none;
            transition: color 0.2s;
        }
        footer a:hover { color: var(--primary) !important; }

        /* ─────────────────────────────────────────
           ANIMATIONS
        ───────────────────────────────────────── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 15px var(--primary-glow); }
            50%       { box-shadow: 0 0 30px rgba(0,208,132,0.4); }
        }

        .fade-in-up { animation: fadeInUp 0.55s ease both; }

        /* ─────────────────────────────────────────
           TABLE (for category/admin tables)
        ───────────────────────────────────────── */
        .table {
            color: var(--text-primary);
        }
        .table thead th {
            background: rgba(0,208,132,0.07);
            border-color: var(--border-glass);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .table tbody tr {
            border-color: var(--border-card);
            transition: background 0.2s;
        }
        .table tbody tr:hover {
            background: rgba(0,208,132,0.04);
        }
        .table td, .table th {
            border-color: var(--border-card);
            vertical-align: middle;
        }

        /* ─────────────────────────────────────────
           PAGINATION
        ───────────────────────────────────────── */
        .page-link {
            background: var(--bg-card);
            border-color: var(--border-card);
            color: var(--text-secondary);
        }
        .page-link:hover {
            background: var(--primary-glow);
            color: var(--primary);
            border-color: rgba(0,208,132,0.3);
        }
        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: #000;
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════
     NAVBAR
═══════════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <span class="brand-icon">🍎</span>
            Fruit Store
        </a>

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
                style="color: var(--primary);">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-lg-center" style="gap: 2px;">

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>">
                        <i class="fas fa-home"></i> Trang chủ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>Product/">
                        <i class="fas fa-boxes"></i> Kho sản phẩm
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>category/">
                        <i class="fas fa-tags"></i> Danh mục
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>Product/cart">
                        <i class="fas fa-shopping-cart" style="color: var(--accent);"></i>
                        Giỏ hàng
                        <span class="nav-cart-badge">
                            <?php
                            $cartCount = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
                                    $cartCount += $item['quantity'];
                                }
                            }
                            echo $cartCount;
                            ?>
                        </span>
                    </a>
                </li>

                <?php if (SessionHelper::isAdmin()): ?>
                <li class="nav-item ml-1">
                    <a class="nav-link nav-btn-add" href="<?= BASE_URL ?>Product/add">
                        <i class="fas fa-plus-circle"></i> Thêm mới
                    </a>
                </li>
                <?php endif; ?>

                <?php if (SessionHelper::isLoggedIn()): ?>
                <li class="nav-item ml-2">
                    <span class="nav-link nav-user-chip">
                        <i class="fas fa-user-circle" style="color: var(--primary);"></i>
                        <?= htmlspecialchars($_SESSION['username']) ?>
                        <span style="opacity:0.5; font-size:0.78em;">(<?= htmlspecialchars(SessionHelper::getRole()) ?>)</span>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-logout" href="<?= BASE_URL ?>account/logout">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>account/login">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>account/register">
                        <i class="fas fa-user-plus"></i> Đăng ký
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 content-wrapper">