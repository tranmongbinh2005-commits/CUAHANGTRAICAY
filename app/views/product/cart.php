<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<style>
/* ── Cart-specific overrides ── */
.cart-hero {
    background: linear-gradient(135deg, #0d2816 0%, #1c522b 60%, #0d2816 100%);
    border: 1px solid rgba(0,208,132,0.12);
    border-radius: 18px;
    padding: 2.5rem 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}
.cart-hero::before {
    content: '';
    position: absolute;
    width: 320px; height: 320px;
    background: rgba(0,208,132,0.04);
    border-radius: 50%;
    top: -120px; right: -60px;
    pointer-events: none;
}
.cart-hero::after {
    content: '';
    position: absolute;
    width: 180px; height: 180px;
    background: rgba(251,191,36,0.03);
    border-radius: 50%;
    bottom: -60px; left: 5%;
    pointer-events: none;
}

.cart-table-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: var(--radius-card);
    overflow: hidden;
    box-shadow: var(--shadow-card);
}
.cart-table-card .card-header-custom {
    background: rgba(0,208,132,0.06);
    border-bottom: 1px solid var(--border-glass);
    padding: 1rem 1.5rem;
    display: flex; align-items: center; gap: 10px;
}
.cart-table-card .card-header-custom h5 {
    margin: 0; font-size: 1rem;
    color: var(--text-primary);
}

.cart-table { width: 100%; border-collapse: collapse; }
.cart-table thead tr {
    background: rgba(0,208,132,0.07);
    border-bottom: 1px solid var(--border-glass);
}
.cart-table thead th {
    padding: 0.85rem 1rem;
    font-size: 0.75rem;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    font-weight: 700;
    color: var(--primary);
}
.cart-table tbody tr {
    border-bottom: 1px solid var(--border-card);
    transition: background 0.2s;
}
.cart-table tbody tr:last-child { border-bottom: none; }
.cart-table tbody tr:hover { background: rgba(0,208,132,0.03); }
.cart-table td { padding: 1rem; vertical-align: middle; color: var(--text-primary); }

.product-thumb {
    width: 64px; height: 64px; border-radius: 10px;
    overflow: hidden; flex-shrink: 0;
    border: 1px solid var(--border-card);
    background: var(--bg-surface);
}
.product-thumb img { width: 100%; height: 100%; object-fit: cover; }

.qty-control {
    display: inline-flex; align-items: center; gap: 0;
    border: 1px solid var(--border-glass);
    border-radius: 999px;
    overflow: hidden;
    background: rgba(0,0,0,0.2);
}
.qty-btn {
    background: rgba(0,208,132,0.1);
    border: none;
    color: var(--primary);
    width: 32px; height: 32px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.2s;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.qty-btn:hover { background: rgba(0,208,132,0.25); }
.qty-input {
    width: 44px;
    background: transparent;
    border: none;
    color: var(--text-primary);
    text-align: center;
    font-weight: 700;
    font-size: 0.9rem;
    outline: none;
    -moz-appearance: textfield;
}
.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button { -webkit-appearance: none; }

.delete-btn {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: rgba(248,113,113,0.1);
    border: 1px solid rgba(248,113,113,0.2);
    color: var(--danger);
    display: inline-flex; align-items: center; justify-content: center;
    transition: all 0.2s;
    font-size: 0.75rem;
    text-decoration: none;
}
.delete-btn:hover {
    background: rgba(248,113,113,0.22);
    border-color: var(--danger);
    color: var(--danger);
    transform: scale(1.12);
}

.cart-footer-actions {
    display: flex; justify-content: space-between; align-items: center;
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-card);
    background: rgba(0,0,0,0.15);
}

/* Summary card */
.summary-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: var(--radius-card);
    box-shadow: var(--shadow-card);
    position: sticky; top: 20px;
}
.summary-card-header {
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--border-card);
    background: rgba(0,208,132,0.06);
    border-radius: var(--radius-card) var(--radius-card) 0 0;
    display: flex; align-items: center; gap: 8px;
}
.summary-body { padding: 1.4rem 1.5rem; }
.summary-row {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 0.85rem; font-size: 0.9rem;
}
.summary-row span:first-child { color: var(--text-muted); }
.summary-row span:last-child { font-weight: 600; color: var(--text-primary); }
.summary-total {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 1rem; border-top: 1px solid var(--border-glass);
    margin-bottom: 1.4rem;
}
.total-label { font-weight: 700; color: var(--text-primary); font-size: 0.95rem; }
.total-amount {
    font-size: 1.65rem; font-weight: 800;
    color: var(--accent);
    font-family: var(--font-heading);
}
.total-currency { font-size: 0.9rem; font-weight: 600; margin-left: 2px; }

/* Empty cart */
.empty-cart-box {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: var(--radius-card);
    box-shadow: var(--shadow-card);
}
.empty-cart-icon {
    font-size: 5rem;
    color: var(--text-muted);
    opacity: 0.3;
    margin-bottom: 1.5rem;
}

/* Toast notification */
#cart-toast {
    position: fixed;
    bottom: 2rem; right: 2rem;
    z-index: 9999;
    background: var(--bg-card);
    border: 1px solid var(--primary);
    border-radius: 14px;
    padding: 0.9rem 1.5rem;
    box-shadow: 0 8px 30px rgba(0,208,132,0.2);
    display: flex; align-items: center; gap: 10px;
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    pointer-events: none;
    min-width: 260px;
}
#cart-toast.show {
    transform: translateY(0);
    opacity: 1;
}
#cart-toast .toast-icon { color: var(--primary); font-size: 1.2rem; }
#cart-toast .toast-text { color: var(--text-primary); font-weight: 600; font-size: 0.9rem; }
</style>

<div class="container py-4 fade-in-up">

    <!-- Hero Banner -->
    <div class="cart-hero">
        <div style="position: relative; z-index: 2;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div>
                    <h1 class="font-weight-bold text-warning mb-1" style="font-family: var(--font-heading); font-size: clamp(1.6rem,4vw,2.4rem); letter-spacing: -0.5px;">
                        <i class="fas fa-shopping-cart mr-2"></i>GIỎ HÀNG CỦA BẠN
                    </h1>
                    <p class="mb-0" style="color: var(--text-secondary); opacity: 0.85; max-width: 500px;">
                        Xem lại danh sách trái cây bạn đã chọn trước khi tiến hành thanh toán.
                    </p>
                </div>
                <i class="fas fa-shopping-basket text-warning d-none d-md-block" style="font-size: 70px; opacity: 0.18;"></i>
            </div>
        </div>
    </div>

    <?php if (!empty($cart)): ?>
        <form action="<?= BASE_URL ?>Product/updateCart" method="POST" id="cartForm">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8 mb-4">
                    <div class="cart-table-card">
                        <div class="card-header-custom">
                            <i class="fas fa-list" style="color: var(--primary);"></i>
                            <h5>Chi tiết sản phẩm</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="cart-table">
                                <thead>
                                    <tr>
                                        <th class="pl-4">Sản phẩm</th>
                                        <th class="text-center">Đơn giá</th>
                                        <th class="text-center" style="width: 140px;">Số lượng</th>
                                        <th class="text-right">Thành tiền</th>
                                        <th class="text-center" style="width: 70px;">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalPrice = 0;
                                    foreach ($cart as $id => $item):
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $totalPrice += $subtotal;
                                    ?>
                                        <tr>
                                            <!-- Product -->
                                            <td class="pl-4">
                                                <div class="d-flex align-items-center" style="gap: 12px;">
                                                    <div class="product-thumb">
                                                        <?php if (!empty($item['image'])): ?>
                                                            <img src="<?= BASE_URL ?><?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>">
                                                        <?php else: ?>
                                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                                <i class="fas fa-image" style="color: var(--text-muted); opacity: 0.4;"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold" style="color: var(--text-primary); font-size: 0.93rem; margin-bottom: 4px;">
                                                            <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </div>
                                                        <span style="font-size: 11px; color: var(--text-muted); background: rgba(0,208,132,0.07); border: 1px solid var(--border-card); border-radius: 6px; padding: 1px 7px;">
                                                            ID: <?php echo $id; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Price -->
                                            <td class="text-center font-weight-bold" style="color: var(--text-secondary);">
                                                <?php echo number_format($item['price'], 0, ',', '.'); ?>&nbsp;<span style="font-size: 0.8rem; color: var(--text-muted);">đ</span>
                                            </td>

                                            <!-- Quantity -->
                                            <td class="text-center">
                                                <div class="qty-control mx-auto">
                                                    <button class="qty-btn" type="button" onclick="changeQuantity(<?php echo $id; ?>, -1)">
                                                        <i class="fas fa-minus" style="font-size: 10px;"></i>
                                                    </button>
                                                    <input type="number"
                                                           name="quantities[<?php echo $id; ?>]"
                                                           id="qty-<?php echo $id; ?>"
                                                           class="qty-input"
                                                           value="<?php echo $item['quantity']; ?>"
                                                           min="1" max="100" readonly>
                                                    <button class="qty-btn" type="button" onclick="changeQuantity(<?php echo $id; ?>, 1)">
                                                        <i class="fas fa-plus" style="font-size: 10px;"></i>
                                                    </button>
                                                </div>
                                            </td>

                                            <!-- Subtotal -->
                                            <td class="text-right font-weight-bold" style="color: var(--primary); font-size: 1rem;">
                                                <?php echo number_format($subtotal, 0, ',', '.'); ?>&nbsp;<span style="font-size: 0.8rem;">đ</span>
                                            </td>

                                            <!-- Delete -->
                                            <td class="text-center">
                                                <a href="<?= BASE_URL ?>Product/removeFromCart/<?php echo $id; ?>"
                                                   class="delete-btn"
                                                   title="Xóa khỏi giỏ"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-footer-actions">
                            <a href="<?= BASE_URL ?>Product/" class="btn btn-outline-success rounded-pill px-4 font-weight-bold" style="font-size: 0.88rem;">
                                <i class="fas fa-arrow-left mr-2"></i>Tiếp tục mua hàng
                            </a>
                            <button type="submit" class="btn btn-warning rounded-pill px-4 font-weight-bold shadow-sm" style="font-size: 0.88rem;">
                                <i class="fas fa-sync-alt mr-2"></i>Cập nhật giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="summary-card">
                        <div class="summary-card-header">
                            <i class="fas fa-receipt" style="color: var(--primary);"></i>
                            <h5 class="mb-0 font-weight-bold" style="font-size: 1rem; color: var(--text-primary);">Tóm tắt đơn hàng</h5>
                        </div>
                        <div class="summary-body">
                            <div class="summary-row">
                                <span>Tạm tính (<?php echo count($cart); ?> loại):</span>
                                <span><?php echo number_format($totalPrice, 0, ',', '.'); ?> đ</span>
                            </div>
                            <div class="summary-row">
                                <span>Phí vận chuyển:</span>
                                <span style="color: var(--primary);">Miễn phí <i class="fas fa-shipping-fast ml-1"></i></span>
                            </div>

                            <div class="summary-total">
                                <span class="total-label">Tổng thanh toán:</span>
                                <div>
                                    <span class="total-amount"><?php echo number_format($totalPrice, 0, ',', '.'); ?></span>
                                    <span class="total-currency" style="color: var(--text-muted);">đ</span>
                                </div>
                            </div>

                            <a href="<?= BASE_URL ?>Product/checkout"
                               class="btn btn-success btn-block font-weight-bold py-3 rounded-pill shadow"
                               style="font-size: 1rem; letter-spacing: 0.03em; transition: all 0.3s;">
                                <i class="fas fa-credit-card mr-2"></i>Tiến hành thanh toán
                            </a>

                            <div class="text-center mt-3" style="font-size: 0.8rem; color: var(--text-muted);">
                                <i class="fas fa-shield-alt mr-1" style="color: var(--primary);"></i>
                                Cam kết trái cây sạch 100% an toàn
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    <?php else: ?>
        <!-- Empty Cart -->
        <div class="empty-cart-box fade-in-up">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h4 class="font-weight-bold mb-2" style="color: var(--text-primary);">Giỏ hàng của bạn đang trống!</h4>
            <p style="color: var(--text-muted); max-width: 400px; margin: 0 auto 1.5rem;">
                Hãy lấp đầy giỏ hàng bằng những loại trái cây tươi ngon, giàu dinh dưỡng tại Fruit Store.
            </p>
            <a href="<?= BASE_URL ?>Product/" class="btn btn-success px-5 font-weight-bold rounded-pill shadow-sm" style="font-size: 1rem;">
                <i class="fas fa-shopping-basket mr-2"></i>Mua sắm ngay
            </a>
        </div>
    <?php endif; ?>

</div>

<!-- Toast notification -->
<div id="cart-toast">
    <span class="toast-icon"><i class="fas fa-check-circle"></i></span>
    <span class="toast-text" id="toast-msg">Đã cập nhật số lượng</span>
</div>

<script>
function showToast(msg) {
    const toast = document.getElementById('cart-toast');
    document.getElementById('toast-msg').textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2200);
}

function changeQuantity(id, amount) {
    const input = document.getElementById('qty-' + id);
    if (!input) return;
    let val = parseInt(input.value) + amount;
    if (val >= 1 && val <= 100) {
        input.value = val;
        // Auto-submit to update cart
        document.getElementById('cartForm').submit();
    }
}
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
