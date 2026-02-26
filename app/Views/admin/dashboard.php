<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Racaza Store</title>
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
            max-width: 1200px;
            margin: 26px auto;
            padding: 0 20px 24px;
        }
        .welcome-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            padding: 26px;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.32);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .welcome-card h2 {
            color: rgba(255,255,255,0.96);
            margin-bottom: 8px;
            font-size: 1.7rem;
        }
        .welcome-card p {
            color: rgba(255,255,255,0.84);
            margin-bottom: 14px;
        }
        .btn-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 12px;
        }
        .btn {
            display: inline-block;
            padding: 11px 16px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.10);
            transition: background 0.2s ease, transform 0.15s ease;
            font-weight: 800;
        }
        .btn:hover {
            background: #d84335;
            transform: translateY(-1px);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.10);
            color: rgba(255,255,255,0.92);
            border-color: rgba(255,255,255,0.16);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.16);
        }
        .alert {
            padding: 10px 12px;
            margin-bottom: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.08);
        }
        .alert-success {
            border-color: rgba(34, 197, 94, 0.35);
            background: rgba(34, 197, 94, 0.12);
            color: rgba(255,255,255,0.92);
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
            <a href="<?= site_url('pos') ?>">POS</a>
            <a href="<?= site_url('pos/sales') ?>">Sales</a>
            <a href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <div class="welcome-card">
            <h2>Welcome, <?= esc($username) ?>!</h2>
            <p>This is your admin dashboard. Manage your products from here.</p>
            <div class="btn-row">
                <a href="<?= site_url('products') ?>" class="btn">Manage Products</a>
                <a href="<?= site_url('products/create') ?>" class="btn btn-secondary">Add New Product</a>
            </div>
        </div>
    </div>
</body>
</html>
