# Media Library Setup & Usage Guide

## ✅ Masalah yang Sudah Diperbaiki

### 1. Tabel Media
- ✅ Migration untuk tabel `media` sudah dibuat
- ✅ Tabel `media` sudah dibuat di database
- ✅ Storage symlink sudah dibuat (`php artisan storage:link`)

### 2. Model Configuration
Semua model yang menggunakan media sudah dikonfigurasi dengan benar:
- ✅ `Portfolio` - untuk featured_image dan gallery images
- ✅ `Service` - untuk service images
- ✅ `TeamMember` - untuk photo
- ✅ `BlogPost` - untuk featured_image
- ✅ `Testimonial` - untuk client_photo

### 3. Filament Integration
- ✅ FileUpload sudah dikonfigurasi di semua form
- ✅ Hook untuk attach file ke Spatie Media Library sudah ditambahkan di:
  - `CreatePortfolio` & `EditPortfolio` (Portfolio)
  - File akan otomatis ter-attach ke model setelah save

---

## 📁 Struktur Storage

File media akan disimpan di:
- **Lokasi fisik**: `storage/app/public/`
- **URL publik**: `http://your-domain.com/storage/`
- **Symlink**: `public/storage` → `storage/app/public`

### Direktori Media:
```
storage/app/public/
├── portfolios/
│   ├── featured/     # Featured images untuk portfolio
│   └── gallery/      # Gallery images untuk portfolio
├── services/
│   └── images/       # Service images
├── team/
│   └── photos/       # Team member photos
├── blog/
│   └── featured/     # Blog post featured images
└── testimonials/
    └── photos/       # Client photos
```

---

## 🎯 Cara Menggunakan Media Library di Filament CMS

### 1. Upload Media untuk Portfolio

1. Login ke `/admin/portfolios`
2. Klik "Create" atau edit portfolio yang ada
3. Scroll ke bagian **Featured Image**:
   - Klik area upload atau drag & drop gambar
   - Gambar akan otomatis di-resize dan dioptimize
   - Format yang didukung: JPG, PNG, WebP
   - Max size: 5MB
4. Scroll ke bagian **Gallery Images**:
   - Bisa upload multiple images (max 10)
   - Bisa reorder dengan drag & drop
   - Setiap image bisa di-edit (crop, resize)
5. Klik "Save" atau "Create"

### 2. Upload Media untuk Service

1. Login ke `/admin/services`
2. Edit service yang ada
3. Upload image di bagian **Service Image**
4. Save

### 3. Upload Media untuk Team Member

1. Login ke `/admin/team-members`
2. Edit team member
3. Upload photo di bagian **Photo**
4. Photo akan otomatis di-crop ke aspect ratio 1:1 atau 4:3
5. Save

### 4. Upload Media untuk Blog Post

1. Login ke `/admin/blog-posts`
2. Edit atau create blog post
3. Upload featured image
4. Save

### 5. Upload Media untuk Testimonial

1. Login ke `/admin/testimonials`
2. Edit testimonial
3. Upload client photo
4. Save

---

## 💻 Cara Menggunakan di Frontend

### Portfolio

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

### Service

```blade
@if($service->getFirstMediaUrl('images'))
    <img src="{{ $service->getFirstMediaUrl('images') }}" alt="{{ $service->title }}">
@endif
```

### Team Member

```blade
@if($member->getFirstMediaUrl('photo'))
    <img src="{{ $member->getFirstMediaUrl('photo') }}" alt="{{ $member->name }}">
@endif
```

### Blog Post

```blade
@if($post->getFirstMediaUrl('featured_image'))
    <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}">
@endif
```

### Testimonial

```blade
@if($testimonial->getFirstMediaUrl('client_photo'))
    <img src="{{ $testimonial->getFirstMediaUrl('client_photo') }}" alt="{{ $testimonial->client_name }}">
@endif
```

---

## 🔧 Advanced Usage

### Get Media dengan Conversion

Jika ingin menggunakan thumbnail atau conversion:

```php
// Di model, tambahkan conversion
public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(300)
        ->height(300)
        ->sharpen(10);
}

// Di frontend
$portfolio->getFirstMediaUrl('featured_image', 'thumb')
```

### Get All Media dari Collection

```php
$portfolio->getMedia('images'); // Get all gallery images
$portfolio->getMedia('featured_image'); // Get featured image (single)
```

### Check if Media Exists

```blade
@if($portfolio->hasMedia('featured_image'))
    <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}">
@else
    <img src="{{ asset('assets/media/images/default.png') }}">
@endif
```

---

## ⚠️ Troubleshooting

### 1. Error: Table 'media' doesn't exist

**Solusi:**
```bash
php artisan migrate
```

### 2. Gambar tidak muncul di frontend

**Solusi:**
```bash
# Pastikan symlink sudah dibuat
php artisan storage:link

# Pastikan file permissions
chmod -R 775 storage
chmod -R 775 public/storage
```

### 3. Error saat upload: "Disk not found"

**Solusi:**
- Pastikan disk `public` sudah dikonfigurasi di `config/filesystems.php`
- Pastikan folder `storage/app/public` ada dan writable

### 4. Gambar terlalu besar

**Solusi:**
- Edit form di Filament, tambahkan `->maxSize(5120)` (5MB)
- Atau edit di `php.ini`: `upload_max_filesize` dan `post_max_size`

---

## 📝 Notes

1. **File Naming**: Spatie Media Library otomatis generate unique filename
2. **Storage**: File disimpan di `storage/app/public/` dengan struktur folder yang rapi
3. **URL**: File bisa diakses via `asset('storage/...')` atau `Storage::url()`
4. **Security**: File di `public` disk bisa diakses publik, pastikan hanya upload file yang aman
5. **Performance**: Gunakan lazy loading untuk images di frontend
6. **Optimization**: Spatie bisa generate thumbnails dan conversions otomatis

---

## 🚀 Next Steps

1. ✅ Tabel media sudah dibuat
2. ✅ Storage symlink sudah dibuat
3. ✅ Models sudah dikonfigurasi
4. ✅ Filament forms sudah dikonfigurasi
5. ⏳ **Test upload gambar melalui Filament CMS**
6. ⏳ **Verifikasi gambar muncul di frontend**

---

## 📚 Resources

- [Spatie Media Library Documentation](https://spatie.be/docs/laravel-medialibrary)
- [Filament File Upload Documentation](https://filamentphp.com/docs/forms/fields/file-upload)
- [Laravel Storage Documentation](https://laravel.com/docs/filesystem)

