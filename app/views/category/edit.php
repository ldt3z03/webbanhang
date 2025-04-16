<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/webbanhang/Category">Quản lý danh mục</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa danh mục</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Chỉnh sửa danh mục: <?php echo htmlspecialchars($category->name); ?></h2>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/webbanhang/Category/update" class="needs-validation" novalidate>
                        <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                        <div class="mb-4">
                            <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo htmlspecialchars($category->name); ?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên danh mục
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3">
                                <?php echo htmlspecialchars($category->description ?? ''); ?>
                            </textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="/webbanhang/Category" class="btn btn-light">
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

<?php include __DIR__ . '/../shares/footer.php'; ?>