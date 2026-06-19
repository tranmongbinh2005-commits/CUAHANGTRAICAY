<?php include 'app/shares/header.php'; ?>

<div class="row justify-content-center my-5 fade-in-up">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">

        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <div class="auth-header-orb"></div>
                <div class="auth-logo">🍎</div>
                <h2 class="auth-title">Xin chào!</h2>
                <p class="auth-subtitle">Đăng nhập để truy cập vào hệ thống</p>
            </div>

            <!-- Body -->
            <div class="auth-body">

                <?php if (isset($error)): ?>
                <div class="auth-alert mb-4">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
                <?php endif; ?>

                <form id="login-form">

                    <div class="auth-field mb-4">
                        <label for="username">Tên tài khoản</label>
                        <div class="field-icon-wrap">
                            <i class="fas fa-user field-icon"></i>
                            <input type="text" id="username" name="username" required
                                   placeholder="Nhập tên đăng nhập">
                        </div>
                    </div>

                    <div class="auth-field mb-2">
                        <label for="password">Mật khẩu</label>
                        <div class="field-icon-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" id="password" name="password" required
                                   placeholder="Nhập mật khẩu">
                        </div>
                    </div>

                    <div class="text-right mb-4">
                        <a href="#" class="forgot-link">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="auth-btn-submit">
                        <i class="fas fa-sign-in-alt mr-2"></i>ĐĂNG NHẬP
                    </button>

                </form>

                <!-- Social divider -->
                <div class="social-divider">
                    <span>hoặc tiếp tục với</span>
                </div>

                <div class="social-row">
                    <a href="#!" class="social-auth-btn">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="social-auth-btn">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#!" class="social-auth-btn">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>

                <div class="auth-footer-link">
                    Chưa có tài khoản?
                    <a href="<?= BASE_URL ?>account/register">Đăng ký ngay</a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.auth-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 12px 60px rgba(0,0,0,0.6);
}
.auth-header {
    position: relative;
    padding: 36px 36px 28px;
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
.auth-logo { font-size: 40px; margin-bottom: 12px; display: block; filter: drop-shadow(0 4px 12px rgba(0,208,132,0.35)); }
.auth-title {
    font-family: var(--font-heading);
    font-size: 1.7rem; font-weight: 900;
    color: #fff; margin: 0 0 6px;
    position: relative; z-index: 2;
}
.auth-subtitle {
    font-size: 0.87rem; color: rgba(255,255,255,0.4);
    margin: 0; position: relative; z-index: 2;
}

.auth-body { padding: 30px 32px 32px; }

.auth-alert {
    display: flex; align-items: center; gap: 10px;
    background: rgba(248,113,113,0.08);
    border: 1px solid rgba(248,113,113,0.2);
    border-radius: 12px;
    padding: 13px 16px;
    font-size: 0.88rem; color: #fca5a5;
}

.auth-field { margin-bottom: 0; }
.auth-field label {
    display: block;
    font-size: 0.78rem; font-weight: 700;
    letter-spacing: 0.04em; text-transform: uppercase;
    color: var(--text-secondary); margin-bottom: 7px;
}
.field-icon-wrap { position: relative; }
.field-icon {
    position: absolute; left: 14px; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted); font-size: 13px;
    pointer-events: none; z-index: 2;
}
.field-icon-wrap input {
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(0,208,132,0.12);
    border-radius: 10px;
    padding: 11px 14px 11px 40px;
    font-size: 0.9rem; color: var(--text-primary);
    font-family: var(--font-main);
    transition: all 0.25s ease; outline: none;
}
.field-icon-wrap input::placeholder { color: var(--text-muted); font-size: 0.85rem; }
.field-icon-wrap input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0,208,132,0.12);
    background: rgba(0,208,132,0.04);
}

.forgot-link {
    font-size: 0.82rem; color: var(--text-muted);
    text-decoration: none; transition: color 0.2s;
}
.forgot-link:hover { color: var(--primary); }

.auth-btn-submit {
    width: 100%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none; border-radius: 999px;
    padding: 14px 20px;
    font-size: 0.93rem; font-weight: 800;
    letter-spacing: 0.06em; color: #042210;
    cursor: pointer; transition: all 0.28s ease;
    box-shadow: 0 6px 20px rgba(0,208,132,0.3);
    font-family: var(--font-main);
}
.auth-btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(0,208,132,0.45);
}

.social-divider {
    display: flex; align-items: center; gap: 12px;
    text-align: center; margin: 22px 0;
    color: var(--text-muted); font-size: 0.78rem; font-weight: 600;
}
.social-divider::before, .social-divider::after {
    content: ''; flex: 1;
    height: 1px; background: var(--border-card);
}

.social-row {
    display: flex; justify-content: center; gap: 12px;
    margin-bottom: 20px;
}
.social-auth-btn {
    width: 44px; height: 44px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--border-glass);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-secondary) !important;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.25s ease;
}
.social-auth-btn:hover {
    background: var(--primary-glow);
    border-color: rgba(0,208,132,0.3);
    color: var(--primary) !important;
    transform: translateY(-3px);
}

.auth-footer-link {
    text-align: center; font-size: 0.87rem; color: var(--text-muted);
}
.auth-footer-link a {
    color: var(--primary); font-weight: 700;
    text-decoration: none; transition: color 0.2s;
}
.auth-footer-link a:hover { color: #39e75f; }
</style>

<script>
// Lắng nghe sự kiện "submit" (khi người dùng bấm nút ĐĂNG NHẬP) của Form
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Chặn việc Form tải lại toàn bộ trang web (reload)

    // Thu thập dữ liệu từ các ô input trong Form (username, password)
    const formData = new FormData(this);
    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    // Sử dụng fetch() để gọi API đăng nhập theo chuẩn RESTful
    fetch('<?= BASE_URL ?>account/checkLogin', {
        method: 'POST', // Phương thức đẩy dữ liệu lên
        headers: {
            'Content-Type': 'application/json' // Báo cho Server biết ta đang gửi chuỗi JSON
        },
        body: JSON.stringify(jsonData) // Chuyển đổi dữ liệu form sang chuỗi JSON
    })
    .then(response => response.json()) // Phân tích kết quả Server trả về thành mảng/object Javascript
    .then(data => {
        // Nếu Server trả về có chứa 'token' (Tức là đăng nhập thành công)
        if (data.token) {
            // Lưu token JWT này vào kho lưu trữ cục bộ (localStorage) của trình duyệt
            // Token này sẽ dùng làm "giấy thông hành" để gửi theo mỗi lần gọi API lấy danh sách
            localStorage.setItem('jwtToken', data.token);
            
            // Chuyển hướng người dùng về trang hiển thị Sản phẩm
            location.href = '<?= BASE_URL ?>Product';
        } else {
            // Nếu sai tài khoản mật khẩu, hiển thị thông báo lỗi
            alert('Đăng nhập thất bại: ' + (data.message || 'Sai thông tin đăng nhập'));
        }
    })
    .catch(error => {
        // Xử lý khi kết nối bị lỗi hoặc Server lỗi
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi gọi API đăng nhập.');
    });
});
</script>

<?php include 'app/shares/footer.php'; ?>
