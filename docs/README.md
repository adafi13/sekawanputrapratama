# 📚 Documentation Index

Welcome to SPP (Software & Project Portfolio) documentation. This folder contains all guides and references for understanding and working with the application.

---

## 📖 Available Documentation

### 1. [SETUP_DAN_TROUBLESHOOTING.md](SETUP_DAN_TROUBLESHOOTING.md) ✅
**⚠️ Setup Tim & Troubleshooting (WAJIB BACA!)**

Dokumentasi lengkap untuk anggota tim yang baru pull code dari repository. Berisi:
- ✅ Checklist setup yang harus dilakukan setelah git pull
- 🔧 Cara jalankan migration dan storage link
- 🗄️ Setup database dan cache clearing
- ⚠️ Troubleshooting masalah umum (gambar tidak muncul, error port, dll)

### 2. [WORKFLOW.md](WORKFLOW.md) ✅
**Alur Kerja dari Leads hingga Project Completed**

Dokumentasi business process flow lengkap mencakup:
- 📞 Lead Management (6 status: New → Contacted → Quotation → Negotiation → Deal Won/Lost)
- 💰 Quotation Process (pembuatan, aksi, manajemen)
- 📄 Contract Management (tracking status dan pembayaran)
- 🎯 Project Phases (Planning → Development → Deployment → Support)
- 🧾 Invoice & Payment Tracking
- ✅ Project Completion Checklist
- 📊 Key Metrics & Reports
- 🔔 Notifications & Reminders
- 👥 Role & Permissions Matrix

### 3. [FEATURES.md](FEATURES.md) ✅
**Dokumentasi Lengkap Semua Fitur Aplikasi**

Penjelasan detail fitur-fitur aplikasi:
- 🌐 **Frontend Features**: Homepage, Services, Portfolio, Blog, Contact
- 🎛️ **Admin Panel Modules**: 
  - Dashboard dengan statistik & grafik
  - CRM Module (Leads, Quotations, Contracts, Projects, Invoices)
  - Content Management (Blog, Portfolio, Services, Team, Testimonials, FAQs)
  - Contact Messages & Settings
  - User Management
- 📋 Detailed forms dan fields untuk setiap module
- 🔐 Role-based permissions

### 4. [DATABASE.md](DATABASE.md) ✅
**Struktur Database dan Relasi Antar Tabel**

Dokumentasi database schema lengkap:
- 📊 Entity Relationship Diagram (ERD)
- 🗄️ Detail semua tabel (users, leads, quotations, contracts, projects, invoices)
- 📝 Content tables (blog_posts, portfolios, services, team_members, testimonials, faqs)
- 🔗 Relasi antar tabel (foreign keys)
- 📦 JSON field structures & examples
- 🔍 Indexes & performance tips
- 🔑 Foreign key constraints

---

## 📂 Documentation Structure

```
docs/
├── README.md                      # Index dokumentasi (file ini)
├── SETUP_DAN_TROUBLESHOOTING.md  # Setup tim & troubleshooting
├── WORKFLOW.md                    # Business process flow
├── FEATURES.md                    # Feature documentation
└── DATABASE.md                    # Database schema
```

---

## 🚀 Quick Start untuk Tim Baru

Jika Anda baru bergabung dengan tim:

1. **Setup Development Environment**  
   Baca [SETUP_DAN_TROUBLESHOOTING.md](SETUP_DAN_TROUBLESHOOTING.md) dan ikuti checklist setup

2. **Pahami Business Process**  
   Pelajari [WORKFLOW.md](WORKFLOW.md) untuk memahami alur kerja dari leads sampai project selesai

3. **Eksplorasi Fitur Aplikasi**  
   Lihat [FEATURES.md](FEATURES.md) untuk mengetahui semua fitur yang tersedia

4. **Pelajari Struktur Data**  
   Baca [DATABASE.md](DATABASE.md) untuk memahami struktur database dan relasi

5. **Troubleshooting**  
   Jika ada error, cek [SETUP_DAN_TROUBLESHOOTING.md](SETUP_DAN_TROUBLESHOOTING.md) bagian troubleshooting

---

## 🏗️ Project Structure

```
SPP/
├── app/                    # Application logic
│   ├── Filament/          # Admin panel resources
│   ├── Http/              # Controllers & Middleware
│   ├── Models/            # Eloquent models
│   └── Observers/         # Model observers
├── database/              # Migrations & seeders
├── docs/                  # Dokumentasi (folder ini)
├── public/                # Public assets
├── resources/             # Views, CSS, JS
│   └── views/
│       └── frontend/      # Frontend templates
├── routes/                # Route definitions
└── storage/               # File uploads & logs
```

---

## 🔗 Quick Links

- **Admin Panel**: http://127.0.0.1:8000/admin
- **Frontend**: http://127.0.0.1:8000
- **Repository**: https://github.com/adafi13/sekawanputrapratama

---

## 🆘 Need Help?

Jika mengalami masalah atau butuh bantuan:
1. ✅ Cek dokumentasi relevan di folder ini
2. 💬 Tanya di grup tim
3. 📞 Hubungi lead developer
4. 🐛 Report bug/issue di repository

---

## 📝 Contributing to Documentation

Dokumentasi ini perlu dijaga tetap update. Jika ada perubahan:
- Update dokumentasi yang relevan
- Commit dengan pesan yang jelas: `docs: update [nama file] - [perubahan]`
- Pull request untuk review

---

**Last Updated**: January 26, 2026  
**Version**: 1.0  
**Tech Stack**: Laravel 12, Filament v4, PHP 8.5.1, MySQL 8.4.3, Bootstrap 5  
**Maintainer**: Development Team

**Last Updated**: January 26, 2026
