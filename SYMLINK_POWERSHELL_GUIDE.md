# 🔗 Membuat Storage Symlink di PowerShell

## ⚠️ Masalah

`mklink` adalah command **CMD**, bukan PowerShell. Di PowerShell, gunakan command yang berbeda.

## ✅ Solusi: PowerShell Command

**Jalankan di PowerShell (bisa sebagai Administrator):**

```powershell
cd c:\laragon\www\SPP

# Hapus folder jika sudah ada
if (Test-Path 'public\storage') {
    Remove-Item -Path 'public\storage' -Recurse -Force
}

# Buat symlink
New-Item -ItemType SymbolicLink -Path 'public\storage' -Target 'storage\app\public'
```

## 🔍 Verifikasi

Setelah symlink dibuat, verifikasi dengan:

```powershell
# Check if symlink exists
Test-Path 'public\storage'

# Check if it's a symlink (PowerShell 5.1+)
(Get-Item 'public\storage').LinkType
```

Atau di Laravel Tinker:

```php
use Illuminate\Support\Facades\Storage;

// Test storage URL
echo Storage::disk('public')->url('test.jpg');
// Should return: http://localhost:8000/storage/test.jpg

// Check symlink
echo is_link(public_path('storage')) ? 'Symlink OK!' : 'Not a symlink';
```

## 📝 Alternative: Gunakan CMD

Jika PowerShell tidak bekerja, gunakan **Command Prompt (CMD)**:

```cmd
cd c:\laragon\www\SPP
rmdir /s /q public\storage
mklink /D public\storage storage\app\public
```

## 🎯 Quick Command (Copy & Paste)

**PowerShell:**
```powershell
cd c:\laragon\www\SPP; if (Test-Path 'public\storage') { Remove-Item -Path 'public\storage' -Recurse -Force }; New-Item -ItemType SymbolicLink -Path 'public\storage' -Target 'storage\app\public'
```

**CMD (as Administrator):**
```cmd
cd c:\laragon\www\SPP && rmdir /s /q public\storage && mklink /D public\storage storage\app\public
```

---

**Note**: Jika masih error, mungkin perlu run PowerShell sebagai Administrator.


