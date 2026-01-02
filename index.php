<?php
session_start();
require_once 'db.php';

$db = new Database();
$contacts = [];
$searchQuery = '';
$message = '';

// Oturum mesajını kontrol et
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Arama işlemi
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $contacts = $db->searchContacts($searchQuery);
} else {
    $contacts = $db->getAllContacts();
}

// Kişi silme işlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($db->deleteContact($id)) {
        $_SESSION['message'] = '<div class="message success">Kişi başarıyla silindi!</div>';
    } else {
        $_SESSION['message'] = '<div class="message error">Kişi silinirken bir hata oluştu!</div>';
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basit Kişi Yöneticisi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📇 Basit Kişi Yöneticisi</h1>
            <p>Kişilerinizi kolayca yönetin</p>
        </div>
        
        <div class="content">
            <?php echo $message; ?>
            
            <div class="action-buttons">
                <a href="add.php" class="btn">➕ Yeni Kişi Ekle</a>
            </div>
            
            <div class="search-box">
                <form method="GET" action="index.php">
                    <input type="text" 
                           name="search" 
                           placeholder="🔍 Kişi ara (ad, soyad, telefon veya email)..." 
                           value="<?php echo htmlspecialchars($searchQuery); ?>">
                </form>
            </div>
            
            <?php if (count($contacts) > 0): ?>
                <table class="contacts-table">
                    <thead>
                        <tr>
                            <th>Ad</th>
                            <th>Soyad</th>
                            <th>Telefon</th>
                            <th>Email</th>
                            <th>Adres</th>
                            <th>Kayıt Tarihi</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contact['ad']); ?></td>
                                <td><?php echo htmlspecialchars($contact['soyad']); ?></td>
                                <td><?php echo htmlspecialchars($contact['telefon']); ?></td>
                                <td><?php echo htmlspecialchars($contact['email'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($contact['adres'] ?? '-'); ?></td>
                                <td><?php echo date('d.m.Y H:i', strtotime($contact['kayit_tarihi'])); ?></td>
                                <td>
                                    <a href="index.php?delete=<?php echo $contact['id']; ?>" 
                                       class="btn btn-danger btn-small" 
                                       onclick="return confirm('Bu kişiyi silmek istediğinizden emin misiniz?')">
                                        🗑️ Sil
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <span style="font-size: 60px;">📭</span>
                    <p style="font-size: 18px; margin-top: 20px;">
                        <?php echo $searchQuery ? 'Arama sonucu bulunamadı!' : 'Henüz kayıtlı kişi yok!'; ?>
                    </p>
                    <?php if ($searchQuery): ?>
                        <a href="index.php" class="btn" style="margin-top: 20px;">Tüm Kişileri Göster</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
