<?php include __DIR__ . '/../shares/header.php'; ?>

<!-- Hero Banner -->
<div class="hero-banner bg-primary text-white py-5 mb-5" data-aos="fade-up">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right" data-aos-delay="200">
                <h1 class="display-4 fw-bold mb-4">Giày dép chính hãng</h1>
                <p class="lead mb-4">Khám phá bộ sưu tập giày dép đa dạng, chất lượng cao dành cho bạn.</p>
                <a href="#products" class="btn btn-light btn-lg">
                    Mua ngay <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features -->
<div class="container mb-5">
    <div class="row g-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center p-4 rounded-3 bg-light h-100">
                <i class="bi bi-shield-check text-primary display-4 mb-3"></i>
                <h5>Chính hãng 100%</h5>
                <p class="text-muted mb-0">Cam kết chất lượng từ các thương hiệu uy tín</p>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center p-4 rounded-3 bg-light h-100">
                <i class="bi bi-truck text-primary display-4 mb-3"></i>
                <h5>Giao hàng miễn phí</h5>
                <p class="text-muted mb-0">Cho đơn hàng từ 500.000đ</p>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="text-center p-4 rounded-3 bg-light h-100">
                <i class="bi bi-arrow-counterclockwise text-primary display-4 mb-3"></i>
                <h5>Đổi trả dễ dàng</h5>
                <p class="text-muted mb-0">Trong vòng 7 ngày</p>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="text-center p-4 rounded-3 bg-light h-100">
                <i class="bi bi-headset text-primary display-4 mb-3"></i>
                <h5>Hỗ trợ 24/7</h5>
                <p class="text-muted mb-0">Luôn sẵn sàng hỗ trợ bạn</p>
            </div>
        </div>
    </div>
</div>

<!-- Products Section -->
<div class="container" id="products">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="display-6 mb-0" data-aos="fade-right">Bộ sưu tập giày</h2>
            <p class="text-muted lead" data-aos="fade-right" data-aos-delay="100">
                Khám phá các mẫu giày mới nhất của chúng tôi
            </p>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="card h-100 product-card">
                    <?php if ($product->image): ?>
                        <div class="card-img-top-wrapper" style="overflow: hidden;">
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image); ?>" 
                                 class="card-img-top product-image" 
                                 alt="<?php echo htmlspecialchars($product->name); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                <?php echo htmlspecialchars($product->name); ?>
                            </a>
                        </h5>
                        <div class="mb-2">
                            <span class="price"><?php echo number_format($product->price, 0, ',', '.'); ?> VND</span>
                        </div>
                        <div class="product-details mb-3">
                            <span class="badge bg-light text-muted">
                                <i class="bi bi-tag"></i> <?php echo htmlspecialchars($product->category_name); ?>
                            </span>
                            <span class="badge bg-light text-muted">
                                <i class="bi bi-award"></i> <?php echo htmlspecialchars($product->brand_name); ?>
                            </span>
                        </div>
                        <div class="mt-auto">
                            <div class="btn-group w-100">
                                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" 
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-eye"></i> Chi tiết
                                </a>
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                                   class="btn btn-primary add-to-cart-btn" data-product-id="<?php echo $product->id; ?>">
                                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Empty State -->
    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <i class="bi bi-bag-x display-1 text-muted mb-4"></i>
            <h3>Không tìm thấy sản phẩm nào</h3>
            <p class="text-muted">Hiện tại chưa có sản phẩm nào trong danh mục này</p>
        </div>
    <?php endif; ?>

    <?php if (SessionHelper::isAdmin()): ?>
        <div class="admin-actions">
            <a href="/webbanhang/Product/add" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = this.dataset.productId;

            fetch(`/webbanhang/Cart/add/${productId}`, {
                method: 'POST',
            })
                .then(response => {
                    if (response.redirected) {
                        // Redirect to login page if the server responds with a redirect
                        window.location.href = response.url;
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        alert(data.message);
                    } else if (data) {
                        alert('Có lỗi xảy ra khi thêm vào giỏ hàng.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

<?php include __DIR__ . '/../shares/footer.php'; ?>
