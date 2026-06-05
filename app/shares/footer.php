</div><!-- /.container.content-wrapper -->

<!-- ═══════════════════════════════════════════
     FOOTER – PREMIUM DARK
═══════════════════════════════════════════ -->
<footer>
    <div class="footer-inner">
        <div class="container">
            <div class="row py-4">
                <!-- Brand -->
                <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                    <div class="footer-brand mb-3">
                        <span class="footer-brand-icon">🍎</span>
                        <span class="footer-brand-name">Fruit Store</span>
                    </div>
                    <p class="footer-desc">
                        Hệ thống quản lý cửa hàng trái cây tươi sạch, chất lượng cao —
                        theo dõi kho hàng, danh mục và đơn hàng một cách thông minh, hiệu quả.
                    </p>
                    <div class="footer-socials">
                        <a href="#" class="social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-btn" title="Zalo"><i class="fas fa-comment-dots"></i></a>
                    </div>
                </div>

                <!-- Links -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="footer-heading">Liên kết nhanh</h6>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>"><i class="fas fa-home mr-2"></i>Trang chủ</a></li>
                        <li><a href="<?= BASE_URL ?>Product/"><i class="fas fa-boxes mr-2"></i>Kho sản phẩm</a></li>
                        <li><a href="<?= BASE_URL ?>category/"><i class="fas fa-tags mr-2"></i>Danh mục</a></li>
                        <li><a href="<?= BASE_URL ?>Product/cart"><i class="fas fa-shopping-cart mr-2"></i>Giỏ hàng</a></li>
                        <?php if (SessionHelper::isAdmin()): ?>
                        <li><a href="<?= BASE_URL ?>Product/add"><i class="fas fa-plus-circle mr-2"></i>Thêm sản phẩm</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Info -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-heading">Thông tin hỗ trợ</h6>
                    <div class="footer-info-item">
                        <i class="fas fa-map-marker-alt footer-info-icon"></i>
                        <span>Hệ thống quản lý nội bộ cửa hàng</span>
                    </div>
                    <div class="footer-info-item">
                        <i class="fas fa-leaf footer-info-icon" style="color:var(--primary);"></i>
                        <span>100% trái cây tươi sạch, nhập khẩu chất lượng cao</span>
                    </div>
                    <div class="footer-info-item">
                        <i class="fas fa-shield-alt footer-info-icon" style="color:var(--accent);"></i>
                        <span>Bảo mật · Ổn định · Tin cậy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer-bottom">
        <div class="container d-flex justify-content-between align-items-center flex-wrap" style="gap:8px;">
            <span>© 2026 <strong style="color:var(--primary);">Fruit Store</strong> · Cửa hàng Trái cây tươi sạch</span>
            <span style="font-size:0.78rem; color: var(--text-muted);">
                <i class="fas fa-code mr-1" style="color:var(--primary);"></i>
                Built with PHP · MVC Pattern
            </span>
        </div>
    </div>
</footer>

<style>
footer {
    background: var(--bg-surface) !important;
    border-top: 1px solid var(--border-glass);
    margin-top: 60px;
    position: relative;
    z-index: 1;
}

.footer-inner {
    padding-top: 8px;
}

/* Brand */
.footer-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}
.footer-brand-icon {
    font-size: 22px;
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--primary), #00ff9d);
    border-radius: 10px;
    display: inline-flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 12px var(--primary-glow);
}
.footer-brand-name {
    font-family: var(--font-heading);
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--primary);
    letter-spacing: -0.3px;
}

.footer-desc {
    font-size: 0.84rem;
    color: var(--text-muted);
    line-height: 1.65;
    max-width: 320px;
    margin-bottom: 16px;
}

.footer-socials {
    display: flex;
    gap: 8px;
}
.social-btn {
    width: 36px; height: 36px;
    background: var(--bg-glass-lite);
    border: 1px solid var(--border-glass);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted) !important;
    font-size: 13px;
    text-decoration: none;
    transition: var(--transition);
}
.social-btn:hover {
    background: var(--primary-glow);
    border-color: rgba(0,208,132,0.3);
    color: var(--primary) !important;
    transform: translateY(-3px);
}

/* Heading */
.footer-heading {
    font-family: var(--font-heading);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 14px;
}

/* Links */
.footer-links {
    list-style: none;
    padding: 0; margin: 0;
}
.footer-links li { margin-bottom: 8px; }
.footer-links a {
    color: var(--text-muted) !important;
    font-size: 0.86rem;
    text-decoration: none;
    transition: color 0.2s;
    display: flex; align-items: center;
}
.footer-links a:hover { color: var(--primary) !important; }
.footer-links a i { width: 16px; color: var(--text-muted); }
.footer-links a:hover i { color: var(--primary); }

/* Info */
.footer-info-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 10px;
    font-size: 0.84rem;
    color: var(--text-muted);
    line-height: 1.5;
}
.footer-info-icon {
    margin-top: 2px;
    width: 14px;
    color: var(--text-muted);
    flex-shrink: 0;
}

/* Bottom bar */
.footer-bottom {
    border-top: 1px solid rgba(0,208,132,0.06);
    padding: 14px 0;
    font-size: 0.82rem;
    color: var(--text-muted);
}
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>