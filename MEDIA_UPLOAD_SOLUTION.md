# Solusi Media Upload dengan Spatie Media Library

## ✅ Masalah yang Sudah Diperbaiki

### 1. Tabel Media Tidak Ada ✅
**Error:** `Table 'spp.media' doesn't exist`

**Solusi:**
- ✅ Migration untuk tabel `media` sudah dibuat: `2026_01_17_180000_create_media_table.php`
- ✅ Tabel `media` sudah dibuat di database dengan struktur lengkap
- ✅ Struktur tabel sesuai dengan requirement Spatie Media Library
- ✅ Index sudah ditambahkan untuk performa query

### 2. File Upload Tidak Ter-attach ke Model ✅
**Masalah:** File diupload melalui Filament, tapi tidak ter-attach ke model via Spatie Media Library

**Solusi:**
- ✅ Hook `afterCreate()` dan `afterSave()` sudah ditambahkan di:
  - `CreatePortfolio` - untuk attach file saat create
  - `EditPortfolio` - untuk attach file saat update
- ✅ File yang diupload melalui Filament `FileUpload` akan otomatis ter-attach ke model
- ✅ File disimpan ke storage dan ter-link ke model melalui tabel `media`
- ✅ File path di-unset dari data sebelum save agar tidak tersimpan ke kolom database

---

## 🔧 Cara Kerja

### Flow Upload File:

1. **User upload file di Filament form**
   - File diupload melalui `FileUpload` component
   - Filament otomatis menyimpan file ke `storage/app/public/`

2. **File path disimpan sementara**
   - Di `mutateFormDataBeforeCreate/Save()`, file path disimpan ke property class
   - File path di-unset dari `$data` agar tidak tersimpan ke kolom database

3. **Model disimpan ke database**
   - Data portfolio (tanpa file path) disimpan ke tabel `portfolios`

4. **File di-attach ke model**
   - Di `afterCreate/Save()`, file di-attach ke model menggunakan Spatie Media Library
   - File path diambil dari storage dan di-attach ke collection yang sesuai

### Kode Implementation:

```php
// CreatePortfolio.php
protected function mutateFormDataBeforeCreate(array $data): array
{
    // Simpan file path sementara
    $this->featuredImagePath = $data['featured_image'] ?? null;
    $this->galleryImagesPaths = $data['images'] ?? [];

    // Hapus dari data agar tidak tersimpan ke kolom database
    unset($data['featured_image'], $data['images']);

    return $data;
}

protected function afterCreate(): void
{
    $record = $this->record;

    // Attach featured image
    if (!empty($this->featuredImagePath)) {
        $fullPath = Storage::disk('public')->path($this->featuredImagePath);
        if (file_exists($fullPath)) {
            $record->addMedia($fullPath)
                ->usingName($record->title . ' - Featured Image')
                ->toMediaCollection('featured_image');
        }
    }

    // Attach gallery images
    if (!empty($this->galleryImagesPaths)) {
        foreach ($this->galleryImagesPaths as $index => $imagePath) {
            $fullPath = Storage::disk('public')->path($imagePath);
            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->title . ' - Gallery Image ' . ($index + 1))
                    ->toMediaCollection('images');
            }
        }
    }
}
```

---

## 📝 Cara Menggunakan

### 1. Upload File di Filament CMS

1. Login ke `/admin/portfolios`
2. Klik "Create" atau edit portfolio yang ada
3. Upload gambar di field **Featured Image** atau **Gallery Images**
4. Klik "Save" atau "Create"
5. File akan otomatis:
   - Tersimpan ke `storage/app/public/portfolios/`
   - Ter-attach ke model melalui Spatie Media Library
   - Tersimpan metadata di tabel `media`

### 2. Mengakses File di Frontend

```blade
{{-- Featured Image --}}
@if($portfolio->getFirstMediaUrl('featured_image'))
    <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" alt="{{ $portfolio->title }}">
@endif

{{-- Gallery Images --}}
@foreach($portfolio->getMedia('images') as $image)
    <img src="{{ $image->getUrl() }}" alt="{{ $portfolio->title }}">
@endforeach
```

---

## ✅ Checklist

- [x] Tabel `media` sudah dibuat
- [x] Storage symlink sudah dibuat (`php artisan storage:link`)
- [x] Hook `afterCreate/Save()` sudah ditambahkan
- [x] FileUpload sudah dikonfigurasi dengan benar
- [x] Model sudah implement `HasMedia` dan `InteractsWithMedia`
- [x] Media collections sudah didefinisikan di model

---

## 🧪 Testing

1. **Test Upload:**
   - Login ke `/admin/portfolios`
   - Create portfolio baru
   - Upload featured image dan gallery images
   - Save
   - Check apakah file ter-attach: `$portfolio->hasMedia('featured_image')`

2. **Test Frontend:**
   - Visit `/portfolio`
   - Check apakah gambar muncul
   - Check apakah URL gambar benar

3. **Test Database:**
   ```sql
   SELECT * FROM media WHERE model_type = 'App\Models\Portfolio';
   ```

---

## ⚠️ Troubleshooting

### File tidak ter-attach setelah upload

**Cek:**
1. Apakah file tersimpan di `storage/app/public/`?
   ```bash
   ls -la storage/app/public/portfolios/
   ```

2. Apakah hook `afterCreate/Save()` dipanggil?
   - Check Laravel log: `storage/logs/laravel.log`
   - Tambahkan logging di hook untuk debug

3. Apakah path file benar?
   ```php
   // Di afterCreate/Save(), tambahkan:
   \Log::info('Featured Image Path: ' . ($this->featuredImagePath ?? 'null'));
   \Log::info('Full Path: ' . Storage::disk('public')->path($this->featuredImagePath ?? ''));
   \Log::info('File exists: ' . (file_exists(Storage::disk('public')->path($this->featuredImagePath ?? '')) ? 'Yes' : 'No'));
   ```

4. **Cek apakah property class ada:**
   - Pastikan `$this->featuredImagePath` dan `$this->galleryImagesPaths` didefinisikan sebagai property class

### Gambar tidak muncul di frontend

**Cek:**
1. Apakah symlink sudah dibuat?
   ```bash
   php artisan storage:link
   ls -la public/storage  # Should be symlink
   ```

2. Apakah file permissions benar?
   ```bash
   chmod -R 775 storage
   chmod -R 775 public/storage
   ```

3. Apakah URL gambar benar?
   ```php
   // Di tinker
   $portfolio = Portfolio::first();
   echo $portfolio->getFirstMediaUrl('featured_image');
   // Should return: http://localhost:8000/storage/...
   ```

4. **Cek apakah media ter-attach:**
   ```php
   $portfolio = Portfolio::first();
   $portfolio->hasMedia('featured_image'); // Should return true
   $portfolio->getMedia('featured_image'); // Should return collection
   ```

### Error: "Call to undefined method addMedia()"

**Solusi:**
- Pastikan model menggunakan trait `InteractsWithMedia`
- Pastikan model implement interface `HasMedia`
- Run `composer dump-autoload`

### Error: "File not found" saat attach

**Solusi:**
- Pastikan file sudah tersimpan sebelum attach
- Check path file: `Storage::disk('public')->path($path)`
- Pastikan disk 'public' sudah dikonfigurasi dengan benar

---

## 🚀 Next Steps

Untuk model lain (Service, TeamMember, BlogPost, Testimonial), tambahkan hook yang sama di:
- `CreateService` & `EditService`
- `CreateTeamMember` & `EditTeamMember`
- `CreateBlogPost` & `EditBlogPost`
- `CreateTestimonial` & `EditTestimonial`

Atau gunakan plugin Filament untuk Spatie Media Library untuk otomatisasi penuh.

