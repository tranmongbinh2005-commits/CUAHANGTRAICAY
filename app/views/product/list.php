<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<!-- Premium Hero Banner -->
<div class="jumbotron jumbotron-fluid text-white rounded-lg shadow-lg mb-5 overflow-hidden position-relative" style="background: linear-gradient(135deg, #0d2816 0%, #1c522b 100%);">
    <div style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.03); border-radius: 50%; top: -100px; right: -50px; pointer-events: none;"></div>
    <div style="position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.04); border-radius: 50%; bottom: -50px; left: 5%; pointer-events: none;"></div>
    
    <div class="container px-4 py-2 position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h1 class="display-4 font-weight-bold text-warning mb-2" style="letter-spacing: -1px;">
                    <i class="fas fa-boxes mr-2"></i>KHO QUẢN LÝ SẢN PHẨM
                </h1>
                <p class="lead text-light mb-0" style="opacity: 0.9;">Hệ thống kiểm kê thông tin, điều chỉnh giá bán và danh mục trái cây sạch theo thời gian thực.</p>
            </div>
            <div class="col-md-3 text-right d-none d-md-block">
                <i class="fas fa-apple-alt text-warning" style="font-size: 80px; opacity: 0.25; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15));"></i>
            </div>
        </div>
    </div>
</div>

<!-- Header Controls: Title & Add Button -->
<div class="row align-items-center mb-4 pb-3 border-bottom mx-0">
    <div class="col-sm-6 px-0">
        <h4 class="text-dark font-weight-bold mb-2 mb-sm-0 d-flex align-items-center">
            <span class="p-2 rounded bg-success-light text-success mr-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: var(--primary-light);">
                <i class="fas fa-leaf" style="font-size: 16px;"></i>
            </span>
            Trái cây tươi ngon chất lượng
        </h4>
    </div>
    <div class="col-sm-6 text-sm-right px-0">
        <a href="<?= BASE_URL ?>Product/add" class="btn btn-success px-4 py-2 font-weight-bold rounded-pill shadow-sm hover-up">
            <i class="fas fa-plus-circle mr-2"></i>Thêm trái cây mới
        </a>
    </div>
</div>

<!-- Interactive Real-time Search and Filter Panel -->
<div class="row mb-5 align-items-center bg-white p-3 rounded-lg shadow-sm border mx-0">
    <div class="col-lg-5 mb-3 mb-lg-0 px-0 px-lg-2">
        <div class="input-group rounded-pill border overflow-hidden bg-light px-2" style="transition: border-color 0.25s ease;">
            <div class="input-group-prepend">
                <span class="input-group-text bg-transparent border-0 pl-3 pr-1 text-muted"><i class="fas fa-search"></i></span>
            </div>
            <input type="text" id="searchInput" class="form-control bg-transparent border-0 py-4 pl-2" placeholder="Tìm tên trái cây hoặc từ khóa..." style="font-size: 0.95rem; box-shadow: none !important;">
        </div>
    </div>
    <div class="col-lg-7 px-0 px-lg-2">
        <div class="d-flex flex-wrap align-items-center justify-content-lg-end">
            <span class="text-muted small font-weight-bold mr-3 d-none d-sm-inline-block"><i class="fas fa-filter mr-1 text-success"></i>LỌC THEO:</span>
            <button class="btn btn-success btn-sm filter-btn rounded-pill px-3 py-2 mr-2 mb-2 active shadow-sm" data-category="all">
                Tất cả
            </button>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <button class="btn btn-outline-success btn-sm filter-btn rounded-pill px-3 py-2 mr-2 mb-2" data-category="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Product Cards Grid -->
<div class="row" id="productGrid">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <!-- Card Wrapper with attributes for instant JS searching and filtering -->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 product-card-container" 
                 data-name="<?php echo htmlspecialchars(strtolower($product->name), ENT_QUOTES, 'UTF-8'); ?>"
                 data-desc="<?php echo htmlspecialchars(strtolower($product->description), ENT_QUOTES, 'UTF-8'); ?>"
                 data-category="<?php echo htmlspecialchars($product->category_name ?? 'Trái cây', ENT_QUOTES, 'UTF-8'); ?>"
                 style="transition: all 0.35s ease;">
                 
                <div class="card h-100 border-0 rounded-lg overflow-hidden transition-card shadow-sm bg-white">
                    
                    <!-- Product Image Container -->
                    <div class="position-relative bg-light text-center flex-shrink-0" style="height: 200px; overflow: hidden;">
                        <?php if (!empty($product->image)): ?>
                            <img src="<?= BASE_URL ?><?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" class="w-100 h-100 card-img-zoom" style="object-fit: cover; transition: transform 0.4s ease;" alt="Product Image">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted flex-column bg-light border-bottom">
                                <i class="fas fa-image fa-3x mb-2 text-muted-50" style="opacity: 0.3;"></i>
                                <span class="small font-italic font-weight-bold" style="opacity: 0.6;">Chưa có ảnh</span>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Category Badge -->
                        <span class="position-absolute badge badge-success px-3 py-2 shadow-sm font-weight-bold text-uppercase" style="top: 12px; left: 12px; border-radius: 30px; font-size: 10px; letter-spacing: 0.5px; background-color: var(--primary); box-shadow: 0 4px 8px rgba(0,0,0,0.15);">
                            <i class="fas fa-tag mr-1 text-warning"></i> <?php echo htmlspecialchars($product->category_name ?? 'Trái cây', ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-4 bg-white">
                        <h5 class="card-title font-weight-bold text-dark text-truncate mb-2" title="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                            <a href="<?= BASE_URL ?>Product/show/<?php echo $product->id; ?>" class="text-decoration-none text-success text-success-hover font-weight-bold" style="transition: color 0.2s;">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        
                        <p class="card-text text-muted small flex-grow-1 mb-4 text-justify" style="line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 40px; opacity: 0.85;">
                            <?php echo htmlspecialchars($product->description ? $product->description : 'Chưa có thông tin mô tả chi tiết cho loại trái cây này.', ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        
                        <div class="border-top pt-3 mt-auto d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small d-block mb-0"><i class="fas fa-wallet mr-1"></i>Giá bán:</span>
                                <h5 class="text-danger font-weight-bold mb-0" style="font-size: 1.15rem;">
                                    <?php echo number_format($product->price, 0, ',', '.'); ?> <span class="small font-weight-bold text-uppercase" style="font-size: 11px;">VND</span>
                                </h5>
                            </div>
                            <a href="<?= BASE_URL ?>Product/addToCart/<?php echo $product->id; ?>" class="btn btn-outline-success btn-sm rounded-circle d-flex align-items-center justify-content-center hover-up" style="width: 35px; height: 35px; border-radius: 50% !important;" title="Thêm vào giỏ">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="card-footer bg-light border-top-0 px-4 py-3 d-flex justify-content-between align-items-center">
                        <a href="<?= BASE_URL ?>Product/show/<?php echo $product->id; ?>" class="btn btn-sm btn-info px-3 font-weight-bold rounded-pill hover-up shadow-xs">
                            <i class="fas fa-eye mr-1"></i> Chi tiết
                        </a>
                        <div>
                            <a href="<?= BASE_URL ?>Product/edit/<?php echo $product->id; ?>" class="btn btn-sm btn-warning text-dark px-3 font-weight-bold mr-1 rounded-pill hover-up shadow-xs">
                                <i class="fas fa-edit mr-1"></i> Sửa
                            </a>
                            <a href="<?= BASE_URL ?>Product/delete/<?php echo $product->id; ?>" class="btn btn-sm btn-danger px-3 font-weight-bold rounded-pill hover-up shadow-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi kho hàng?');">
                                <i class="fas fa-trash-alt mr-1"></i> Xóa
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 my-5 text-center py-5 bg-white rounded shadow-sm border">
            <i class="fas fa-folder-open fa-4x text-muted mb-3" style="opacity: 0.5;"></i>
            <h5 class="text-secondary font-weight-bold">Kho hàng hiện tại đang trống!</h5>
            <p class="text-muted small">Vui lòng bấm nút "Thêm trái cây mới" ở phía trên để nhập sản phẩm đầu tiên.</p>
        </div>
    <?php endif; ?>
    
    <!-- Empty state for search/filter results -->
    <div id="empty-search-state" class="col-12 my-5 text-center py-5 bg-white rounded shadow-sm border" style="display: none !important;">
        <i class="fas fa-search fa-4x text-muted mb-3" style="opacity: 0.4;"></i>
        <h5 class="text-secondary font-weight-bold">Không tìm thấy sản phẩm phù hợp!</h5>
        <p class="text-muted small">Vui lòng thay đổi từ khóa tìm kiếm hoặc chọn danh mục khác.</p>
    </div>
</div>

<style>
    /* Styling overrides for premium effects */
    .transition-card {
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease-in-out;
    }
    
    .transition-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }
    
    .transition-card:hover .card-img-zoom {
        transform: scale(1.08);
    }
    
    .text-success-hover:hover {
        color: var(--primary-hover) !important;
    }
    
    .hover-up:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.12) !important;
    }
    
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
</style>

<!-- SPA-like client side Real-time Searching and Filtering logic -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card-container');
    const emptyState = document.getElementById('empty-search-state');

    let activeCategory = 'all';
    let searchQuery = '';

    function filterProducts() {
        let visibleCount = 0;

        productCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const desc = card.getAttribute('data-desc');
            const category = card.getAttribute('data-category');

            const matchesSearch = name.includes(searchQuery) || desc.includes(searchQuery);
            const matchesCategory = activeCategory === 'all' || category === activeCategory;

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                // Trigger quick animations
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 10);
                visibleCount++;
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                card.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            emptyState.style.setProperty('display', 'block', 'important');
        } else {
            emptyState.style.setProperty('display', 'none', 'important');
        }
    }

    // Input Search box event handler
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value.toLowerCase().trim();
            filterProducts();
        });
        
        // Add dynamic focus border effect
        searchInput.closest('.input-group').addEventListener('focusin', function() {
            this.style.borderColor = 'var(--primary)';
            this.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.15)';
        });
        
        searchInput.closest('.input-group').addEventListener('focusout', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    }

    // Category button filter click handlers
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => {
                b.classList.remove('btn-success', 'active', 'shadow-sm');
                b.classList.add('btn-outline-success');
            });

            this.classList.remove('btn-outline-success');
            this.classList.add('btn-success', 'active', 'shadow-sm');

            activeCategory = this.getAttribute('data-category');
            filterProducts();
        });
    });
});
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>