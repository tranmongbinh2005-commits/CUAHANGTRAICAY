<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<style>
/* ── Checkout-specific styles ── */
.checkout-hero {
    background: linear-gradient(135deg, #0d2816 0%, #1c522b 60%, #0d2816 100%);
    border: 1px solid rgba(0,208,132,0.12);
    border-radius: 18px;
    padding: 2.5rem 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}
.checkout-hero::before {
    content: '';
    position: absolute;
    width: 320px; height: 320px;
    background: rgba(0,208,132,0.04);
    border-radius: 50%;
    top: -120px; right: -60px;
    pointer-events: none;
}

.checkout-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: var(--radius-card);
    box-shadow: var(--shadow-card);
    padding: 1.75rem;
}
.checkout-card .section-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-glass);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Form labels override (since header.php uppercases labels) */
.checkout-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--text-secondary);
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-bottom: 6px;
    display: block;
}

/* Payment options */
.payment-option {
    background: rgba(0,0,0,0.2);
    border: 1px solid var(--border-card);
    border-radius: 12px;
    padding: 1rem 1.2rem;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 0.6rem;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
.payment-option:hover {
    border-color: rgba(0,208,132,0.35);
    background: rgba(0,208,132,0.04);
}
.payment-option input[type="radio"] { margin-top: 3px; flex-shrink: 0; accent-color: var(--primary); }
.payment-option-label { cursor: pointer; }
.payment-option-label strong { color: var(--text-primary); font-size: 0.9rem; display: block; margin-bottom: 3px; }
.payment-option-label small { color: var(--text-muted); font-size: 0.8rem; line-height: 1.4; }
.payment-option.active {
    border-color: var(--primary);
    background: rgba(0,208,132,0.07);
    box-shadow: 0 0 0 2px rgba(0,208,132,0.15);
}

/* Summary card */
.summary-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: var(--radius-card);
    box-shadow: var(--shadow-card);
    position: sticky;
    top: 20px;
    overflow: hidden;
}
.summary-card-header {
    padding: 1rem 1.4rem;
    background: rgba(0,208,132,0.07);
    border-bottom: 1px solid var(--border-card);
    display: flex; align-items: center; gap: 8px;
}
.summary-card-header h5 { margin: 0; font-size: 0.97rem; color: var(--text-primary); }
.summary-body { padding: 1.3rem 1.4rem; }

.summary-item {
    display: flex; align-items: center; gap: 10px;
    padding: 0.65rem 0;
    border-bottom: 1px solid var(--border-card);
}
.summary-item:last-child { border-bottom: none; }
.summary-item-img {
    width: 44px; height: 44px; border-radius: 8px;
    overflow: hidden; flex-shrink: 0;
    border: 1px solid var(--border-card);
    background: var(--bg-surface);
}
.summary-item-img img { width: 100%; height: 100%; object-fit: cover; }
.summary-item-name { font-size: 0.85rem; font-weight: 600; color: var(--text-primary); flex: 1; }
.summary-item-qty { font-size: 0.78rem; color: var(--text-muted); }
.summary-item-price { font-size: 0.88rem; font-weight: 700; color: var(--primary); white-space: nowrap; }

.summary-totals { padding-top: 0.8rem; }
.summary-row {
    display: flex; justify-content: space-between;
    margin-bottom: 0.6rem; font-size: 0.88rem;
}
.summary-row span:first-child { color: var(--text-muted); }
.summary-row span:last-child { font-weight: 600; color: var(--text-primary); }
.summary-grand-total {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 0.8rem;
    border-top: 1px solid var(--border-glass);
    margin-top: 0.4rem;
}
.grand-label { font-weight: 700; font-size: 0.95rem; color: var(--text-primary); }
.grand-amount {
    font-size: 1.7rem; font-weight: 800;
    color: var(--accent);
    font-family: var(--font-heading);
}
.grand-currency { font-size: 0.9rem; color: var(--text-muted); margin-left: 2px; }

.info-note {
    background: rgba(0,208,132,0.05);
    border: 1px solid rgba(0,208,132,0.15);
    border-radius: 10px;
    padding: 0.7rem 1rem;
    font-size: 0.8rem;
    color: var(--text-muted);
    margin-top: 1rem;
    line-height: 1.5;
}

/* Autofill badge */
.autofill-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(0,208,132,0.1);
    border: 1px solid rgba(0,208,132,0.25);
    border-radius: 999px;
    padding: 2px 10px;
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 1rem;
}
</style>

<div class="container py-4 fade-in-up">

    <!-- Hero -->
    <div class="checkout-hero">
        <div style="position: relative; z-index: 2;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div>
                    <h1 class="font-weight-bold text-warning mb-1"
                        style="font-family: var(--font-heading); font-size: clamp(1.6rem,4vw,2.4rem); letter-spacing: -0.5px;">
                        <i class="fas fa-credit-card mr-2"></i>TIẾN HÀNH ĐẶT HÀNG
                    </h1>
                    <p class="mb-0" style="color: var(--text-secondary); opacity: 0.85; max-width: 500px;">
                        Nhập thông tin giao nhận chính xác để chúng tôi gửi trái cây tươi sạch tới bạn nhanh nhất.
                    </p>
                </div>
                <i class="fas fa-shipping-fast text-warning d-none d-md-block"
                   style="font-size: 70px; opacity: 0.18;"></i>
            </div>
        </div>
    </div>

    <!-- Error Alerts -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle fa-2x mr-3" style="color: var(--danger);"></i>
                <div>
                    <strong style="color: var(--danger);">Vui lòng sửa các lỗi sau:</strong>
                    <ul class="mb-0 pl-3 mt-1" style="font-size: 0.88rem; color: var(--text-secondary);">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Shipping Form -->
        <div class="col-lg-7 mb-4">
            <div class="checkout-card">

                <!-- Auto-fill indicator -->
                <?php if (!empty($userInfo)): ?>
                    <div class="autofill-badge mb-3">
                        <i class="fas fa-magic"></i>
                        Đã tự động điền từ tài khoản: <strong><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></strong>
                    </div>
                <?php endif; ?>

                <div class="section-title">
                    <i class="fas fa-user-edit" style="color: var(--primary);"></i>
                    Thông tin giao hàng
                </div>

                <form action="<?= BASE_URL ?>Product/processCheckout" method="POST">

                    <!-- Customer Name -->
                    <div class="form-group">
                        <label class="checkout-label">
                            <i class="far fa-user mr-1"></i>Họ và tên <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="text"
                               class="form-control rounded-pill <?php echo isset($errors['customer_name']) ? 'is-invalid' : ''; ?>"
                               id="customer_name" name="customer_name"
                               placeholder="Ví dụ: Nguyễn Văn A"
                               value="<?php echo htmlspecialchars(!empty($_POST['customer_name']) ? $_POST['customer_name'] : ($userInfo->fullname ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                               required>
                        <?php if (isset($errors['customer_name'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['customer_name']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-row">
                        <!-- Phone -->
                        <div class="form-group col-md-6">
                            <label class="checkout-label">
                                <i class="fas fa-phone-alt mr-1"></i>Số điện thoại <span style="color: var(--danger);">*</span>
                            </label>
                            <input type="tel"
                                   class="form-control rounded-pill <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                                   id="phone" name="phone"
                                   placeholder="Ví dụ: 0987654321"
                                   value="<?php echo htmlspecialchars(!empty($_POST['phone']) ? $_POST['phone'] : ($userInfo->phone ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                                   required>
                            <?php if (isset($errors['phone'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['phone']; ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="form-group col-md-6">
                            <label class="checkout-label">
                                <i class="far fa-envelope mr-1"></i>Địa chỉ Email
                            </label>
                            <input type="email"
                                   class="form-control rounded-pill"
                                   id="email" name="email"
                                   placeholder="Ví dụ: a@gmail.com"
                                   value="<?php echo htmlspecialchars(!empty($_POST['email']) ? $_POST['email'] : ($userInfo->email ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label class="checkout-label">
                            <i class="fas fa-map-marker-alt mr-1"></i>Địa chỉ nhận hàng <span style="color: var(--danger);">*</span>
                        </label>
                        <textarea class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>"
                                  id="address" name="address"
                                  rows="3"
                                  placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..."
                                  required
                                  style="border-radius: 14px !important; resize: none;"><?php echo htmlspecialchars(!empty($_POST['address']) ? $_POST['address'] : ($userInfo->address ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['address']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Notes -->
                    <div class="form-group">
                        <label class="checkout-label">
                            <i class="far fa-comment-dots mr-1"></i>Ghi chú giao hàng
                        </label>
                        <textarea class="form-control"
                                  id="notes" name="notes"
                                  rows="2"
                                  placeholder="Ghi chú về thời gian giao hàng, chỉ dẫn đường đi..."
                                  style="border-radius: 14px !important; resize: none;"><?php echo htmlspecialchars($_POST['notes'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="section-title mt-4">
                        <i class="fas fa-wallet" style="color: var(--primary);"></i>
                        Phương thức thanh toán
                    </div>

                    <div class="payment-option active" id="wrap-cod" onclick="selectPayment('cod', this)">
                        <input type="radio" id="payment_cod" name="payment_method" value="cod" checked>
                        <label class="payment-option-label" for="payment_cod">
                            <strong><i class="fas fa-money-bill-wave mr-2" style="color: var(--primary);"></i>Thanh toán khi nhận hàng (COD)</strong>
                            <small>Thanh toán bằng tiền mặt trực tiếp cho nhân viên giao hàng khi bạn đã nhận và kiểm tra trái cây đầy đủ.</small>
                        </label>
                    </div>

                    <div class="payment-option" id="wrap-bank" onclick="selectPayment('bank_transfer', this)">
                        <input type="radio" id="payment_bank" name="payment_method" value="bank_transfer">
                        <label class="payment-option-label" for="payment_bank">
                            <strong><i class="fas fa-university mr-2" style="color: var(--info);"></i>Chuyển khoản qua ngân hàng</strong>
                            <small>Nhận thông tin số tài khoản Fruit Store ở màn hình tiếp theo và chuyển khoản nhanh 24/7.</small>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <a href="<?= BASE_URL ?>Product/cart"
                           class="btn btn-outline-success rounded-pill px-4 font-weight-bold"
                           style="font-size: 0.88rem;">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại giỏ hàng
                        </a>
                        <button type="submit"
                                class="btn btn-success rounded-pill px-5 font-weight-bold shadow"
                                style="font-size: 0.95rem;">
                            <i class="fas fa-check-circle mr-2"></i>Đặt hàng ngay
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="summary-card">
                <div class="summary-card-header">
                    <i class="fas fa-shopping-basket" style="color: var(--primary);"></i>
                    <h5>Tóm tắt giỏ hàng</h5>
                </div>
                <div class="summary-body">

                    <!-- Items list -->
                    <div style="max-height: 260px; overflow-y: auto; margin-bottom: 1rem;">
                        <?php
                        $totalPrice = 0;
                        foreach ($cart as $id => $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $totalPrice += $subtotal;
                        ?>
                            <div class="summary-item">
                                <div class="summary-item-img">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="<?= BASE_URL ?><?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="fas fa-image" style="color: var(--text-muted); opacity: 0.4; font-size: 14px;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1" style="min-width: 0;">
                                    <div class="summary-item-name text-truncate"
                                         title="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </div>
                                    <div class="summary-item-qty">x <?php echo $item['quantity']; ?></div>
                                </div>
                                <div class="summary-item-price">
                                    <?php echo number_format($subtotal, 0, ',', '.'); ?>&nbsp;đ
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Totals -->
                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Tổng tiền hàng:</span>
                            <span><?php echo number_format($totalPrice, 0, ',', '.'); ?> đ</span>
                        </div>
                        <div class="summary-row">
                            <span>Phí vận chuyển:</span>
                            <span style="color: var(--primary);">Miễn phí <i class="fas fa-shipping-fast ml-1"></i></span>
                        </div>
                        <div class="summary-grand-total">
                            <span class="grand-label">Tổng thanh toán:</span>
                            <div>
                                <span class="grand-amount"><?php echo number_format($totalPrice, 0, ',', '.'); ?></span>
                                <span class="grand-currency">đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-note">
                        <i class="fas fa-info-circle mr-1" style="color: var(--primary);"></i>
                        Bằng việc nhấn "Đặt hàng ngay", bạn đồng ý các điều khoản bán hàng của Fruit Store. Trái cây sẽ được giao trong vòng 2–4 giờ tùy khu vực.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectPayment(value, el) {
    document.querySelectorAll('.payment-option').forEach(d => d.classList.remove('active'));
    el.classList.add('active');
    el.querySelector('input[type="radio"]').checked = true;
}
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
