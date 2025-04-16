<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm" data-aos="fade-up">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="/webbanhang/assets/images/logo.png" alt="Baby Shoes Logo" 
                             class="mb-3" style="max-height: 60px;">
                        <h1 class="h3">Đăng nhập</h1>
                        <p class="text-muted">Chào mừng bạn quay trở lại!</p>
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

                    <form id="loginForm" action="/webbanhang/Account/login" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : ''; ?>"
                                       required>
                                <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <a href="#" class="text-decoration-none small" data-bs-toggle="modal" 
                                   data-bs-target="#forgotPasswordModal">
                                    Quên mật khẩu?
                                </a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                       <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="remember">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                        </button>

                        <p class="text-center mb-0">
                            Chưa có tài khoản? 
                            <a href="/webbanhang/Account/register" class="text-decoration-none">Đăng ký ngay</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quên mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="resetEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="resetEmail" required>
                        <div class="form-text">
                            Chúng tôi sẽ gửi hướng dẫn đặt lại mật khẩu vào email của bạn.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Gửi yêu cầu
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function () {
    'use strict'

    const form = document.getElementById('loginForm');
    
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    });
})();

// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
});

// Handle forgot password form
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('resetEmail').value;
    
    // Here you would typically make an AJAX call to your backend
    alert('Hướng dẫn đặt lại mật khẩu đã được gửi đến email của bạn (chức năng demo)');
    $('#forgotPasswordModal').modal('hide');
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
</style>

<?php include __DIR__ . '/../shares/footer.php'; ?>