<?php
require_once 'db.php';

// Kişileri veritabanından çek
function getKisiler() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT * FROM kisiler ORDER BY ad, soyad");
    return $stmt->fetchAll();
}

// Kişi silme işlemi
if (isset($_GET['sil']) && is_numeric($_GET['sil'])) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("DELETE FROM kisiler WHERE id = ?");
    $stmt->execute([$_GET['sil']]);
    header("Location: index.php");
    exit;
}

$kisiler = getKisiler();
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
        <header>
            <h1>📖 Basit Kişi Yöneticisi</h1>
            <p>Kişilerinizi kolayca yönetin</p>
        </header>

        <div class="actions">
            <a href="add.php" class="btn btn-primary">➕ Yeni Kişi Ekle</a>
        </div>

        <div class="contacts-list">
            <h2>Kişi Listesi (<?php echo count($kisiler); ?> kişi)</h2>
            
            <?php if (empty($kisiler)): ?>
                <div class="empty-state">
                    <p>Henüz kayıtlı kişi yok. Yeni kişi eklemek için yukarıdaki butona tıklayın.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Ad</th>
                            <th>Soyad</th>
                            <th>Telefon</th>
                            <th>E-posta</th>
                            <th>Adres</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kisiler as $kisi): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($kisi['ad']); ?></td>
                                <td><?php echo htmlspecialchars($kisi['soyad']); ?></td>
                                <td><?php echo htmlspecialchars($kisi['telefon']); ?></td>
                                <td><?php echo htmlspecialchars($kisi['email'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($kisi['adres'] ?? '-'); ?></td>
                                <td class="actions-cell">
                                    <a href="?sil=<?php echo $kisi['id']; ?>" 
                                       class="btn btn-danger btn-small"
                                       onclick="return confirm('Bu kişiyi silmek istediğinize emin misiniz?');">
                                        🗑️ Sil
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <footer>
            <p>&copy; 2026 Basit Kişi Yöneticisi</p>
        </footer>
    </div>
</body>
</html>
