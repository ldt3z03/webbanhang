<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Thêm thương hiệu mới</h1>
<form method="POST" action="/webbanhang/Brand/save">
    <div class="form-group">
        <label for="name">Tên thương hiệu:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>

<?php include __DIR__ . '/../shares/footer.php'; ?>
