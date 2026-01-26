# Sekawan Putra Pratama - Company Website

Website perusahaan untuk Sekawan Putra Pratama, menyediakan informasi layanan, portfolio proyek, blog artikel teknologi, dan contact form.

## 🚀 Tech Stack

- **Framework**: Laravel 12.47.0
- **Admin Panel**: Filament v4
- **Frontend**: Bootstrap 5 + Blade Templates
- **Database**: MySQL 8.4.3
- **PHP**: 8.5.1
- **Image Processing**: Intervention Image v3

## 📦 Fitur Utama

- ✅ **Admin Panel** (Filament) - Manajemen konten lengkap
- ✅ **Blog Management** - Artikel dengan kategori dan featured image
- ✅ **Portfolio Management** - Case study proyek dengan gallery
- ✅ **Service Pages** - Deskripsi layanan perusahaan
- ✅ **Team Members** - Profil tim
- ✅ **Testimonials** - Review klien
- ✅ **Contact Form** - Form kontak dengan validasi
- ✅ **SEO Optimized** - Meta title, description, keywords

## 🔧 Setup Development

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM (optional, untuk compile assets)

### Installation

1. **Clone repository**
   ```bash
   git clone https://github.com/adafi13/sekawanputrapratama.git
   cd sekawanputrapratama
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit file `.env`:
   ```env
   APP_URL=http://127.0.0.1:8000
   DB_DATABASE=spp
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```
   
   Access: http://127.0.0.1:8000

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di folder **`docs/`**:

- **[Setup & Troubleshooting](docs/SETUP_DAN_TROUBLESHOOTING.md)** - ⚠️ Setup tim & troubleshooting (WAJIB BACA!)
- **[Workflow](docs/WORKFLOW.md)** - Alur kerja dari Leads hingga Project Completed
- **[Features](docs/FEATURES.md)** - Dokumentasi lengkap semua fitur
- **[Database](docs/DATABASE.md)** - Struktur database dan relasi
- **[Dokumentasi Lengkap](docs/README.md)** - Index semua dokumentasi

## 🔐 Default Admin Access

Setelah setup, buat user admin:
```bash
php artisan make:filament-user
```

Access admin panel: http://127.0.0.1:8000/admin

## 🎯 Modules Overview

### Frontend (Public Website)
- 🏠 Homepage dengan hero section dan service overview
- 💼 Portfolio showcase dengan case studies
- 📝 Blog dengan kategori dan search
- 📧 Contact form dengan validasi
- 👥 Team & testimonials

### Admin Panel (Filament)
- 📊 Dashboard dengan statistik real-time
- 🔄 **CRM Module**: Leads → Quotations → Contracts → Projects → Invoices
- 📝 **Content Management**: Blog, Portfolio, Services, Team, Testimonials, FAQs
- 💬 Contact Messages
- ⚙️ Settings & User Management

## 🤝 Contributing

Untuk tim development:
1. **WAJIB baca**: [docs/SETUP_DAN_TROUBLESHOOTING.md](docs/SETUP_DAN_TROUBLESHOOTING.md) sebelum mulai coding
2. Pahami business flow di [docs/WORKFLOW.md](docs/WORKFLOW.md)
3. Lihat semua fitur di [docs/FEATURES.md](docs/FEATURES.md)
4. Pelajari database di [docs/DATABASE.md](docs/DATABASE.md)

## 📝 License

This project is proprietary software for Sekawan Putra Pratama.

---

**Developed by**: Sekawan Putra Pratama Development Team  
**Last Updated**: January 26, 2026  
**Repository**: https://github.com/adafi13/sekawanputrapratama
