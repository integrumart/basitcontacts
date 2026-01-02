<?php
// Veritabanı bağlantı ayarları
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'basitcontacts');
define('DB_CHARSET', 'utf8mb4');

// Hata raporlama (Geliştirme ortamı için)
// Üretim ortamında DEVELOPMENT sabitini false yapın
define('DEVELOPMENT', true);

if (DEVELOPMENT) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>
