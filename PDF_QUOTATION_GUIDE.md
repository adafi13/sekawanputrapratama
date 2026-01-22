# PDF Quotation System - User Guide

## Overview
Sistem PDF Quotation menghasilkan dokumen quotation profesional secara otomatis setiap kali Anda menyimpan atau mengupdate quotation. PDF ini mencakup pricing, payment terms, revision policy, terms & conditions, dan signature section.

---

## Fitur Utama

### 1. **Auto-Generate PDF**
- PDF otomatis dibuat saat Anda save/update quotation
- File tersimpan di `storage/app/quotations/`
- Nama file: `{QUOTATION_NUMBER}_{TIMESTAMP}.pdf`
- Tidak perlu manual generate

### 2. **Flexible Payment Terms (3 Termin)**
- **Termin 1**: Default 30% - Down Payment
- **Termin 2**: Default 40% - Progress Payment
- **Termin 3**: Default 30% - Final Payment
- **Adjustable**: Persentase dan deskripsi bisa diubah sesuai kesepakatan

### 3. **Revision Policy**
- **Revision Rounds**: Default 3 kali putaran revisi
- **Revision Notes**: Tambahkan catatan khusus untuk revisi
- **Adjustable**: Jumlah rounds bisa disesuaikan per quotation

### 4. **Pricing Components**
- **Subtotal**: Kalkulasi otomatis dari semua items
- **Discount**: Input persentase discount (opsional)
- **Tax / PPN**: Toggle on/off, default 11%
- **Grand Total**: Kalkulasi final otomatis

### 5. **Metadata & PIC**
- **Prepared By**: Nama pembuat quotation (auto-filled)
- **Position**: Jabatan pembuat
- **Sales PIC**: Contact untuk follow-up
- **Validity Period**: Masa berlaku quotation (default 30 hari)

### 6. **Terms & Conditions**
- **10 Standard Terms**: Pre-defined, bisa di-check/uncheck
- **Custom Terms**: Tambahkan terms khusus jika diperlukan
- Semua terms muncul di PDF

---

## Cara Penggunaan

### A. Create New Quotation

1. **Masuk ke Quotations Menu**
   - Klik `Quotations` di sidebar
   - Klik `New Quotation`

2. **Isi Quotation Information**
   ```
   - Lead: Pilih lead dari dropdown
   - Customer: Auto-filled atau pilih manual
   - Valid Until: Default 30 hari ke depan
   - Status: Draft
   - Notes: Catatan tambahan (opsional)
   ```

3. **Tambah Quotation Items**
   ```
   - Klik "Add Item"
   - Isi:
     * Item Type: Service, Product, atau Custom
     * Name: Nama item/jasa
     * Description: Detail lengkap
     * Quantity: Jumlah
     * Unit Price: Harga per unit
     * Discount %: Discount per item (opsional)
   - Total otomatis terhitung
   ```

4. **Configure Summary**
   ```
   - Subtotal: Auto-calculated
   - Discount %: Discount untuk total (opsional)
   - Include Tax: Toggle on jika include PPN
   - Tax %: Default 11% (PPN)
   - Grand Total: Auto-calculated
   ```

5. **Set Payment Terms**
   ```
   Section: Payment Terms (3 Termin)
   
   Termin 1:
   - Percentage: 30% (default)
   - Description: "Down Payment (DP) - Setelah approval quotation"
   
   Termin 2:
   - Percentage: 40% (default)
   - Description: "Progress Payment - Setelah progress 50%"
   
   Termin 3:
   - Percentage: 30% (default)
   - Description: "Final Payment - Setelah serah terima project"
   
   ⚠️ Note: Total harus 100%
   ```

6. **Set Revision Terms**
   ```
   - Revision Rounds: 3 (default)
   - Validity Days: 30 (default)
   - Revision Notes: Catatan tambahan (opsional)
   ```

7. **Set Metadata & PIC**
   ```
   - Prepared By: Auto-filled dengan nama Anda
   - Position: Jabatan (e.g., Sales Executive)
   - Sales PIC: Email/phone untuk contact
   ```

8. **Select Terms & Conditions**
   ```
   Standard Terms (check yang berlaku):
   ✓ Pembayaran 3 termin
   ✓ Revisi sesuai rounds
   ✓ Timeline fleksibel
   ✓ Garansi 30 hari
   ✓ Source code after payment
   ✓ Hosting/domain terpisah
   ✓ Training 1x
   ✓ Scope change = biaya tambahan
   ✓ Confidentiality
   ✓ No refund after DP
   
   Custom Terms: (opsional)
   Tambahkan terms khusus jika ada
   ```

9. **Save Quotation**
   - Klik **Create**
   - PDF otomatis generate di background
   - Notifikasi sukses muncul

### B. Download PDF Quotation

**Cara 1: Dari Table Actions**
1. Masuk ke `Quotations` list
2. Klik icon **Download PDF** di baris quotation
3. PDF langsung terdownload

**Cara 2: Regenerate PDF**
1. Jika ada perubahan setelah save
2. Klik icon **Regenerate PDF**
3. PDF baru akan dibuat
4. Download dengan icon **Download PDF**

### C. Send Quotation to Client

1. **Mark as Sent**
   - Klik action **Send to Client**
   - Status berubah menjadi `Sent`
   
2. **Download & Email Manual**
   - Klik **Download PDF**
   - Attach ke email manual
   - Atau share via WhatsApp/tool lain

### D. Update Existing Quotation

1. Klik **Edit** pada quotation
2. Ubah data yang diperlukan:
   - Items (tambah/hapus/edit)
   - Payment terms
   - Revision policy
   - Terms & conditions
3. Klik **Save**
4. PDF otomatis regenerate dengan data terbaru

---

## PDF Design & Content

### Header Section
```
┌──────────────────────────────────────────┐
│ [Company Logo]       QUOTATION           │
│ Company Name         QUO-2025-001        │
│ Address              Date: 22 Jan 2025   │
│ Contact Info         Valid: 21 Feb 2025  │
└──────────────────────────────────────────┘
```

### Customer Info Box
```
┌──────────────────────────────────────────┐
│ Kepada Yth.                              │
│ PT. Client Company Name                  │
│ Contact Person                           │
│ Email & Phone                            │
│ Address                                  │
└──────────────────────────────────────────┘
```

### Items Table
```
┌────┬─────────────────┬─────┬──────────┬──────┬──────────┐
│ No │ Item/Desc       │ Qty │ Unit Pr  │ Disc │ Total    │
├────┼─────────────────┼─────┼──────────┼──────┼──────────┤
│ 1  │ Website Dev     │  1  │ 50,000K  │  0%  │ 50,000K  │
│    │ (Description)   │     │          │      │          │
├────┼─────────────────┼─────┼──────────┼──────┼──────────┤
│ 2  │ Mobile App      │  1  │ 75,000K  │  5%  │ 71,250K  │
└────┴─────────────────┴─────┴──────────┴──────┴──────────┘
```

### Summary Box
```
┌──────────────────────────────────┐
│ Subtotal:        Rp 121,250,000  │
│ Discount (0%):   Rp           0  │
│ After Discount:  Rp 121,250,000  │
│ Tax / PPN (11%): Rp  13,337,500  │
├──────────────────────────────────┤
│ GRAND TOTAL:     Rp 134,587,500  │ (Bold)
└──────────────────────────────────┘
```

### Payment Terms Table
```
┌──────────────────────────────────────────────┐
│ Syarat Pembayaran (Payment Terms)           │
├────────────────────────┬──────┬──────────────┤
│ Down Payment           │ 30%  │ Rp 40,376K   │
│ Progress Payment       │ 40%  │ Rp 53,835K   │
│ Final Payment          │ 30%  │ Rp 40,376K   │
└────────────────────────┴──────┴──────────────┘
```

### Revision Info Box
```
┌──────────────────────────────────────────────┐
│ Revision Policy:                             │
│ Quotation ini mencakup 3 kali revisi.        │
└──────────────────────────────────────────────┘
```

### Terms & Conditions
```
Syarat & Ketentuan (Terms & Conditions)

✓ Pembayaran dilakukan dalam 3 termin...
✓ Revisi desain/konten sesuai rounds...
✓ Timeline pengerjaan fleksibel...
✓ Garansi bug fixing 30 hari...
✓ Source code after payment...
(dan seterusnya)
```

### Signature Section
```
Quotation berlaku 30 hari dari tanggal penerbitan

┌──────────────────┐         ┌──────────────────┐
│  Prepared By     │         │  Approved By     │
│                  │         │                  │
│  [Signature]     │         │  [Signature]     │
│                  │         │                  │
│  John Doe        │         │  PT. Client      │
│  Sales Executive │         │  (TTD & Stempel) │
└──────────────────┘         └──────────────────┘

Untuk informasi: john@spp.com
```

---

## Tips & Best Practices

### 1. **Pricing Strategy**
- Gunakan discount per item untuk item-specific discount
- Gunakan quotation discount untuk discount keseluruhan
- Jelas komunikasikan apakah harga sudah termasuk PPN atau belum

### 2. **Payment Terms**
- **30-40-30** cocok untuk project medium (3-6 bulan)
- **50-50** cocok untuk project kecil (<3 bulan)
- **20-30-30-20** bisa untuk project besar (>6 bulan) - custom description
- Sesuaikan persentase dengan cashflow requirement

### 3. **Revision Policy**
- **3 rounds** cocok untuk project medium complexity
- **5 rounds** untuk project dengan banyak feedback
- **1-2 rounds** untuk project simple/maintenance
- Jelaskan di revision notes apa yang termasuk revisi

### 4. **Validity Period**
- **30 hari** standard
- **14 hari** untuk flash promo
- **60 hari** untuk project government/tender
- Perpanjang jika client butuh internal approval

### 5. **Terms & Conditions**
- Check semua standard terms yang relevan
- Uncheck jika tidak applicable (e.g., hosting included)
- Tambahkan custom terms untuk requirement khusus
- Review dengan legal team untuk project besar

### 6. **Professional Presentation**
- Pastikan company logo sudah diupload di Settings
- Isi company info lengkap (address, contact)
- Gunakan deskripsi item yang jelas dan detail
- Proofread sebelum send ke client

---

## Troubleshooting

### PDF Tidak Generate
**Problem**: Setelah save, PDF tidak ada
**Solution**:
1. Check log: `storage/logs/laravel.log`
2. Pastikan DomPDF package installed: `composer show barryvdh/laravel-dompdf`
3. Check permission folder: `storage/app/quotations/`
4. Gunakan action **Regenerate PDF** manual

### PDF Error / Corrupt
**Problem**: PDF tidak bisa dibuka
**Solution**:
1. Check items ada minimal 1 item
2. Pastikan semua numeric fields terisi (quantity, price)
3. Check company logo format (PNG/JPG)
4. Regenerate PDF

### Payment Terms Total ≠ 100%
**Problem**: Total persentase tidak 100%
**Solution**:
- Hitung manual: Termin 1 + Termin 2 + Termin 3 = 100%
- System tidak enforce, tapi pastikan total = 100%
- Client akan konfusi jika total bukan 100%

### Terms Not Showing in PDF
**Problem**: Terms di form tidak muncul di PDF
**Solution**:
1. Pastikan checkbox terms sudah di-check
2. Save ulang quotation
3. Regenerate PDF
4. Check custom terms sudah disave (jika ada)

### Company Info Missing
**Problem**: Logo/company info tidak muncul di PDF
**Solution**:
1. Masuk ke `Settings` menu
2. Isi `Company Name`, `Address`, `Phone`, `Email`
3. Upload `Company Logo` (max 2MB)
4. Save settings
5. Regenerate PDF quotation

---

## Advanced: Customize PDF Template

Jika Anda ingin customize design PDF:

### File Location
```
resources/views/pdf/quotation.blade.php
```

### Customization Options
1. **Colors**: Ubah `#2563eb` (blue) ke brand color Anda
2. **Fonts**: Ubah `Arial` ke font lain
3. **Layout**: Adjust width, padding, spacing
4. **Logo Size**: Adjust `.company-logo { max-width: 150px; }`
5. **Add Watermark**: Tambahkan background image

### Example: Change Brand Color
```css
/* Dari */
background-color: #2563eb;
color: #2563eb;
border: 3px solid #2563eb;

/* Ke (Orange) */
background-color: #ea580c;
color: #ea580c;
border: 3px solid #ea580c;
```

### After Customization
1. Save file
2. Clear cache: `php artisan view:clear`
3. Test generate PDF
4. Check result

---

## Storage Management

### PDF Storage Location
```
storage/app/quotations/
  ├── QUO-2025-001_20250122065500.pdf
  ├── QUO-2025-002_20250122070000.pdf
  └── QUO-2025-003_20250122071500.pdf
```

### Cleanup Old PDFs
Jika storage penuh, hapus PDF lama:

```bash
# Manual delete
rm storage/app/quotations/QUO-2024-*.pdf

# Or via artisan command (buat sendiri):
php artisan quotations:cleanup --older-than=90days
```

### Backup PDFs
Backup folder quotations secara berkala:

```bash
# Zip all PDFs
zip -r quotations_backup_2025_01.zip storage/app/quotations/

# Copy to external storage
cp quotations_backup_2025_01.zip /backup/location/
```

---

## FAQ

**Q: Apakah PDF auto-regenerate saat edit quotation?**
A: Ya, setiap kali save/update, PDF otomatis regenerate.

**Q: Bisa customize payment terms jadi 4 atau 5 termin?**
A: Sistem default 3 termin. Untuk lebih banyak, perlu modifikasi code migration + form.

**Q: Apakah bisa kirim email langsung dari sistem?**
A: Saat ini belum ada fitur auto-email. Download manual dan attach ke email.

**Q: Bisa buat quotation tanpa tax?**
A: Ya, uncheck toggle "Include Tax" di Summary section.

**Q: Bagaimana track revisi quotation?**
A: PDF tersimpan dengan timestamp. Setiap regenerate buat file baru.

**Q: Bisa multi-bahasa (English)?**
A: Saat ini template Bahasa Indonesia. Untuk English, duplicate template dan translate.

---

## Support

Jika ada masalah atau pertanyaan:
1. Check log: `storage/logs/laravel.log`
2. Check dokumentasi: `CRM_WORKFLOW_GUIDE.md`
3. Contact developer team

---

**Last Updated**: 22 January 2025
**Version**: 1.0.0
