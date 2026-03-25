<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Racaza Store</title>
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
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.32);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            margin-top: 16px;
        }
        .card h2 {
            font-size: 1.2rem;
            margin-bottom: 12px;
            color: rgba(255,255,255,0.96);
        }
        .form-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }
        .select {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.18);
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
        }
        .select:focus {
            border-color: rgba(231, 76, 60, 0.85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.18);
        }
        .input {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.18);
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
        }
        .input::placeholder {
            color: rgba(255,255,255,0.55);
        }
        .input:focus {
            border-color: rgba(231, 76, 60, 0.85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.18);
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
        .alert-error {
            border-color: rgba(231, 76, 60, 0.40);
            background: rgba(231, 76, 60, 0.14);
            color: rgba(255,255,255,0.92);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 14px;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }
        th {
            color: rgba(255,255,255,0.90);
            font-weight: 800;
            background: rgba(255,255,255,0.06);
        }
        td {
            color: rgba(255,255,255,0.86);
        }
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.14);
            font-weight: 800;
            font-size: 0.85rem;
        }
        .badge-active {
            background: rgba(34, 197, 94, 0.14);
            border-color: rgba(34, 197, 94, 0.30);
        }
        .badge-inactive {
            background: rgba(231, 76, 60, 0.14);
            border-color: rgba(231, 76, 60, 0.35);
        }
        .btn {
            display: inline-block;
            padding: 9px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.92);
            font-weight: 800;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
            text-decoration: none;
        }
        .btn:hover {
            background: rgba(255,255,255,0.14);
            transform: translateY(-1px);
        }
        .btn-danger {
            background: rgba(231, 76, 60, 0.14);
            border-color: rgba(231, 76, 60, 0.35);
        }
        .btn-success {
            background: rgba(34, 197, 94, 0.14);
            border-color: rgba(34, 197, 94, 0.30);
        }
        form {
            display: inline;
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
            <a href="<?= site_url('users') ?>">Users</a>
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
            <h2>Add User</h2>
            <form class="form-row" method="post" action="<?= site_url('users/create') ?>">
                <?= csrf_field() ?>
                <select class="select" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
                <input class="input" type="text" name="username" placeholder="Username" required>
                <input class="input" type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn btn-success">Add</button>
            </form>

            <h2>All Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($users ?? []) as $user): ?>
                        <?php $role = (string) (($user['role'] ?? '')); ?>
                        <?php $isActive = (int) (($user['is_active'] ?? 1)); ?>
                        <tr>
                            <td><?= esc(ucfirst($role)) ?></td>
                            <td><?= (int) ($user['id'] ?? 0) ?></td>
                            <td><?= esc((string) ($user['username'] ?? '')) ?></td>
                            <td>
                                <?php if ($isActive): ?>
                                    <span class="badge badge-active">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-inactive">Deactivated</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn" href="<?= site_url('users/edit/' . $role . '/' . ((int) ($user['id'] ?? 0))) ?>">Edit</a>

                                <?php if ($role === 'admin' && ((int) ($user['id'] ?? 0)) === (int) session()->get('admin_id')): ?>
                                    <span class="badge">Current</span>
                                <?php else: ?>
                                    <form method="post" action="<?= site_url('users/toggle/' . $role . '/' . ((int) ($user['id'] ?? 0))) ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn <?= $isActive ? 'btn-danger' : 'btn-success' ?>">
                                            <?= $isActive ? 'Deactivate' : 'Activate' ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
