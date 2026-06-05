<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">

        <!-- Back link -->
        <div class="mb-4 fade-in-up">
            <a href="<?= BASE_URL ?>Product/" class="back-link">
                <i class="fas fa-arrow-left mr-2"></i>Quay về kho sản phẩm
            </a>
        </div>

        <!-- Form Card -->
        <div class="form-card fade-in-up" style="animation-delay:0.08s;">
            <!-- Header -->
            <div class="form-card-header edit-header">
                <div class="form-header-orb edit-orb"></div>
                <div class="d-flex align-items-center" style="position:relative;z-index:2;">
                    <div class="form-header-icon edit-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div>
                        <div class="form-header-badge edit-badge">KHO SẢN PHẨM</div>
                        <h4 class="form-header-title">Chỉnh Sửa Thông Tin</h4>
                        <p style="font-size:0.8rem; color:rgba(255,255,255,0.4); margin:0;">
                            ID: #<?php echo $product->id; ?> · <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="form-card-body">
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle mr-2" style="color:var(--danger);"></i>
                        <strong>Có lỗi xảy ra:</strong>
                    </div>
                    <ul class="mb-0 pl-4" style="font-size:0.88rem;">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>Product/update" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">

                    <!-- Tên sản phẩm -->
                    <div class="field-group">
                        <label for="name">
                            <i class="fas fa-leaf mr-1" style="color:var(--accent);"></i>
                            Tên trái cây <span class="required-star">*</span>
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <!-- Mô tả -->
                    <div class="field-group">
                        <label for="description">
                            <i class="fas fa-align-left mr-1" style="color:var(--text-muted);"></i>
                            Mô tả sản phẩm <span class="required-star">*</span>
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?php
                            echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8');
                        ?></textarea>
                    </div>

                    <!-- Giá bán -->
                    <div class="field-group">
                        <label for="price">
                            <i class="fas fa-tag mr-1" style="color:var(--accent);"></i>
                            Giá bán <span class="required-star">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="price" name="price"
                                   value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>"
                                   required style="border-radius: 10px 0 0 10px !important;">
                            <div class="input-group-append">
                                <span class="input-group-text" style="border-radius: 0 10px 10px 0; font-weight:700;">₫ VND</span>
                            </div>
                        </div>
                    </div>

                    <!-- Danh mục -->
                    <div class="field-group">
                        <label for="category_id">
                            <i class="fas fa-tags mr-1" style="color:var(--accent);"></i>
                            Danh mục loại trái cây <span class="required-star">*</span>
                        </label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"
                                    <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="field-group">
                        <label>
                            <i class="fas fa-image mr-1" style="color:var(--info);"></i>
                            Hình ảnh sản phẩm
                        </label>

                        <?php if ($product->image): ?>
                        <!-- Current image preview -->
                        <div class="current-img-card mb-3">
                            <div class="current-img-wrap">
                                <img src="<?= BASE_URL ?><?php echo $product->image; ?>"
                                     alt="Ảnh hiện tại" class="current-img">
                            </div>
                            <div class="current-img-info">
                                <div class="current-img-label">
                                    <i class="fas fa-check-circle mr-1" style="color:var(--primary);"></i>
                                    Ảnh hiện tại
                                </div>
                                <p style="font-size:0.78rem; color:var(--text-muted); margin:0;">
                                    Chọn tệp mới bên dưới để thay thế ảnh này.
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Upload new -->
                        <div class="upload-zone" id="uploadZone">
                            <div>
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <p class="upload-text">Kéo thả ảnh mới hoặc <span class="upload-link">chọn tệp</span></p>
                                <p class="upload-hint">PNG, JPG, WEBP · Tối đa 5MB</p>
                            </div>
                            <input type="file" class="upload-input" id="image" name="image" accept="image/*">
                        </div>
                        <div id="imagePreview" class="img-preview-wrap" style="display:none;">
                            <img id="previewImg" src="" alt="Preview" class="img-preview">
                            <button type="button" class="img-remove-btn" id="removeImage">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <a href="<?= BASE_URL ?>Product/" class="btn btn-secondary px-4">
                            <i class="fas fa-times mr-2"></i>Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-warning font-weight-bold px-5">
                            <i class="fas fa-check mr-2"></i>Lưu thay đổi
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<style>
/* Reuse from add.php + overrides for edit */
.back-link {
    display: inline-flex; align-items: center;
    color: var(--text-muted); font-size: 0.85rem; font-weight: 600;
    text-decoration: none; transition: color 0.2s;
}
.back-link:hover { color: var(--accent); text-decoration: none; }

.form-card {
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.5);
}

.form-card-header {
    position: relative;
    padding: 28px 32px;
    background: linear-gradient(135deg, #1a0e00 0%, #3d2200 55%, #4a2d00 100%);
    border-bottom: 1px solid rgba(251,191,36,0.1);
    overflow: hidden;
}
.edit-header { background: linear-gradient(135deg, #1a1000 0%, #3a2800 55%, #4a3800 100%); }

.form-header-orb {
    position: absolute;
    width: 300px; height: 300px;
    top: -120px; right: -80px;
    border-radius: 50%;
    pointer-events: none;
}
.edit-orb { background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, transparent 70%); }

.form-header-icon {
    width: 50px; height: 50px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    margin-right: 16px; flex-shrink: 0;
}
.edit-icon {
    background: linear-gradient(135deg, var(--accent), #f59e0b);
    color: #1a0e00;
    box-shadow: 0 6px 20px rgba(251,191,36,0.3);
}

.form-header-badge {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 2px;
}
.edit-badge { color: var(--accent); }

.form-header-title {
    font-family: var(--font-heading);
    font-size: 1.4rem; font-weight: 800;
    color: #fff; margin: 0 0 2px;
}

.form-card-body { padding: 28px 32px 32px; }

.field-group { margin-bottom: 22px; }
.field-group label {
    display: block;
    font-size: 0.8rem; font-weight: 700;
    letter-spacing: 0.05em; text-transform: uppercase;
    color: var(--text-secondary); margin-bottom: 8px;
}
.required-star { color: var(--danger); margin-left: 2px; }

/* Current image card */
.current-img-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: rgba(251,191,36,0.05);
    border: 1px solid rgba(251,191,36,0.15);
    border-radius: 12px;
    padding: 14px 16px;
}
.current-img-wrap {
    flex-shrink: 0;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(251,191,36,0.2);
}
.current-img {
    width: 80px; height: 70px;
    object-fit: cover; display: block;
}
.current-img-label {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 4px;
}

/* Upload zone */
.upload-zone {
    position: relative;
    border: 2px dashed rgba(251,191,36,0.18);
    border-radius: 12px;
    padding: 22px 20px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    background: rgba(251,191,36,0.02);
}
.upload-zone:hover {
    border-color: var(--accent);
    background: rgba(251,191,36,0.05);
}
.upload-input {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer;
    width: 100%; height: 100%;
}
.upload-icon {
    font-size: 28px;
    color: var(--accent);
    opacity: 0.45;
    margin-bottom: 8px;
    display: block;
}
.upload-text { font-size: 0.88rem; color: var(--text-secondary); margin: 0; }
.upload-link { color: var(--accent); font-weight: 700; }
.upload-hint { font-size: 0.75rem; color: var(--text-muted); margin: 4px 0 0; }

.img-preview-wrap {
    position: relative; display: inline-block;
    margin-top: 10px; border-radius: 12px; overflow: hidden;
}
.img-preview {
    max-width: 160px; max-height: 120px;
    object-fit: cover; border-radius: 12px; display: block;
    border: 2px solid rgba(251,191,36,0.25);
}
.img-remove-btn {
    position: absolute; top: 6px; right: 6px;
    width: 24px; height: 24px;
    background: rgba(248,113,113,0.85); border: none;
    border-radius: 50%; color: #fff; font-size: 11px;
    cursor: pointer; display: flex;
    align-items: center; justify-content: center;
    transition: background 0.2s;
}
.img-remove-btn:hover { background: var(--danger-dark); }

.divider {
    border: none;
    border-top: 1px solid var(--border-card);
    margin: 24px 0;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}
</style>

<script>
const imageInput  = document.getElementById('image');
const previewWrap = document.getElementById('imagePreview');
const previewImg  = document.getElementById('previewImg');
const removeBtn   = document.getElementById('removeImage');
const uploadZone  = document.getElementById('uploadZone');

if (imageInput) {
    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewWrap.style.display = 'block';
                uploadZone.style.display  = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
}
if (removeBtn) {
    removeBtn.addEventListener('click', function () {
        imageInput.value = '';
        previewWrap.style.display = 'none';
        uploadZone.style.display  = '';
        previewImg.src = '';
    });
}
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
