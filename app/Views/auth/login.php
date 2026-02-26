<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Racaza Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-image:
                linear-gradient(rgba(11, 18, 32, 0.78), rgba(11, 18, 32, 0.78)),
                url('https://upload.wikimedia.org/wikipedia/commons/1/1c/Sari-sari_Store_2.JPG');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: rgba(255,255,255,0.92);
        }
        .login-container {
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.35);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }
        .brand {
            font-weight: 800;
            letter-spacing: 0.2px;
            color: rgba(255,255,255,0.95);
        }
        .back-link {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.06);
            transition: background 0.2s ease, transform 0.15s ease;
            white-space: nowrap;
        }
        .back-link:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-1px);
        }
        .login-container h2 {
            text-align: left;
            color: rgba(255,255,255,0.96);
            margin: 0 0 6px;
            font-size: 1.6rem;
        }
        .subtitle {
            color: rgba(255,255,255,0.82);
            margin-bottom: 18px;
            font-size: 0.95rem;
        }
        .form-group {
            margin-bottom: 14px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: rgba(255,255,255,0.88);
            font-size: 0.95rem;
        }
        .form-group input {
            width: 100%;
            padding: 12px 12px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 12px;
            box-sizing: border-box;
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
        }
        .form-group input::placeholder {
            color: rgba(255,255,255,0.55);
        }
        .form-group input:focus {
            border-color: rgba(231, 76, 60, 0.85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.18);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #e74c3c;
            color: white;
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 800;
            transition: transform 0.15s ease, background 0.2s ease;
        }
        .btn:hover {
            background: #d84335;
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
        @media (max-width: 420px) {
            .login-container {
                padding: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="top-row">
            <div class="brand">Racaza Store</div>
            <a class="back-link" href="<?= site_url('/') ?>">Back to Home</a>
        </div>

        <h2>Login</h2>
        <div class="subtitle">Admin/Staff access</div>
        
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
        
        <form action="<?= site_url('auth/authenticate') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
