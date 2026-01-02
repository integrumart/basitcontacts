<?php
require_once 'db.php';

$hata = '';
$basarili = false;

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad = trim($_POST['ad'] ?? '');
    $soyad = trim($_POST['soyad'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $adres = trim($_POST['adres'] ?? '');
    
    // Basit doğrulama
    if (empty($ad) || empty($soyad) || empty($telefon)) {
        $hata = 'Ad, soyad ve telefon alanları zorunludur!';
    } else {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("INSERT INTO kisiler (ad, soyad, telefon, email, adres) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$ad, $soyad, $telefon, $email, $adres]);
            $basarili = true;
            
            // Formu temizle
            $ad = $soyad = $telefon = $email = $adres = '';
        } catch (PDOException $e) {
            // Güvenlik için detaylı hata mesajı gösterilmez
            error_log('Kayıt ekleme hatası: ' . $e->getMessage());
            $hata = 'Kayıt eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.';
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
        <header>
            <h1>➕ Yeni Kişi Ekle</h1>
        </header>

        <div class="actions">
            <a href="index.php" class="btn btn-secondary">⬅️ Listeye Dön</a>
        </div>

        <?php if ($hata): ?>
            <div class="alert alert-error">
                ❌ <?php echo htmlspecialchars($hata); ?>
            </div>
        <?php endif; ?>

        <?php if ($basarili): ?>
            <div class="alert alert-success">
                ✅ Kişi başarıyla eklendi! <a href="index.php">Listeye dön</a>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="add.php">
                <div class="form-group">
                    <label for="ad">Ad <span class="required">*</span></label>
                    <input type="text" id="ad" name="ad" value="<?php echo htmlspecialchars($ad ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="soyad">Soyad <span class="required">*</span></label>
                    <input type="text" id="soyad" name="soyad" value="<?php echo htmlspecialchars($soyad ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefon">Telefon <span class="required">*</span></label>
                    <input type="tel" id="telefon" name="telefon" value="<?php echo htmlspecialchars($telefon ?? ''); ?>" required placeholder="0555 123 45 67">
                </div>

                <div class="form-group">
                    <label for="email">E-posta</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" placeholder="ornek@email.com">
                </div>

                <div class="form-group">
                    <label for="adres">Adres</label>
                    <textarea id="adres" name="adres" rows="3" placeholder="Açık adres giriniz..."><?php echo htmlspecialchars($adres ?? ''); ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Kaydet</button>
                    <a href="index.php" class="btn btn-secondary">❌ İptal</a>
                </div>
            </form>
        </div>

        <footer>
            <p>&copy; 2026 Basit Kişi Yöneticisi</p>
        </footer>
    </div>
</body>
</html>
