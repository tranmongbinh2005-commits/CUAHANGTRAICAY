<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Store - Cửa hàng Trái cây tươi sạch</title>
    <!-- Google Fonts: Plus Jakarta Sans for premium typography -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #28a745;
            --primary-hover: #218838;
            --primary-light: #e8f5e9;
            --dark-emerald: #11361c;
            --accent: #ffc107;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light); 
            color: var(--text-dark);
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            -webkit-font-smoothing: antialiased;
        }
        
        .content-wrapper { 
            flex: 1; 
        }
        
        /* Premium Glassy Emerald Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, #0d2816 0%, #153e22 100%);
            border-bottom: 3px solid #28a745;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 0.8rem 1rem;
        }
        
        .navbar-brand { 
            font-weight: 800 !important; 
            color: #39e75f !important; 
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: 0 0 12px rgba(57, 231, 95, 0.4);
        }
        
        .nav-link {
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.5rem 1rem !important;
            border-radius: 30px;
            transition: all 0.25s ease;
            margin-left: 5px;
        }
        
        .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.08);
        }
        
        .nav-item.active .nav-link {
            color: #fff !important;
            background: rgba(40, 167, 69, 0.3) !important;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
        }
        
        /* General custom inputs */
        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
        }

        .btn-success {
            background-color: var(--primary);
            border-color: var(--primary);
            transition: all 0.25s ease;
        }
        
        .btn-success:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>"><i class="fas fa-apple-alt mr-2 text-warning"></i>Fruit Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>"><i class="fas fa-home mr-1"></i> Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>Product/"><i class="fas fa-boxes mr-1"></i> Kho sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>category/"><i class="fas fa-tags mr-1"></i> Danh mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>Product/cart">
                        <i class="fas fa-shopping-cart mr-1 text-warning"></i> Giỏ hàng 
                        <span class="badge badge-pill badge-warning" style="font-size: 11px; padding: 0.35em 0.6em;">
                            <?php
                            $cartCount = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
                                    $cartCount += $item['quantity'];
                                }
                            }
                            echo $cartCount;
                            ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-success text-white px-3 ml-2 rounded-pill font-weight-bold" href="<?= BASE_URL ?>Product/add" style="box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);"><i class="fas fa-plus-circle mr-1"></i> Thêm mới</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 content-wrapper">