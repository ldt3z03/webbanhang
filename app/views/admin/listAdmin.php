<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <h1 class="mb-4">Quản lý sản phẩm (Admin)</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Thương hiệu</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo htmlspecialchars($product->name); ?></td>
                    <td><?php echo number_format($product->price, 0, ',', '.'); ?> VND</td>
                    <td><?php echo htmlspecialchars($product->brand_name); ?></td>
                    <td><?php echo htmlspecialchars($product->category_name); ?></td>
                    <td>
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/webbanhang/Product/add" class="btn btn-primary">Thêm sản phẩm mới</a>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>