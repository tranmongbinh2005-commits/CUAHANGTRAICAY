<?php include dirname(dirname(__DIR__)) . '/shares/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 rounded-lg my-4 overflow-hidden">
            <div class="card-header text-white font-weight-bold py-3" style="background: linear-gradient(135deg, #785a00 0%, #ffc107 100%);">
                <h4 class="mb-0 text-dark font-weight-bold"><i class="fas fa-edit mr-2 text-dark"></i>CHỈNH SỬA THÔNG TIN TRÁI CÂY</h4>
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

                <form method="POST" action="<?= BASE_URL ?>Product/update" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                    <div class="form-group mb-3">
                        <label for="name" class="font-weight-bold text-dark">Tên sản phẩm:</label>
                        <input type="text" id="name" name="name" class="form-control border-warning" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="font-weight-bold text-dark">Mô tả:</label>
                        <textarea id="description" name="description" class="form-control border-warning" rows="4" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="font-weight-bold text-dark">Giá bán (VND):</label>
                        <input type="number" id="price" name="price" class="form-control border-warning" value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category_id" class="font-weight-bold text-dark">Danh mục loại trái cây:</label>
                        <select id="category_id" name="category_id" class="form-control border-warning" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="image" class="font-weight-bold text-dark d-block">Hình ảnh sản phẩm:</label>
                        <input type="file" id="image" name="image" class="form-control-file border p-2 rounded mb-3 bg-light border-warning">
                        <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                        
                        <?php if ($product->image): ?>
                            <div class="p-2 border rounded bg-light d-inline-block text-center shadow-sm">
                                <img src="<?= BASE_URL ?><?php echo $product->image; ?>" alt="Product Image" style="max-width: 150px; height: 100px; object-fit: cover;" class="rounded img-thumbnail d-block mb-2">
                                <span class="badge badge-secondary py-1 px-2">Ảnh hiện tại</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>Product/" class="btn btn-secondary px-4 font-weight-bold rounded-pill">
                            <i class="fas fa-arrow-left mr-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning font-weight-bold px-4 text-dark rounded-pill shadow-sm">
                            <i class="fas fa-check mr-1 text-dark"></i> Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include dirname(dirname(__DIR__)) . '/shares/footer.php'; ?>
