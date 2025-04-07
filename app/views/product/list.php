<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="text-center my-4 text-dark">Danh sách giày</h1>
<?php if (SessionHelper::isAdmin()): ?>
    <div class="text-center mb-4">
        <a href="/webbanhang/Product/add" class="btn btn-success">Thêm sản phẩm mới</a>
    </div>
<?php endif; ?>
<div class="row justify-content-center">
    <?php foreach ($products as $product): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
            <div class="card shadow-sm h-100 product-card">
                <?php if ($product->image): ?>
                    <img src="/webbanhang/<?php echo $product->image; ?>" class="card-img-top product-image" alt="Giày">
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark">
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="text-decoration-none">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h5>
                    <p class="text-danger font-weight-bold">Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
                    <p class="text-muted">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="text-muted">Thương hiệu: <?php echo htmlspecialchars($product->brand_name, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <?php if (SessionHelper::isAdmin()): ?>
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm mx-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            <i class="bi bi-trash"></i>
                        </a>
                    <?php endif; ?>
                    <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-sm mx-1">
                        <i class="bi bi-cart-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>
