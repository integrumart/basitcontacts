<?php
require_once 'config.php';
requireLogin();

// Get user's contacts
$conn = getDBConnection();
$stmt = $conn->prepare("SELECT * FROM contacts WHERE user_id = ? ORDER BY name ASC");
$stmt->execute([$_SESSION['user_id']]);
$contacts = $stmt->fetchAll();

$total_contacts = count($contacts);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrol Paneli - BasitContacts</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 24px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .stats {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            text-align: center;
        }
        .stats h2 {
            color: #667eea;
            font-size: 36px;
            margin-bottom: 5px;
        }
        .stats p {
            color: #666;
        }
        .actions {
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .contacts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .contact-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .contact-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .contact-info {
            color: #666;
            margin-bottom: 5px;
        }
        .contact-info strong {
            color: #333;
        }
        .contact-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }
        .edit-btn {
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .delete-btn {
            padding: 8px 15px;
            background: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .no-contacts {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        .no-contacts h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>BasitContacts</h1>
            <div class="user-info">
                <span>Hoş geldin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="logout.php" class="logout-btn">Çıkış Yap</a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="stats">
            <h2><?php echo $total_contacts; ?></h2>
            <p>Toplam Kişi (Sınırsız)</p>
        </div>
        
        <div class="actions">
            <a href="add_contact.php" class="btn">+ Yeni Kişi Ekle</a>
        </div>
        
        <?php if ($total_contacts > 0): ?>
            <div class="contacts-grid">
                <?php foreach ($contacts as $contact): ?>
                    <div class="contact-card">
                        <div class="contact-name"><?php echo htmlspecialchars($contact['name']); ?></div>
                        
                        <?php if ($contact['email']): ?>
                            <div class="contact-info">
                                <strong>E-posta:</strong> <?php echo htmlspecialchars($contact['email']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($contact['phone']): ?>
                            <div class="contact-info">
                                <strong>Telefon:</strong> <?php echo htmlspecialchars($contact['phone']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($contact['address']): ?>
                            <div class="contact-info">
                                <strong>Adres:</strong> <?php echo htmlspecialchars($contact['address']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($contact['notes']): ?>
                            <div class="contact-info">
                                <strong>Notlar:</strong> <?php echo htmlspecialchars($contact['notes']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="contact-actions">
                            <a href="edit_contact.php?id=<?php echo $contact['id']; ?>" class="edit-btn">Düzenle</a>
                            <a href="delete_contact.php?id=<?php echo $contact['id']; ?>" class="delete-btn" onclick="return confirm('Bu kişiyi silmek istediğinizden emin misiniz?')">Sil</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-contacts">
                <h2>Henüz kişi eklemediniz</h2>
                <p>Sınırsız sayıda kişi ekleyebilirsiniz!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
