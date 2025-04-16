<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Xóa danh mục</h2>

                    <p>Bạn có chắc chắn muốn xóa danh mục "<strong><?php echo htmlspecialchars($category->name); ?></strong>"?</p>
                    <p class="text-danger">Lưu ý: Hành động này không thể hoàn tác!</p>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/webbanhang/Category" class="btn btn-light">
                            <i class="bi bi-x-circle me-2"></i>Hủy
                        </a>
                        <a href="/webbanhang/Category/deleteConfirm/<?php echo $category->id; ?>" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Xác nhận xóa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>