<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Racaza Store</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }
        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .search {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(11, 18, 32, 0.45);
        }
        .search input {
            width: 240px;
            max-width: 60vw;
            border: none;
            outline: none;
            background: transparent;
            color: rgba(255,255,255,0.95);
            font-size: 14px;
        }
        .search input::placeholder {
            color: rgba(255,255,255,0.60);
        }
        .card-header h2 {
            margin: 0;
            color: rgba(255,255,255,0.96);
            font-size: 1.25rem;
        }
        .card-body {
            padding: 18px;
        }
        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }
        .table th {
            background: rgba(255,255,255,0.06);
            font-weight: 600;
            color: rgba(255,255,255,0.88);
        }
        .table tbody tr:hover {
            background: rgba(255,255,255,0.06);
        }
        .low-stock {
            background: rgba(245, 158, 11, 0.22);
            border: 1px solid rgba(245, 158, 11, 0.35);
            color: rgba(255,255,255,0.95);
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 800;
            display: inline-block;
            line-height: 1.2;
        }
        .danger {
            background: rgba(239, 68, 68, 0.18);
            border: 1px solid rgba(239, 68, 68, 0.30);
            color: rgba(255,255,255,0.95);
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 900;
            display: inline-block;
            line-height: 1.2;
        }
        .warn {
            background: rgba(245, 158, 11, 0.18);
            border: 1px solid rgba(245, 158, 11, 0.30);
            color: rgba(255,255,255,0.95);
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 900;
            display: inline-block;
            line-height: 1.2;
        }
        .btn {
            display: inline-block;
            padding: 9px 12px;
            text-decoration: none;
            border-radius: 12px;
            font-size: 14px;
            margin: 0 4px 4px 0;
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
        .btn-warning {
            background: rgba(255,255,255,0.10);
            color: rgba(255,255,255,0.92);
            border: 1px solid rgba(255,255,255,0.16);
        }
        .btn-warning:hover {
            background: rgba(255,255,255,0.16);
            transform: translateY(-1px);
        }
        .btn-danger {
            background: rgba(239, 68, 68, 0.18);
            color: white;
            border: 1px solid rgba(239, 68, 68, 0.30);
        }
        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.26);
            transform: translateY(-1px);
        }
        .alert {
            padding: 10px 12px;
            margin-bottom: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.92);
        }
        .alert-success {
            border-color: rgba(34, 197, 94, 0.35);
            background: rgba(34, 197, 94, 0.12);
        }
        .alert-error {
            border-color: rgba(239, 68, 68, 0.35);
            background: rgba(239, 68, 68, 0.12);
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: rgba(255,255,255,0.82);
        }
        .empty-state h3 {
            margin: 0 0 6px;
            color: rgba(255,255,255,0.96);
        }
        .empty-state p {
            margin: 0 0 14px;
            color: rgba(255,255,255,0.82);
        }
        .section-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 16px;
        }
        .muted {
            color: rgba(255,255,255,0.82);
        }
        .pill {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            border: 1px solid rgba(239, 68, 68, 0.30);
            background: rgba(239, 68, 68, 0.14);
            color: rgba(255,255,255,0.92);
        }
        .list {
            padding-left: 18px;
            margin: 10px 0 0;
        }
        .list li {
            margin: 6px 0;
        }
        @media (max-width: 560px) {
            .nav-links {
                gap: 10px;
            }
            .nav-links a {
                padding: 8px 10px;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .search input {
                width: 100%;
            }
            .section-grid {
                grid-template-columns: 1fr;
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
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-header">
                <h2>Products</h2>
                <div class="header-actions">
                    <div class="search">
                        <input id="productSearch" type="text" placeholder="Search product or expiry...">
                    </div>
                    <a href="<?= site_url('products/create') ?>" class="btn btn-primary">Add New Product</a>
                </div>
            </div>
            
            <?php if (empty($products)): ?>
                <div class="empty-state">
                    <h3>No products found</h3>
                    <p>Start by adding your first product.</p>
                    <a href="<?= site_url('products/create') ?>" class="btn btn-primary">Add Product</a>
                </div>
            <?php else: ?>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Expiry</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productsTbody">
                            <?php $today = date('Y-m-d'); ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= esc($product['product_name']) ?></td>
                                    <td>$<?= number_format($product['price'], 2) ?></td>
                                    <td>
                                        <?php if ((int) $product['quantity'] === 0): ?>
                                            <span class="danger">0 Out of Stock</span>
                                        <?php elseif ((int) $product['quantity'] <= 3): ?>
                                            <span class="low-stock"><?= $product['quantity'] ?> Low Stock</span>
                                        <?php else: ?>
                                            <?= $product['quantity'] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php $expiry = $product['expiry_date'] ?? ''; ?>
                                        <?php if (!empty($expiry) && $expiry < $today): ?>
                                            <span class="danger"><?= esc($expiry) ?> Expired</span>
                                        <?php elseif (!empty($expiry) && $expiry <= date('Y-m-d', strtotime('+7 days'))): ?>
                                            <span class="warn"><?= esc($expiry) ?> Near Expiry</span>
                                        <?php else: ?>
                                            <?= esc($expiry) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('product/edit/' . $product['id']) ?>" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div class="section-grid">
            <div class="card">
                <div class="card-header">
                    <h2>History</h2>
                </div>
                <div class="card-body">
                    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                        <div style="font-weight:800; color: rgba(255,255,255,0.96);">Expired Products</div>
                        <span class="pill">Expired</span>
                    </div>

                    <div class="muted" style="margin-top:8px;">Auto list (demo): products with quantity = 0</div>

                    <div class="table-wrap" style="margin-top:12px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Expiry</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $hasExpired = false; ?>
                                <?php $today = date('Y-m-d'); ?>
                                <?php foreach ($products as $product): ?>
                                    <?php if (!empty($product['expiry_date']) && $product['expiry_date'] < $today): ?>
                                        <?php $hasExpired = true; ?>
                                        <tr>
                                            <td><?= $product['id'] ?></td>
                                            <td><?= esc($product['product_name']) ?></td>
                                            <td><?= esc($product['expiry_date']) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$hasExpired): ?>
                                    <tr>
                                        <td colspan="3" class="muted">No expired products yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var input = document.getElementById('productSearch');
            var tbody = document.getElementById('productsTbody');
            if (!input || !tbody) return;

            input.addEventListener('input', function () {
                var q = (input.value || '').toLowerCase().trim();
                var rows = tbody.querySelectorAll('tr');

                rows.forEach(function (row) {
                    var text = (row.innerText || row.textContent || '').toLowerCase();
                    row.style.display = text.indexOf(q) !== -1 ? '' : 'none';
                });
            });
        })();
    </script>
</body>
</html>
