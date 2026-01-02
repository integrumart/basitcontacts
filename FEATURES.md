# Basit Kişi Yöneticisi - Uygulama Özellikleri

## 📋 Genel Bakış

Bu proje, PHP ve MySQL kullanarak geliştirilmiş basit bir kişi yönetim uygulamasıdır.

## ✨ Özellikler

### 1. Ana Sayfa (index.php)
- **Kişi Listesi**: Tüm kayıtlı kişileri tablo formatında gösterir
- **Arama Fonksiyonu**: Ad, soyad, telefon veya email ile anlık arama
- **Silme İşlemi**: Onay ile kişi silme
- **Responsive Tasarım**: Mobil ve masaüstü uyumlu
- **Modern UI**: Gradient renkler ve smooth animasyonlar

### 2. Kişi Ekleme (add.php)
- **Form Validasyonu**: Zorunlu alanlar için kontrol
- **Email Validasyonu**: Geçerli email formatı kontrolü
- **Başarı Mesajları**: Session ile kalıcı mesajlar
- **Hata Yönetimi**: Kullanıcı dostu hata mesajları

### 3. Veritabanı (database.sql)
- **UTF-8 Türkçe Desteği**: Türkçe karakterler için özel collation
- **Optimize Edilmiş İndeksler**: Composite index ile hızlı sorgulama
- **Otomatik Zaman Damgası**: Kayıt tarihi otomatik eklenir

### 4. Veritabanı Yönetimi (db.php)
- **PDO ile Güvenlik**: SQL injection koruması
- **Prepared Statements**: Güvenli veri işleme
- **CRUD Operasyonları**: Create, Read, Update, Delete işlemleri
- **Arama Fonksiyonu**: Çoklu alan araması

### 5. Yapılandırma (config.php)
- **Ortam Yönetimi**: Development/Production ayırımı
- **Hata Yönetimi**: Ortama göre error reporting
- **Kolay Düzenleme**: Tek dosyada tüm ayarlar

### 6. Stil (style.css)
- **Modern Tasarım**: Gradient background ve card design
- **Responsive**: Mobil, tablet ve desktop uyumlu
- **Animasyonlar**: Hover effects ve smooth transitions
- **Kullanıcı Dostu**: İyi düzenlenmiş form ve tablo tasarımı

## 🔒 Güvenlik Özellikleri

1. **SQL Injection Koruması**: PDO Prepared Statements
2. **XSS Koruması**: htmlspecialchars() kullanımı
3. **Input Validasyonu**: Sunucu tarafı doğrulama
4. **Session Güvenliği**: session_start() ile güvenli veri taşıma
5. **Ortam Bazlı Error Handling**: Production'da hataları gizleme

## 📦 Kurulum Kolaylığı

### Otomatik Kurulum
- **install.sh**: Interactive kurulum scripti
- Veritabanı otomatik oluşturma
- Config dosyası otomatik güncelleme

### Manuel Kurulum
- Detaylı README talimatları
- Adım adım kurulum rehberi

## 🎨 UI/UX Özellikleri

- **Emoji İkonlar**: Modern ve anlaşılır arayüz
- **Gradient Renkler**: Mor-mavi gradient tema
- **Shadow Effects**: Depth ve 3D hissi
- **Hover Animasyonlar**: İnteraktif butonlar
- **Empty States**: Boş liste için özel ekranlar

## 📱 Responsive Tasarım

- Mobil cihazlar için optimize
- Tablet görünüm desteği
- Desktop için geniş layout
- Flexible form ve tablo yapısı

## 🌐 Türkçe Dil Desteği

- Tüm arayüz Türkçe
- Türkçe karakter desteği (UTF-8)
- Türkçe hata mesajları
- Türkçe tarih formatı

## 📊 Veritabanı Şeması

```
contacts table:
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- ad (VARCHAR(100), NOT NULL)
- soyad (VARCHAR(100), NOT NULL)
- telefon (VARCHAR(20), NOT NULL)
- email (VARCHAR(150), NULLABLE)
- adres (TEXT, NULLABLE)
- kayit_tarihi (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
- INDEX: idx_ad_soyad (ad, soyad)
```

## 🛠 Teknoloji Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3
- **Architecture**: MVC-like pattern
- **Security**: PDO, Prepared Statements, XSS Protection

## 📝 Kod Kalitesi

- Clean code prensipleri
- Türkçe yorumlar ve değişken isimleri
- Separation of concerns
- Reusable database class
- Error handling best practices

## 🚀 Gelecek Geliştirmeler (Öneriler)

- Kişi düzenleme (edit) özelliği
- Sayfalama (pagination)
- Kişi detay sayfası
- Resim yükleme
- Excel/CSV export
- API endpoint'leri
- Admin panel
- Kullanıcı yetkilendirme

## 📄 Lisans

GPL-3.0 License - Açık kaynak kodlu proje
