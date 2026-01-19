# Storage Symlink Setup Guide

## ⚠️ Masalah: Symlink Belum Dibuat

Symlink `public/storage` → `storage/app/public` **belum dibuat**, sehingga file yang diupload tidak bisa diakses dari browser.

## ✅ Solusi

### Opsi 1: Buat Symlink Manual (Recommended)

**Windows (Command Prompt as Administrator):**
```cmd
cd c:\laragon\www\SPP
mklink /D public\storage storage\app\public
```

**Linux/Mac:**
```bash
cd /path/to/SPP
php artisan storage:link
```

### Opsi 2: Copy Files (Temporary Solution)

Jika symlink tidak bisa dibuat, copy files:
```cmd
xcopy /E /I /Y storage\app\public public\storage
```

**Note:** Dengan cara ini, setiap kali ada file baru, harus di-copy manual.

### Opsi 3: Konfigurasi Web Server

Konfigurasi web server (Apache/Nginx) untuk serve `storage/app/public` langsung.

---

## 🔍 Verifikasi

Setelah symlink dibuat, test dengan:

```php
// Di tinker
use Illuminate\Support\Facades\Storage;
echo Storage::disk('public')->url('test.jpg');
// Should return: http://localhost:8000/storage/test.jpg

// Test file access
$testFile = public_path('storage/test.txt');
file_put_contents($testFile, 'test');
echo file_exists($testFile) ? 'Symlink works!' : 'Symlink not working';
```

---

## 📝 Status Saat Ini

- ❌ Symlink belum dibuat
- ✅ Storage disk 'public' sudah dikonfigurasi
- ✅ Spatie Media Library sudah dikonfigurasi
- ✅ Models sudah menggunakan `InteractsWithMedia`
- ✅ Frontend sudah menggunakan `getFirstMediaUrl()`

**Action Required:** Buat symlink agar file bisa diakses dari browser.

---

## 🚀 Quick Fix

Jalankan command ini (Windows, sebagai Administrator):

```cmd
cd c:\laragon\www\SPP
mklink /D public\storage storage\app\public
```

Atau gunakan Laravel command (jika symlink function enabled):

```bash
php artisan storage:link
```


