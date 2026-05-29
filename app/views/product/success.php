<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; 
$order = $_SESSION['order_success'] ?? null;
if (!$order) {
    header('Location: /bai1/Product/');
    return;
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-lg overflow-hidden bg-white">
                
                <!-- Success Header -->
                <div class="text-white text-center py-5 position-relative" style="background: linear-gradient(135deg, #0d2816 0%, #28a745 100%);">
                    <div style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.03); border-radius: 50%; top: -100px; right: -50px; pointer-events: none;"></div>
                    <div style="position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.04); border-radius: 50%; bottom: -50px; left: 5%; pointer-events: none;"></div>
                    
                    <div class="position-relative" style="z-index: 2;">
                        <!-- Animated Checkmark Icon using CSS -->
                        <div class="checkmark-wrapper mb-4">
                            <div class="checkmark-circle">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bold mb-2">ĐẶT HÀNG THÀNH CÔNG!</h2>
                        <p class="lead mb-0 text-light" style="opacity: 0.9;">Cảm ơn bạn đã tin tưởng lựa chọn mua sắm tại Fruit Store.</p>
                    </div>
                </div>

                <!-- Invoice Content -->
                <div class="card-body p-5 bg-white">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <span class="text-muted d-block small mb-1">MÃ ĐƠN HÀNG CỦA BẠN</span>
                        <h4 class="font-weight-bold text-success">#FS-<?php echo str_pad($order['order_id'], 6, '0', STR_PAD_LEFT); ?></h4>
                    </div>

                    <h5 class="text-dark font-weight-bold mb-3"><i class="fas fa-file-invoice text-success mr-2"></i>Thông tin hóa đơn đặt hàng</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-striped rounded-lg overflow-hidden">
                            <tbody>
                                <tr>
                                    <th scope="row" class="bg-light font-weight-bold text-dark" style="width: 35%;">Khách hàng:</th>
                                    <td class="text-dark font-weight-bold"><?php echo htmlspecialchars($order['customer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light font-weight-bold text-dark">Số điện thoại:</th>
                                    <td class="text-dark"><?php echo htmlspecialchars($order['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light font-weight-bold text-dark">Địa chỉ nhận hàng:</th>
                                    <td class="text-dark"><?php echo htmlspecialchars($order['address'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light font-weight-bold text-dark">Thanh toán qua:</th>
                                    <td class="text-dark font-weight-bold text-uppercase">
                                        <?php 
                                        if ($order['payment_method'] === 'cod') {
                                            echo '<span class="badge badge-success px-3 py-2 rounded-pill"><i class="fas fa-money-bill-wave mr-1 text-warning"></i> COD (Khi nhận hàng)</span>';
                                        } else {
                                            echo '<span class="badge badge-info px-3 py-2 rounded-pill"><i class="fas fa-university mr-1 text-warning"></i> Chuyển khoản ngân hàng</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light font-weight-bold text-dark">Tổng giá trị đơn hàng:</th>
                                    <td class="text-danger font-weight-bold text-lg" style="font-size: 1.15rem;">
                                        <?php echo number_format($order['total_price'], 0, ',', '.'); ?> đ
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Payment Bank Details if Bank Transfer -->
                    <?php if ($order['payment_method'] === 'bank_transfer'): ?>
                        <div class="card border-info rounded-lg bg-light p-4 mb-4" style="border-radius: 15px !important; border-left: 5px solid #17a2b8 !important;">
                            <h6 class="text-info font-weight-bold mb-3"><i class="fas fa-university mr-2"></i>Thông tin chuyển khoản ngân hàng</h6>
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <ul class="list-unstyled mb-0 font-weight-bold text-secondary small" style="line-height: 1.8;">
                                        <li>Ngân hàng: <span class="text-dark">MB BANK (Ngân hàng Quân Đội)</span></li>
                                        <li>Số tài khoản: <span class="text-danger font-weight-bold">0988 888 888 888</span></li>
                                        <li>Chủ tài khoản: <span class="text-dark">CONG TY FRUIT STORE VIET NAM</span></li>
                                        <li>Số tiền: <span class="text-danger font-weight-bold"><?php echo number_format($order['total_price'], 0, ',', '.'); ?> đ</span></li>
                                        <li>Nội dung chuyển khoản: <span class="text-info">FS <?php echo $order['order_id']; ?></span></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 text-center mt-3 mt-md-0 border-left-0 border-md-left">
                                    <div class="p-2 bg-white rounded border d-inline-block shadow-sm">
                                        <i class="fas fa-qrcode fa-5x text-dark" style="opacity: 0.85;"></i>
                                        <span class="d-block small text-muted font-weight-bold mt-1" style="font-size: 9px;">QUÉT MÃ QR MB BANK</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="p-3 bg-light rounded-lg border text-center text-secondary small mb-4" style="border-radius: 12px !important; line-height: 1.5;">
                        <i class="fas fa-check-circle text-success mr-1"></i> Nhân viên chăm sóc khách hàng của Fruit Store sẽ liên hệ qua điện thoại để xác nhận lại đơn hàng trong vòng 10 phút.
                    </div>

                    <!-- Footer Actions -->
                    <div class="text-center pt-2">
                        <a href="<?= BASE_URL ?>Product/" class="btn btn-success btn-lg font-weight-bold px-5 py-3 rounded-pill shadow-sm hover-up" style="transition: all 0.25s;">
                            <i class="fas fa-shopping-basket mr-2"></i>Quay lại trang sản phẩm
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* CSS checkmark animation */
    .checkmark-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .checkmark-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    
    .checkmark-circle i {
        color: #28a745;
        font-size: 38px;
        animation: checkmarkGrow 0.3s ease-in-out 0.4s both;
    }

    .hover-up:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3) !important;
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    
    @keyframes checkmarkGrow {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @media (min-width: 768px) {
        .border-md-left {
            border-left: 1px solid #dee2e6 !important;
        }
    }
</style>

<?php 
// Làm sạch mốc đơn hàng sau khi hoàn tất hiển thị để tránh tải lại trang vô tình
unset($_SESSION['order_success']); 
?>
<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
