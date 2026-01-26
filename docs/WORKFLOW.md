# 🔄 Workflow: Dari Leads hingga Project Completed

Dokumentasi lengkap alur kerja business process di Sekawan Putra Pratama.

---

## 📊 Overview Workflow

```
Leads → Quotation → Contract → Project → Invoice → Payment → Completed
```

---

## 1️⃣ LEADS MANAGEMENT

### 1.1 Lead Baru Masuk
**Sumber Lead:**
- Contact Form di website
- Email inquiry
- Telepon
- Referral
- Social Media

**Data yang Dicatat:**
- Nama & Perusahaan
- Email & Telepon
- Tipe Layanan yang Diminati
- Budget Range (optional)
- Catatan Kebutuhan

### 1.2 Status Lead & Workflow

#### **Status: New Lead** 
- Lead baru masuk, belum ada kontak
- **Action**: Assign ke Sales Person
- **Next**: Hubungi lead dalam 24 jam

#### **Status: Contacted**
- Sales sudah menghubungi lead
- **Action**: Diskusi kebutuhan, kualifikasi lead
- **Required Data**:
  - Tanggal kontak
  - Metode kontak (call, email, meeting)
  - Hasil percakapan
- **Next**: Siapkan quotation jika qualified

#### **Status: Quotation Sent**
- Penawaran harga sudah dikirim
- **Action**: Follow up dalam 3-5 hari
- **Required Data**:
  - Link/nomor quotation
  - Tanggal kirim
  - Estimasi nilai deal
- **Next**: Tunggu response atau follow up

#### **Status: Negotiation**
- Lead sedang negosiasi harga/scope
- **Action**: Diskusi revisi, adjust quotation
- **Next**: Finalisasi deal atau revisi quotation

#### **Status: Deal Won** ✅
- Lead setuju dengan penawaran
- **Action**: Buat Contract & Invoice
- **Required Data**:
  - Deal value (final)
  - Tanggal closed
  - Payment terms
- **Next**: Generate contract & invoice

#### **Status: Lost** ❌
- Lead tidak jadi atau pilih competitor
- **Action**: Catat alasan loss
- **Next**: Archive atau mark for follow up later

---

## 2️⃣ QUOTATION MANAGEMENT

### 2.1 Membuat Quotation
**Dari:** Leads dengan status "Contacted" atau "Negotiation"

**Informasi Quotation:**
- Client Information (auto dari Lead)
- Service Items:
  - Deskripsi layanan
  - Quantity
  - Unit Price
  - Subtotal
- Additional Notes/Terms
- Validity Period (default 30 hari)
- Payment Terms

### 2.2 Quotation Actions
- **Send to Client**: Kirim via email (PDF attachment)
- **Revise**: Buat versi baru jika ada perubahan
- **Convert to Contract**: Jika deal won
- **Mark as Expired**: Jika melewati validity period

---

## 3️⃣ CONTRACT MANAGEMENT

### 3.1 Membuat Contract
**Triggered by:** Lead status → "Deal Won"

**Contract Contains:**
- Client details
- Scope of work (dari quotation)
- Project timeline
- Deliverables
- Payment schedule
- Terms & Conditions
- Signatures (digital/scan)

### 3.2 Contract Status
- **Draft**: Belum dikirim ke client
- **Sent**: Sudah dikirim, waiting signature
- **Signed**: Client sudah sign
- **Active**: Project berjalan
- **Completed**: Project selesai
- **Cancelled**: Dibatalkan

---

## 4️⃣ PROJECT MANAGEMENT

### 4.1 Create Project
**Triggered by:** Contract status → "Signed"

**Project Setup:**
- Project Name & Code
- Client (linked to contract)
- Project Manager
- Team Members
- Start Date & Deadline
- Budget & Resources

### 4.2 Project Phases

#### **Phase 1: Planning**
- Requirement analysis
- Technical specification
- Resource allocation
- Timeline breakdown

#### **Phase 2: Development**
- Design mockups/wireframes
- Development/Implementation
- Testing (QA)
- Client review & feedback

#### **Phase 3: Deployment**
- Production deployment
- User training
- Documentation
- Handover

#### **Phase 4: Support**
- Post-launch support
- Bug fixes
- Maintenance
- Final review

### 4.3 Project Status
- **Not Started**: Project belum dimulai
- **In Progress**: Development ongoing
- **On Hold**: Temporary pause
- **Review**: Client review stage
- **Completed**: All deliverables done
- **Closed**: Project officially closed

---

## 5️⃣ INVOICE & PAYMENT

### 5.1 Invoice Creation
**Triggered by:** 
- Contract milestone reached
- Project phase completed
- Based on payment schedule

**Invoice Details:**
- Invoice Number (auto-generated)
- Client billing info
- Service/deliverable items
- Subtotal, Tax, Total
- Payment due date
- Payment methods

### 5.2 Invoice Status
- **Draft**: Belum dikirim
- **Sent**: Sudah dikirim ke client
- **Paid**: Payment received
- **Partial**: Sebagian sudah dibayar
- **Overdue**: Melewati due date
- **Cancelled**: Dibatalkan

### 5.3 Payment Tracking
- Record payment received
- Link to invoice
- Payment method (transfer, cash, etc)
- Payment date
- Receipt/proof of payment

---

## 6️⃣ PROJECT COMPLETION

### Checklist Completion:
- [ ] All deliverables completed
- [ ] Client approval received
- [ ] Final invoice paid
- [ ] Documentation delivered
- [ ] Training completed (if applicable)
- [ ] Warranty/support period starts
- [ ] Project archived

### Post-Project:
- Request testimonial
- Add to portfolio (if approved by client)
- Collect lessons learned
- Update case study

---

## 📈 Key Metrics & Reports

### Lead Metrics:
- Conversion rate (Lead → Deal)
- Average deal value
- Time to close
- Lead source effectiveness

### Project Metrics:
- On-time delivery rate
- Budget vs actual
- Client satisfaction score
- Team productivity

### Financial Metrics:
- Revenue per project
- Payment collection rate
- Outstanding invoices
- Profit margin

---

## 🔔 Notifications & Reminders

**Auto Notifications:**
- New lead assigned
- Quotation expiring soon
- Contract awaiting signature
- Project milestone due
- Invoice payment due
- Payment received confirmation

---

## 👥 Role & Permissions

### **Admin**
- Full access to all modules
- Manage users & settings
- View all reports

### **Sales Manager**
- Manage all leads
- Create quotations & contracts
- View sales reports
- Assign leads to team

### **Sales Person**
- Manage assigned leads
- Create quotations
- Update lead status
- View own performance

### **Project Manager**
- Manage all projects
- Assign team members
- Track project progress
- Report to management

### **Finance**
- Manage invoices
- Track payments
- Generate financial reports
- View contracts

---

**Last Updated**: January 26, 2026  
**Version**: 1.0
