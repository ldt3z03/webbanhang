<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm" data-aos="fade-up">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="/webbanhang/assets/images/logo.png" alt="Baby Shoes Logo" 
                             class="mb-3" style="max-height: 60px;">
                        <h1 class="h3">Đăng ký tài khoản</h1>
                        <p class="text-muted">Tạo tài khoản để mua sắm dễ dàng hơn</p>
                    </div>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php 
                            echo htmlspecialchars($_SESSION['error']);
                            unset($_SESSION['error']);
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php 
                            echo htmlspecialchars($_SESSION['success']);
                            unset($_SESSION['success']);
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form id="registerForm" action="/webbanhang/Account/register" method="POST" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="username" class="form-label">Họ và Tên</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="invalid-feedback">Vui lòng nhập họ và tên của bạn</div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d[^A-Za-z\d]]{8,}$" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ, số và ký tự đặc biệt
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="confirmPassword" 
                                           name="confirmPassword" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">Mật khẩu không khớp</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Tôi đồng ý với <a href="#" data-bs-toggle="modal" 
                                        data-bs-target="#termsModal">điều khoản sử dụng</a>
                                    </label>
                                    <div class="invalid-feedback">
                                        Bạn phải đồng ý với điều khoản sử dụng để tiếp tục
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-person-plus me-2"></i>Đăng ký
                                </button>
                            </div>

                            <div class="col-12 text-center">
                                <p class="mb-0">
                                    Đã có tài khoản? 
                                    <a href="/webbanhang/Account/login" class="text-decoration-none">Đăng nhập ngay</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-shield-check text-success me-2"></i>
                        Lợi ích khi đăng ký tài khoản
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-clock-history text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Xem lịch sử đơn hàng</h6>
                                    <p class="text-muted small mb-0">
                                        Theo dõi đơn hàng và lịch sử mua sắm của bạn
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-heart text-danger me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Lưu sản phẩm yêu thích</h6>
                                    <p class="text-muted small mb-0">
                                        Tạo danh sách sản phẩm yêu thích của riêng bạn
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-truck text-success me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Thanh toán nhanh hơn</h6>
                                    <p class="text-muted small mb-0">
                                        Lưu thông tin giao hàng để thanh toán nhanh chóng
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-gift text-warning me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Ưu đãi đặc biệt</h6>
                                    <p class="text-muted small mb-0">
                                        Nhận thông báo về các chương trình khuyến mãi
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Điều khoản sử dụng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>1. Điều khoản chung</h6>
                <p>Bằng việc truy cập và sử dụng website này, bạn đồng ý tuân thủ và chịu ràng buộc bởi các điều khoản sau.</p>
                
                <h6>2. Tài khoản người dùng</h6>
                <p>Khi tạo tài khoản, bạn phải cung cấp thông tin chính xác và cập nhật. Bạn chịu trách nhiệm bảo mật tài khoản của mình.</p>
                
                <h6>3. Quyền riêng tư</h6>
                <p>Chúng tôi tôn trọng quyền riêng tư của bạn. Thông tin cá nhân của bạn sẽ được bảo mật theo chính sách riêng tư của chúng tôi.</p>
                
                <h6>4. Đơn hàng và thanh toán</h6>
                <p>Bạn đồng ý cung cấp thông tin thanh toán chính xác và có quyền sử dụng phương thức thanh toán được cung cấp.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function () {
    'use strict'

    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    
    // Add password match validation
    confirmPassword.addEventListener('input', function() {
        if (password.value !== this.value) {
            this.setCustomValidity('Mật khẩu không khớp');
        } else {
            this.setCustomValidity('');
        }
    });

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    });
})();

// Toggle password visibility
function togglePasswordVisibility(inputId, buttonId) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

document.getElementById('togglePassword').addEventListener('click', function() {
    togglePasswordVisibility('password', 'togglePassword');
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword');
});

// Phone number validation
const phoneInput = document.getElementById('phone');
phoneInput.addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
});

// Password strength indicator
password.addEventListener('input', function() {
    const strengthMeter = document.createElement('div');
    strengthMeter.className = 'progress mt-2';
    strengthMeter.style.height = '5px';
    
    if (!this.nextElementSibling.classList.contains('progress')) {
        this.parentElement.insertBefore(strengthMeter, this.nextElementSibling);
    }
    
    const value = this.value;
    let strength = 0;
    
    if (value.length >= 8) strength += 25;
    if (value.match(/[A-Z]/)) strength += 25;
    if (value.match(/[0-9]/)) strength += 25;
    if (value.match(/[^A-Za-z0-9]/)) strength += 25;
    
    const progressBar = strengthMeter.querySelector('.progress-bar') || document.createElement('div');
    progressBar.className = `progress-bar ${strength > 75 ? 'bg-success' : strength > 50 ? 'bg-warning' : 'bg-danger'}`;
    progressBar.style.width = strength + '%';
    progressBar.setAttribute('aria-valuenow', strength);
    
    if (!strengthMeter.querySelector('.progress-bar')) {
        strengthMeter.appendChild(progressBar);
    }
});
</script>

<style>
.input-group-text {
    background-color: transparent;
}

.btn-outline-secondary:hover {
    background-color: transparent;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.card {
    border: none;
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}
</style>

<?php include __DIR__ . '/../shares/footer.php'; ?>
