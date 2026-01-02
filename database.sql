-- Veritabanı oluştur (Create database)
CREATE DATABASE IF NOT EXISTS basitcontacts CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci;

USE basitcontacts;

-- Kişiler tablosu (Contacts table)
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(100) NOT NULL,
    soyad VARCHAR(100) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    email VARCHAR(150),
    adres TEXT,
    kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad (ad),
    INDEX idx_soyad (soyad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;
