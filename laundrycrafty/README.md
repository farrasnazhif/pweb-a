# LaundryCrafty — Fullstack PHP + MySQL (MAMP/XAMPP) Ready Project (English)

This is a ready-to-run sample web application for a laundry management system using
PHP 8.x, MySQL, and Bootstrap + vanilla JavaScript for the frontend.

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

This is a minimal, educational project intended to be extended and secured before production use.
