<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Danh sách thương hiệu</h1>
<a href="/webbanhang/Brand/add" class="btn btn-primary">Thêm thương hiệu</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($brands as $brand): ?>
            <tr>
                <td><?php echo $brand->id; ?></td>
                <td><?php echo htmlspecialchars($brand->name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($brand->description, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="/webbanhang/Brand/edit/<?php echo $brand->id; ?>" class="btn btn-warning">Sửa</a>
                    <a href="/webbanhang/Brand/delete/<?php echo $brand->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../shares/footer.php'; ?>
