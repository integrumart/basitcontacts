# BasitContacts - Basit Kişi Yöneticisi

PHP tabanlı, güvenli ve kullanıcı dostu bir kişi yönetim sistemi. MySQL veritabanı ile çalışır ve sınırsız kişi eklemenize olanak tanır.

## Özellikler

✅ **Güvenli Kullanıcı Girişi**
- Kullanıcı adı ve şifre ile güvenli giriş
- Şifre hashleme (bcrypt)
- Oturum yönetimi

✅ **Sınırsız Kişi Yönetimi**
- Sınırsız sayıda kişi ekleyebilirsiniz
- Kişi bilgilerini düzenleyebilirsiniz
- Kişileri silebilirsiniz

✅ **Kapsamlı Kişi Bilgileri**
- İsim
- E-posta
- Telefon
- Adres
- Notlar

✅ **Güvenlik Özellikleri**
- SQL injection koruması (Prepared Statements)
- XSS koruması
- CSRF koruması
- Güvenli şifre hashleme

✅ **Modern Arayüz**
- Responsive tasarım
- Kullanıcı dostu
- Modern ve şık görünüm

## Gereksinimler

- PHP 7.4 veya üzeri
- MySQL 5.7 veya üzeri
- Apache/Nginx web sunucusu
- PHP PDO MySQL eklentisi

## Kurulum

### 1. Dosyaları İndirin

Projeyi bilgisayarınıza klonlayın veya indirin:

```bash
git clone https://github.com/integrumart/basitcontacts.git
cd basitcontacts
```

### 2. Veritabanını Oluşturun

MySQL'e giriş yapın ve veritabanını oluşturun:

```bash
mysql -u root -p < database.sql
```

Ya da MySQL istemcisinde manuel olarak:

```sql
mysql -u root -p
```

Ardından `database.sql` dosyasındaki SQL komutlarını çalıştırın.

### 3. Veritabanı Ayarlarını Yapılandırın

`config.php` dosyasını açın ve veritabanı bilgilerinizi güncelleyin:

```php
define('DB_HOST', 'localhost');     // Veritabanı sunucusu
define('DB_USER', 'root');          // Veritabanı kullanıcı adı
define('DB_PASS', '');              // Veritabanı şifresi
define('DB_NAME', 'basitcontacts'); // Veritabanı adı
```

### 4. Web Sunucusunu Yapılandırın

#### Apache için:

Projeyi web sunucunuzun document root dizinine kopyalayın:

```bash
sudo cp -r /path/to/basitcontacts /var/www/html/
```

#### XAMPP kullanıyorsanız:

Dosyaları `C:\xampp\htdocs\basitcontacts` (Windows) veya `/opt/lampp/htdocs/basitcontacts` (Linux) dizinine kopyalayın.

#### PHP Built-in Server (Geliştirme için):

```bash
cd /path/to/basitcontacts
php -S localhost:8000
```

### 5. Uygulamayı Açın

Tarayıcınızda aşağıdaki adresi açın:

- Apache/XAMPP: `http://localhost/basitcontacts`
- PHP Built-in Server: `http://localhost:8000`

## Kullanım

### İlk Kullanım

1. **Kayıt Ol**: İlk kullanımda "Kayıt Ol" linkine tıklayarak yeni bir hesap oluşturun
2. **Giriş Yap**: Kullanıcı adı ve şifrenizle giriş yapın
3. **Kişi Ekle**: "+ Yeni Kişi Ekle" butonuna tıklayarak kişi eklemeye başlayın

### Kişi Yönetimi

- **Kişi Ekle**: Dashboard'dan "+ Yeni Kişi Ekle" butonuna tıklayın
- **Kişi Düzenle**: Kişi kartındaki "Düzenle" butonuna tıklayın
- **Kişi Sil**: Kişi kartındaki "Sil" butonuna tıklayın (onay gerektirir)

### Güvenlik İpuçları

1. **Güçlü Şifre Kullanın**: En az 6 karakter, sayı ve özel karakter içeren şifreler kullanın
2. **Düzenli Çıkış Yapın**: Bilgisayarınızı başkalarıyla paylaşıyorsanız çıkış yapmayı unutmayın
3. **Güncel Tutun**: Sistemi ve PHP'yi düzenli olarak güncelleyin

## Dosya Yapısı

```
basitcontacts/
├── index.php           # Giriş sayfası
├── register.php        # Kayıt sayfası
├── dashboard.php       # Ana kontrol paneli
├── add_contact.php     # Kişi ekleme sayfası
├── edit_contact.php    # Kişi düzenleme sayfası
├── delete_contact.php  # Kişi silme işlemi
├── logout.php          # Çıkış işlemi
├── config.php          # Veritabanı ve güvenlik ayarları
├── database.sql        # Veritabanı şeması
└── README.md           # Bu dosya
```

## Güvenlik Özellikleri

- **Password Hashing**: Şifreler bcrypt algoritması ile hashlenir
- **Prepared Statements**: SQL injection saldırılarına karşı koruma
- **Input Sanitization**: XSS saldırılarına karşı koruma
- **Session Management**: Güvenli oturum yönetimi
- **Access Control**: Kullanıcılar sadece kendi kişilerini görebilir/düzenleyebilir

## Sık Sorulan Sorular

**S: Kaç tane kişi ekleyebilirim?**
C: Sınırsız! İstediğiniz kadar kişi ekleyebilirsiniz.

**S: Veritabanı hatası alıyorum.**
C: `config.php` dosyasındaki veritabanı bilgilerini kontrol edin ve MySQL sunucusunun çalıştığından emin olun.

**S: Şifremi unuttum.**
C: Veritabanından doğrudan şifre değiştirebilirsiniz:
```sql
UPDATE users SET password = '$2y$10$...' WHERE username = 'kullanici_adi';
```

## Katkıda Bulunma

Katkılarınızı bekliyoruz! Pull request göndermekten çekinmeyin.

## Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için `LICENSE` dosyasına bakın.

## İletişim

Sorularınız için issue açabilirsiniz.

## Teşekkürler

BasitContacts'i kullandığınız için teşekkür ederiz! 🎉
