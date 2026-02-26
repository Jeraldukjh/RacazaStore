<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Racaza Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(11, 18, 32, 0.82), rgba(11, 18, 32, 0.82)),
                url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRx7Gz22FABd1AfWslQ50Gdhf1uK3e4_SDjUQ&s');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: rgba(255,255,255,0.92);
        }
        .header {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(11, 18, 32, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: rgba(255,255,255,0.95);
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }
        .header h1 {
            margin: 0;
            font-size: 1.15rem;
            letter-spacing: 0.2px;
        }
        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .nav-links a {
            color: rgba(255,255,255,0.92);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.06);
            transition: background 0.2s ease, transform 0.15s ease;
        }
        .nav-links a:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-1px);
        }
        .container {
            max-width: 800px;
            margin: 26px auto;
            padding: 0 20px 24px;
        }
        .card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.32);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            overflow: hidden;
        }
        .card-header {
            background: rgba(255,255,255,0.06);
            padding: 18px;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }
        .card-header h2 {
            margin: 0;
            color: rgba(255,255,255,0.96);
            font-size: 1.25rem;
        }
        .card-body {
            padding: 18px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: rgba(255,255,255,0.88);
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 12px;
            box-sizing: border-box;
            font-size: 16px;
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
        }
        .form-group input[type="date"] {
            color-scheme: dark;
        }
        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.9;
            cursor: pointer;
        }
        .form-group input:focus {
            border-color: rgba(231, 76, 60, 0.85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.18);
        }
        .btn {
            display: inline-block;
            padding: 11px 16px;
            text-decoration: none;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: background 0.2s ease, transform 0.15s ease;
            font-weight: 800;
        }
        .btn-primary {
            background: #e74c3c;
            color: white;
        }
        .btn-primary:hover {
            background: #d84335;
            transform: translateY(-1px);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.10);
            color: rgba(255,255,255,0.92);
            border: 1px solid rgba(255,255,255,0.16);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.16);
            transform: translateY(-1px);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .alert {
            padding: 10px 12px;
            margin-bottom: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.92);
        }
        .alert-error {
            border-color: rgba(239, 68, 68, 0.35);
            background: rgba(239, 68, 68, 0.12);
        }
        @media (max-width: 560px) {
            .nav-links {
                gap: 10px;
            }
            .nav-links a {
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Racaza Store Admin</h1>
        <div class="nav-links">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('products') ?>">Products</a>
            <a href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Add New Product</h2>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= site_url('product/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date:</label>
                        <input type="date" id="expiry_date" name="expiry_date">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                        <a href="<?= site_url('products') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
