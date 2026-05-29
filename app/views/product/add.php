<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow border-0 rounded-lg my-4 overflow-hidden">
            <div class="card-header text-white text-center py-3" style="background: linear-gradient(135deg, #153e22 0%, #28a745 100%);">
                <h4 class="mb-0 font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>THÊM TRÁI CÂY MỚI</h4>
            </div>
            
            <div class="card-body p-4 bg-white">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger shadow-sm border-0 rounded-lg mb-4">
                        <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-circle mr-1"></i> Có lỗi xảy ra:</h6>
                        <ul class="mb-0 pl-3">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>Product/save" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group mb-3">
                        <label for="name" class="font-weight-bold text-dark">Tên trái cây <span class="text-danger">*</span></label>
                        <input type="text" class="form-control border-success" id="name" name="name" placeholder="Ví dụ: Táo Envy Mỹ, Xoài Cát Hòa Lộc..." required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category_id" class="font-weight-bold text-dark">Danh mục sản phẩm <span class="text-danger">*</span></label>
                        <select class="form-control border-success" id="category_id" name="category_id" required>
                            <option value="">-- Chọn danh mục phân loại --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>">
                                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="font-weight-bold text-dark">Giá bán (VND) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control border-success" id="price" name="price" placeholder="Nhập giá tiền..." min="0" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-success text-white">VND</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="font-weight-bold text-dark">Hình ảnh sản phẩm</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                            <label class="custom-file-label border-success" for="image">Chọn tệp hình ảnh...</label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description" class="font-weight-bold text-dark">Mô tả sản phẩm</label>
                        <textarea class="form-control border-success" id="description" name="description" rows="4" placeholder="Nhập đặc điểm đặc trưng, nguồn gốc xuất xứ của loại trái cây này..."></textarea>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>Product/" class="btn btn-secondary px-4 font-weight-bold rounded-pill">
                            <i class="fas fa-arrow-left mr-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-success px-5 font-weight-bold shadow-sm rounded-pill">
                            <i class="fas fa-save mr-1"></i> Lưu sản phẩm
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("image").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
