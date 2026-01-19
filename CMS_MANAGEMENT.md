# CMS Management Guide

## Akses Admin Panel
- URL: `/admin`
- Email: `admin@sekawanputrapratama.com`
- Password: `password`

## Modul yang Bisa Dikelola di CMS

### 1. **Team Members** (`/admin/team-members`)
   - **Fitur**: Tambah, Edit, Hapus anggota tim
   - **Field yang bisa di-edit**:
     - Nama, Posisi, Bio
     - Email, Phone
     - Years Experience
     - Photo (upload gambar)
     - Order (urutan tampil)
     - Is Active (aktif/nonaktif)
   - **Tampil di Frontend**: 
     - Home page (section "Tim Profesional Kami")
     - About page (section "Tim Inti Kami")

### 2. **Services** (`/admin/services`)
   - **Fitur**: Tambah, Edit, Hapus layanan
   - **Field yang bisa di-edit**:
     - Title, Description, Content (HTML)
     - Slug (auto-generate dari title)
     - Images (upload gambar)
     - Order (urutan tampil)
     - Is Active (aktif/nonaktif)
     - Meta Title, Meta Description (SEO)
   - **Tampil di Frontend**:
     - Home page (section "Layanan Profesional Kami")
     - Services listing page (`/services`)
     - Service detail page (`/services/{slug}`)

### 3. **Portfolios** (`/admin/portfolios`)
   - **Fitur**: Tambah, Edit, Hapus portfolio
   - **Field yang bisa di-edit**:
     - Title, Description, Content (HTML)
     - Category (Website, Apps, Server)
     - Client Name, Project Date, Project URL
     - Technologies (array)
     - Featured Image & Images (upload gambar)
     - Is Featured (tampil di homepage)
     - Order (urutan tampil)
     - Meta Title, Meta Description (SEO)
   - **Tampil di Frontend**:
     - Home page (section "Portofolio Unggulan Kami")
     - Portfolio listing page (`/portfolio`)
     - Portfolio detail page (`/portfolio/{slug}`)

### 4. **Portfolio Categories** (`/admin/portfolio-categories`)
   - **Fitur**: Tambah, Edit, Hapus kategori portfolio
   - **Field yang bisa di-edit**:
     - Name, Slug, Description
     - Order (urutan tampil)
   - **Digunakan untuk**: Filter portfolio di frontend

### 5. **Blog Posts** (`/admin/blog-posts`)
   - **Fitur**: Tambah, Edit, Hapus artikel blog
   - **Field yang bisa di-edit**:
     - Title, Excerpt, Content (HTML)
     - Category
     - Author
     - Featured Image (upload gambar)
     - Status (Draft, Published, Scheduled)
     - Published At (tanggal publish)
     - Meta Title, Meta Description, Meta Keywords (SEO)
   - **Tampil di Frontend**:
     - Blog listing page (`/blog`)
     - Blog detail page (`/blog/{slug}`)

### 6. **Blog Categories** (`/admin/blog-categories`)
   - **Fitur**: Tambah, Edit, Hapus kategori blog
   - **Field yang bisa di-edit**:
     - Name, Slug, Description
   - **Digunakan untuk**: Kategorisasi artikel blog

### 7. **Testimonials** (`/admin/testimonials`)
   - **Fitur**: Tambah, Edit, Hapus testimonial
   - **Field yang bisa di-edit**:
     - Testimonial (teks)
     - Client Name, Client Company, Client Position
     - Rating (1-5)
     - Client Photo (upload gambar)
     - Is Featured (tampil di homepage)
     - Order (urutan tampil)
   - **Tampil di Frontend**:
     - Home page (section "Apa Kata Klien Kami?")

### 8. **Contact Messages** (`/admin/contact-messages`)
   - **Fitur**: Lihat, Balas, Hapus pesan dari form kontak
   - **Field yang tersimpan**:
     - Name, Email, Phone
     - Service Type
     - Message
   - **Tampil di Frontend**: Form kontak di `/contact`

### 9. **Pages** (`/admin/pages`)
   - **Fitur**: Tambah, Edit, Hapus halaman custom
   - **Field yang bisa di-edit**:
     - Title, Slug, Content (HTML)
     - Meta Title, Meta Description (SEO)
   - **Digunakan untuk**: Halaman custom yang bisa dibuat admin

### 10. **Users** (`/admin/users`)
   - **Fitur**: Kelola user dan role
   - **Roles yang tersedia**:
     - Super Admin (akses penuh)
     - Admin (akses penuh kecuali user management)
     - Editor (bisa edit semua konten)
     - Author (hanya bisa edit blog & portfolio)

## Cara Mengisi Data Default

Jalankan seeder untuk mengisi data default:

```bash
php artisan db:seed
```

Atau seed per-modul:

```bash
php artisan db:seed --class=TeamMemberSeeder
php artisan db:seed --class=ServiceSeeder
php artisan db:seed --class=PortfolioCategorySeeder
php artisan db:seed --class=BlogCategorySeeder
php artisan db:seed --class=TestimonialSeeder
php artisan db:seed --class=PortfolioSeeder
php artisan db:seed --class=BlogPostSeeder
```

## Catatan Penting

1. **Media Upload**: Semua gambar (photo, images, featured_image) menggunakan Spatie Media Library. Upload gambar melalui form di Filament.

2. **Cache**: Frontend menggunakan cache untuk performa. Jika update konten tidak langsung muncul, jalankan:
   ```bash
   php artisan cache:clear
   ```

3. **Slug**: Slug auto-generate dari title. Bisa di-edit manual jika perlu.

4. **Order**: Field `order` menentukan urutan tampil di frontend. Semakin kecil angka, semakin atas posisinya.

5. **Is Active / Is Featured**: 
   - `is_active`: Konten aktif/tidak aktif
   - `is_featured`: Konten ditampilkan di homepage

## Semua Halaman Frontend Terhubung dengan CMS

✅ **Home** (`/`) - Mengambil data dari:
   - Portfolio (featured)
   - Services (active)
   - Team Members (active)
   - Testimonials (featured)

✅ **About** (`/about`) - Mengambil data dari:
   - Team Members (active)

✅ **Services** (`/services`) - Mengambil data dari:
   - Services (active)

✅ **Service Detail** (`/services/{slug}`) - Mengambil data dari:
   - Service (by slug)

✅ **Portfolio** (`/portfolio`) - Mengambil data dari:
   - Portfolios (all)
   - Portfolio Categories

✅ **Portfolio Detail** (`/portfolio/{slug}`) - Mengambil data dari:
   - Portfolio (by slug)
   - Related Portfolios

✅ **Blog** (`/blog`) - Mengambil data dari:
   - Blog Posts (published)

✅ **Blog Detail** (`/blog/{slug}`) - Mengambil data dari:
   - Blog Post (by slug)

✅ **Contact** (`/contact`) - Form submit ke:
   - Contact Messages (database)

Semua konten bisa di-manage lengkap melalui CMS Filament di `/admin`!


