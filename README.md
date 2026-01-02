# Basit Kişi Yöneticisi

Basit bir PHP ve MySQL tabanlı kişi rehberi uygulaması.

## Özellikler

- ✅ Kişi ekleme
- ✅ Kişi listeleme
- ✅ Kişi silme
- ✅ Responsive tasarım
- ✅ Modern ve kullanıcı dostu arayüz

## Gereksinimler

- PHP 7.4 veya üzeri
- MySQL 5.7 veya üzeri
- Web sunucusu (Apache, Nginx vb.)

## Kurulum

1. Projeyi klonlayın veya indirin:
```bash
git clone https://github.com/integrumart/basitcontacts.git
cd basitcontacts
```

2. MySQL veritabanını oluşturun:
```bash
mysql -u root -p < database.sql
```

veya phpMyAdmin üzerinden `database.sql` dosyasını import edin.

3. Veritabanı ayarlarını düzenleyin:
`config.php` dosyasını açın ve veritabanı bağlantı bilgilerinizi girin:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'kullanici_adi');
define('DB_PASS', 'sifre');
define('DB_NAME', 'basitcontacts');
```

4. Projeyi web sunucunuzun root dizinine kopyalayın veya yerel sunucu başlatın:
```bash
php -S localhost:8000
```

5. Tarayıcınızda açın:
```
http://localhost:8000
```

## Kullanım

### Yeni Kişi Ekleme
1. Ana sayfada "Yeni Kişi Ekle" butonuna tıklayın
2. Formu doldurun (Ad, Soyad ve Telefon zorunludur)
3. "Kaydet" butonuna tıklayın

### Kişileri Görüntüleme
- Ana sayfa tüm kişileri tablo formatında gösterir
- Kişi sayısı başlıkta görüntülenir

### Kişi Silme
- Kişi listesindeki "Sil" butonuna tıklayın
- Onay mesajını kabul edin

## Dosya Yapısı

```
basitcontacts/
├── config.php       # Veritabanı yapılandırması
├── db.php          # Veritabanı bağlantı yöneticisi
├── index.php       # Ana sayfa (kişi listesi)
├── add.php         # Kişi ekleme sayfası
├── style.css       # CSS stilleri
├── database.sql    # Veritabanı şeması
└── README.md       # Dokümantasyon
```

## Güvenlik Notları

- PDO prepared statements kullanılarak SQL injection koruması sağlanmıştır
- XSS koruması için `htmlspecialchars()` kullanılmıştır
- Üretim ortamında mutlaka güçlü veritabanı şifreleri kullanın

## Lisans

MIT License - Detaylar için LICENSE dosyasına bakınız.

## Katkıda Bulunma

Pull request'ler kabul edilmektedir. Büyük değişiklikler için önce bir issue açarak değişikliği tartışınız.

## İletişim

Sorularınız için issue açabilirsiniz.
