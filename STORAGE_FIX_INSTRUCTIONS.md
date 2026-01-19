# 🔧 Instruksi Perbaikan Storage Symlink

## Status Saat Ini

✅ **File sudah di-copy ke `public/storage`** (temporary solution)
❌ **Symlink belum dibuat** (perlu Administrator privileges)

## ⚠️ Masalah

File yang diupload melalui Filament akan tersimpan di `storage/app/public/`, tapi untuk bisa diakses dari browser, perlu symlink `public/storage` → `storage/app/public`.

Saat ini file sudah di-copy, tapi ini **bukan solusi permanen** karena:
- Setiap file baru harus di-copy manual
- File yang dihapus di storage tidak otomatis terhapus di public/storage

## ✅ Solusi Permanen: Buat Symlink

### Windows (Laragon)

1. **Buka Command Prompt sebagai Administrator:**
   - Klik kanan pada Command Prompt
   - Pilih "Run as Administrator"

2. **Jalankan command:**
   ```cmd
   cd c:\laragon\www\SPP
   rmdir /s /q public\storage
   mklink /D public\storage storage\app\public
   ```

3. **Verifikasi:**
   ```cmd
   dir public\storage
   ```
   Harus menunjukkan isi dari `storage/app/public`

### Alternative: Gunakan Laragon File Manager

1. Buka Laragon
2. Klik kanan pada project `SPP`
3. Pilih "Open Terminal Here"
4. Jalankan:
   ```cmd
   php artisan storage:link
   ```

## 🧪 Test Setelah Symlink Dibuat

1. **Upload file di Filament:**
   - Login ke `/admin/portfolios`
   - Upload gambar untuk portfolio
   - Save

2. **Check file:**
   ```cmd
   dir storage\app\public\portfolios
   dir public\storage\portfolios
   ```
   Keduanya harus menunjukkan file yang sama

3. **Test di browser:**
   - Visit: `http://localhost:8000/storage/portfolios/featured/[filename]`
   - File harus bisa diakses

4. **Test di frontend:**
   - Visit: `http://localhost:8000/portfolio`
   - Gambar portfolio harus muncul

## 📝 Catatan Penting

- **Symlink vs Copy:** Symlink lebih baik karena otomatis sync
- **Permission:** Di Windows, perlu Administrator untuk create symlink
- **Laragon:** Laragon biasanya sudah handle ini, tapi perlu di-verify

## 🔍 Verifikasi Symlink

Setelah symlink dibuat, test dengan:

```php
// Di tinker
use Illuminate\Support\Facades\Storage;
echo Storage::disk('public')->url('test.jpg');
// Should return: http://localhost:8000/storage/test.jpg

// Check if symlink
echo is_link(public_path('storage')) ? 'Symlink OK!' : 'Not a symlink';
```

---

## ⚡ Quick Action

**Jalankan command ini di Command Prompt (as Administrator):**

```cmd
cd c:\laragon\www\SPP
rmdir /s /q public\storage
mklink /D public\storage storage\app\public
```

Setelah itu, semua file yang diupload akan otomatis bisa diakses dari browser!


