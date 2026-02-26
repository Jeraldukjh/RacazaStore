# Racaza Store Admin Product Management System

A simple Admin Product Management System built with CodeIgniter 4.

## Features

- **Admin Authentication**: Secure login system with session management
- **Product Management**: Full CRUD operations for products
- **Database Migrations**: Version-controlled database schema
- **Database Seeders**: Sample data for testing

## Database Setup

### Using Migrations and Seeders

1. Make sure your database configuration in `.env` is set correctly:
   ```env
   database.default.hostname = localhost
   database.default.database = racazastore
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

2. Run the migrations to create database tables:
   ```bash
   php spark migrate
   ```

3. Run the seeders to populate sample data:
   ```bash
   php spark db:seed MainSeeder
   ```

### Default Login Credentials

- **Username**: admin
- **Password**: admin123

## Project Structure

```
app/
├── Controllers/
│   ├── Auth.php          # Login/Logout functionality
│   ├── Dashboard.php     # Main dashboard
│   └── Product.php       # Product CRUD operations
├── Models/
│   ├── AdminModel.php    # Admin user model
│   └── ProductModel.php  # Product model
└── Views/
    ├── login.php         # Login form
    ├── dashboard.php     # Admin dashboard
    └── products/
        ├── index.php     # Product list
        ├── create.php    # Add product form
        └── edit.php      # Edit product form

Database/
├── Migrations/
│   ├── 2024_02_26_000001_create_admins_table.php
│   └── 2024_02_26_000002_create_products_table.php
└── Seeds/
    ├── AdminSeeder.php   # Seed admin users
    ├── ProductSeeder.php # Seed sample products
    └── MainSeeder.php    # Main seeder that calls all seeders
```

## Routes

- `/` or `/login` - Login page
- `/auth/authenticate` - Process login (POST)
- `/auth/logout` - Logout
- `/dashboard` - Admin dashboard
- `/products` - Product list
- `/products/create` - Add new product form
- `/product/store` - Save new product (POST)
- `/product/edit/{id}` - Edit product form
- `/product/update/{id}` - Update product (POST)
- `/product/delete/{id}` - Delete product

## Usage

1. Start your development server:
   ```bash
   php spark serve
   ```

2. Open your browser and navigate to `http://localhost:8080`

3. Login with the default credentials:
   - Username: admin
   - Password: admin123

4. You can now:
   - View the dashboard
   - Add, edit, and delete products
   - View all products in a table format

## Security Features

- Password hashing using PHP's built-in `password_hash()`
- Session-based authentication
- CSRF protection on all forms
- Input escaping to prevent XSS attacks

## Database Tables

### admins
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `username` (VARCHAR 50, UNIQUE)
- `password` (VARCHAR 255, hashed)
- `created_at` (DATETIME)
- `updated_at` (DATETIME)

### products
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `product_name` (VARCHAR 100)
- `price` (DECIMAL 10,2)
- `quantity` (INT)
- `created_at` (DATETIME)
- `updated_at` (DATETIME)

## Requirements

- PHP 7.4 or higher
- MySQL/MariaDB database
- CodeIgniter 4
- Web server (Apache, Nginx, or PHP built-in server)
