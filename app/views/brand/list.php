<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8" data-aos="fade-right">
            <h1 class="display-4 mb-0">Quản lý thương hiệu</h1>
            <p class="text-muted lead">Quản lý các thương hiệu sản phẩm</p>
        </div>
        <div class="col-md-4 text-md-end" data-aos="fade-left">
            <a href="/webbanhang/Brand/add" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm thương hiệu mới
            </a>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-up">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-up">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($brands)): ?>
        <div class="row">
            <?php foreach ($brands as $brand): ?>
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="card h-100 brand-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <?php if ($brand->logo): ?>
                                    <img src="/webbanhang/<?php echo htmlspecialchars($brand->logo); ?>" 
                                         class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: contain;">
                                <?php else: ?>
                                    <div class="rounded-circle me-3 bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="bi bi-building text-muted fs-3"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h5 class="card-title mb-1"><?php echo htmlspecialchars($brand->name); ?></h5>
                                    <span class="badge bg-primary rounded-pill">
                                        <?php echo $brand->product_count ?? 0; ?> sản phẩm
                                    </span>
                                </div>
                            </div>

                            <p class="card-text text-muted mb-3">
                                <?php echo htmlspecialchars($brand->description ?? 'Không có mô tả'); ?>
                            </p>

                            <div class="brand-actions">
                                <a href="/webbanhang/Brand/edit/<?php echo $brand->id; ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <a href="/webbanhang/Brand/delete/<?php echo $brand->id; ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5" data-aos="fade-up">
            <i class="bi bi-building display-1 text-muted mb-4"></i>
            <h4>Chưa có thương hiệu nào</h4>
            <p class="text-muted">Hãy thêm thương hiệu đầu tiên của bạn</p>
            <a href="/webbanhang/Brand/add" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle me-2"></i> Thêm thương hiệu mới
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa thương hiệu "<span id="brandNameToDelete"></span>"?
                <p class="text-danger mb-0 mt-2">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Lưu ý: Hành động này không thể hoàn tác!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Hủy
                </button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i>Xác nhận xóa
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    const modal = document.getElementById('deleteModal');
    const deleteModal = new bootstrap.Modal(modal);
    
    document.getElementById('brandNameToDelete').textContent = name;
    document.getElementById('confirmDeleteButton').href = `/webbanhang/Brand/delete/${id}`;
    
    deleteModal.show();
}

// Brand card hover effect
document.querySelectorAll('.brand-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.1)';
    });

    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.08)';
    });
});
</script>

<?php include __DIR__ . '/../shares/footer.php'; ?>
