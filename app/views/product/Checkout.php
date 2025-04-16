<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div data-aos="fade-right">
                <h1 class="display-4 mb-4">Thanh toán</h1>

                <form id="checkoutForm" action="/webbanhang/Product/processCheckout" method="POST" class="needs-validation" novalidate>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">Thông tin giao hàng</h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="customerName" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="customerName" name="customer_name"
                                           value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['fullname'] : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           pattern="[0-9]{10}" required>
                                    <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ (10 số)</div>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['email'] : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                    <div class="invalid-feedback">Vui lòng nhập địa chỉ giao hàng</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">Phương thức thanh toán</h5>

                            <div class="payment-methods">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                           id="cod" value="cod" checked required>
                                    <label class="form-check-label d-flex align-items-center" for="cod">
                                        <i class="bi bi-cash-coin text-success me-2"></i>
                                        Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-lock-fill me-2"></i>Đặt hàng
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4" data-aos="fade-left">
            <div class="card shadow-sm mb-4 sticky-top" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Đơn hàng của bạn</h5>

                    <div class="order-items mb-4">
                        <?php 
                        $total = 0;
                        foreach ($cart as $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <?php if ($item['image']): ?>
                                        <img src="/webbanhang/<?php echo htmlspecialchars($item['image']); ?>"
                                             class="rounded" alt="<?php echo htmlspecialchars($item['name']); ?>"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
                                    <p class="mb-0 text-muted">
                                        <small>
                                            <?php echo $item['quantity']; ?> x 
                                            <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                        </small>
                                    </p>
                                </div>
                                <div class="flex-shrink-0 ms-3">
                                    <span class="price">
                                        <?php echo number_format($subtotal, 0, ',', '.'); ?> VND
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="order-summary">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính</span>
                            <span class="price"><?php echo number_format($total, 0, ',', '.'); ?> VND</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển</span>
                            <span class="text-success">Miễn phí</span>
                        </div>

                        <?php if ($total >= 500000): ?>
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Ưu đãi
                                </span>
                                <span>Miễn phí vận chuyển</span>
                            </div>
                        <?php endif; ?>

                        <hr>

                        <div class="d-flex justify-content-between mb-0">
                            <strong>Tổng cộng</strong>
                            <span class="price h4 mb-0"><?php echo number_format($total, 0, ',', '.'); ?> VND</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm" data-aos="fade-left" data-aos-delay="200">
                <div class="card-body p-4">
                    <h6 class="card-title mb-3">
                        <i class="bi bi-shield-check text-success me-2"></i>
                        Cam kết của chúng tôi
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <small>
                                <i class="bi bi-check2 text-success me-2"></i>
                                Miễn phí vận chuyển cho đơn hàng từ 500.000đ
                            </small>
                        </li>
                        <li class="mb-2">
                            <small>
                                <i class="bi bi-check2 text-success me-2"></i>
                                Đổi trả miễn phí trong 7 ngày
                            </small>
                        </li>
                        <li class="mb-2">
                            <small>
                                <i class="bi bi-check2 text-success me-2"></i>
                                Bảo hành chính hãng 12 tháng
                            </small>
                        </li>
                        <li>
                            <small>
                                <i class="bi bi-check2 text-success me-2"></i>
                                Thanh toán an toàn & bảo mật
                            </small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function () {
    'use strict'

    const form = document.getElementById('checkoutForm');
    
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    });
})();

// Payment method toggle
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const bankDetails = document.getElementById('bankDetails');
        if (this.value === 'bank') {
            bankDetails.style.display = 'block';
        } else {
            bankDetails.style.display = 'none';
        }
    });
});

// Phone number validation
const phoneInput = document.getElementById('phone');
phoneInput.addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
});

// Auto-fill address from previous orders if available
document.addEventListener('DOMContentLoaded', function() {
    const savedAddress = localStorage.getItem('lastUsedAddress');
    if (savedAddress) {
        document.getElementById('address').value = savedAddress;
    }
});

// Save address to localStorage when form is submitted
document.getElementById('checkoutForm').addEventListener('submit', function() {
    const address = document.getElementById('address').value;
    localStorage.setItem('lastUsedAddress', address);
});
</script>

<style>
.sticky-top {
    z-index: 1020;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.order-items {
    max-height: 300px;
    overflow-y: auto;
}

.payment-methods .form-check-label {
    cursor: pointer;
}

.payment-methods .form-check-input:checked ~ .form-check-label {
    color: var(--bs-primary);
}
</style>

<?php include __DIR__ . '/../shares/footer.php'; ?>