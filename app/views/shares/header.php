<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baby Shoes - Giày dép chính hãng</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="/webbanhang/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-primary text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <small>
                        <i class="bi bi-telephone-fill me-2"></i> Hotline: (028) 1234 5678
                        <span class="mx-3">|</span>
                        <i class="bi bi-envelope-fill me-2"></i> Email: info@babyshoes.com
                    </small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <small>
                        <i class="bi bi-truck me-2"></i> Miễn phí vận chuyển cho đơn hàng từ 500.000đ
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" data-aos="fade-down" data-aos-duration="800">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/webbanhang/app/" data-aos="fade-right">
                <img src="/webbanhang/assets/images/logo.png" alt="Baby Shoes Logo" class="me-3" style="height: 40px;">
                <span>BABY SHOES</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item" data-aos="fade-down" data-aos-delay="100">
                        <a class="nav-link" href="/webbanhang/app/">
                            <i class="bi bi-house-door"></i> Trang chủ
                        </a>
                    </li>
                    <?php if (SessionHelper::isAdmin()): ?>
                        <li class="nav-item dropdown" data-aos="fade-down" data-aos-delay="200">
                            <a class="nav-link dropdown-toggle" href="#" id="managementDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear"></i> Quản Lý
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="managementDropdown">
                                <li><a class="dropdown-item" href="/webbanhang/Product/list">Quản lý sản phẩm</a></li>
                                <li><a class="dropdown-item" href="/webbanhang/Category/">Quản lý danh mục</a></li>
                                <li><a class="dropdown-item" href="/webbanhang/Brand/">Quản lý thương hiệu</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav" data-aos="fade-left">
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link cart-badge" href="/webbanhang/Product/cart" 
                               data-count="<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?>">
                                <i class="bi bi-cart3"></i> Giỏ hàng
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person"></i> Tài khoản của tôi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-clock-history"></i> Lịch sử đơn hàng
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="/webbanhang/account/logout">
                                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/webbanhang/account/login">
                                <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <?php if ($_SERVER['REQUEST_URI'] === '/webbanhang/app/'): ?>
    <div class="bg-light py-3 mb-4 border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="d-flex flex-column" action="/webbanhang/Product/search" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." 
                                   name="q" aria-label="Search">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <select class="form-select" name="category">
                                    <option value="">Tất cả danh mục</option>
                                    <?php foreach ((new CategoryModel((new Database())->getConnection()))->getCategories() as $category): ?>
                                        <option value="<?php echo $category->id; ?>">
                                            <?php echo htmlspecialchars($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <select class="form-select" name="brand">
                                    <option value="">Tất cả thương hiệu</option>
                                    <?php foreach ((new BrandModel((new Database())->getConnection()))->getBrands() as $brand): ?>
                                        <option value="<?php echo $brand->id; ?>">
                                            <?php echo htmlspecialchars($brand->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('input[name="q"]');
            const suggestionBox = document.createElement('ul');
            suggestionBox.classList.add('autocomplete-suggestions');
            searchInput.parentNode.appendChild(suggestionBox);

            searchInput.addEventListener('input', function () {
                const query = this.value;

                if (query.length < 2) {
                    suggestionBox.innerHTML = '';
                    return;
                }

                fetch(`/webbanhang/Product/autocomplete?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionBox.innerHTML = '';
                        data.forEach(item => {
                            const suggestionItem = document.createElement('li');
                            suggestionItem.textContent = item;
                            suggestionItem.addEventListener('click', function () {
                                window.location.href = `/webbanhang/Product/search?q=${encodeURIComponent(item)}`;
                            });
                            suggestionBox.appendChild(suggestionItem);
                        });
                    })
                    .catch(error => console.error('Error fetching autocomplete suggestions:', error));
            });

            document.addEventListener('click', function (event) {
                if (!searchInput.contains(event.target) && !suggestionBox.contains(event.target)) {
                    suggestionBox.innerHTML = '';
                }
            });
        });
    </script>

    <style>
        .autocomplete-suggestions {
            position: absolute;
            top: 100%; 
            left: 0;
            background: white;
            border: 1px solid #ddd;
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        }

        .autocomplete-suggestions li {
            padding: 8px 12px;
            cursor: pointer;
        }

        .autocomplete-suggestions li:hover {
            background: #f0f0f0;
        }

        .input-group {
            position: relative; /* Đảm bảo danh sách gợi ý được căn chỉnh theo thanh tìm kiếm */
        }
    </style>

    <div class="container">
