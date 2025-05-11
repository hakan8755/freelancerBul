# 🧑‍💻 Freelancer Hizmet Alım Platformu

Laravel tabanlı bu proje, freelance ilan oluşturmak ve başvuruları yönetmek isteyen kullanıcılar için basit, hızlı ve işlevsel bir sistem sunar. Kullanıcılar ilan verebilir, diğer kullanıcılar bu ilanlara başvurabilir. Başvurular admin panelinden takip edilebilir.

## 🚀 Özellikler

- 👤 Kullanıcı kayıt & giriş sistemi (Laravel Auth)
- 📝 Kullanıcılar ilan oluşturabilir
- 📄 Tüm ilanlar listelenebilir ve detayları görüntülenebilir
- 📥 İlanlara başvuru yapılabilir (başvurular sadece admin görür)
- 📊 Voyager admin paneli (otomatik kurulum ile gelir)
- 📱 Duyarlı ve sade tasarım (Bootstrap 5 destekli)

## 🛠️ Kullanılan Teknolojiler

- Laravel 9.x
- Voyager Admin Paneli
- MySQL (Veritabanı)
- Blade + Bootstrap
- AOS - Animate On Scroll
- Laravel UI (Auth sistemi için)

## ⚙️ Kurulum Adımları

1. Repoyu klonlayın:
git clone https://github.com/kullaniciadi/freelancer-platformu.git
cd freelancer-platformu

markdown
Kopyala
Düzenle

2. Bağımlılıkları yükleyin:
composer install
npm install && npm run dev

markdown
Kopyala
Düzenle

3. Ortam dosyasını oluşturun:
cp .env.example .env
php artisan key:generate

markdown
Kopyala
Düzenle

4. `.env` dosyasını açın ve veritabanı ayarlarını yapın.

5. Veritabanı migrasyonlarını çalıştırın:
php artisan migrate

markdown
Kopyala
Düzenle

6. Voyager admin panelini yükleyin:
php artisan voyager:install --with-dummy

markdown
Kopyala
Düzenle

7. Uygulamayı başlatın:
php artisan serve

shell
Kopyala
Düzenle

## 🔐 Varsayılan Admin Girişi

Email: admin@admin.com
Şifre: password

markdown
Kopyala
Düzenle

> Değiştirmek isterseniz `users` tablosundan veya Voyager panelden düzenleyebilirsiniz.

## 📁 Proje Yapısı

- `app/Models/Job.php` → İlan modeli
- `app/Models/Application.php` → Başvuru modeli
- `resources/views/jobs/` → İlan listeleme, detay, oluşturma sayfaları
- `routes/web.php` → Laravel rotaları

## 📸 Ekran Görüntüleri

Kendi bilgisayarınızda `docs/screenshots/` klasörü oluşturarak görselleri ekleyebilir ve README’ye dahil edebilirsiniz.

## 📄 Lisans

MIT Lisansı ile lisanslanmıştır.

## 👤 Geliştirici

**Hakan Fırat**  
[GitHub](https://github.com/hakan8755)
