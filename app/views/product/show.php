<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Chi tiết sản phẩm</h1>

<?php if ($product): ?>
    <h2><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h2>
    <?php if ($product->image): ?>
        <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" style="max-width: 300px;">
    <?php endif; ?>
    <p>Mô tả: <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
    <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>
<?php else: ?>
    <p>Không tìm thấy sản phẩm.</p>
<?php endif; ?>

<a href="/webbanhang/Product" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>

<?php include __DIR__ . '/../shares/footer.php'; ?>
