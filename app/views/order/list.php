<h1>Danh sách đơn hàng</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tổng tiền</th>
            <th>Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order->id; ?></td>
                <td><?php echo $order->customer_name; ?></td>
                <td><?php echo $order->order_date; ?></td>
                <td><?php echo $order->total_amount; ?></td>
                <td><a href="/webbanhang/Order/details/<?php echo $order->id; ?>">Xem</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>