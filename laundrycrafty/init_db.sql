CREATE DATABASE IF NOT EXISTS laundrycrafty CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE laundrycrafty;

CREATE TABLE IF NOT EXISTS user (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','kasir','pelanggan') NOT NULL DEFAULT 'kasir'
);

CREATE TABLE IF NOT EXISTS pelanggan (
  id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  alamat TEXT,
  no_hp VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS layanan (
  id_layanan INT AUTO_INCREMENT PRIMARY KEY,
  nama_layanan VARCHAR(100) NOT NULL,
  harga_per_kg DECIMAL(12,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS transaksi (
  id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
  id_pelanggan INT NOT NULL,
  id_layanan INT NOT NULL,
  tanggal_masuk DATE NOT NULL,
  tanggal_selesai DATE DEFAULT NULL,
  berat DECIMAL(8,2) NOT NULL,
  total_harga DECIMAL(12,2) NOT NULL,
  status ENUM('Proses','Selesai','Sudah Diambil') DEFAULT 'Proses',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
  FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan) ON DELETE CASCADE
);

INSERT INTO layanan (nama_layanan, harga_per_kg) VALUES
('Cuci Kering', 8000.00),
('Cuci Setrika', 12000.00),
('Express', 18000.00);
