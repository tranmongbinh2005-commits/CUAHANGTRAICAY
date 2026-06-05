<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-9">

        <!-- Back -->
        <div class="mb-4 fade-in-up">
            <a href="<?= BASE_URL ?>Product/" class="back-link">
                <i class="fas fa-arrow-left mr-2"></i>Quay về kho sản phẩm
            </a>
        </div>

        <?php if ($product): ?>

        <!-- Product Detail Card -->
        <div class="detail-card fade-in-up" style="animation-delay:0.06s;">

            <div class="row no-gutters">
                <!-- ══ IMAGE PANEL ══ -->
                <div class="col-md-5">
                    <div class="detail-img-panel">
                        <?php if ($product->image): ?>
                            <img src="<?= BASE_URL ?><?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                 class="detail-img"
                                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            <div class="detail-img-placeholder">
                                <i class="fas fa-apple-alt"></i>
                                <span>Chưa có hình ảnh</span>
                            </div>
                        <?php endif; ?>

                        <!-- Floating category badge -->
                        <div class="detail-cat-badge">
                            <i class="fas fa-tag mr-1"></i>
                            <?php echo htmlspecialchars($product->category_name ?? 'Trái cây', ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    </div>
                </div>

                <!-- ══ INFO PANEL ══ -->
                <div class="col-md-7">
                    <div class="detail-info-panel">

                        <!-- ID chip -->
                        <div class="detail-id-chip mb-3">
                            <i class="fas fa-barcode mr-1"></i> SKU #<?php echo str_pad($product->id, 4, '0', STR_PAD_LEFT); ?>
                        </div>

                        <!-- Name -->
                        <h1 class="detail-name">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </h1>

                        <!-- Price block -->
                        <div class="detail-price-block">
                            <div>
                                <div class="price-tag-label">Giá bán lẻ</div>
                                <div class="detail-price">
                                    <?php echo number_format($product->price, 0, ',', '.'); ?>
                                    <span class="detail-price-unit">₫</span>
                                </div>
                            </div>
                            <div class="detail-freshness">
                                <i class="fas fa-leaf"></i>
                                <span>Tươi sạch</span>
                            </div>
                        </div>

                        <div class="detail-divider"></div>

                        <!-- Description -->
                        <div class="detail-desc-section">
                            <h6 class="detail-section-title">
                                <i class="fas fa-file-alt mr-2"></i>Mô tả sản phẩm
                            </h6>
                            <p class="detail-desc">
                                <?php echo nl2br(htmlspecialchars(
                                    $product->description ? $product->description : 'Chưa có thông tin mô tả cho sản phẩm này.',
                                    ENT_QUOTES, 'UTF-8'
                                )); ?>
                            </p>
                        </div>

                        <!-- Meta row -->
                        <div class="detail-meta-row">
                            <div class="meta-item">
                                <i class="fas fa-boxes"></i>
                                <div>
                                    <span class="meta-label">Danh mục</span>
                                    <span class="meta-value"><?php echo htmlspecialchars($product->category_name ?? '—', ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-hashtag"></i>
                                <div>
                                    <span class="meta-label">Mã sản phẩm</span>
                                    <span class="meta-value">#<?php echo str_pad($product->id, 4, '0', STR_PAD_LEFT); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="detail-divider"></div>

                        <!-- Actions -->
                        <div class="detail-actions">
                            <a href="<?= BASE_URL ?>Product/addToCart/<?php echo $product->id; ?>"
                               class="btn btn-success px-4 py-2 font-weight-bold">
                                <i class="fas fa-cart-plus mr-2"></i>Thêm vào giỏ hàng
                            </a>
                            <a href="<?= BASE_URL ?>Product/"
                               class="btn btn-secondary px-4 py-2 font-weight-bold">
                                <i class="fas fa-th-large mr-2"></i>Xem tất cả
                            </a>
                            <?php if (SessionHelper::isAdmin()): ?>
                            <a href="<?= BASE_URL ?>Product/edit/<?php echo $product->id; ?>"
                               class="btn btn-warning px-4 py-2 font-weight-bold">
                                <i class="fas fa-edit mr-2"></i>Sửa
                            </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="alert alert-danger text-center my-4">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Không tìm thấy sản phẩm này!
        </div>
        <?php endif; ?>

    </div>
</div>

<style>
/* Back link */
.back-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--text-muted); font-size: 0.85rem; font-weight: 600;
    text-decoration: none; transition: color 0.2s;
}
.back-link:hover { color: var(--primary); text-decoration: none; }

/* Detail card */
.detail-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 8px 50px rgba(0,0,0,0.55);
    margin-bottom: 40px;
}

/* Image Panel */
.detail-img-panel {
    position: relative;
    height: 100%;
    min-height: 420px;
    background: #060e09;
    overflow: hidden;
}
.detail-img {
    width: 100%; height: 100%;
    object-fit: cover;
    min-height: 420px;
    display: block;
    transition: transform 0.5s ease;
}
.detail-card:hover .detail-img { transform: scale(1.04); }
.detail-img-placeholder {
    height: 420px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 12px; color: var(--text-muted);
}
.detail-img-placeholder i { font-size: 56px; opacity: 0.2; color: var(--primary); }
.detail-img-placeholder span { font-size: 0.85rem; opacity: 0.5; font-style: italic; }

/* Category badge (floating on image) */
.detail-cat-badge {
    position: absolute;
    top: 16px; left: 16px;
    background: rgba(0,208,132,0.12);
    border: 1px solid rgba(0,208,132,0.28);
    backdrop-filter: blur(10px);
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--primary);
}

/* Info Panel */
.detail-info-panel {
    padding: 36px 36px 30px;
    display: flex; flex-direction: column;
    height: 100%;
}

/* ID chip */
.detail-id-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 999px;
    padding: 4px 12px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    color: var(--text-muted);
    text-transform: uppercase;
    width: fit-content;
}

/* Name */
.detail-name {
    font-family: var(--font-heading);
    font-size: 1.85rem;
    font-weight: 900;
    color: var(--text-primary);
    line-height: 1.2;
    margin: 0 0 18px;
    letter-spacing: -0.5px;
}

/* Price */
.detail-price-block {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0,208,132,0.05);
    border: 1px solid rgba(0,208,132,0.12);
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 22px;
}
.price-tag-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    margin-bottom: 3px;
}
.detail-price {
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 900;
    color: var(--accent);
    line-height: 1;
}
.detail-price-unit {
    font-size: 1rem;
    font-weight: 700;
    opacity: 0.7;
}
.detail-freshness {
    display: flex; flex-direction: column;
    align-items: center; gap: 4px;
    color: var(--primary);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.detail-freshness i { font-size: 22px; opacity: 0.7; }

/* Divider */
.detail-divider {
    border: none;
    border-top: 1px solid var(--border-card);
    margin: 18px 0;
}

/* Description */
.detail-section-title {
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 10px;
    display: flex; align-items: center;
}
.detail-desc {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.72;
    margin: 0;
}

/* Meta */
.detail-meta-row {
    display: flex;
    gap: 20px;
    margin-top: 16px;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border-card);
    border-radius: 10px;
    padding: 10px 14px;
    flex: 1;
}
.meta-item i {
    color: var(--primary);
    font-size: 16px;
    width: 18px; text-align: center;
    flex-shrink: 0;
}
.meta-label {
    display: block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 1px;
}
.meta-value {
    display: block;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--text-primary);
}

/* Actions */
.detail-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: auto;
}

@media (max-width: 767px) {
    .detail-info-panel { padding: 24px 20px; }
    .detail-name { font-size: 1.4rem; }
    .detail-img, .detail-img-placeholder { min-height: 260px; }
    .detail-meta-row { flex-direction: column; gap: 10px; }
}
</style>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
