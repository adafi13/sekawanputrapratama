# Quotation Form - Visual PDF-Style Update

## Overview
Form quotation sekarang memiliki **visual elements yang menyerupai template PDF** dengan menggunakan background colors, borders, dan styling yang sesuai dengan output PDF yang akan digenerate.

## Visual Changes Implemented

### 1. **Header Preview Section** 🎨
```
┌─────────────────────────────────────────────────────────────┐
│  PT. SEKAWAN PUTRA PRATAMA              QUOTATION           │
│  Jl. Contoh Alamat No. 123              Auto-generated      │
│  Phone: +62 21 1234567                  Date: 22 Jan 2026   │
│  Email: info@spp.com                                        │
└─────────────────────────────────────────────────────────────┘
```
- **Visual**: Gradient background (blue-gray to white)
- **Layout**: Company info (left) | QUOTATION title (right)
- **Border**: Blue bottom border 3px
- **Purpose**: Preview bagaimana header PDF akan terlihat

### 2. **📄 QUOTATION Section**
- **Icon**: 📄 Document emoji
- **Description**: "Header quotation - Company info & Client details"
- **Styling**: Blue bottom border (4px)
- **Visual Effect**: Separator seperti di PDF

### 3. **📋 ITEMS / DESCRIPTION Section**
- **Icon**: 📋 Clipboard emoji
- **Description**: "Tabel item seperti quotation PDF - No | Item | Qty | Price | Disc | Total"
- **Layout**: Grid 12 kolom untuk menyerupai table structure
- **Columns**:
  - Type (2 cols)
  - Item Name (4 cols)
  - Qty (1 col)
  - Unit Price (2 cols)
  - Disc % (1 col)
  - Total (2 cols) - live calculation
- **Visual**: Form fields arranged like table rows

### 4. **📊 PRICING SUMMARY Section**
- **Icon**: 📊 Chart emoji
- **Description**: "Summary tampil di kanan bawah PDF - Subtotal → Discount → Tax → GRAND TOTAL"
- **Background**: Gray (#f9fafb) with border
- **Layout**: 
  - Left: Control inputs (Discount %, Tax toggle, Tax %)
  - Right: Calculation displays (Subtotal, Discount, Tax)
- **GRAND TOTAL**:
  ```
  ╔═══════════════════════════════╗
  ║   GRAND TOTAL: Rp 50,000,000  ║
  ╚═══════════════════════════════╝
  ```
  - **Background**: Blue (#2563eb)
  - **Text**: White, bold, 2xl size
  - **Padding**: 4 (p-4)
  - **Border Radius**: rounded

### 5. **💳 PAYMENT TERMS Section** 🟡
- **Icon**: 💳 Credit card emoji
- **Description**: "3 Termin - Background kuning di PDF | DP 30% → Progress 40% → Final 30%"
- **Background**: Yellow (#fef3c7) ⚠️
- **Border**: Yellow (#fbbf24)
- **Padding**: p-4
- **Visual Effect**: Menyerupai warning/important section di PDF
- **Fields**:
  - 3 Percentage inputs (Grid 3 cols)
  - 3 Description textareas

### 6. **🔄 REVISION POLICY Section** 🔵
- **Icon**: 🔄 Refresh emoji
- **Description**: "Background biru muda di PDF | Default: 3x revisi, valid 30 hari"
- **Background**: Blue-50 (#f0f9ff) 🔵
- **Border**: Blue left border 4px (#0ea5e9)
- **Padding**: p-4
- **Visual Effect**: Info box style
- **Fields**:
  - Revision Rounds (default: 3)
  - Validity Days (default: 30)
  - Revision Notes

### 7. **✅ TERMS & CONDITIONS Section**
- **Icon**: ✅ Checkmark emoji
- **Description**: "Checklist dengan ✓ di PDF - 10 standard terms + custom"
- **CheckboxList**: 10 predefined terms (all checked by default)
- **Visual**: Akan render sebagai list dengan ✓ mark di PDF
- **Custom Terms**: Textarea untuk additional terms

### 8. **✍️ SIGNATURE & APPROVAL Section**
- **Icon**: ✍️ Writing hand emoji
- **Description**: "Area tanda tangan - Prepared By (kiri) | Approved By (kanan)"
- **Border Top**: 2px gray (#e5e7eb)
- **Margin Top**: mt-8
- **Layout**: 2 columns
  - **Left**: Prepared By preview + fields (Name, Position, Contact)
  - **Right**: Approved By preview + validity note
- **Signature Preview**:
  ```
  ┌─────────────────────┐
  │   Prepared By       │
  │                     │
  │                     │
  │                     │
  │   ───────────────   │
  │   (Signature)       │
  └─────────────────────┘
  ```
  - Dashed border preview box
  - 60px space for signature
  - Border-top for signature line

### 9. **📎 FILE UPLOAD Section**
- Remains at bottom
- Optional manual PDF upload
- Helper text: "PDF akan otomatis digenerate. Upload manual hanya jika diperlukan."

## Color Scheme Matching PDF

| Element | PDF Color | Form Color | Implementation |
|---------|-----------|------------|----------------|
| Header Border | Blue #2563eb | Blue #2563eb | `border-b-4 border-blue-600` |
| Company Name | Blue #2563eb | Blue #2563eb | HTML inline style |
| Section Background | Gray #f8fafc | Gray #f8fafc | `class="bg-gray-50"` |
| Payment Terms | Yellow #fef3c7 | Yellow #fef3c7 | `class="bg-yellow-50"` |
| Revision Box | Blue #f0f9ff | Blue #f0f9ff | `class="bg-blue-50"` |
| Grand Total | Blue #2563eb | Blue #2563eb | `class="bg-blue-600 text-white"` |
| Borders | Gray #e5e7eb | Gray #e5e7eb | `border-gray-200` |

## Layout Improvements

### **Before** (Old Linear Form):
```
Section 1: QUOTATION
  - Fields in simple layout
  
Section 2: Items
  - Plain repeater

Section 3: Summary
  - Simple grid

...
```

### **After** (PDF-Style Visual Form):
```
┌══════════════════════════════════════════════════════┐
│  [HEADER PREVIEW]                                     │
│  Company Logo + Name         QUOTATION Title          │
└══════════════════════════════════════════════════════┘
     ↓ Blue border 3px

┌──────────────────────────────────────────────────────┐
│  📄 QUOTATION                                         │
│  [Quotation #] [Valid Until] [Status]                │
│  [Lead] [Customer]                                    │
│  [Notes]                                              │
└──────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────┐
│  📋 ITEMS / DESCRIPTION                               │
│  [Template Selector]                                  │
│  ┌────┬─────────┬────┬──────┬──────┬──────┐         │
│  │Type│   Name  │Qty │Price │Disc %│Total │         │
│  └────┴─────────┴────┴──────┴──────┴──────┘         │
│  [Description]                                        │
└──────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────┐
│  📊 PRICING SUMMARY              [Gray Background]    │
│  [Controls]           |    [Summary Display]         │
│  Discount %           |    Subtotal: Rp XXX          │
│  Include Tax          |    Discount: Rp XXX          │
│  Tax %                |    Tax/PPN: Rp XXX           │
│                       |    ┏━━━━━━━━━━━━━━━━━┓       │
│                       |    ┃ GRAND TOTAL     ┃       │
│                       |    ┃ Rp XX,XXX,XXX   ┃       │
│                       |    ┗━━━━━━━━━━━━━━━━━┛       │
└──────────────────────────────────────────────────────┘

┌══════════════════════════════════════════════════════┐
│  💳 PAYMENT TERMS       [YELLOW BACKGROUND ⚠️]       │
│  [Termin 1 %] [Termin 2 %] [Termin 3 %]              │
│  [Description 1]                                      │
│  [Description 2]                                      │
│  [Description 3]                                      │
└══════════════════════════════════════════════════════┘

┌══════════════════════════════════════════════════════┐
│  🔄 REVISION POLICY     [BLUE BACKGROUND 🔵]         │
│  ┃ [Revision Rounds]  [Validity Days]                │
│  ┃ [Revision Notes]                                  │
└══════════════════════════════════════════════════════┘

┌──────────────────────────────────────────────────────┐
│  ✅ TERMS & CONDITIONS                                │
│  ☑️ Payment terms                                     │
│  ☑️ Revision policy                                   │
│  ☑️ Timeline                                          │
│  ... (10 checkboxes)                                 │
│  [Custom Terms]                                       │
└──────────────────────────────────────────────────────┘

───────────────────────────────────────────────────────
│  ✍️ SIGNATURE & APPROVAL                              │
│  ┌───────────────┐     ┌───────────────┐            │
│  │  Prepared By  │     │  Approved By  │            │
│  │               │     │               │            │
│  │  ___________  │     │  ___________  │            │
│  └───────────────┘     └───────────────┘            │
│  [Name] [Position] [Contact]                         │
└──────────────────────────────────────────────────────┘

```

## Benefits of Visual Updates

### **User Experience** ✨
1. ✅ **Visual Preview**: Form memberikan preview bagaimana PDF akan terlihat
2. ✅ **Color Coding**: Different sections menggunakan warna yang sesuai dengan PDF
   - Yellow = Payment (important)
   - Blue = Revision (info)
   - White = Standard sections
   - Blue header = Company branding
3. ✅ **Layout Match**: Grid structure menyerupai table/layout di PDF
4. ✅ **WYSIWYG Feel**: "What You Fill Is What You Get" - form = preview dokumen

### **Visual Hierarchy** 📊
1. 🔵 **Header Preview** - Most prominent (gradient + large text)
2. 🟡 **Payment Terms** - Yellow background (stands out)
3. 🔵 **Revision Policy** - Blue background (info box)
4. ⚫ **Grand Total** - Blue background with white text (call to action)
5. ⚪ **Standard Sections** - Clean white with subtle borders

### **Professional Look** 💼
- Matches company branding (blue theme)
- Clear section separation (borders, backgrounds)
- Consistent spacing and padding
- Icon indicators for quick identification
- Descriptive helper texts

## Technical Implementation

### **Tailwind CSS Classes Used**
```css
border-b-4 border-blue-600    /* Header bottom border */
bg-gray-50 border-gray-200     /* Summary section */
bg-yellow-50 border-yellow-400 /* Payment terms */
bg-blue-50 border-l-4          /* Revision policy */
bg-blue-600 text-white         /* Grand total */
mt-8 pt-6 border-t-2           /* Signature section */
```

### **Inline Styles (For Complex Layouts)**
```html
<!-- Header preview with gradient -->
<div style="display: flex; justify-content: space-between; 
     background: linear-gradient(to right, #f8fafc, #ffffff);">
  <!-- Content -->
</div>
```

### **HtmlString Component**
```php
new \Illuminate\Support\HtmlString('...')
```
Used for rendering HTML directly in Placeholder components for visual previews.

## Comparison with PDF Output

### **Form Section** → **PDF Section**

| Form | PDF | Visual Match |
|------|-----|--------------|
| Header Preview | Header (Company + QUOTATION) | ✅ Gradient + blue border |
| 📄 QUOTATION | Customer Info Box | ✅ Blue left border + background |
| 📋 ITEMS | Items Table | ✅ Grid layout like table |
| 📊 SUMMARY | Summary (right-aligned) | ✅ Grid layout, blue grand total |
| 💳 PAYMENT | Payment Terms (yellow) | ✅ Yellow background matches |
| 🔄 REVISION | Revision Info (blue) | ✅ Blue background matches |
| ✅ TERMS | Terms Checklist | ✅ Checkbox list with ✓ |
| ✍️ SIGNATURE | Signature Section | ✅ Border-top + 2 columns |

## Result

Form sekarang **visual menyerupai template quotation PDF** dengan:
- ✅ Color-coded sections matching PDF
- ✅ Header preview showing company info + title
- ✅ Table-like grid for items
- ✅ Highlighted grand total (blue background)
- ✅ Yellow payment terms (important section)
- ✅ Blue revision policy (info box)
- ✅ Signature preview boxes
- ✅ Consistent borders and spacing

User sekarang dapat **"melihat" quotation mereka** saat mengisi form, bukan hanya form input standar. Ini memberikan confidence bahwa output PDF akan sesuai dengan ekspektasi.

## Next Steps

### Optional Enhancements:
1. **Real-time PDF Preview**: Add iframe/modal showing actual PDF preview
2. **Dynamic Company Info**: Fetch from settings and display in header
3. **Customer Info Preview**: Show customer details in box like PDF
4. **Items Table Header**: Add static "No | Item | Qty | Price | Disc | Total" header above repeater
5. **Terms Preview**: Show checked terms with ✓ marks in real-time

### Testing Checklist:
- [ ] Header preview displays correctly
- [ ] Sections have correct background colors
- [ ] Grand total has blue background
- [ ] Payment terms has yellow background
- [ ] Revision section has blue background
- [ ] Signature section has border-top
- [ ] Form is responsive on different screen sizes
- [ ] All calculations work correctly
- [ ] PDF generation matches form visual

Form sudah siap dan memberikan user experience yang lebih baik dengan visual preview yang menyerupai dokumen quotation!
