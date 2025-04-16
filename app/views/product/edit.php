<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/webbanhang/Product">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa sản phẩm</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">
                        Chỉnh sửa sản phẩm: <?php echo htmlspecialchars($product->name); ?>
                    </h2>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image); ?>">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo htmlspecialchars($product->name); ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên sản phẩm
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="4"><?php echo htmlspecialchars($product->description ?? ''); ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="brand_id" class="form-label">Thương hiệu <span class="text-danger">*</span></label>
                                        <select class="form-select" id="brand_id" name="brand_id" required>
                                            <option value="">Chọn thương hiệu</option>
                                            <?php foreach ($brands as $brand): ?>
                                                <option value="<?php echo $brand->id; ?>" <?php echo $brand->id == $product->brand_id ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($brand->name); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Vui lòng chọn thương hiệu
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option value="">Chọn danh mục</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category->id; ?>"
                                                        <?php echo ($category->id == $product->category_id) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category->name); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Vui lòng chọn danh mục
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="price" name="price" 
                                                   value="<?php echo $product->price; ?>"
                                                   min="0" step="1000" required>
                                            <span class="input-group-text">VND</span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập giá sản phẩm
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <?php if ($product->image): ?>
                                                    <img src="/webbanhang/<?php echo htmlspecialchars($product->image); ?>" 
                                                         alt="Current Product Image" class="img-fluid" id="imagePreview"
                                                         style="max-height: 200px;">
                                                <?php else: ?>
                                                    <img src="/webbanhang/assets/images/product-placeholder.png" 
                                                         alt="Product Preview" class="img-fluid" id="imagePreview"
                                                         style="max-height: 200px;">
                                                <?php endif; ?>
                                            </div>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="image" name="image" 
                                                       accept="image/*" onchange="previewImage(this);">
                                            </div>
                                            <div class="form-text mt-2">
                                                Chấp nhận file ảnh (JPG, PNG, GIF). Kích thước tối đa 2MB.
                                                <?php if ($product->image): ?>
                                                    <br>Để trống nếu không muốn thay đổi ảnh hiện tại.
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="/webbanhang/Product" class="btn btn-light">
                                <i class="bi bi-x-circle me-2"></i>Hủy
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Form validation
(function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php include __DIR__ . '/../shares/footer.php'; ?>