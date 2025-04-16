<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/webbanhang/Product">Sản phẩm</a></li>
            <li class="breadcrumb-item"><a href="#"><?php echo htmlspecialchars($product->category_name); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product->name); ?></li>
        </ol>
    </nav>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" data-aos="fade-up">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 mb-4" data-aos="fade-right">
            <div class="card">
                <div class="card-body p-0">
                    <?php if ($product->image): ?>
                        <img src="/webbanhang/<?php echo htmlspecialchars($product->image); ?>"
                             class="img-fluid rounded product-detail-image"
                             alt="<?php echo htmlspecialchars($product->name); ?>"
                             id="mainProductImage">
                    <?php else: ?>
                        <div class="text-center p-5">
                            <i class="bi bi-image text-muted display-1"></i>
                            <p class="text-muted">Chưa có hình ảnh</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left">
            <div class="product-info">
                <h1 class="display-5 mb-3"><?php echo htmlspecialchars($product->name); ?></h1>
                
                <div class="mb-4">
                    <span class="h2 price mb-0"><?php echo number_format($product->price, 0, ',', '.'); ?> VND</span>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-muted me-3">Thương hiệu:</span>
                        <a href="#" class="badge bg-light text-dark text-decoration-none">
                            <?php if ($product->brand_logo): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->brand_logo); ?>" 
                                     alt="<?php echo htmlspecialchars($product->brand_name); ?>"
                                     class="me-1" style="height: 20px;">
                            <?php endif; ?>
                            <?php echo htmlspecialchars($product->brand_name); ?>
                        </a>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <span class="text-muted me-3">Danh mục:</span>
                        <a href="#" class="badge bg-light text-dark text-decoration-none">
                            <?php echo htmlspecialchars($product->category_name); ?>
                        </a>
                    </div>
                </div>

                <?php if ($product->description): ?>
                    <div class="mb-4">
                        <h5>Mô tả sản phẩm</h5>
                        <p class="text-muted"><?php echo nl2br(htmlspecialchars($product->description)); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Add to Cart Button -->
                <form action="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" method="POST" class="mt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng
                    </button>
                </form>

                <?php if (SessionHelper::isAdmin()): ?>
                    <div class="admin-actions">
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                           class="btn btn-outline-primary me-2">
                            <i class="bi bi-pencil"></i> Chỉnh sửa
                        </a>
                        <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete(<?php echo $product->id; ?>, '<?php echo htmlspecialchars($product->name); ?>')">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($relatedProducts)): ?>
        <div class="related-products mt-5" data-aos="fade-up">
            <h3 class="mb-4">Sản phẩm tương tự</h3>
            <div class="row">
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 product-card">
                            <?php if ($relatedProduct->image): ?>
                                <div class="card-img-top-wrapper">
                                    <img src="/webbanhang/<?php echo htmlspecialchars($relatedProduct->image); ?>" 
                                         class="card-img-top product-image" 
                                         alt="<?php echo htmlspecialchars($relatedProduct->name); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/webbanhang/Product/show/<?php echo $relatedProduct->id; ?>">
                                        <?php echo htmlspecialchars($relatedProduct->name); ?>
                                    </a>
                                </h5>
                                <p class="price mb-0">
                                    <?php echo number_format($relatedProduct->price, 0, ',', '.'); ?> VND
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa sản phẩm "<span id="productNameToDelete"></span>"?
                <p class="text-danger mb-0 mt-2">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Lưu ý: Hành động này không thể hoàn tác!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Hủy
                </button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i>Xác nhận xóa
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    const modal = document.getElementById('deleteModal');
    const deleteModal = new bootstrap.Modal(modal);
    
    document.getElementById('productNameToDelete').textContent = name;
    document.getElementById('confirmDeleteButton').href = `/webbanhang/Product/delete/${id}`;
    
    deleteModal.show();
}

// Initialize image zoom effect
const productImage = document.getElementById('mainProductImage');
if (productImage) {
    productImage.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
        this.style.transition = 'transform 0.3s ease';
    });

    productImage.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
}

document.querySelector('form[action^="/webbanhang/Product/addToCart/"]').addEventListener('submit', function(event) {
    event.preventDefault();
    const productId = this.action.split('/').pop();

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
</script>

<style>
.product-detail-image {
    max-height: 500px;
    width: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-info {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.badge {
    font-weight: 500;
    padding: 0.5em 1em;
}

.input-group input[type="number"] {
    text-align: center;
}

.input-group input[type="number"]::-webkit-inner-spin-button,
.input-group input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.related-products .product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.related-products .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}
</style>

<?php include __DIR__ . '/../shares/footer.php'; ?>
