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
                        <i class="fas fa-credit-card mr-2"></i>TIẾN HÀNH ĐẶT HÀNG
                    </h1>
                    <p class="lead text-light mb-0" style="opacity: 0.9;">Nhập thông tin giao nhận chính xác để chúng tôi gửi trái cây tươi sạch tới bạn nhanh nhất.</p>
                </div>
                <div class="col-md-3 text-right d-none d-md-block">
                    <i class="fas fa-shipping-fast text-warning" style="font-size: 80px; opacity: 0.25; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15));"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Alerts -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-lg shadow-xs border-0 mb-4 py-3" role="alert" style="border-left: 5px solid #dc3545; background-color: #fff5f5;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle fa-2x text-danger mr-3"></i>
                <div>
                    <h6 class="font-weight-bold text-danger mb-1">Vui lòng sửa các lỗi sau để hoàn tất đặt hàng:</h6>
                    <ul class="mb-0 pl-3 small font-weight-bold text-secondary">
                        <?php foreach ($errors as $field => $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close" style="top: 50%; transform: translateY(-50%); opacity: 0.8;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Billing/Shipping Form -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-4">
                <h5 class="text-dark font-weight-bold mb-4 pb-2 border-bottom">
                    <i class="fas fa-user-edit text-success mr-2"></i>Thông tin giao hàng
                </h5>
                
                <form action="<?= BASE_URL ?>Product/processCheckout" method="POST">
                    
                    <div class="form-row">
                        <!-- Customer Name -->
                        <div class="form-group col-md-12">
                            <label for="customer_name" class="font-weight-bold text-dark"><i class="far fa-user mr-1 text-muted"></i>Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-pill <?php echo isset($errors['customer_name']) ? 'is-invalid' : ''; ?>" id="customer_name" name="customer_name" placeholder="Ví dụ: Nguyễn Văn A" value="<?php echo htmlspecialchars($_POST['customer_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                            <?php if (isset($errors['customer_name'])): ?>
                                <div class="invalid-feedback ml-2 font-weight-bold"><?php echo $errors['customer_name']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Phone -->
                        <div class="form-group col-md-6">
                            <label for="phone" class="font-weight-bold text-dark"><i class="fas fa-phone-alt mr-1 text-muted"></i>Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control rounded-pill <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>" id="phone" name="phone" placeholder="Ví dụ: 0987654321" value="<?php echo htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                            <?php if (isset($errors['phone'])): ?>
                                <div class="invalid-feedback ml-2 font-weight-bold"><?php echo $errors['phone']; ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Email -->
                        <div class="form-group col-md-6">
                            <label for="email" class="font-weight-bold text-dark"><i class="far fa-envelope mr-1 text-muted"></i>Địa chỉ Email</label>
                            <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Ví dụ: a@gmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address" class="font-weight-bold text-dark"><i class="fas fa-map-marker-alt mr-1 text-muted"></i>Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                        <textarea class="form-control rounded-lg <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" id="address" name="address" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..." required style="border-radius: 15px !important; resize: none;"><?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback ml-2 font-weight-bold"><?php echo $errors['address']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Order Notes -->
                    <div class="form-group">
                        <label for="notes" class="font-weight-bold text-dark"><i class="far fa-comment-dots mr-1 text-muted"></i>Ghi chú giao hàng</label>
                        <textarea class="form-control rounded-lg" id="notes" name="notes" rows="2" placeholder="Ghi chú về thời gian giao hàng, chỉ dẫn đường đi..." style="border-radius: 15px !important; resize: none;"><?php echo htmlspecialchars($_POST['notes'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <!-- Payment Method -->
                    <h5 class="text-dark font-weight-bold mt-4 mb-3 pb-2 border-bottom">
                        <i class="fas fa-wallet text-success mr-2"></i>Phương thức thanh toán
                    </h5>
                    
                    <div class="form-group">
                        <!-- COD Option -->
                        <div class="custom-control custom-radio p-3 border rounded-lg mb-2 bg-light select-payment shadow-xs" style="cursor: pointer; border-radius: 12px !important; transition: all 0.2s;">
                            <input type="radio" id="payment_cod" name="payment_method" value="cod" class="custom-control-input" checked>
                            <label class="custom-control-label font-weight-bold text-dark" for="payment_cod" style="cursor: pointer;">
                                <i class="fas fa-money-bill-wave text-success mr-2"></i>Thanh toán khi nhận hàng (COD)
                            </label>
                            <p class="text-muted small mb-0 mt-1 pl-4">Thanh toán bằng tiền mặt trực tiếp cho nhân viên giao hàng khi bạn đã nhận và kiểm tra trái cây đầy đủ.</p>
                        </div>
                        
                        <!-- Bank Transfer Option -->
                        <div class="custom-control custom-radio p-3 border rounded-lg bg-light select-payment shadow-xs" style="cursor: pointer; border-radius: 12px !important; transition: all 0.2s;">
                            <input type="radio" id="payment_bank" name="payment_method" value="bank_transfer" class="custom-control-input">
                            <label class="custom-control-label font-weight-bold text-dark" for="payment_bank" style="cursor: pointer;">
                                <i class="fas fa-university text-info mr-2"></i>Chuyển khoản qua ngân hàng
                            </label>
                            <p class="text-muted small mb-0 mt-1 pl-4">Nhận thông tin số tài khoản của Fruit Store ở màn hình tiếp theo và tiến hành chuyển khoản nhanh 24/7.</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 d-flex justify-content-between align-items-center">
                        <a href="<?= BASE_URL ?>Product/cart" class="btn btn-outline-success font-weight-bold rounded-pill px-4 py-2" style="transition: all 0.25s;">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại giỏ hàng
                        </a>
                        <button type="submit" class="btn btn-success font-weight-bold rounded-pill px-5 py-2 shadow hover-up" style="transition: all 0.25s;">
                            <i class="fas fa-check-circle mr-2"></i>Đặt hàng ngay
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Order Summary Checklist -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-lg overflow-hidden bg-white position-sticky" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="text-dark font-weight-bold mb-4 pb-2 border-bottom">
                        <i class="fas fa-shopping-basket text-success mr-2"></i>Tóm tắt giỏ hàng
                    </h5>
                    
                    <div class="mb-4" style="max-height: 280px; overflow-y: auto;">
                        <?php 
                        $totalPrice = 0;
                        foreach ($cart as $id => $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $totalPrice += $subtotal;
                        ?>
                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                <div class="rounded overflow-hidden bg-light border mr-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="<?= BASE_URL ?><?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" class="w-100 h-100" style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center h-100 text-muted bg-light">
                                            <i class="fas fa-image" style="font-size: 12px; opacity: 0.4;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <h6 class="font-weight-bold text-dark text-truncate mb-0" title="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                    <span class="text-muted small">Số lượng: <?php echo $item['quantity']; ?> x <?php echo number_format($item['price'], 0, ',', '.'); ?> đ</span>
                                </div>
                                <div class="text-right pl-2 font-weight-bold text-dark" style="flex-shrink: 0;">
                                    <?php echo number_format($subtotal, 0, ',', '.'); ?> đ
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Tổng tiền hàng:</span>
                        <span class="font-weight-bold text-dark"><?php echo number_format($totalPrice, 0, ',', '.'); ?> đ</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Phí vận chuyển:</span>
                        <span class="text-success font-weight-bold">Miễn phí <i class="fas fa-shipping-fast ml-1"></i></span>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold text-dark" style="font-size: 1.1rem;">Tổng thanh toán:</span>
                        <h3 class="text-danger font-weight-bold mb-0">
                            <?php echo number_format($totalPrice, 0, ',', '.'); ?> <span class="small font-weight-bold" style="font-size: 14px;">đ</span>
                        </h3>
                    </div>
                    
                    <div class="p-3 bg-light rounded-lg border mt-4 text-secondary small" style="border-radius: 12px !important; line-height: 1.5;">
                        <i class="fas fa-info-circle text-info mr-2"></i> Bằng việc nhấn nút "Đặt hàng ngay", bạn đồng ý các điều khoản bán hàng của Fruit Store. Trái cây sẽ được giao trong vòng 2-4 giờ tùy khu vực.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .select-payment:hover {
        border-color: var(--primary) !important;
        background-color: var(--primary-light) !important;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: var(--primary) !important;
        background-color: var(--primary) !important;
    }
    .hover-up:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3) !important;
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cho phép click vào cả div bọc ngoài để tích chọn radio button thanh toán
    const selectPaymentDivs = document.querySelectorAll('.select-payment');
    selectPaymentDivs.forEach(div => {
        div.addEventListener('click', function(e) {
            const radio = this.querySelector('input[type="radio"]');
            if (radio && e.target !== radio && !radio.contains(e.target)) {
                radio.checked = true;
            }
        });
    });
});
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
