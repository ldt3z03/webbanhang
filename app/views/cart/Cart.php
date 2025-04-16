<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>

    <?php if (!empty($cart)): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $consolidatedCart = [];
                    foreach ($cart as $item) {
                        if (isset($consolidatedCart[$item['product_id']])) {
                            $consolidatedCart[$item['product_id']]['quantity'] += $item['quantity'];
                            $consolidatedCart[$item['product_id']]['total'] += $item['price'] * $item['quantity'];
                        } else {
                            $consolidatedCart[$item['product_id']] = [
                                'name' => $item['name'],
                                'price' => $item['price'],
                                'quantity' => $item['quantity'],
                                'image' => $item['image'],
                                'total' => $item['price'] * $item['quantity']
                            ];
                        }
                    }
                    ?>

                    <?php foreach ($consolidatedCart as $productId => $item): ?>
                        <tr>
                            <td><img src="/webbanhang/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 50px;"></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                            <td>
                                <form action="/webbanhang/Cart/updateQuantity/<?php echo $productId; ?>" method="POST">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control" style="width: 60px;">
                                </form>
                            </td>
                            <td><?php echo number_format($item['total'], 0, ',', '.'); ?> VND</td>
                            <td>
                                <a href="/webbanhang/Cart/remove/<?php echo $productId; ?>" class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                        <td colspan="2" class="text-end">
                            <?php 
                            $total = 0;
                            foreach ($consolidatedCart as $item) {
                                $total += $item['total'];
                            }
                            echo number_format($total, 0, ',', '.'); 
                            ?> VND
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-end">
            <a href="/webbanhang/Product/checkout" class="btn btn-primary">Thanh toán</a>
        </div>
    <?php else: ?>
        <p>Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>
</div>

<script>
    document.querySelectorAll('input[name="quantity"]').forEach(input => {
        input.addEventListener('change', function () {
            const form = this.closest('form');
            const productId = form.action.split('/').pop();
            const quantity = this.value;

            fetch(`/webbanhang/Cart/updateQuantity/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `quantity=${quantity}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = this.closest('tr');
                        const price = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace(/[^0-9]/g, ''));
                        const totalCell = row.querySelector('td:nth-child(5)');
                        totalCell.textContent = new Intl.NumberFormat('vi-VN').format(price * quantity) + ' VND';

                        let grandTotal = 0;
                        document.querySelectorAll('td:nth-child(5)').forEach(cell => {
                            grandTotal += parseFloat(cell.textContent.replace(/[^0-9]/g, ''));
                        });
                        document.querySelector('tfoot td:nth-child(2)').textContent = new Intl.NumberFormat('vi-VN').format(grandTotal) + ' VND';
                    } else {
                        alert('Cập nhật số lượng thất bại.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

<?php include __DIR__ . '/../shares/footer.php'; ?>