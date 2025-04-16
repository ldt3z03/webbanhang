<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8" data-aos="fade-right">
            <h1 class="display-4 mb-0">Quản lý danh mục</h1>
            <p class="text-muted lead">Quản lý các danh mục sản phẩm</p>
        </div>
        <div class="col-md-4 text-md-end" data-aos="fade-left">
            <a href="/webbanhang/Category/add" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm danh mục mới
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

    <?php if (!empty($categories)): ?>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="card h-100 category-card">
                        <div class="card-body">
                            <h5 class="card-title mb-1"><?php echo htmlspecialchars($category->name); ?></h5>
                            <p class="card-text text-muted mb-3">
                                <?php echo htmlspecialchars($category->description ?? 'Không có mô tả'); ?>
                            </p>
                            <div class="category-actions">
                                <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>" class="btn btn-sm btn-outline-danger">
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
            <i class="bi bi-folder-x display-1 text-muted mb-4"></i>
            <h4>Chưa có danh mục nào</h4>
            <p class="text-muted">Hãy thêm danh mục đầu tiên của bạn</p>
            <a href="/webbanhang/Category/add" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> Thêm danh mục mới
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>