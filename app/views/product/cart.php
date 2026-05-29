<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<div class="container py-4">

    <!-- Hero Banner -->
    <div class="jumbotron jumbotron-fluid text-white rounded-lg shadow-lg mb-5 overflow-hidden position-relative" style="background: linear-gradient(135deg, #0d2816 0%, #1c522b 100%);">
        <div style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.03); border-radius: 50%; top: -100px; right: -50px; pointer-events: none;"></div>
        <div style="position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.04); border-radius: 50%; bottom: -50px; left: 5%; pointer-events: none;"></div>
        
        <div class="container px-4 py-2 position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <h1 class="display-4 font-weight-bold text-warning mb-2" style="letter-spacing: -1px;">
                        <i class="fas fa-shopping-cart mr-2"></i>GIỎ HÀNG CỦA BẠN
                    </h1>
                    <p class="lead text-light mb-0" style="opacity: 0.9;">Xem lại danh sách trái cây bạn đã chọn trước khi tiến hành thanh toán.</p>
                </div>
                <div class="col-md-3 text-right d-none d-md-block">
                    <i class="fas fa-shopping-basket text-warning" style="font-size: 80px; opacity: 0.25; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15));"></i>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($cart)): ?>
        <form action="<?= BASE_URL ?>Product/updateCart" method="POST" id="cartForm">
            <div class="row">
                <!-- Cart Items List -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden bg-white">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <h5 class="text-dark font-weight-bold mb-0 d-flex align-items-center">
                                <i class="fas fa-list text-success mr-2"></i>Chi tiết sản phẩm
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="border-0 pl-4">Sản phẩm</th>
                                        <th scope="col" class="border-0 text-center">Đơn giá</th>
                                        <th scope="col" class="border-0 text-center" style="width: 150px;">Số lượng</th>
                                        <th scope="col" class="border-0 text-right pr-4">Thành tiền</th>
                                        <th scope="col" class="border-0 text-center" style="width: 80px;">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalPrice = 0;
                                    foreach ($cart as $id => $item): 
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $totalPrice += $subtotal;
                                    ?>
                                        <tr style="transition: all 0.2s;">
                                            <!-- Product Info -->
                                            <td class="pl-4 align-middle">
                                                <div class="d-flex align-items-center py-2">
                                                    <div class="rounded overflow-hidden bg-light border mr-3" style="width: 65px; height: 65px; flex-shrink: 0;">
                                                        <?php if (!empty($item['image'])): ?>
                                                            <img src="<?= BASE_URL ?><?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" class="w-100 h-100" style="object-fit: cover;">
                                                        <?php else: ?>
                                                            <div class="d-flex align-items-center justify-content-center h-100 text-muted bg-light">
                                                                <i class="fas fa-image" style="opacity: 0.4;"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <h6 class="font-weight-bold text-dark mb-1"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                                        <span class="badge badge-pill badge-light text-muted border py-1 px-2" style="font-size: 10px;">ID: <?php echo $id; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Price -->
                                            <td class="text-center align-middle font-weight-bold text-dark">
                                                <?php echo number_format($item['price'], 0, ',', '.'); ?> <span class="small font-weight-bold text-muted">đ</span>
                                            </td>
                                            <!-- Quantity Controls -->
                                            <td class="text-center align-middle">
                                                <div class="input-group input-group-sm justify-content-center mx-auto" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary btn-minus rounded-left" type="button" onclick="changeQuantity(<?php echo $id; ?>, -1)">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number" name="quantities[<?php echo $id; ?>]" id="qty-<?php echo $id; ?>" class="form-control text-center font-weight-bold border-secondary bg-white" value="<?php echo $item['quantity']; ?>" min="1" max="100" readonly style="max-width: 50px; box-shadow: none !important;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-plus rounded-right" type="button" onclick="changeQuantity(<?php echo $id; ?>, 1)">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Subtotal -->
                                            <td class="text-right align-middle font-weight-bold text-success pr-4" style="font-size: 1.05rem;">
                                                <?php echo number_format($subtotal, 0, ',', '.'); ?> <span class="small font-weight-bold">đ</span>
                                            </td>
                                            <!-- Action Delete -->
                                            <td class="text-center align-middle">
                                                <a href="<?= BASE_URL ?>Product/removeFromCart/<?php echo $id; ?>" class="btn btn-sm btn-outline-danger rounded-circle d-inline-flex align-items-center justify-content-center hover-scale" style="width: 32px; height: 32px; transition: all 0.25s;" title="Xóa khỏi giỏ" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                                    <i class="fas fa-trash-alt" style="font-size: 12px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center py-3 px-4">
                            <a href="<?= BASE_URL ?>Product/" class="btn btn-outline-success font-weight-bold rounded-pill px-4" style="transition: all 0.25s;">
                                <i class="fas fa-arrow-left mr-2"></i>Tiếp tục mua hàng
                            </a>
                            <button type="submit" class="btn btn-warning text-dark font-weight-bold rounded-pill px-4 shadow-sm hover-scale" style="transition: all 0.25s;">
                                <i class="fas fa-sync-alt mr-2"></i>Cập nhật giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden bg-white position-sticky" style="top: 20px;">
                        <div class="card-body p-4">
                            <h5 class="text-dark font-weight-bold mb-4 pb-2 border-bottom">
                                <i class="fas fa-receipt text-success mr-2"></i>Tóm tắt đơn hàng
                            </h5>
                            
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Tạm tính (<?php echo count($cart); ?> loại):</span>
                                <span class="font-weight-bold text-dark"><?php echo number_format($totalPrice, 0, ',', '.'); ?> đ</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success font-weight-bold">Miễn phí <i class="fas fa-shipping-fast ml-1"></i></span>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="font-weight-bold text-dark">Tổng thanh toán:</span>
                                <h4 class="text-danger font-weight-bold mb-0">
                                    <?php echo number_format($totalPrice, 0, ',', '.'); ?> <span class="small font-weight-bold" style="font-size: 14px;">đ</span>
                                </h4>
                            </div>
                            
                            <a href="<?= BASE_URL ?>Product/checkout" class="btn btn-success btn-block btn-lg font-weight-bold py-3 rounded-pill shadow hover-up" style="transition: all 0.3s ease;">
                                <i class="fas fa-credit-card mr-2"></i>Tiến hành thanh toán
                            </a>
                            
                            <div class="text-center mt-3">
                                <span class="text-muted small"><i class="fas fa-shield-alt text-success mr-1"></i>Cam kết trái cây sạch 100% an toàn</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php else: ?>
        <!-- Empty Cart State -->
        <div class="my-5 text-center py-5 bg-white rounded-lg shadow-sm border p-4">
            <div class="mb-4">
                <i class="fas fa-shopping-cart fa-5x text-muted mb-3" style="opacity: 0.35; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.05));"></i>
            </div>
            <h4 class="text-dark font-weight-bold">Giỏ hàng của bạn đang trống!</h4>
            <p class="text-muted max-w-sm mx-auto mb-4" style="max-width: 450px;">Hãy lấp đầy giỏ hàng của bạn bằng những loại trái cây tươi ngon, giàu dinh dưỡng tại Fruit Store.</p>
            <a href="<?= BASE_URL ?>Product/" class="btn btn-success btn-lg px-5 font-weight-bold rounded-pill shadow-sm hover-scale" style="transition: all 0.25s;">
                <i class="fas fa-shopping-basket mr-2"></i>Mua sắm ngay
            </a>
        </div>
    <?php endif; ?>
</div>

<style>
    .hover-scale:hover {
        transform: scale(1.04);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    }
    .hover-up:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3) !important;
    }
    .align-middle {
        vertical-align: middle !important;
    }
</style>

<script>
function changeQuantity(id, amount) {
    const input = document.getElementById('qty-' + id);
    if (!input) return;
    
    let currentVal = parseInt(input.value);
    let newVal = currentVal + amount;
    
    if (newVal >= 1 && newVal <= 100) {
        input.value = newVal;
        // Bôi màu thay đổi nhẹ để kích thích người dùng bấm cập nhật
        document.getElementById('qty-' + id).classList.add('border-warning');
        
        // Tự động gửi submit form luôn để cập nhật giỏ hàng
        document.getElementById('cartForm').submit();
    }
}
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
