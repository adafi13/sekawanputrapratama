# 📋 CRM WORKFLOW GUIDE - Sekawan Putra Pratama

## 🎯 Overview
Panduan lengkap penggunaan sistem CRM untuk mengelola lead dari awal hingga menjadi customer.

---

## 🔄 Complete Workflow Diagram

```
┌─────────────────────────────────────────────────────────────────────┐
│                         LEAD LIFECYCLE                               │
└─────────────────────────────────────────────────────────────────────┘

    📥 NEW LEAD
        │
        │ [Kualifikasi Lead]
        ↓
    ✅ QUALIFIED ────────┐
        │                 │
        │ [Kontak Lead]   │
        ↓                 │
    📞 CONTACTED          │
        │                 │
        │ [Kirim Penawaran] │
        ↓                 │
    📄 QUOTATION SENT     │
        │                 │
        │ [Negosiasi]     │
        ↓                 │
    💬 NEGOTIATION        │
        │                 │
        ├─[Deal]──────────┤
        │                 │
        ↓                 │
    ✅ DEAL WON          │
        │                 │
        │                 │
        └─[Lost]──────────┤
                          ↓
                      ❌ LOST
                          │
                          │ [Revive]
                          ↓
                      📞 CONTACTED
```

---

## 📝 Detailed Workflow Steps

### 1️⃣ NEW LEAD (Lead Baru Masuk)

**Apa itu?**
Lead baru yang baru saja masuk dari berbagai sumber (form website, telepon, email, referral, dll).

**Karakteristik:**
- ⚪ Status: **NEW**
- 📋 Data minimal: Company Name, Contact Person, Email/Phone
- ❓ Belum diverifikasi
- ❓ Belum dicek kelayakannya

**Action yang Tersedia:**
- 🔵 **Actions → Qualified** - Majukan ke tahap Qualified
- ❌ **Actions → Mark as Lost** - Tandai sebagai lost (jika tidak relevan)
- ✏️ **Edit** - Edit data lead
- 🗑️ **Delete** - Hapus lead

**Kapan Majukan ke Qualified?**
✅ Setelah melakukan screening awal:
- Budget sesuai dengan service kita
- Punya kebutuhan yang jelas
- Timeline realistis
- Contact person adalah decision maker atau punya akses ke decision maker

**Contoh Skenario:**
```
Lead: PT ABC masuk via form website
→ Cek data: Butuh website company profile, budget 50jt, start 2 bulan lagi
→ ✅ Sesuai kriteria kita
→ Action: Klik "Actions → Qualified"
```

---

### 2️⃣ QUALIFIED (Lead Terverifikasi)

**Apa itu?**
Lead yang sudah diverifikasi dan memenuhi kriteria BANT (Budget, Authority, Need, Timeline).

**Karakteristik:**
- 🔵 Status: **QUALIFIED**
- ✅ Sudah dicek kelayakannya
- ✅ Potensial untuk difollow-up
- 📊 Layak mendapat alokasi waktu tim sales

**Action yang Tersedia:**
- 📞 **Actions → Contacted** - Majukan ke tahap Contacted
- ⚠️ **Actions → Previous Stage** - Kembali ke New (jika salah kualifikasi)
- ❌ **Actions → Mark as Lost** - Tandai sebagai lost
- ✏️ **Edit** - Edit data lead

**Kapan Majukan ke Contacted?**
✅ Setelah berhasil menghubungi lead untuk pertama kali:
- Sudah telepon/email/meeting pertama
- Lead merespon positif
- Sudah dapat informasi kebutuhan lebih detail

**Form yang Harus Diisi:**
- 📅 **Contact Date** - Tanggal kontak pertama (otomatis hari ini)
- 📝 **Notes** (opsional) - Catatan hasil kontak

**Contoh Skenario:**
```
Lead PT ABC sudah qualified
→ Tim sales telepon: "Halo, saya dari SPP..."
→ Klien tertarik, ingin diskusi lebih lanjut
→ Action: Klik "Actions → Contacted"
→ Isi Contact Date: 22/01/2026
→ Isi Notes: "Sudah telepon, butuh landing page + backend"
```

---

### 3️⃣ CONTACTED (Sudah Dihubungi)

**Apa itu?**
Lead yang sudah berhasil dihubungi dan sedang dalam tahap diskusi kebutuhan.

**Karakteristik:**
- 💙 Status: **CONTACTED**
- 📞 Sudah ada komunikasi 2 arah
- 📋 Informasi kebutuhan sudah lebih lengkap
- ⏳ Menunggu persiapan quotation

**Action yang Tersedia:**
- 📄 **Actions → Quotation Sent** - Majukan ke tahap Quotation Sent
- ⚠️ **Actions → Previous Stage** - Kembali ke Qualified
- ❌ **Actions → Mark as Lost** - Tandai sebagai lost
- ✏️ **Edit** - Edit data lead

**Kapan Majukan ke Quotation Sent?**
✅ Setelah membuat dan mengirim quotation:
- Sudah paham kebutuhan detail klien
- Sudah buat quotation/proposal
- Quotation sudah dikirim ke klien

**Form yang Harus Diisi:**
- 📝 **Quotation Notes** - Ringkasan penawaran
- 📅 **Quotation Sent Date** - Otomatis hari ini

**Fitur Khusus:**
🎯 **Auto-Create Quotation**: Sistem otomatis membuat record Quotation baru saat status diubah ke "Quotation Sent"!

**Contoh Skenario:**
```
Lead PT ABC sudah contacted
→ Meeting: Butuh web + mobile app, timeline 4 bulan
→ Tim sales buat quotation Rp 150jt
→ Quotation dikirim via email
→ Action: Klik "Actions → Quotation Sent"
→ Isi Quotation Notes: "Web corporate + Mobile app iOS/Android, 4 bulan"
→ ✅ Sistem otomatis create Quotation record!
```

**Akses Quotation:**
- Menu **CRM → Quotations**
- Cari quotation berdasarkan lead/company name
- Edit quotation untuk lengkapi detail items

---

### 4️⃣ QUOTATION SENT (Penawaran Terkirim)

**Apa itu?**
Lead yang sudah dikirim quotation/proposal dan sedang menunggu feedback.

**Karakteristik:**
- 🟡 Status: **QUOTATION SENT**
- 📄 Quotation sudah terkirim
- ⏳ Menunggu respon klien
- 💼 Ada record Quotation di sistem

**Action yang Tersedia:**
- 💬 **Actions → Negotiation** - Majukan ke tahap Negotiation
- ⚠️ **Actions → Previous Stage** - Kembali ke Contacted
- ❌ **Actions → Mark as Lost** - Tandai sebagai lost
- ✏️ **Edit** - Edit data lead

**Kapan Majukan ke Negotiation?**
✅ Saat klien mulai merespon dan diskusi harga:
- Klien minta revisi harga
- Klien tanya detail spesifikasi
- Klien minta perubahan scope
- Klien nego timeline

**Form yang Harus Diisi:**
- 📝 **Notes** (opsional) - Catatan negosiasi

**Tips:**
- 📧 Follow-up reguler jika tidak ada respon (3 hari, 1 minggu)
- 📝 Update notes setiap ada komunikasi
- 📄 Edit quotation di menu Quotations jika ada revisi

**Contoh Skenario:**
```
Lead PT ABC sudah terima quotation
→ 3 hari kemudian: Klien email "Bisa nego harga?"
→ Action: Klik "Actions → Negotiation"
→ Isi Notes: "Klien nego harga, minta diskon 10%"
```

---

### 5️⃣ NEGOTIATION (Tahap Negosiasi)

**Apa itu?**
Lead dalam tahap negosiasi aktif tentang harga, scope, atau timeline.

**Karakteristik:**
- 🟠 Status: **NEGOTIATION**
- 💬 Sedang diskusi detail
- 💰 Nego harga/scope/timeline
- 🤝 Closing sudah dekat

**Action yang Tersedia:**
- ✅ **Actions → Deal Won** - Majukan ke Deal (Berhasil closing!)
- ⚠️ **Actions → Previous Stage** - Kembali ke Quotation Sent
- ❌ **Actions → Mark as Lost** - Tandai sebagai lost
- ✏️ **Edit** - Edit data lead

**Kapan Majukan ke Deal Won?**
✅ Saat deal berhasil closed:
- Klien setuju dengan proposal final
- Klien siap untuk PO/kontrak
- Deal sudah confirmed

**Form yang Harus Diisi:**
- 💰 **Deal Value** ⚠️ WAJIB - Nilai kontrak dalam Rupiah
- 📅 **Deal Closed Date** - Otomatis hari ini
- 📝 **Notes** (opsional) - Catatan deal

**Fitur Khusus:**
🎉 **Auto-Create Customer, Project & Contract**: Saat status diubah ke "Deal Won", sistem otomatis membuat:
1. **Customer** record
2. **Project** record
3. **Contract** record

**Contoh Skenario:**
```
Lead PT ABC dalam negosiasi
→ Final nego: Harga turun jadi 135jt, deal!
→ Klien konfirmasi via email: "Oke, kami setuju"
→ Action: Klik "Actions → Deal Won"
→ Isi Deal Value: 135000000 (Rp 135 juta)
→ ✅ Sistem otomatis create:
   - Customer: PT ABC
   - Project: Web + Mobile App PT ABC
   - Contract: Kontrak PT ABC
```

**Next Steps Setelah Deal:**
1. 📋 Cek menu **CRM → Customers** - Data customer sudah ada
2. 📁 Cek menu **CRM → Projects** - Project baru otomatis dibuat
3. 📄 Cek menu **CRM → Contracts** - Contract draft sudah tersedia
4. ✏️ Edit Project & Contract untuk lengkapi detail
5. 💰 Buat Invoice di menu **CRM → Invoices**

---

### 6️⃣ DEAL WON (Deal Berhasil) ✅

**Apa itu?**
Lead berhasil menjadi customer! Deal closed dan project dimulai.

**Karakteristik:**
- ✅ Status: **DEAL WON**
- 🎉 Deal sudah confirmed
- 💰 Ada deal value
- 📊 Sudah jadi Customer + Project + Contract
- 🏁 Status FINAL (tidak bisa diubah lagi)

**Action yang Tersedia:**
- ✏️ **Edit** - Edit data lead (view only untuk status)
- 🗑️ **Delete** - Hapus lead (jarang dilakukan)

**Data Terkait:**
- **Customer**: Menu CRM → Customers
- **Project**: Menu CRM → Projects
- **Contract**: Menu CRM → Contracts
- **Invoices**: Menu CRM → Invoices (buat manual)

**Workflow Lanjutan:**
```
DEAL WON
    │
    ├─→ [Kelola Project] → CRM → Projects
    ├─→ [Buat Invoice] → CRM → Invoices
    ├─→ [Tracking Progress] → Update project status
    └─→ [Payment] → Update invoice status
```

---

### 7️⃣ LOST (Lead Gagal) ❌

**Apa itu?**
Lead yang tidak jadi/gagal karena berbagai alasan.

**Karakteristik:**
- ❌ Status: **LOST**
- 📝 Ada catatan alasan lost
- 💔 Tidak jadi deal
- 🔄 Bisa di-revive nanti

**Cara Menandai Lead Sebagai Lost:**
Dari status apapun (kecuali Deal Won):
- ❌ **Actions → Mark as Lost**
- 📝 Isi **Reason for Lost** - WAJIB
- ✅ Submit

**Alasan Umum Lost:**
- 💰 Budget tidak cukup
- 🏆 Memilih kompetitor
- ⏰ Timeline tidak cocok
- 📊 Tidak ada kebutuhan mendesak
- 📵 Tidak merespon (ghosting)
- 🔄 Posisi ditunda/pending

**Action yang Tersedia:**
- 🔄 **Actions → Revive Lead** - Hidupkan kembali lead
- ✏️ **Edit** - Edit data lead
- 🗑️ **Delete** - Hapus lead

**Revive Lead:**
Jika lead yang lost ternyata kembali tertarik:
- 🔄 **Actions → Revive Lead**
- 📝 Isi **Reason for Reviving** - WAJIB
- ✅ Lead kembali ke status **CONTACTED**

**Contoh Skenario Lost:**
```
Lead PT ABC dalam negotiation
→ Klien email: "Maaf, budget kami tidak cukup"
→ Action: Klik "Actions → Mark as Lost"
→ Isi Reason: "Budget tidak mencukupi, hanya ada 80jt"
→ ✅ Lead ditandai sebagai LOST
```

**Contoh Skenario Revive:**
```
Lead PT ABC status LOST (3 bulan lalu)
→ Klien telepon: "Sekarang budget sudah ada, bisa lanjut?"
→ Action: Klik "Actions → Revive Lead"
→ Isi Reason: "Budget sudah approved, ingin lanjut project"
→ ✅ Lead kembali ke status CONTACTED
→ Lanjutkan workflow dari awal
```

---

## 🎯 Quick Reference - Action Buttons

### Button di Table (List View)

| Button | Fungsi | Keterangan |
|--------|--------|------------|
| **Actions ▼** | Dropdown workflow actions | Berisi 4 sub-actions |
| ├─ Status Name | Advance ke next stage | Label dinamis (Qualified, Contacted, dll) |
| ├─ Previous Stage | Mundur ke stage sebelumnya | Muncul jika bisa mundur |
| ├─ Mark as Lost | Tandai sebagai lost | Tidak muncul jika DEAL/LOST |
| └─ Revive Lead | Hidupkan kembali | Hanya muncul jika LOST |
| **Edit** | Edit data lead | Selalu tersedia |
| **Delete** | Hapus lead | Selalu tersedia |

---

## 🚫 Workflow Rules & Validations

### ✅ Rules:

1. **Sequential Flow**: Harus maju bertahap, tidak bisa loncat
   - ❌ NEW → langsung NEGOTIATION (TIDAK BOLEH)
   - ✅ NEW → QUALIFIED → CONTACTED → ... (HARUS BERURUTAN)

2. **Status Lock**: Field Status **tidak bisa diubah manual**
   - Hanya bisa diubah via **Actions** dropdown
   - Super Admin tetap tidak bisa ubah manual

3. **Final Status**: Status **DEAL WON** adalah final
   - Tidak bisa diubah lagi ke status lain
   - Tidak ada button "Previous Stage" atau "Lost"

4. **Backward Movement**: Bisa mundur 1 tahap ke belakang
   - ✅ CONTACTED → QUALIFIED (boleh)
   - ✅ NEGOTIATION → QUOTATION SENT (boleh)
   - ❌ NEGOTIATION → CONTACTED (tidak bisa, harus mundur 1-1)

5. **Lost from Anywhere**: Bisa mark as lost dari status apapun
   - ✅ Kecuali dari DEAL WON
   - ✅ Kecuali sudah LOST

6. **Revive to Contacted**: Lead yang di-revive selalu kembali ke **CONTACTED**
   - Tidak kembali ke status sebelumnya
   - Workflow mulai dari CONTACTED lagi

### ⚠️ Kanban Board Rules:

- **Drag & Drop Validation**: 
  - ✅ Drag ke stage berikutnya (next)
  - ✅ Drag ke stage sebelumnya (previous)
  - ❌ Drag loncat 2+ stage (blocked)
- **Sequential Enforcement**: 
  - Sistem akan tolak dan tampilkan notification
  - Harus pakai "Advance Stage" button untuk input data

---

## 👥 Permission & Access Control

### 🔐 Assignment & Tracking Fields (Super Admin Only)

Field-field ini **hanya bisa diedit oleh Super Admin**:
- 👤 **Assigned To** - Assign lead ke user
- 📅 **Contact Date** - Tanggal kontak manual
- 📅 **Quotation Sent Date** - Tanggal kirim quotation manual
- 📅 **Deal Closed Date** - Tanggal deal manual

User biasa (Admin, Editor, Author):
- ✅ Bisa **view** semua field
- ❌ **Tidak bisa edit** field di atas
- ✅ Bisa edit field lainnya (company name, notes, dll)

**Catatan**: Date otomatis tetap ter-set saat advance stage, ini hanya untuk edit manual.

---

## 📊 Monitoring & Reporting

### Kanban Board View

Access: **CRM → Leads → Switch to Kanban Board**

Fitur:
- 📊 Visual pipeline leads per stage
- 🔢 Counter jumlah lead per kolom
- 🖱️ Drag & drop dengan validasi
- 🎨 Color-coded status cards
- 📱 Responsive layout

Kolom:
```
┌─────────┬──────────┬───────────┬────────────┬─────────────┬──────────┬────────┐
│   NEW   │ QUALIFIED│ CONTACTED │ QUOTATION  │ NEGOTIATION │   DEAL   │  LOST  │
│   (3)   │   (5)    │    (8)    │  SENT (4)  │     (2)     │  WON (1) │  (2)   │
└─────────┴──────────┴───────────┴────────────┴─────────────┴──────────┴────────┘
```

### Table View

Access: **CRM → Leads** (default)

Kolom:
- Company Name
- Contact Person
- Email
- Phone
- **Status** (badge dengan warna)
- Assigned To
- Deal Value
- Created At

Filter:
- 🔍 Filter by Status
- 👤 Filter by Assigned To
- 🔎 Search by company/email/phone

---

## 🎓 Best Practices

### ✅ DO (Lakukan)

1. **Selalu Isi Notes** saat advance stage
   - Dokumentasi komunikasi
   - History untuk referensi
   - Handover antar tim

2. **Update Contact Date** secara akurat
   - Tracking response time
   - SLA monitoring
   - Performance metrics

3. **Isi Deal Value dengan Benar**
   - Nilai final setelah nego
   - Dalam Rupiah (tanpa simbol)
   - Contoh: 150000000 (bukan 150jt)

4. **Kualifikasi dengan BANT**
   - **B**udget: Ada budget?
   - **A**uthority: Decision maker?
   - **N**eed: Butuh apa?
   - **T**imeline: Kapan?

5. **Follow-up Teratur**
   - NEW/QUALIFIED: Max 1 hari
   - CONTACTED: Max 3 hari
   - QUOTATION SENT: Max 7 hari
   - NEGOTIATION: Daily/sesuai kesepakatan

### ❌ DON'T (Jangan)

1. **Jangan Skip Stage**
   - Sistem akan block
   - Harus sequential

2. **Jangan Lupa Isi Reason**
   - Wajib saat Lost
   - Wajib saat Revive
   - Wajib saat Previous Stage

3. **Jangan Edit Status Manual**
   - Field disabled
   - Hanya via Actions

4. **Jangan Duplicate Lead**
   - Cek dulu di list
   - Search by company name

5. **Jangan Hapus Lead DEAL WON**
   - Data penting untuk reporting
   - Sudah terkait Customer/Project

---

## 🆘 Troubleshooting

### Q: Button "Actions" tidak muncul?
**A:** Button Actions muncul di table row. Cari di kolom paling kanan, sejajar dengan Edit dan Delete.

### Q: Tidak bisa advance stage?
**A:** Pastikan:
- Lead bukan status DEAL WON atau LOST
- Anda sedang di stage yang bisa maju
- Isi semua field required di form modal

### Q: Quotation tidak otomatis terbuat?
**A:** Quotation otomatis dibuat saat:
- Advance dari CONTACTED → QUOTATION SENT
- Cek di menu CRM → Quotations
- Cari berdasarkan lead/company name

### Q: Customer/Project tidak otomatis terbuat?
**A:** Auto-create terjadi saat:
- Advance ke DEAL WON
- Cek di menu CRM → Customers, Projects, Contracts
- Field deal_value harus diisi!

### Q: Lead tidak bisa di-revive?
**A:** Lead hanya bisa di-revive jika:
- Status saat ini = LOST
- Button "Revive Lead" ada di Actions dropdown

### Q: Tidak bisa edit Assignment & Tracking?
**A:** Field tersebut hanya untuk Super Admin:
- Assigned To
- Contact/Quotation/Deal dates
- Request akses ke Super Admin jika perlu edit

---

## 📞 Support

Jika ada pertanyaan atau kendala:
- 📧 Email: it@sekawanputrapratama.com
- 💬 Internal: Contact IT Team
- 📖 Docs: CRM_IMPLEMENTATION.md

---

**Last Updated**: 22 Januari 2026
**Version**: 1.0
**Author**: IT Team - Sekawan Putra Pratama
