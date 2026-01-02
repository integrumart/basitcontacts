<?php
session_start();
require_once 'db.php';

$db = new Database();
$message = '';
$error = '';

// Oturum mesajını kontrol et
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad = trim($_POST['ad'] ?? '');
    $soyad = trim($_POST['soyad'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $adres = trim($_POST['adres'] ?? '');
    
    // Validasyon
    if (empty($ad)) {
        $error = 'Ad alanı zorunludur!';
    } elseif (empty($soyad)) {
        $error = 'Soyad alanı zorunludur!';
    } elseif (empty($telefon)) {
        $error = 'Telefon alanı zorunludur!';
    } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Geçerli bir email adresi giriniz!';
    } else {
        // Kişiyi ekle
        if ($db->addContact($ad, $soyad, $telefon, $email, $adres)) {
            $_SESSION['success_message'] = 'Kişi başarıyla eklendi!';
            header("Location: add.php");
            exit;
        } else {
            $error = 'Kişi eklenirken bir hata oluştu!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Kişi Ekle - Basit Kişi Yöneticisi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>➕ Yeni Kişi Ekle</h1>
            <p>Yeni bir kişi kaydedin</p>
        </div>
        
        <div class="content">
            <?php if ($message): ?>
                <div class="message success"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="add.php">
                <div class="form-group">
                    <label for="ad">Ad *</label>
                    <input type="text" 
                           id="ad" 
                           name="ad" 
                           value="<?php echo htmlspecialchars($ad ?? ''); ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="soyad">Soyad *</label>
                    <input type="text" 
                           id="soyad" 
                           name="soyad" 
                           value="<?php echo htmlspecialchars($soyad ?? ''); ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="telefon">Telefon *</label>
                    <input type="tel" 
                           id="telefon" 
                           name="telefon" 
                           value="<?php echo htmlspecialchars($telefon ?? ''); ?>" 
                           placeholder="5XX XXX XX XX" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?php echo htmlspecialchars($email ?? ''); ?>" 
                           placeholder="ornek@email.com">
                </div>
                
                <div class="form-group">
                    <label for="adres">Adres</label>
                    <textarea id="adres" 
                              name="adres" 
                              placeholder="Kişinin adresi..."><?php echo htmlspecialchars($adres ?? ''); ?></textarea>
                </div>
                
                <div class="action-buttons">
                    <button type="submit" class="btn">💾 Kaydet</button>
                    <a href="index.php" class="btn btn-danger">⬅️ Geri Dön</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
