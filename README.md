# Basit Kişi Yöneticisi

Basit bir PHP ve MySQL tabanlı kişi yönetim sistemi.

## Özellikler

- ✅ Kişi ekleme
- ✅ Kişileri listeleme
- ✅ Kişi silme
- ✅ Kişi arama (ad, soyad, telefon, email)
- ✅ Responsive tasarım
- ✅ Modern ve kullanıcı dostu arayüz

## Gereksinimler

- PHP 7.4 veya üzeri
- MySQL 5.7 veya üzeri
- Apache veya Nginx web sunucusu
- PDO PHP eklentisi

## Kurulum

### 1. Dosyaları Kopyalayın

Proje dosyalarını web sunucunuzun kök dizinine kopyalayın (örneğin: `htdocs` veya `www`).

### 2. Veritabanını Oluşturun

MySQL'e bağlanın ve `database.sql` dosyasını çalıştırın:

```bash
mysql -u root -p < database.sql
```

Veya phpMyAdmin kullanarak `database.sql` dosyasını içe aktarın.

### 3. Veritabanı Ayarlarını Yapılandırın

`config.php` dosyasını açın ve veritabanı bilgilerinizi güncelleyin:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Şifrenizi girin
define('DB_NAME', 'basitcontacts');
```

### 4. Uygulamayı Başlatın

Web tarayıcınızda şu adresi açın:

```
http://localhost/basitcontacts/
```

## Kullanım

### Kişi Ekleme

1. Ana sayfada "➕ Yeni Kişi Ekle" butonuna tıklayın
2. Kişi bilgilerini doldurun (Ad, Soyad ve Telefon zorunludur)
3. "💾 Kaydet" butonuna tıklayın

### Kişi Arama

Ana sayfadaki arama kutusuna ad, soyad, telefon veya email yazın. Arama otomatik olarak gerçekleşir.

### Kişi Silme

Kişi listesinde silmek istediğiniz kişinin yanındaki "🗑️ Sil" butonuna tıklayın ve onaylayın.

## Dosya Yapısı

```
basitcontacts/
├── index.php          # Ana sayfa (kişi listesi)
├── add.php            # Kişi ekleme formu
├── db.php             # Veritabanı işlemleri
├── config.php         # Veritabanı yapılandırması
├── style.css          # CSS stilleri
├── database.sql       # Veritabanı şeması
└── README.md          # Bu dosya
```

## Güvenlik Notları

- Üretim ortamında `config.php` dosyasındaki hata raporlamayı kapatın
- Güçlü veritabanı şifreleri kullanın
- HTTPS kullanın
- SQL injection koruması için PDO prepared statements kullanılmıştır

## Lisans

GPL-3.0 License

## Katkıda Bulunma

Pull request'ler memnuniyetle karşılanır. Büyük değişiklikler için lütfen önce bir issue açın.

## Geliştirici

integrumart
