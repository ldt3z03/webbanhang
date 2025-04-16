<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="order-confirmation" style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 8px; max-width: 800px; margin: 20px auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center; color: #333;">Xác nhận đơn hàng</h1>

    <div class="order-details" style="margin-bottom: 20px;">
        <h2 style="color: #555;">Thông tin đơn hàng</h2>
        <p><strong>Mã đơn hàng:</strong> <span style="color: #007bff;"><?= htmlspecialchars($order['id']) ?></span></p>
        <p><strong>Họ và tên:</strong> <?= htmlspecialchars($order['name']) ?></p>
        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></p>
        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></p>
        <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
        <p><strong>Ngày đặt hàng:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
    </div>

    <div class="order-items" style="margin-bottom: 20px;">
        <h2 style="color: #555;">Chi tiết sản phẩm</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Thương hiệu</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <?php 
                        $imagePath = strpos($item['image'], 'uploads/') === 0 ? substr($item['image'], 8) : $item['image'];
                        ?>
                        <td><img src="/webbanhang/uploads/<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-thumbnail" style="width: 50px; height: 50px;"></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= htmlspecialchars($item['brand_name']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div style="text-align: center;">
        <a href="/webbanhang/app/" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>