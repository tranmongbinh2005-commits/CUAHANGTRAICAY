<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0 rounded-lg overflow-hidden my-4">
            <div class="card-header text-white font-weight-bold py-3" style="background: linear-gradient(135deg, #0d2816 0%, #153e22 100%);">
                <h4 class="mb-0"><i class="fas fa-info-circle mr-2 text-warning"></i>Chi tiết sản phẩm trái cây</h4>
            </div>
            <div class="card-body p-4 bg-white">
                <?php if ($product): ?>
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center mb-4 mb-md-0">
                            <?php if ($product->image): ?>
                                <img src="<?= BASE_URL ?><?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid rounded shadow-sm border" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" style="max-height: 350px; object-fit: cover;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm flex-column py-5" style="height: 300px;">
                                    <i class="fas fa-image fa-4x text-muted mb-2" style="opacity: 0.3;"></i>
                                    <span class="small text-muted font-italic">Chưa có hình ảnh</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-7">
                            <h2 class="font-weight-bold text-dark mb-2">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </h2>
                            
                            <div class="mb-3">
                                <span class="badge badge-success p-2 font-weight-bold text-uppercase px-3 rounded-pill">
                                    <i class="fas fa-tags mr-1"></i> <?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
                                </span>
                            </div>
                            
                            <h3 class="text-danger font-weight-bold mb-4">
                                <?php echo number_format($product->price, 0, ',', '.'); ?> <span class="small font-weight-bold text-uppercase" style="font-size: 14px;">VND</span>
                            </h3>
                            
                            <h5 class="font-weight-bold text-secondary border-bottom pb-2 mb-3"><i class="fas fa-file-alt mr-2 text-success"></i>Mô tả sản phẩm:</h5>
                            <p class="card-text text-justify text-dark" style="line-height: 1.6;">
                                <?php echo nl2br(htmlspecialchars($product->description ? $product->description : 'Chưa có mô tả.', ENT_QUOTES, 'UTF-8')); ?>
                            </p>
                            
                            <div class="mt-4 pt-3 border-top d-flex flex-wrap">
                                <a href="<?= BASE_URL ?>Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success btn-md px-4 shadow-sm font-weight-bold rounded-pill mr-2 mb-2"><i class="fas fa-cart-plus mr-1"></i> Thêm vào giỏ hàng</a>
                                <a href="<?= BASE_URL ?>Product/" class="btn btn-secondary btn-md px-4 shadow-sm font-weight-bold rounded-pill mb-2">Quay lại danh sách</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger text-center my-4 border-0 rounded-lg shadow-sm">
                        <h4><i class="fas fa-exclamation-triangle mr-2"></i>Không tìm thấy sản phẩm này!</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
