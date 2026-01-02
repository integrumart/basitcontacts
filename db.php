<?php
require_once 'config.php';

class Database {
    private $conn;
    
    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch(PDOException $e) {
            die("Veritabanı bağlantı hatası: " . $e->getMessage());
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    // Tüm kişileri getir
    public function getAllContacts() {
        $sql = "SELECT * FROM contacts ORDER BY ad, soyad";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Yeni kişi ekle
    public function addContact($ad, $soyad, $telefon, $email, $adres) {
        $sql = "INSERT INTO contacts (ad, soyad, telefon, email, adres) VALUES (:ad, :soyad, :telefon, :email, :adres)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ad', $ad);
        $stmt->bindParam(':soyad', $soyad);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':adres', $adres);
        return $stmt->execute();
    }
    
    // Kişi sil
    public function deleteContact($id) {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // Kişi ara
    public function searchContacts($search) {
        $search = "%$search%";
        $sql = "SELECT * FROM contacts WHERE ad LIKE :search OR soyad LIKE :search OR telefon LIKE :search OR email LIKE :search ORDER BY ad, soyad";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
