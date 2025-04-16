<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/webbanhang/Brand">Quản lý thương hiệu</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa thương hiệu</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">
                        Chỉnh sửa thương hiệu: <?php echo htmlspecialchars($brand->name); ?>
                    </h2>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/webbanhang/Brand/update" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <input type="hidden" name="id" value="<?php echo $brand->id; ?>">
                        <div class="mb-4">
                            <label for="name" class="form-label">Tên thương hiệu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo htmlspecialchars($brand->name); ?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên thương hiệu
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3"><?php echo htmlspecialchars($brand->description ?? ''); ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="form-label">Logo thương hiệu</label>
                            <?php if ($brand->logo): ?>
                                <div class="mb-3">
                                    <img src="/webbanhang/<?php echo htmlspecialchars($brand->logo); ?>" 
                                         alt="Current Logo" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            <?php endif; ?>
                            <div class="input-group">
                                <input type="file" class="form-control" id="logo" name="logo" 
                                       accept="image/*" onchange="previewImage(this);">
                            </div>
                            <div class="form-text">
                                Chấp nhận file ảnh (JPG, PNG, GIF). Kích thước tối đa 2MB.
                                <?php if ($brand->logo): ?>
                                    <br>Để trống nếu không muốn thay đổi logo hiện tại.
                                <?php endif; ?>
                            </div>
                            <div class="mt-2" id="imagePreview" style="display: none;">
                                <img src="" alt="Logo Preview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="/webbanhang/Brand" class="btn btn-light">
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
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
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
