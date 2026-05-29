<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<div class="jumbotron jumbotron-fluid bg-white rounded shadow-sm mb-4 border-left border-success" style="border-left-width: 6px !important;">
    <div class="container px-4">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h1 class="display-5 font-weight-bold text-success mb-2">
                    <i class="fas fa-tags mr-2"></i>DANH MỤC TRÁI CÂY
                </h1>
                <p class="lead text-muted mb-0">Hệ thống phân loại các loại trái cây giúp việc quản lý kho hàng được khoa học và dễ dàng tìm kiếm.</p>
            </div>
            <div class="col-md-3 text-right d-none d-md-block">
                <i class="fas fa-tags text-success" style="font-size: 70px; opacity: 0.15;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row align-items-center mb-4 pb-3 border-bottom mx-0">
    <div class="col-sm-6 px-0">
        <h4 class="text-dark font-weight-bold mb-2 mb-sm-0">
            <i class="fas fa-list text-success mr-2"></i>Danh mục hiện có
        </h4>
    </div>
</div>

<div class="row">
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden transition-card bg-white" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-3 rounded-circle bg-success text-white mr-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-tag fa-lg"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-dark mb-0">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                        </div>
                        <p class="card-text text-muted flex-grow-1" style="font-size: 0.9rem; line-height: 1.6;">
                            <?php echo htmlspecialchars($category->description ? $category->description : 'Chưa có thông tin mô tả chi tiết cho danh mục này.', ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        
                        <div class="border-top pt-3 mt-auto">
                            <span class="text-muted small"><i class="fas fa-barcode mr-1"></i> Mã phân loại: <strong>#<?php echo $category->id; ?></strong></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 my-5 text-center py-5 bg-white rounded shadow-sm border">
            <i class="fas fa-folder-open fa-4x text-muted mb-3" style="opacity: 0.5;"></i>
            <h5 class="text-secondary font-weight-bold">Không có danh mục nào!</h5>
            <p class="text-muted small">Vui lòng kiểm tra lại cơ sở dữ liệu của bạn.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .transition-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
</style>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
