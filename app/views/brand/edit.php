<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Sửa thương hiệu</h1>
<form method="POST" action="/webbanhang/Brand/update">
    <input type="hidden" name="id" value="<?php echo $brand->id; ?>">
    <div class="form-group">
        <label for="name">Tên thương hiệu:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($brand->name, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($brand->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>

<?php include __DIR__ . '/../shares/footer.php'; ?>
