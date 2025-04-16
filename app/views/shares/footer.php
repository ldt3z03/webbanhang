</div> <!-- Đóng container từ header -->

    <!-- Newsletter Section -->
    <section class="bg-primary text-white py-5 mb-0">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8" data-aos="fade-up">
                    <h3 class="mb-3">Đăng ký nhận thông tin</h3>
                    <p class="mb-4">Nhận ngay thông tin về sản phẩm mới và khuyến mãi hấp dẫn!</p>
                    <form class="newsletter-form" onsubmit="return subscribeNewsletter(event)">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="email" class="form-control form-control-lg" 
                                           placeholder="Nhập email của bạn" required>
                                    <button class="btn btn-light btn-lg" type="submit">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <footer class="bg-dark text-light mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Baby Shoes</h5>
                    <p class="small">Chuyên cung cấp các sản phẩm giày dép chất lượng cao với đa dạng mẫu mã và thương hiệu uy tín.</p>
                    <div class="social-links mt-4">
                        <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase mb-4">Danh mục</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/webbanhang/Product" class="text-light text-decoration-none">Tất cả sản phẩm</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Sản phẩm mới</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Sản phẩm bán chạy</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Khuyến mãi</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase mb-4">Hỗ trợ khách hàng</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Hướng dẫn mua hàng</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Chính sách đổi trả</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Chính sách bảo hành</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-light text-decoration-none">Câu hỏi thường gặp</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase mb-4">Liên hệ</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i> 123 Đường ABC, Quận XYZ, TP.HCM
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2"></i> (028) 1234 5678
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i> info@babyshoes.com
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-clock me-2"></i> 8:00 - 21:00 (T2-CN)
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-darker py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 small">© 2024 Baby Shoes. Tất cả quyền được bảo lưu.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <img src="/webbanhang/assets/images/payment-methods.png" alt="Payment Methods" 
                             style="height: 30px;">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Animation on Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Newsletter Subscription
        function subscribeNewsletter(event) {
            event.preventDefault();
            const email = event.target.querySelector('input[type="email"]').value;
            
            // Show loading overlay
            document.getElementById('loadingOverlay').classList.add('active');
            
            // Simulate API call
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.remove('active');
                
                // Show success message
                const alert = document.createElement('div');
                alert.className = 'alert alert-success alert-dismissible fade show';
                alert.innerHTML = `
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Cảm ơn bạn đã đăng ký! Chúng tôi sẽ gửi thông tin đến email ${email}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                event.target.reset();
                document.querySelector('.newsletter-form').prepend(alert);
                
                // Remove alert after 5 seconds
                setTimeout(() => {
                    alert.remove();
                }, 5000);
            }, 1000);
            
            return false;
        }

        // Back to Top Button
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Loading Overlay
        const loadingOverlay = document.getElementById('loadingOverlay');
        
        window.addEventListener('load', () => {
            loadingOverlay.classList.add('active');
            setTimeout(() => {
                loadingOverlay.classList.remove('active');
            }, 500);
        });

        // Show loading overlay before unload
        window.addEventListener('beforeunload', () => {
            loadingOverlay.classList.add('active');
        });

        // Add loading overlay to form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => {
                if (form.checkValidity()) {
                    loadingOverlay.classList.add('active');
                }
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animate elements on scroll
        const fadeUpElements = document.querySelectorAll('.fade-up');
        
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        fadeUpElements.forEach(element => {
            observer.observe(element);
        });
    </script>
</body>
</html>
