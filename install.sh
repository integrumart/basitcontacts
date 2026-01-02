#!/bin/bash
# Basit Kişi Yöneticisi Kurulum Scripti

echo "================================"
echo "Basit Kişi Yöneticisi Kurulum"
echo "================================"
echo ""

# Veritabanı bilgilerini al
echo "Veritabanı bilgilerinizi girin:"
read -p "MySQL Host (varsayılan: localhost): " DB_HOST
DB_HOST=${DB_HOST:-localhost}

read -p "MySQL Kullanıcı adı (varsayılan: root): " DB_USER
DB_USER=${DB_USER:-root}

read -sp "MySQL Şifre: " DB_PASS
echo ""

read -p "Veritabanı adı (varsayılan: basitcontacts): " DB_NAME
DB_NAME=${DB_NAME:-basitcontacts}

echo ""
echo "Veritabanı oluşturuluyor..."

# Veritabanını oluştur
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" < database.sql

if [ $? -eq 0 ]; then
    echo "✓ Veritabanı başarıyla oluşturuldu!"
    
    # config.php dosyasını güncelle
    echo ""
    echo "Yapılandırma dosyası güncelleniyor..."
    
    sed -i "s/define('DB_HOST', 'localhost');/define('DB_HOST', '$DB_HOST');/" config.php
    sed -i "s/define('DB_USER', 'root');/define('DB_USER', '$DB_USER');/" config.php
    sed -i "s/define('DB_PASS', '');/define('DB_PASS', '$DB_PASS');/" config.php
    sed -i "s/define('DB_NAME', 'basitcontacts');/define('DB_NAME', '$DB_NAME');/" config.php
    
    echo "✓ Yapılandırma dosyası güncellendi!"
    
    echo ""
    echo "================================"
    echo "Kurulum Tamamlandı!"
    echo "================================"
    echo ""
    echo "Uygulamayı kullanmak için web tarayıcınızda açın:"
    echo "http://localhost/basitcontacts/"
    echo ""
else
    echo "✗ Veritabanı oluşturulurken bir hata oluştu!"
    echo "Lütfen MySQL bilgilerinizi kontrol edin."
    exit 1
fi
