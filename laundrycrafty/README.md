# LaundryCrafty, Fullstack PHP + MySQL 

This is a ready-to-run sample web application for a laundry management system using
PHP 8.x and MySQL.

I use simple HTML and CSS for the frontend as well.

## Quick setup
1. Place the `laundrycrafty/` folder into your web server directory (`htdocs` for XAMPP/MAMP, `www` for Laragon).
2. Create a MySQL database named `laundrycrafty` (or change credentials in `config.php`).
3. Import `init_db.sql` using phpMyAdmin to create tables and sample data.
4. Visit `http://localhost/laundrycrafty/create_admin.php` once to create an admin account (`admin` / `admin123`).
5. Login at `http://localhost/laundrycrafty/` and explore the dashboard and CRUD pages.

## What is included
- Basic authentication (session-based) for admin/kasir (cashier).
- CRUD for customers, services, and transactions.
- Dashboard with simple stats and Chart.js revenue graph (data from API endpoint).
- API endpoint `api/transaksi.php` for revenue data (last N days).
