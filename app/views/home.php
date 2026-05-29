<?php include 'app/shares/header.php'; ?>

<div class="container py-4">

    <!-- Premium Hero Section -->
    <div class="jumbotron jumbotron-fluid text-white rounded-lg shadow-lg mb-5 overflow-hidden position-relative" style="background: linear-gradient(135deg, #0d2816 0%, #28a745 100%);">
        <!-- Floating shapes backdrops -->
        <div style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.03); border-radius: 50%; top: -100px; right: -50px; pointer-events: none;"></div>
        <div style="position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%; bottom: -50px; left: 10%; pointer-events: none;"></div>

        <div class="container px-4 py-3 position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 font-weight-bold mb-2"><i class="fas fa-apple-alt text-warning mr-2"></i>Fruit Store</h1>
                    <p class="lead font-italic text-light" style="opacity: 0.9;">Hệ thống quản lý và phân phối trái cây tươi sạch, an toàn hàng đầu.</p>
                    <hr class="my-4 bg-white" style="opacity: 0.2;">
                    <p class="mb-4 text-white-50">Chào mừng bạn đến với trang quản trị. Tại đây bạn có thể cập nhật kho hàng, kiểm kê danh mục sản phẩm một cách nhanh chóng và tối ưu nhất.</p>
                    <a class="btn btn-light btn-lg text-success font-weight-bold px-4 shadow-sm rounded-pill hover-scale" href="<?= BASE_URL ?>Product/" role="button" style="transition: all 0.25s ease;">
                        <i class="fas fa-boxes mr-2"></i>Vào kho quản lý
                    </a>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="fas fa-shopping-basket text-white" style="font-size: 130px; opacity: 0.25; filter: drop-shadow(0 8px 16px rgba(0,0,0,0.15));"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 hover-shadow" style="transition: all 0.3s ease;">
                <div class="card-body">
                    <div class="text-success mb-2">
                        <i class="fas fa-apple-alt fa-3x" style="opacity: 0.85;"></i>
                    </div>
                    <h3 class="font-weight-bold text-dark mb-1">Cập Nhật</h3>
                    <p class="text-muted font-weight-bold text-uppercase small mb-0">Ăn trái cây sang – sống healthy ngang</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 hover-shadow" style="transition: all 0.3s ease;">
                <div class="card-body">
                    <div class="text-info mb-2">
                        <i class="fas fa-tags fa-3x" style="opacity: 0.85;"></i>
                    </div>
                    <h3 class="font-weight-bold text-dark mb-1">Đầy Đủ</h3>
                    <p class="text-muted font-weight-bold text-uppercase small mb-0">Danh mục phân loại</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 hover-shadow" style="transition: all 0.3s ease;">
                <div class="card-body">
                    <div class="text-warning mb-2">
                        <i class="fas fa-truck fa-3x" style="opacity: 0.85;"></i>
                    </div>
                    <h3 class="font-weight-bold text-dark mb-1">100%</h3>
                    <p class="text-muted font-weight-bold text-uppercase small mb-0">Đảm bảo tươi sạch</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-dark font-weight-bold mb-4 border-bottom pb-2">
        <i class="fas fa-star text-warning mr-2"></i>Tính năng quản trị cốt lõi
    </h3>

    <!-- Feature Access Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-white hover-shadow" style="transition: all 0.3s ease;">
                <div class="card-body p-4 d-flex align-items-start">
                    <div class="p-3 rounded-lg mr-3" style="background-color: #e8f5e9; color: #28a745;">
                        <i class="fas fa-th-list fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-1">Xem kho sản phẩm</h5>
                        <p class="text-muted small mb-3">Xem danh sách toàn bộ trái cây hiện có, bộ lọc danh mục, giá bán và hình ảnh trực quan.</p>
                        <a href="<?= BASE_URL ?>Product/" class="btn btn-success btn-sm px-4 font-weight-bold rounded-pill shadow-sm">Truy cập ngay &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-white hover-shadow" style="transition: all 0.3s ease;">
                <div class="card-body p-4 d-flex align-items-start">
                    <div class="p-3 rounded-lg mr-3" style="background-color: #ffebee; color: #dc3545;">
                        <i class="fas fa-plus-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-1">Thêm sản phẩm mới</h5>
                        <p class="text-muted small mb-3">Đăng tải sản phẩm mới lên hệ thống, hỗ trợ đăng hình ảnh minh họa và phân loại danh mục gốc.</p>
                        <a href="<?= BASE_URL ?>Product/add" class="btn btn-danger btn-sm px-4 font-weight-bold rounded-pill shadow-sm">Thêm ngay &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
    }
    .hover-scale:hover {
        transform: scale(1.04);
        box-shadow: 0 6px 15px rgba(255,255,255,0.2) !important;
    }
</style>

<?php include 'app/shares/footer.php'; ?>