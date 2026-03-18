<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - Racaza Store</title>
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
            margin-bottom: 20px;
            overflow: hidden;
        }
        .card-header {
            padding: 16px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.10);
            background: rgba(255,255,255,0.06);
        }
        .card-header h2 {
            margin: 0;
            color: rgba(255,255,255,0.96);
            font-size: 1.15rem;
            letter-spacing: 0.2px;
        }
        .card-body {
            padding: 18px;
        }
        .subtitle {
            margin-top: 6px;
            color: rgba(255,255,255,0.78);
            font-size: 0.92rem;
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
            position: sticky;
            top: 0;
        }
        .table tbody tr:hover {
            background: rgba(255,255,255,0.06);
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .summary-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 16px;
            padding: 14px 14px;
            text-align: left;
            display: grid;
            gap: 8px;
        }
        .summary-card h3 {
            margin: 0 0 8px 0;
            color: rgba(255,255,255,0.96);
            font-size: 0.9rem;
            font-weight: 700;
        }
        .summary-card .value {
            font-size: 1.55rem;
            font-weight: 900;
            color: #e74c3c;
            letter-spacing: 0.2px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 12px;
            padding: 11px 14px;
            font-weight: 900;
            border: 1px solid rgba(255,255,255,0.16);
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.15s ease;
        }
        .btn:active { transform: translateY(0); }
        .btn-primary {
            background: #e74c3c;
            color: white;
            border-color: rgba(231, 76, 60, 0.25);
        }
        .btn-primary:hover {
            background: #d84335;
            transform: translateY(-1px);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.10);
            color: rgba(255,255,255,0.92);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.16);
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
        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: flex-end;
        }
        .filter-group label {
            display: block;
            margin-bottom: 6px;
            color: rgba(255,255,255,0.88);
            font-weight: 600;
        }
        .filter-group input[type="date"] {
            padding: 10px 12px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 12px;
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
            color-scheme: dark;
            min-width: 180px;
        }
        .filter-group input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.9;
            cursor: pointer;
        }
        .btn-inline {
            width: auto;
        }
        @media (max-width: 560px) {
            .nav-links {
                gap: 10px;
            }
            .nav-links a {
                padding: 8px 10px;
            }
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sales Report</h1>
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

        <div class="card">
            <div class="card-header">
                <h2>Filter</h2>
            </div>
            <div class="card-body">
                <div class="subtitle">Pumili ng date para makita ang sales ng araw na iyon.</div>
                <form method="get" action="<?= site_url('pos/sales') ?>" class="filters" style="margin-top: 12px;">
                    <div class="filter-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" value="<?= esc($selectedDate ?? date('Y-m-d')) ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-inline">Apply</button>
                    <a href="<?= site_url('pos/sales') ?>" class="btn btn-secondary btn-inline">Today</a>
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2>Summary (<?= esc($selectedDate ?? date('Y-m-d')) ?>)</h2>
            </div>
            <div class="card-body">
                <div class="summary-grid" style="margin-bottom: 0;">
                    <div class="summary-card">
                        <h3>Total Sales</h3>
                        <div class="value"><?= (int) (($dailySummary['total_sales'] ?? 0)) ?></div>
                    </div>
                    <div class="summary-card">
                        <h3>Total Revenue</h3>
                        <div class="value">₱<?= number_format((float) (($dailySummary['total_revenue'] ?? 0)), 2) ?></div>
                    </div>
                    <div class="summary-card">
                        <h3>Avg Sale</h3>
                        <?php $totalSales = (int) (($dailySummary['total_sales'] ?? 0)); ?>
                        <?php $totalRevenue = (float) (($dailySummary['total_revenue'] ?? 0)); ?>
                        <div class="value">₱<?= $totalSales > 0 ? number_format($totalRevenue / $totalSales, 2) : '0.00' ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2>Sales (<?= esc($selectedDate ?? date('Y-m-d')) ?>)</h2>
            </div>
            <div class="card-body">
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($sales)): ?>
                                <tr>
                                    <td colspan="6" style="color: rgba(255,255,255,0.82);">No sales found for this date.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($sales as $sale): ?>
                                    <tr>
                                        <td><?= date('h:i A', strtotime($sale['sold_at'])) ?></td>
                                        <td><?= esc($sale['product_name']) ?></td>
                                        <td><?= $sale['quantity_sold'] ?></td>
                                        <td>₱<?= number_format($sale['unit_price'], 2) ?></td>
                                        <td>₱<?= number_format($sale['total_price'], 2) ?></td>
                                        <td><?= esc($sale['customer_name'] ?? 'Walk-in') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2>Top Products (Last 7 Days)</h2>
            </div>
            <div class="card-body">
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total Sold</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($topProducts)): ?>
                                <tr>
                                    <td colspan="3" style="color: rgba(255,255,255,0.82);">No data yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($topProducts as $product): ?>
                                    <tr>
                                        <td><?= esc($product['product_name']) ?></td>
                                        <td><?= $product['total_sold'] ?></td>
                                        <td>₱<?= number_format($product['total_revenue'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
