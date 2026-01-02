<?php
// Veritabanı bağlantı dosyası
require_once 'config.php';

function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Güvenlik için detaylı hata mesajı gösterilmez
        error_log('Veritabanı bağlantı hatası: ' . $e->getMessage());
        die("Veritabanı bağlantı hatası oluştu. Lütfen sistem yöneticinizle iletişime geçin.");
    }
}
