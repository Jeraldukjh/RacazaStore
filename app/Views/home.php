<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Racaza Store - Your Online Shopping Destination</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #0b1220;
        }
        .navbar {
            background: rgba(11, 18, 32, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: white;
            padding: 0.85rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ecf0f1;
            text-decoration: none;
            letter-spacing: 0.2px;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        .nav-menu a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-menu a:hover {
            background: rgba(255,255,255,0.10);
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background: rgba(11, 18, 32, 0.92);
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            top: 100%;
            right: 0;
            border: 1px solid rgba(255,255,255,0.08);
            overflow: hidden;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content a {
            display: block;
            padding: 0.75rem 1rem;
            color: #ecf0f1;
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background: rgba(255,255,255,0.10);
        }
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 7.5rem 2rem 3.5rem;
            background-image:
                linear-gradient(rgba(11, 18, 32, 0.72), rgba(11, 18, 32, 0.72)),
                url('https://upload.wikimedia.org/wikipedia/commons/1/1c/Sari-sari_Store_2.JPG');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
        }
        .hero-inner {
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 2rem;
            align-items: center;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255,255,255,0.18);
            font-size: 0.9rem;
        }
        .hero h1 {
            font-size: 3.15rem;
            line-height: 1.1;
            margin: 0.9rem 0 0.9rem;
            animation: fadeInUp 0.9s ease-out;
        }
        .hero p {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.88);
            margin: 0 0 1.6rem;
            animation: fadeInUp 0.9s ease-out 0.15s;
            animation-fill-mode: both;
        }
        .cta-row {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.9s ease-out 0.3s;
            animation-fill-mode: both;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.15rem;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid transparent;
            transition: transform 0.15s ease, background 0.2s ease, border-color 0.2s ease;
            user-select: none;
        }
        .btn-primary {
            background: #e74c3c;
            color: white;
        }
        .btn-primary:hover {
            background: #d84335;
            transform: translateY(-1px);
        }
        .btn-ghost {
            background: rgba(255,255,255,0.10);
            color: rgba(255,255,255,0.95);
            border-color: rgba(255,255,255,0.16);
        }
        .btn-ghost:hover {
            background: rgba(255,255,255,0.16);
            transform: translateY(-1px);
        }
        .hero-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 18px;
            padding: 1.25rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .hero-card h3 {
            margin: 0 0 0.35rem;
            font-size: 1.1rem;
        }
        .hero-card p {
            margin: 0;
            font-size: 0.95rem;
            color: rgba(255,255,255,0.85);
            animation: none;
        }
        .footer {
            background: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }
        @media (max-width: 920px) {
            .hero-inner {
                grid-template-columns: 1fr;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?= site_url() ?>" class="logo"> Racaza Store</a>
            <ul class="nav-menu">
                <li><a href="<?= site_url() ?>">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn"> Admin/Staff</a>
                    <div class="dropdown-content">
                        <a href="<?= site_url('login') ?>">Admin Login</a>
                        <a href="<?= site_url('login') ?>">Staff Login</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-inner">
            <div>
                <div class="badge">📍 Located in Alabel, Sarangani</div>
                <h1>Racaza Sari‑Sari Store</h1>
                <p>
                    A friendly neighborhood store for everyday essentials.
                    Admin and staff can log in to manage products and inventory.
                </p>
                <div class="cta-row">
                    <a href="<?= site_url('login') ?>" class="btn btn-primary">Admin Login</a>
                    <a href="<?= site_url('login') ?>" class="btn btn-ghost">Staff Login</a>
                </div>
            </div>
            <div class="hero-card">
                <h3>Store Hours</h3>
                <p>Mon–Sun: 6:00 AM – 9:00 PM</p>
                <h3 style="margin-top: 1rem;">Quick Info</h3>
                <p>Retail • Snacks • Beverages • Daily Needs</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Racaza Store. All rights reserved.</p>
</body>
</html>
