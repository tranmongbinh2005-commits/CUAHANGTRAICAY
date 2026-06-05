<?php include dirname(dirname(__DIR__)) . '/shares/header.php';
$order = $_SESSION['order_success'] ?? null;
if (!$order) {
    header('Location: ' . BASE_URL . 'Product');
    return;
}
?>

<style>
/* ── Success page styles ── */
.success-wrapper {
    max-width: 720px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

/* Hero banner */
.success-hero {
    background: linear-gradient(135deg, #0a3d1e 0%, #1a6b36 50%, #0d2816 100%);
    border: 1px solid rgba(0,208,132,0.2);
    border-radius: 20px 20px 0 0;
    padding: 3rem 2rem 2.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.success-hero::before {
    content: '';
    position: absolute;
    width: 350px; height: 350px;
    background: rgba(0,208,132,0.05);
    border-radius: 50%;
    top: -150px; right: -80px;
    pointer-events: none;
}
.success-hero::after {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    background: rgba(251,191,36,0.04);
    border-radius: 50%;
    bottom: -80px; left: 5%;
    pointer-events: none;
}

.checkmark-circle {
    width: 88px; height: 88px;
    border-radius: 50%;
    background: rgba(0,208,132,0.15);
    border: 3px solid var(--primary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.2rem;
    box-shadow: 0 0 40px rgba(0,208,132,0.3);
    animation: popIn 0.55s cubic-bezier(0.175,0.885,0.32,1.275) forwards;
}
.checkmark-circle i {
    font-size: 38px;
    color: var(--primary);
    animation: fadeCheck 0.3s ease 0.45s both;
}
@keyframes popIn {
    0%   { transform: scale(0); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
@keyframes fadeCheck {
    0%   { transform: scale(0.5); opacity: 0; }
    100% { transform: scale(1);   opacity: 1; }
}

/* Card body */
.success-body {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-top: none;
    border-radius: 0 0 20px 20px;
    padding: 2rem 2.5rem;
}
@media (max-width: 576px) { .success-body { padding: 1.5rem 1rem; } }

/* Order ID badge */
.order-id-badge {
    display: inline-block;
    background: rgba(0,208,132,0.1);
    border: 1px solid rgba(0,208,132,0.3);
    border-radius: 999px;
    padding: 0.4rem 1.4rem;
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--primary);
    font-family: var(--font-heading);
    letter-spacing: 1px;
}
.order-id-label {
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 0.4rem;
    display: block;
}

/* Info table */
.info-section-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border-glass);
}

.info-table { width: 100%; }
.info-table tr { border-bottom: 1px solid var(--border-card); }
.info-table tr:last-child { border-bottom: none; }
.info-table td, .info-table th {
    padding: 0.75rem 0.6rem;
    vertical-align: middle;
    font-size: 0.9rem;
}
.info-table th {
    color: var(--text-muted);
    font-weight: 600;
    width: 38%;
    white-space: nowrap;
}
.info-table td {
    color: var(--text-primary);
    font-weight: 500;
}

/* Payment method badge */
.pay-badge-cod {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(0,208,132,0.1);
    border: 1px solid rgba(0,208,132,0.25);
    border-radius: 999px;
    padding: 4px 14px;
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--primary);
}
.pay-badge-bank {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(56,189,248,0.1);
    border: 1px solid rgba(56,189,248,0.25);
    border-radius: 999px;
    padding: 4px 14px;
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--info);
}

/* Total amount */
.total-row td {
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--accent) !important;
}

/* Bank transfer card */
.bank-card {
    background: rgba(56,189,248,0.05);
    border: 1px solid rgba(56,189,248,0.2);
    border-radius: 14px;
    padding: 1.3rem 1.5rem;
    margin: 1.5rem 0;
}
.bank-card-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--info);
    margin-bottom: 1rem;
    display: flex; align-items: center; gap: 6px;
}
.bank-info-list { list-style: none; padding: 0; margin: 0; }
.bank-info-list li {
    font-size: 0.88rem;
    color: var(--text-secondary);
    padding: 0.3rem 0;
    display: flex; gap: 6px;
}
.bank-info-list li span { color: var(--text-primary); font-weight: 600; }
.bank-info-list li .highlight { color: var(--danger); font-weight: 800; }

/* QR box */
.qr-box {
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--border-card);
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
}
.qr-box i { color: var(--text-secondary); opacity: 0.6; }
.qr-box small { color: var(--text-muted); font-size: 10px; display: block; margin-top: 6px; }

/* Note box */
.note-box {
    background: rgba(0,208,132,0.05);
    border: 1px solid rgba(0,208,132,0.15);
    border-radius: 12px;
    padding: 0.9rem 1.2rem;
    font-size: 0.83rem;
    color: var(--text-secondary);
    line-height: 1.55;
    margin: 1.5rem 0;
}
</style>

<div class="container py-5 fade-in-up">
    <div class="success-wrapper">

        <!-- Hero -->
        <div class="success-hero">
            <div style="position: relative; z-index: 2;">
                <div class="checkmark-circle">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="font-weight-bold mb-2" style="color: #fff; font-family: var(--font-heading); font-size: 1.8rem; letter-spacing: -0.5px;">
                    ĐẶT HÀNG THÀNH CÔNG!
                </h2>
                <p class="mb-0" style="color: rgba(255,255,255,0.75); font-size: 0.95rem;">
                    Cảm ơn bạn đã tin tưởng lựa chọn mua sắm tại Fruit Store.
                </p>
            </div>
        </div>

        <!-- Body -->
        <div class="success-body">

            <!-- Order ID -->
            <div class="text-center mb-4 pb-3" style="border-bottom: 1px solid var(--border-glass);">
                <span class="order-id-label">MÃ ĐƠN HÀNG CỦA BẠN</span>
                <div class="order-id-badge">
                    #FS-<?php echo str_pad($order['order_id'], 6, '0', STR_PAD_LEFT); ?>
                </div>
            </div>

            <!-- Invoice info -->
            <div class="info-section-title">
                <i class="fas fa-file-invoice" style="color: var(--primary);"></i>
                Thông tin hóa đơn đặt hàng
            </div>

            <table class="info-table mb-4">
                <tbody>
                    <tr>
                        <th>Khách hàng:</th>
                        <td><?php echo htmlspecialchars($order['customer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại:</th>
                        <td><?php echo htmlspecialchars($order['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ nhận hàng:</th>
                        <td><?php echo htmlspecialchars($order['address'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th>Thanh toán qua:</th>
                        <td>
                            <?php if ($order['payment_method'] === 'cod'): ?>
                                <span class="pay-badge-cod">
                                    <i class="fas fa-money-bill-wave"></i> COD (Khi nhận hàng)
                                </span>
                            <?php else: ?>
                                <span class="pay-badge-bank">
                                    <i class="fas fa-university"></i> Chuyển khoản ngân hàng
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="total-row">
                        <th style="color: var(--text-secondary);">Tổng giá trị đơn hàng:</th>
                        <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?> đ</td>
                    </tr>
                </tbody>
            </table>

            <!-- Bank transfer info -->
            <?php if ($order['payment_method'] === 'bank_transfer'): ?>
                <div class="bank-card">
                    <div class="bank-card-title">
                        <i class="fas fa-university"></i>
                        Thông tin chuyển khoản ngân hàng
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <ul class="bank-info-list">
                                <li>Ngân hàng: <span>MB BANK (Ngân hàng Quân Đội)</span></li>
                                <li>Số tài khoản: <span class="highlight">0988 888 888 888</span></li>
                                <li>Chủ tài khoản: <span>CONG TY FRUIT STORE VIET NAM</span></li>
                                <li>Số tiền: <span class="highlight"><?php echo number_format($order['total_price'], 0, ',', '.'); ?> đ</span></li>
                                <li>Nội dung CK: <span style="color: var(--info);">FS <?php echo $order['order_id']; ?></span></li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-center mt-3 mt-md-0">
                            <div class="qr-box">
                                <i class="fas fa-qrcode fa-4x"></i>
                                <small>QUÉT MÃ QR MB BANK</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Note -->
            <div class="note-box">
                <i class="fas fa-check-circle mr-2" style="color: var(--primary);"></i>
                Nhân viên chăm sóc khách hàng của Fruit Store sẽ liên hệ qua điện thoại để xác nhận lại đơn hàng trong vòng 10 phút.
            </div>

            <!-- CTA -->
            <div class="text-center pt-2">
                <a href="<?= BASE_URL ?>Product/"
                   class="btn btn-success btn-lg font-weight-bold px-5 py-3 rounded-pill shadow"
                   style="font-size: 1rem; letter-spacing: 0.02em;">
                    <i class="fas fa-shopping-basket mr-2"></i>Quay lại trang sản phẩm
                </a>
            </div>

        </div><!-- .success-body -->
    </div>
</div>

<?php
// Xóa session đơn hàng sau khi hiển thị xong
unset($_SESSION['order_success']);
?>
<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
