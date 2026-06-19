<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<!-- ═══════════════════════════════════════════
     KHO QUẢN LÝ SẢN PHẨM – PREMIUM LIST VIEW
═══════════════════════════════════════════ -->

<!-- Hero Banner -->
<div class="warehouse-hero fade-in-up mb-4">
    <!-- Decorative orbs -->
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>

    <div class="hero-content">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="hero-badge mb-2">
                    <i class="fas fa-circle text-success mr-1" style="font-size:8px; animation: pulse-glow 2s infinite;"></i>
                    LIVE · Cập nhật theo thời gian thực
                </div>
                <h1 class="hero-title">
                    <span class="hero-icon-wrap"><i class="fas fa-boxes"></i></span>
                    KHO SẢN PHẨM
                </h1>
                <p class="hero-subtitle">
                    Quản lý toàn bộ danh mục trái cây tươi sạch, cập nhật giá bán
                    và theo dõi tình trạng kho hàng một cách thông minh.
                </p>
            </div>
            <div class="col-md-4 text-right d-none d-md-flex justify-content-end align-items-center">
                <!-- Stats chips -->
                <div class="hero-stats">
                    <div class="stat-chip">
                        <span class="stat-value"><?php echo count($products ?? []); ?></span>
                        <span class="stat-label">Sản phẩm</span>
                    </div>
                    <div class="stat-chip">
                        <span class="stat-value"><?php echo count($categories ?? []); ?></span>
                        <span class="stat-label">Danh mục</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toolbar: Title + Add Button -->
<div class="d-flex justify-content-between align-items-center mb-4 fade-in-up" style="animation-delay:0.08s;">
    <div class="section-label">
        <span class="section-dot"></span>
        <h5 class="mb-0 font-weight-bold" style="font-family: var(--font-heading);">Trái cây tươi ngon chất lượng</h5>
    </div>
    <?php if (SessionHelper::isAdmin()): ?>
    <a href="<?= BASE_URL ?>Product/add" class="btn btn-success px-4 py-2 font-weight-bold">
        <i class="fas fa-plus-circle mr-2"></i>Thêm sản phẩm mới
    </a>
    <?php endif; ?>
</div>

<!-- Search & Filter Panel -->
<div class="filter-panel glass-panel mb-5 fade-in-up" style="animation-delay:0.14s;">
    <!-- Search -->
    <div class="row align-items-center">
        <div class="col-lg-5 mb-3 mb-lg-0">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput"
                       class="search-input"
                       placeholder="Tìm tên trái cây hoặc từ khóa...">
            </div>
        </div>
        <div class="col-lg-7">
            <div class="filter-tags d-flex flex-wrap align-items-center justify-content-lg-end" style="gap:8px;">
                <span class="filter-label"><i class="fas fa-sliders-h mr-1"></i> LỌC:</span>
                <button class="filter-btn active" data-category="all" id="filter-all">Tất cả</button>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <button class="filter-btn" data-category="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Product Grid -->
<div class="row" id="productGrid">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $index => $product): ?>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 product-card-container fade-in-up"
             data-name="<?php echo htmlspecialchars(strtolower($product->name), ENT_QUOTES, 'UTF-8'); ?>"
             data-desc="<?php echo htmlspecialchars(strtolower($product->description), ENT_QUOTES, 'UTF-8'); ?>"
             data-category="<?php echo htmlspecialchars($product->category_name ?? 'Trái cây', ENT_QUOTES, 'UTF-8'); ?>"
             style="animation-delay: <?php echo ($index % 8) * 0.06; ?>s;">

            <div class="product-card">
                <!-- Image -->
                <div class="product-img-wrap">
                    <?php if (!empty($product->image)): ?>
                        <img src="<?= BASE_URL ?><?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                             class="product-img" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php else: ?>
                        <div class="product-img-placeholder">
                            <i class="fas fa-apple-alt"></i>
                            <span>Chưa có ảnh</span>
                        </div>
                    <?php endif; ?>

                    <!-- Category badge -->
                    <span class="product-category-badge">
                        <i class="fas fa-tag mr-1" style="font-size:9px;"></i>
                        <?php echo htmlspecialchars($product->category_name ?? 'Trái cây', ENT_QUOTES, 'UTF-8'); ?>
                    </span>

                    <!-- Quick cart overlay -->
                    <div class="product-img-overlay">
                        <a href="<?= BASE_URL ?>Product/addToCart/<?php echo $product->id; ?>"
                           class="btn btn-success btn-sm rounded-pill px-3 font-weight-bold overlay-cart-btn">
                            <i class="fas fa-cart-plus mr-1"></i>Thêm vào giỏ
                        </a>
                    </div>
                </div>

                <!-- Body -->
                <div class="product-body">
                    <h6 class="product-name">
                        <a href="<?= BASE_URL ?>Product/show/<?php echo $product->id; ?>" class="product-name-link">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h6>

                    <p class="product-desc">
                        <?php echo htmlspecialchars($product->description
                            ? $product->description
                            : 'Chưa có mô tả chi tiết.', ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <div class="product-price-row">
                        <div>
                            <div class="price-label">Giá bán</div>
                            <div class="product-price">
                                <?php echo number_format($product->price, 0, ',', '.'); ?>
                                <span class="price-currency">₫</span>
                            </div>
                        </div>
                        <a href="<?= BASE_URL ?>Product/addToCart/<?php echo $product->id; ?>"
                           class="cart-mini-btn" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="product-footer">
                    <a href="<?= BASE_URL ?>Product/show/<?php echo $product->id; ?>"
                       class="btn btn-info btn-sm font-weight-bold px-3">
                        <i class="fas fa-eye mr-1"></i>Chi tiết
                    </a>

                    <?php if (SessionHelper::isAdmin()): ?>
                    <div class="d-flex" style="gap:6px;">
                        <a href="<?= BASE_URL ?>Product/edit/<?php echo $product->id; ?>"
                           class="btn btn-warning btn-sm font-weight-bold px-3">
                            <i class="fas fa-edit mr-1"></i>Sửa
                        </a>
                        <a href="<?= BASE_URL ?>Product/delete/<?php echo $product->id; ?>"
                           class="btn btn-danger btn-sm font-weight-bold px-3"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            <i class="fas fa-trash-alt mr-1"></i>Xóa
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    <?php else: ?>
    <div class="col-12">
        <div class="empty-state-card text-center py-5 my-4">
            <div class="empty-icon mb-4">
                <i class="fas fa-box-open"></i>
            </div>
            <h5 class="font-weight-bold mb-2" style="font-family: var(--font-heading);">Kho hàng đang trống!</h5>
            <p class="text-secondary mb-4">Vui lòng thêm sản phẩm đầu tiên vào kho hàng.</p>
            <?php if (SessionHelper::isAdmin()): ?>
            <a href="<?= BASE_URL ?>Product/add" class="btn btn-success px-5 py-2 font-weight-bold">
                <i class="fas fa-plus-circle mr-2"></i>Thêm sản phẩm đầu tiên
            </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Empty search state -->
    <div id="empty-search-state" class="col-12" style="display: none !important;">
        <div class="empty-state-card text-center py-5 my-4">
            <div class="empty-icon mb-4" style="background: rgba(251,191,36,0.08);">
                <i class="fas fa-search" style="color: var(--accent);"></i>
            </div>
            <h5 class="font-weight-bold mb-2">Không tìm thấy sản phẩm!</h5>
            <p class="text-secondary">Vui lòng thay đổi từ khóa hoặc chọn danh mục khác.</p>
        </div>
    </div>
</div>

<!-- ──────────────────────────────────
     PAGE-SPECIFIC STYLES
────────────────────────────────── -->
<style>
/* ── Hero Banner ── */
.warehouse-hero {
    position: relative;
    background: linear-gradient(135deg, #021a0c 0%, #0a3a1c 40%, #0d4a25 70%, #061203 100%);
    border: 1px solid rgba(0,208,132,0.12);
    border-radius: 20px;
    padding: 36px 40px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.5), inset 0 1px 0 rgba(0,208,132,0.1);
}

.hero-orb {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    filter: blur(60px);
}
.hero-orb-1 {
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(0,208,132,0.12) 0%, transparent 70%);
    top: -120px; right: -60px;
}
.hero-orb-2 {
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(0,168,107,0.08) 0%, transparent 70%);
    bottom: -80px; left: 10%;
}
.hero-orb-3 {
    width: 150px; height: 150px;
    background: radial-gradient(circle, rgba(251,191,36,0.06) 0%, transparent 70%);
    top: 20px; left: 35%;
}

.hero-content { position: relative; z-index: 2; }

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0,208,132,0.08);
    border: 1px solid rgba(0,208,132,0.2);
    border-radius: 999px;
    padding: 4px 14px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    color: var(--primary);
    text-transform: uppercase;
}

.hero-title {
    font-family: var(--font-heading);
    font-size: 2.4rem;
    font-weight: 900;
    color: #fff;
    letter-spacing: -1px;
    margin: 8px 0 10px;
    display: flex;
    align-items: center;
    gap: 14px;
    line-height: 1.1;
}

.hero-icon-wrap {
    width: 54px; height: 54px;
    background: linear-gradient(135deg, var(--primary) 0%, #00ff9d 100%);
    border-radius: 15px;
    display: inline-flex; align-items: center; justify-content: center;
    color: #062012;
    font-size: 22px;
    flex-shrink: 0;
    box-shadow: 0 6px 20px rgba(0,208,132,0.35);
}

.hero-subtitle {
    color: rgba(255,255,255,0.55);
    font-size: 0.92rem;
    line-height: 1.65;
    max-width: 480px;
    margin: 0;
}

.hero-stats {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.stat-chip {
    background: rgba(0,208,132,0.07);
    border: 1px solid rgba(0,208,132,0.15);
    border-radius: 12px;
    padding: 10px 20px;
    text-align: center;
    min-width: 90px;
}
.stat-value {
    display: block;
    font-family: var(--font-heading);
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary);
    line-height: 1;
}
.stat-label {
    font-size: 0.72rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

/* ── Section Label ── */
.section-label {
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-dot {
    width: 10px; height: 10px;
    background: var(--primary);
    border-radius: 50%;
    box-shadow: 0 0 8px var(--primary), 0 0 20px rgba(0,208,132,0.4);
    animation: pulse-glow 2s ease-in-out infinite;
}

/* ── Filter Panel ── */
.filter-panel {
    padding: 20px 24px;
}

.search-box {
    position: relative;
}
.search-icon {
    position: absolute;
    left: 16px; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 14px;
    pointer-events: none;
    z-index: 2;
}
.search-input {
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(0,208,132,0.15);
    border-radius: 999px;
    padding: 10px 18px 10px 44px;
    font-size: 0.9rem;
    color: var(--text-primary);
    font-family: var(--font-main);
    transition: var(--transition);
    outline: none;
}
.search-input::placeholder { color: var(--text-muted); }
.search-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-glow);
    background: rgba(0,208,132,0.04);
}

.filter-label {
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    color: var(--text-muted);
    text-transform: uppercase;
}

.filter-btn {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 999px;
    padding: 6px 16px;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--text-secondary);
    cursor: pointer;
    transition: var(--transition);
    font-family: var(--font-main);
}
.filter-btn:hover {
    border-color: rgba(0,208,132,0.3);
    color: var(--primary);
    background: var(--primary-glow);
}
.filter-btn.active {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-color: transparent;
    color: #042210;
    font-weight: 700;
    box-shadow: 0 4px 12px var(--primary-glow);
}

/* ── Product Card ── */
.product-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: var(--radius-card);
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform 0.32s cubic-bezier(0.165, 0.84, 0.44, 1),
                box-shadow 0.32s ease,
                border-color 0.28s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.4);
}
.product-card:hover {
    transform: translateY(-8px);
    border-color: rgba(0,208,132,0.25);
    box-shadow: 0 20px 50px rgba(0,0,0,0.55), 0 0 0 1px rgba(0,208,132,0.12);
}

/* Image */
.product-img-wrap {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: #060d0a;
    flex-shrink: 0;
}
.product-img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.45s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.product-card:hover .product-img {
    transform: scale(1.1);
}
.product-img-placeholder {
    width: 100%; height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: var(--text-muted);
}
.product-img-placeholder i { font-size: 36px; opacity: 0.3; }
.product-img-placeholder span { font-size: 0.78rem; opacity: 0.5; font-style: italic; }

/* Overlay on hover */
.product-img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.55);
    display: flex; align-items: center; justify-content: center;
    opacity: 0;
    transition: opacity 0.28s ease;
    backdrop-filter: blur(4px);
}
.product-card:hover .product-img-overlay { opacity: 1; }
.overlay-cart-btn {
    transform: translateY(10px);
    transition: transform 0.3s ease 0.05s;
}
.product-card:hover .overlay-cart-btn { transform: translateY(0); }

/* Category badge */
.product-category-badge {
    position: absolute;
    top: 12px; left: 12px;
    background: rgba(0,208,132,0.12);
    border: 1px solid rgba(0,208,132,0.25);
    color: var(--primary);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 999px;
    backdrop-filter: blur(8px);
}

/* Body */
.product-body {
    padding: 18px 18px 12px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-name {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1.3;
}
.product-name-link {
    color: var(--text-primary) !important;
    text-decoration: none;
    transition: color 0.2s;
}
.product-name-link:hover { color: var(--primary) !important; }

.product-desc {
    font-size: 0.82rem;
    color: var(--text-muted);
    line-height: 1.6;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 14px;
}

.product-price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid var(--border-card);
}
.price-label {
    font-size: 0.72rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    font-weight: 600;
    margin-bottom: 1px;
}
.product-price {
    font-family: var(--font-heading);
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--accent);
    line-height: 1.1;
}
.price-currency {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--accent);
    opacity: 0.7;
}

.cart-mini-btn {
    width: 36px; height: 36px;
    background: rgba(0,208,132,0.08);
    border: 1px solid rgba(0,208,132,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--primary);
    font-size: 14px;
    text-decoration: none;
    transition: var(--transition);
    flex-shrink: 0;
}
.cart-mini-btn:hover {
    background: var(--primary);
    color: #000;
    box-shadow: 0 4px 12px var(--primary-glow);
    transform: scale(1.12);
}

/* Footer */
.product-footer {
    padding: 12px 18px;
    background: rgba(0,0,0,0.15);
    border-top: 1px solid var(--border-card);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* ── Empty State ── */
.empty-state-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: 20px;
    box-shadow: var(--shadow-card);
}
.empty-icon {
    width: 80px; height: 80px;
    background: rgba(0,208,132,0.07);
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 32px;
    color: var(--primary);
    margin: 0 auto;
}
</style>

<!-- Search & Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput  = document.getElementById('searchInput');
    const filterBtns   = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card-container');
    const emptyState   = document.getElementById('empty-search-state');

    let activeCategory = 'all';
    let searchQuery    = '';

    function filterProducts() {
        let count = 0;
        productCards.forEach(card => {
            const name     = card.dataset.name;
            const desc     = card.dataset.desc;
            const category = card.dataset.category;
            const matchesSearch   = name.includes(searchQuery) || desc.includes(searchQuery);
            const matchesCategory = activeCategory === 'all' || category === activeCategory;

            if (matchesSearch && matchesCategory) {
                card.style.display = '';
                card.style.opacity = '1';
                count++;
            } else {
                card.style.opacity = '0';
                setTimeout(() => { if (card.style.opacity === '0') card.style.display = 'none'; }, 280);
            }
        });
        if (count === 0) {
            emptyState.style.setProperty('display', 'block', 'important');
        } else {
            emptyState.style.setProperty('display', 'none', 'important');
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', e => {
            searchQuery = e.target.value.toLowerCase().trim();
            filterProducts();
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.dataset.category;
            filterProducts();
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Kiểm tra JWT Token
    const token = localStorage.getItem('jwtToken');
    if (!token) {
        alert('Vui lòng đăng nhập để xem thông tin sản phẩm');
        location.href = '<?= BASE_URL ?>account/login'; 
        return;
    }

    // 2. Fix lỗi vị trí cuộn trang (Scroll Restoration) khi bấm Thêm vào giỏ
    const savedScrollPosition = sessionStorage.getItem('scrollPosition');
    if (savedScrollPosition) {
        window.scrollTo({
            top: parseInt(savedScrollPosition),
            behavior: 'instant'
        });
        sessionStorage.removeItem('scrollPosition');
    }

    // Lắng nghe sự kiện click vào các nút thêm giỏ hàng để lưu lại vị trí cuộn
    const cartBtns = document.querySelectorAll('a[href*="addToCart"]');
    cartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    });
});
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>