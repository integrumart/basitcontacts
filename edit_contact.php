<?php
require_once 'config.php';
requireLogin();

$error = '';
$success = '';
$contact = null;

// Get contact ID
$contact_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($contact_id <= 0) {
    header("Location: dashboard.php");
    exit();
}

// Get contact details
try {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ? AND user_id = ?");
    $stmt->execute([$contact_id, $_SESSION['user_id']]);
    $contact = $stmt->fetch();
    
    if (!$contact) {
        header("Location: dashboard.php");
        exit();
    }
} catch(PDOException $e) {
    $error = 'Bir hata oluştu.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $address = sanitizeInput($_POST['address'] ?? '');
    $notes = sanitizeInput($_POST['notes'] ?? '');
    
    if (empty($name)) {
        $error = 'İsim alanı zorunludur.';
    } else {
        try {
            $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, phone = ?, address = ?, notes = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$name, $email, $phone, $address, $notes, $contact_id, $_SESSION['user_id']]);
            
            $success = 'Kişi başarıyla güncellendi!';
            
            // Refresh contact data
            $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ? AND user_id = ?");
            $stmt->execute([$contact_id, $_SESSION['user_id']]);
            $contact = $stmt->fetch();
        } catch(PDOException $e) {
            $error = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kişi Düzenle - BasitContacts</title>
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
        .back-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .back-btn:hover {
            background: rgba(255,255,255,0.3);
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
        }
        .error {
            background: #ff4444;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success {
            background: #44ff44;
            color: #006600;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Kişi Düzenle</h1>
            <a href="dashboard.php" class="back-btn">← Kontrol Paneli</a>
        </div>
    </div>
    
    <div class="container">
        <div class="form-card">
            <h2>Kişi Bilgilerini Düzenle</h2>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($contact): ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">İsim: *</label>
                        <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($contact['name']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-posta:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Telefon:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Adres:</label>
                        <textarea id="address" name="address"><?php echo htmlspecialchars($contact['address']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Notlar:</label>
                        <textarea id="notes" name="notes"><?php echo htmlspecialchars($contact['notes']); ?></textarea>
                    </div>
                    
                    <button type="submit">Değişiklikleri Kaydet</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
