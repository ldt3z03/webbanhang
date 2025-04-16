<h1>Chi tiết đơn hàng</h1>
<p>ID: <?php echo $order->id; ?></p>
<p>Tên khách hàng: <?php echo $order->customer_name; ?></p>
<p>Ngày đặt hàng: <?php echo $order->order_date; ?></p>
<p>Tổng tiền: <?php echo $order->total_amount; ?></p>
<p>Danh sách sản phẩm:</p>
<ul>
    <?php foreach ($order->products as $product): ?>
        <li><?php echo $product->name; ?> - Số lượng: <?php echo $product->quantity; ?></li>
    <?php endforeach; ?>
</ul>