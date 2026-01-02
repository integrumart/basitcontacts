-- Basit Contacts Veritabanı Şeması
-- MySQL veritabanı oluşturma ve tablo yapısı

CREATE DATABASE IF NOT EXISTS basitcontacts CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE basitcontacts;

-- Kişiler tablosu
CREATE TABLE IF NOT EXISTS kisiler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(100) NOT NULL,
    soyad VARCHAR(100) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    adres TEXT,
    olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_soyad (ad, soyad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
