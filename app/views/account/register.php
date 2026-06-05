<?php include 'app/shares/header.php'; ?>

<div class="row justify-content-center my-5 fade-in-up">
    <div class="col-12 col-md-9 col-lg-7 col-xl-6">

        <!-- Auth Card -->
        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <div class="auth-header-orb"></div>
                <div class="auth-logo">🍎</div>
                <h2 class="auth-title">Tạo tài khoản</h2>
                <p class="auth-subtitle">Điền đầy đủ thông tin để đăng ký tài khoản mới</p>
            </div>

            <!-- Body -->
            <div class="auth-body">

                <?php if (isset($errors) && count($errors) > 0): ?>
                <div class="auth-alert mb-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <div>
                        <?php foreach ($errors as $err): ?>
                            <div><?= htmlspecialchars($err) ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>account/save" method="post" id="registerForm">

                    <!-- ─ THÔNG TIN TÀI KHOẢN ─ -->
                    <div class="auth-section-label">
                        <i class="fas fa-key mr-2"></i>Thông tin tài khoản
                    </div>

                    <div class="auth-field-row">
                        <div class="auth-field">
                            <label for="username">Tên tài khoản <span class="req">*</span></label>
                            <div class="field-icon-wrap">
                                <i class="fas fa-user field-icon"></i>
                                <input type="text" id="username" name="username" required
                                       placeholder="Tên đăng nhập"
                                       value="<?= htmlspecialchars($username ?? '') ?>">
                            </div>
                        </div>
                        <div class="auth-field">
                            <label for="fullname">Họ và tên <span class="req">*</span></label>
                            <div class="field-icon-wrap">
                                <i class="fas fa-id-card field-icon"></i>
                                <input type="text" id="fullname" name="fullname" required
                                       placeholder="Nguyễn Văn A"
                                       value="<?= htmlspecialchars($fullName ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="auth-field-row">
                        <div class="auth-field">
                            <label for="password">Mật khẩu <span class="req">*</span></label>
                            <div class="field-icon-wrap">
                                <i class="fas fa-lock field-icon"></i>
                                <input type="password" id="password" name="password" required
                                       placeholder="Tối thiểu 6 ký tự">
                            </div>
                        </div>
                        <div class="auth-field">
                            <label for="confirmpassword">Xác nhận mật khẩu <span class="req">*</span></label>
                            <div class="field-icon-wrap">
                                <i class="fas fa-lock field-icon"></i>
                                <input type="password" id="confirmpassword" name="confirmpassword" required
                                       placeholder="Nhập lại mật khẩu">
                            </div>
                        </div>
                    </div>

                    <!-- ─ THÔNG TIN CÁ NHÂN ─ -->
                    <div class="auth-section-label mt-2">
                        <i class="fas fa-address-card mr-2"></i>Thông tin liên hệ
                    </div>

                    <div class="auth-field-row">
                        <div class="auth-field">
                            <label for="email">Địa chỉ Email</label>
                            <div class="field-icon-wrap">
                                <i class="fas fa-envelope field-icon"></i>
                                <input type="email" id="email" name="email"
                                       placeholder="example@email.com"
                                       value="<?= htmlspecialchars($email ?? '') ?>">
                            </div>
                        </div>
                        <div class="auth-field">
                            <label for="phone">Số điện thoại</label>
                            <div class="field-icon-wrap">
                                <i class="fas fa-phone field-icon"></i>
                                <input type="tel" id="phone" name="phone"
                                       placeholder="09x xxx xxxx"
                                       value="<?= htmlspecialchars($phone ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label for="address">Địa chỉ nhận hàng</label>
                        <div class="field-icon-wrap">
                            <i class="fas fa-map-marker-alt field-icon" style="top:16px;"></i>
                            <textarea id="address" name="address" rows="2"
                                      placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố..."><?= htmlspecialchars($address ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="auth-btn-submit mt-3">
                        <i class="fas fa-user-plus mr-2"></i>ĐĂNG KÝ TÀI KHOẢN
                    </button>

                </form>

                <div class="auth-footer-link">
                    Đã có tài khoản?
                    <a href="<?= BASE_URL ?>account/login">Đăng nhập ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ── Auth Card ── */
.auth-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 12px 60px rgba(0,0,0,0.6);
}

/* Header */
.auth-header {
    position: relative;
    padding: 32px 36px 24px;
    text-align: center;
    background: linear-gradient(160deg, #021a0c 0%, #0a3a1c 60%, #061203 100%);
    border-bottom: 1px solid rgba(0,208,132,0.1);
    overflow: hidden;
}
.auth-header-orb {
    position: absolute;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(0,208,132,0.1) 0%, transparent 70%);
    top: -130px; left: 50%;
    transform: translateX(-50%);
    border-radius: 50%;
    pointer-events: none;
}
.auth-logo {
    font-size: 36px;
    margin-bottom: 10px;
    display: block;
    filter: drop-shadow(0 4px 12px rgba(0,208,132,0.3));
}
.auth-title {
    font-family: var(--font-heading);
    font-size: 1.6rem;
    font-weight: 900;
    color: #fff;
    margin: 0 0 6px;
    position: relative;
    z-index: 2;
}
.auth-subtitle {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.4);
    margin: 0;
    position: relative;
    z-index: 2;
}

/* Body */
.auth-body { padding: 28px 32px 32px; }

/* Alert */
.auth-alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: rgba(248,113,113,0.08);
    border: 1px solid rgba(248,113,113,0.2);
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 0.87rem;
    color: #fca5a5;
    line-height: 1.5;
}
.auth-alert i { margin-top: 2px; flex-shrink: 0; }

/* Section labels */
.auth-section-label {
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(0,208,132,0.08);
}

/* Field row */
.auth-field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}
.auth-field { margin-bottom: 14px; }
.auth-field label {
    display: block;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 7px;
}
.req { color: var(--danger); margin-left: 2px; }

/* Input with icon */
.field-icon-wrap {
    position: relative;
}
.field-icon {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 13px;
    pointer-events: none;
    z-index: 2;
}
.field-icon-wrap input,
.field-icon-wrap textarea {
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(0,208,132,0.12);
    border-radius: 10px;
    padding: 10px 14px 10px 40px;
    font-size: 0.9rem;
    color: var(--text-primary);
    font-family: var(--font-main);
    transition: all 0.25s ease;
    outline: none;
}
.field-icon-wrap input::placeholder,
.field-icon-wrap textarea::placeholder { color: var(--text-muted); font-size: 0.85rem; }
.field-icon-wrap input:focus,
.field-icon-wrap textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0,208,132,0.12);
    background: rgba(0,208,132,0.04);
}
.field-icon-wrap textarea {
    resize: none;
    padding-top: 14px;
}

/* Submit button */
.auth-btn-submit {
    width: 100%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
    border-radius: 999px;
    padding: 14px 20px;
    font-size: 0.92rem;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: #042210;
    cursor: pointer;
    transition: all 0.28s ease;
    box-shadow: 0 6px 20px rgba(0,208,132,0.3);
    font-family: var(--font-main);
}
.auth-btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(0,208,132,0.45);
}

/* Footer link */
.auth-footer-link {
    text-align: center;
    margin-top: 20px;
    font-size: 0.87rem;
    color: var(--text-muted);
}
.auth-footer-link a {
    color: var(--primary);
    font-weight: 700;
    text-decoration: none;
    transition: color 0.2s;
}
.auth-footer-link a:hover { color: #39e75f; }

@media (max-width: 576px) {
    .auth-field-row { grid-template-columns: 1fr; }
    .auth-body { padding: 20px 18px 24px; }
    .auth-header { padding: 24px 18px 20px; }
}
</style>

<?php include 'app/shares/footer.php'; ?>
