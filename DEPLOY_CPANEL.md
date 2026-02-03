# 🚀 Panduan Deploy ke cPanel dengan Git

## 📋 Persiapan Sebelum Deploy

### 1. Checklist Optimasi ✅
- [x] Email menggunakan Queue (tidak blocking)
- [x] Assets production sudah di-build (`npm run build`)
- [x] File `.env.production` sudah dibuat
- [x] APP_DEBUG=false untuk production
- [x] APP_ENV=production
- [x] APP_URL sesuai domain production

---

## 🎯 Langkah Deploy ke cPanel

### **STEP 1: Setup Git Repository di cPanel**

1. **Login ke cPanel** → https://sekawanputrapratama.com:2083
2. Buka **Git Version Control**
3. Klik **Create**
4. Isi form:
   ```
   Clone URL: https://github.com/adafi13/sekawanputrapratama.git
   Repository Path: /home/username/repositories/sekawanputrapratama
   Repository Name: sekawanputrapratama
   ```
5. Klik **Create**

---

### **STEP 2: Deploy ke Public Directory**

1. Di halaman **Git Version Control**, klik **Manage** pada repository
2. Pada bagian **Pull or Deploy**, klik **Update from Remote**
3. Klik **Deploy HEAD Commit**
4. Isi deployment path:
   ```
   /home/username/public_html
   ```
5. Klik **Deploy**

---

### **STEP 3: Setup Environment Production**

SSH ke server atau gunakan **Terminal** di cPanel:

```bash
cd /home/username/public_html

# 1. Copy .env production
cp .env.production .env

# 2. Install Composer dependencies (optimized)
composer install --optimize-autoloader --no-dev

# 3. Generate Application Key (jika belum ada)
php artisan key:generate

# 4. Setup Database
php artisan migrate --force

# 5. Setup Storage Link
php artisan storage:link

# 6. Cache untuk Performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Setup Permissions
chmod -R 755 storage bootstrap/cache
```

---

### **STEP 4: Setup Document Root di cPanel**

1. Buka **Domains** di cPanel
2. Pilih domain `sekawanputrapratama.com`
3. Edit **Document Root** menjadi:
   ```
   /home/username/public_html/public
   ```
4. Save

---

### **STEP 5: Setup .htaccess** (Jika perlu)

File `.htaccess` di `public/` sudah ada dari Laravel. Pastikan isinya:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

### **STEP 6: Setup Queue Worker dengan Cron Job**

1. Buka **Cron Jobs** di cPanel
2. Tambah cron job baru:
   ```
   * * * * * cd /home/username/public_html && php artisan schedule:run >> /dev/null 2>&1
   ```
3. Untuk queue worker, tambahkan:
   ```
   * * * * * cd /home/username/public_html && php artisan queue:work --stop-when-empty >> /dev/null 2>&1
   ```

**Alternative**: Gunakan Supervisor (jika tersedia di server)

---

### **STEP 7: Test Website**

1. **Buka website**: https://sekawanputrapratama.com
2. **Test form contact**: Submit contact form
3. **Check email**:
   - Admin harus terima notifikasi
   - Customer harus terima thank you email
4. **Check Filament Admin**: https://sekawanputrapratama.com/admin

---

## 🔄 Update Aplikasi (Setelah Push Baru)

Setiap kali push code baru ke GitHub:

```bash
cd /home/username/public_html

# 1. Pull perubahan dari Git
git pull origin main

# 2. Update dependencies (jika ada perubahan composer.json)
composer install --optimize-autoloader --no-dev

# 3. Migrate database (jika ada migration baru)
php artisan migrate --force

# 4. Build assets (jika ada perubahan frontend)
npm install && npm run build

# 5. Clear & rebuild cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Restart queue worker (jika pakai supervisor)
php artisan queue:restart
```

**ATAU** pakai script otomatis di cPanel Git: **Pull or Deploy** → **Update from Remote**

---

## 🛡️ Security Checklist

- [ ] `.env` tidak tercommit ke Git (sudah di `.gitignore`)
- [ ] `APP_DEBUG=false` di production
- [ ] `APP_ENV=production`
- [ ] Database credentials aman
- [ ] MAIL password aman
- [ ] File permissions sudah benar (755 untuk directories, 644 untuk files)
- [ ] `/admin` path dilindungi (login Filament)
- [ ] SSL Certificate aktif (HTTPS)

---

## 📊 Monitoring & Maintenance

### Check Logs
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Queue logs
php artisan queue:failed
```

### Clear Cache (jika ada masalah)
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database Backup
Gunakan **phpMyAdmin** di cPanel atau setup backup otomatis:
```bash
# Manual backup
mysqldump -u sekawan_sekawan -p sekawan_sekawan > backup_$(date +%Y%m%d).sql
```

---

## 🎛️ cPanel Features yang Digunakan

1. **Git Version Control** - Deploy otomatis dari GitHub
2. **Cron Jobs** - Queue worker & scheduled tasks
3. **Domains** - Setup document root
4. **File Manager** - Edit .env dan permissions
5. **Terminal** - Run artisan commands
6. **phpMyAdmin** - Database management
7. **SSL/TLS** - HTTPS certificate

---

## 🚨 Troubleshooting

### 500 Internal Server Error
```bash
# Check permissions
chmod -R 755 storage bootstrap/cache

# Check .env
cat .env | grep APP_KEY

# Regenerate key jika kosong
php artisan key:generate
```

### Email tidak terkirim
```bash
# Check queue jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Test email config
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('admin@sekawanputrapratama.com')->subject('Test'); });
```

### Database Connection Error
- Check `.env` DB credentials
- Check database exists di cPanel MySQL
- Check user permissions

### Assets tidak load (CSS/JS)
```bash
# Rebuild assets
npm run build

# Check symbolic link
php artisan storage:link

# Clear cache
php artisan view:clear
```

---

## 📞 Support

Jika ada masalah:
1. Check `/storage/logs/laravel.log`
2. Check cPanel error logs
3. Contact hosting support untuk server issues
4. Check dokumentasi Laravel: https://laravel.com/docs

---

## ✅ Post-Deploy Checklist

- [ ] Website bisa diakses: https://sekawanputrapratama.com
- [ ] Admin panel bisa login: https://sekawanputrapratama.com/admin
- [ ] Contact form berfungsi
- [ ] Email terkirim (admin & customer)
- [ ] Google Analytics tracking
- [ ] Google Search Console verified
- [ ] Sitemap submitted
- [ ] SSL Certificate aktif
- [ ] Robots.txt correct
- [ ] All pages load correctly
- [ ] Mobile responsive
- [ ] Performance optimized

**🎉 Aplikasi siap production!**
