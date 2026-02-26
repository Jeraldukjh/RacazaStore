<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sale - Racaza Store</title>
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
            max-width: 1400px;
            margin: 26px auto;
            padding: 0 20px 24px;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 20px;
        }
        .main-panel {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.32);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .side-panel {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.32);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .search-bar input {
            flex: 1;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 12px;
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
        }
        .search-bar input::placeholder {
            color: rgba(255,255,255,0.60);
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
            max-height: 500px;
            overflow-y: auto;
        }
        .product-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 12px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .product-card:hover {
            background: rgba(255,255,255,0.10);
            transform: translateY(-2px);
        }
        .product-name {
            font-weight: 600;
            margin-bottom: 4px;
        }
        .product-price {
            font-size: 1.1rem;
            color: #e74c3c;
            margin-bottom: 4px;
        }
        .product-quantity {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.82);
        }
        .cart {
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: rgba(255,255,255,0.06);
            border-radius: 8px;
            margin-bottom: 8px;
        }
        .cart-item-name {
            flex: 1;
        }
        .cart-item-price {
            margin-right: 10px;
        }
        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .quantity-btn {
            width: 24px;
            height: 24px;
            border: 1px solid rgba(255,255,255,0.18);
            background: rgba(255,255,255,0.10);
            color: rgba(255,255,255,0.95);
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-btn:hover {
            background: rgba(255,255,255,0.20);
        }
        .total-section {
            padding: 15px;
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .total-label {
            color: rgba(255,255,255,0.82);
        }
        .total-amount {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: rgba(255,255,255,0.88);
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 12px;
            background: rgba(11, 18, 32, 0.55);
            color: rgba(255,255,255,0.95);
            outline: none;
        }
        .form-group input:focus {
            border-color: rgba(231, 76, 60, 0.85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.18);
        }
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 800;
            transition: all 0.2s ease;
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
        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
            }
            .side-panel {
                order: -1;
            }
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
        <h1>Racaza Store POS</h1>
        <div class="nav-links">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('products') ?>">Products</a>
            <a href="<?= site_url('pos') ?>">POS</a>
            <a href="<?= site_url('pos/sales') ?>">Sales</a>
            <a href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="main-panel">
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
            
            <div class="search-bar">
                <input type="text" id="productSearch" placeholder="Search products...">
            </div>
            
            <div class="products-grid" id="productsGrid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card" onclick="addToCart(<?= $product['id'] ?>, '<?= esc($product['product_name']) ?>', <?= $product['price'] ?>, <?= $product['quantity'] ?>)">
                        <div class="product-name"><?= esc($product['product_name']) ?></div>
                        <div class="product-price">₱<?= number_format($product['price'], 2) ?></div>
                        <div class="product-quantity">Stock: <?= $product['quantity'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="side-panel">
            <h2 style="margin-bottom: 15px;">Cart</h2>
            
            <div class="cart" id="cart">
                <div id="cartItems"></div>
            </div>
            
            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Subtotal:</span>
                    <span class="total-amount" id="subtotal">₱0.00</span>
                </div>
                <div class="total-row">
                    <span class="total-label">Total:</span>
                    <span class="total-amount" id="total">₱0.00</span>
                </div>
            </div>
            
            <form id="saleForm" method="post" action="<?= site_url('pos/processSale') ?>">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="customer_name">Customer Name:</label>
                    <input type="text" id="customer_name" name="customer_name" placeholder="Optional">
                </div>
                <div class="form-group">
                    <label for="cash_received">Cash Received:</label>
                    <input type="number" id="cash_received" name="cash_received" step="0.01" min="0" placeholder="0.00">
                </div>
                <div class="form-group">
                    <label for="change">Change:</label>
                    <input type="number" id="change" name="change" step="0.01" min="0" placeholder="0.00" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Complete Sale</button>
                <button type="button" class="btn btn-secondary" onclick="clearCart()" style="margin-top: 10px;">Clear Cart</button>
            </form>
        </div>
    </div>
    
    <script>
        let cart = [];
        
        function addToCart(id, name, price, stock) {
            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                if (existingItem.quantity < stock) {
                    existingItem.quantity++;
                } else {
                    alert('Insufficient stock!');
                    return;
                }
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1,
                    stock: stock
                });
            }
            
            updateCart();
        }
        
        function updateCart() {
            const cartItems = document.getElementById('cartItems');
            const subtotalEl = document.getElementById('subtotal');
            const totalEl = document.getElementById('total');
            
            cartItems.innerHTML = '';
            let subtotal = 0;
            
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">₱${item.price.toFixed(2)}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </div>
                    </div>
                `;
            });
            
            subtotalEl.textContent = `₱${subtotal.toFixed(2)}`;
            totalEl.textContent = `₱${subtotal.toFixed(2)}`;
            
            // Update hidden form fields
            updateHiddenFields();
        }
        
        function updateQuantity(id, change) {
            const item = cart.find(item => item.id === id);
            if (item) {
                const newQuantity = item.quantity + change;
                if (newQuantity > 0 && newQuantity <= item.stock) {
                    item.quantity = newQuantity;
                    updateCart();
                } else if (newQuantity <= 0) {
                    cart = cart.filter(item => item.id !== id);
                    updateCart();
                } else {
                    alert('Insufficient stock!');
                }
            }
        }
        
        function updateHiddenFields() {
            const form = document.getElementById('saleForm');
            
            // Remove existing hidden fields
            const existingFields = form.querySelectorAll('input[name^="items"]');
            existingFields.forEach(field => field.remove());
            
            // Add hidden fields for cart items
            cart.forEach((item, index) => {
                const hiddenId = document.createElement('input');
                hiddenId.type = 'hidden';
                hiddenId.name = `items[${index}][product_id]`;
                hiddenId.value = item.id;
                form.appendChild(hiddenId);
                
                const hiddenQty = document.createElement('input');
                hiddenQty.type = 'hidden';
                hiddenQty.name = `items[${index}][quantity]`;
                hiddenQty.value = item.quantity;
                form.appendChild(hiddenQty);
                
                const hiddenPrice = document.createElement('input');
                hiddenPrice.type = 'hidden';
                hiddenPrice.name = `items[${index}][unit_price]`;
                hiddenPrice.value = item.price;
                form.appendChild(hiddenPrice);
            });
        }
        
        function clearCart() {
            cart = [];
            updateCart();
            document.getElementById('customer_name').value = '';
            document.getElementById('cash_received').value = '';
            document.getElementById('change').value = '';
        }
        
        // Calculate change when cash received changes
        document.getElementById('cash_received').addEventListener('input', function() {
            const cashReceived = parseFloat(this.value) || 0;
            const total = parseFloat(document.getElementById('total').textContent.replace('₱', '')) || 0;
            const change = cashReceived - total;
            document.getElementById('change').value = change.toFixed(2);
        });
        
        // Search functionality
        document.getElementById('productSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const cards = document.querySelectorAll('.product-card');
            
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? '' : 'none';
            });
        });
        
        // Initialize
        updateCart();
    </script>
</body>
</html>
