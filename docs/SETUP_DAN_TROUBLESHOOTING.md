# 🚀 Setup untuk Tim Setelah Pull Code

## ⚠️ WAJIB: Jalankan Semua Langkah Ini Setelah Git Pull!

### Langkah 1: Pull Code Terbaru
```bash
git pull origin main
```

### Langkah 2: Pastikan APP_URL di .env
Buka file `.env` dan pastikan baris ini:
```env
APP_URL=http://127.0.0.1:8000
```
**JANGAN gunakan domain lain seperti spp.test atau localhost!**

### Langkah 3: Jalankan Migration
```bash
php artisan migrate
```
💡 **Apa ini?** Migration akan membuat/update tabel database yang diperlukan.

⚠️ **PENTING:** Jika ada prompt "Do you really wish to run this command?", ketik `yes`

### Langkah 4: Buat Storage Link (Hanya Sekali)
```bash
php artisan storage:link
```
Ini membuat symbolic link agar gambar bisa diakses via browser.
**Cek:** Seharusnya ada folder `storage` di dalam folder `public/`

### Langkah 5: Clear Cache
**Jalankan satu per satu:**
```bash
php artisan config:clear
```
```bash
php artisan cache:clear
```
```bash
php artisan view:clear
```

💡 **Atau gabung dalam 1 baris (Windows CMD/PowerShell):**
```bash
php artisan config:clear && php artisan cache:clear && php artisan view:clear
```
⚠️ Wajib dijalankan setiap kali pull code atau ubah `.env`!

### Langkah 6: Start Server
```bash
php artisan serve
```
Kemudian buka browser: **http://127.0.0.1:8000**

---

## 🔧 Troubleshooting

### ❌ Gambar Tidak Muncul / Broken Image
**Penyebab:**
1. Storage link belum dibuat
2. APP_URL salah di `.env`
3. Cache belum di-clear

**Solusi:**
```bash
php artisan storage:link
```
Kemudian clear cache:
```bash
php artisan config:clear && php artisan cache:clear
```
Pastikan `APP_URL=http://127.0.0.1:8000` di file `.env`

### ❌ Error: Column not found 'featured_image'
**Penyebab:** Migration belum dijalankan

**Solusi:**
```bash
php artisan migrate
```

### ❌ Error: Duplicate column name 'featured_image'
**Penyebab:** Ada migration duplikat yang mencoba menambahkan kolom yang sama

**Solusi:**
Cek migration yang gagal:
```bash
php artisan migrate:status
```

Rollback migration terakhir yang gagal:
```bash
php artisan migrate:rollback --step=1
```

Atau hapus file migration duplikat di folder `database/migrations/` yang memiliki tanggal lebih baru.

### ❌ Gambar Masuk ke Folder `temp-uploads`
**Ini NORMAL saat CREATE (buat baru):**
1. Saat pertama kali upload → masuk `temp-uploads` (karena ID belum ada)
2. Setelah SAVE → refresh halaman, edit lagi
3. Upload gambar baru → sekarang masuk ke `blog/{id}/` atau `portfolios/{id}/`

**Kalau tetap masuk temp-uploads:**
- Pastikan Anda akses via `http://127.0.0.1:8000` (bukan domain lain!)
- Clear cache: `php artisan config:clear && php artisan cache:clear`

### ❌ Error 500 Saat Upload Gambar
**Penyebab:** Permission folder storage (khusus Linux/Mac)

**Solusi Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Solusi Windows:**
Pastikan folder `storage/app/public` ada dan bisa ditulis.

---

## 📋 Checklist Setelah Pull

Gunakan checklist ini setiap kali pull code:

- [ ] `git pull origin main`
- [ ] Cek `.env` → `APP_URL=http://127.0.0.1:8000`
- [ ] `php artisan migrate`
- [ ] `php artisan config:clear && php artisan cache:clear`
- [ ] `php artisan serve`
- [ ] Test upload gambar di admin panel

---

## 📝 Catatan Penting untuk Tim

### ✅ DO's (Yang HARUS dilakukan)
- ✅ **SELALU** gunakan `http://127.0.0.1:8000`
- ✅ **JALANKAN** `php artisan migrate` setiap pull code
- ✅ **CLEAR CACHE** setiap ubah `.env` atau pull code
- ✅ **TEST** upload gambar setelah setup
- ✅ **COMMIT** tanpa file di `storage/` (sudah di .gitignore)

### ❌ DON'Ts (Yang JANGAN dilakukan)
- ❌ **JANGAN** gunakan domain custom (spp.test, localhost, dll)
- ❌ **JANGAN** commit file di folder `storage/app/public/`
- ❌ **JANGAN** edit langsung file di `storage/`
- ❌ **JANGAN** lupa clear cache setelah pull
- ❌ **JANGAN** langsung coding tanpa jalankan migration

---

## 🆘 Butuh Bantuan?

Jika masih error setelah ikuti semua langkah:
1. Screenshot error message
2. Share ke grup
3. Sertakan info:
   - OS: Windows/Mac/Linux
   - PHP Version: `php -v`
   - Laravel Version: `php artisan --version`
   - Langkah yang sudah dilakukan
