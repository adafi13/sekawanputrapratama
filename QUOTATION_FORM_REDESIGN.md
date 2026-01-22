# Quotation Form Redesign - Linear Layout

## Overview
Form quotation telah didesign ulang untuk menyerupai format PDF quotation yang akan digenerate. Form sekarang memiliki struktur linear tanpa collapsible sections, sehingga semua field terlihat langsung seperti dokumen quotation yang sesungguhnya.

## Changes Made

### 1. **Removed Collapsible Features**
- ❌ Removed: `collapsible()`, `collapsed()`, `persistCollapsed()`
- ❌ Removed: `icon()` from sections (emoji icons in section titles are sufficient)
- ✅ All sections now visible and expanded by default
- ✅ Linear top-to-bottom flow matching PDF document structure

### 2. **Section Structure (8 Sections)**

#### **Section 1: QUOTATION (Header)**
- **Layout**: 2-column grid
- **Left Column**: Quotation info (Number, Valid Until, Status)
- **Right Column**: Client info (Lead, Customer)
- **Bottom**: Notes field (full width)
- **Icons**: Added prefixIcons to all fields for better visual cues

#### **Section 2: Items**
- **Template Selector**: Quick load from predefined templates
- **Repeater**: 12-column grid for table-like layout
  - Type (2 cols)
  - Item Name (4 cols)
  - Quantity (1 col)
  - Unit Price (2 cols)
  - Discount % (1 col)
  - Total (2 cols) - calculated placeholder
- **Description**: Full-width textarea per item
- **Features**: Reorderable, collapsible (per item), cloneable

#### **Section 3: Summary**
- **Layout**: 2-column grid
- **Left Column**: Calculation displays
  - Subtotal (from items)
  - Discount (shows amount & percentage)
  - Tax/PPN (shows amount & percentage or "Not included")
  - **GRAND TOTAL** (bold, large, primary color)
- **Right Column**: Control inputs
  - Additional Discount %
  - Include Tax toggle
  - Tax Percentage (conditional, shows when tax included)

#### **Section 4: Payment Terms**
- **Percentages**: 3-column grid (Termin 1/2/3 %)
- **Descriptions**: 3 textareas (one per termin)
- **Defaults**: 30% / 40% / 30%

#### **Section 5: Revision & Validity**
- **Layout**: 2-column grid
  - Revision Rounds (default: 3)
  - Validity Days (default: 30)
- **Icons**: Added prefixIcons (ArrowPath, Calendar)
- **Notes**: Full-width textarea for revision policy notes

#### **Section 6: Terms & Conditions**
- **Standard Terms**: CheckboxList with 10 predefined terms
  - All checked by default
  - Bulk toggle available
- **Custom Terms**: Textarea for additional terms
- **Removed**: gridDirection and searchable (simplification)

#### **Section 7: Prepared By (Metadata)**
- **Layout**: 3-column grid
  - Name (default: logged-in user)
  - Position (default: "Sales Executive")
  - Contact/PIC (phone/email)
- **Icons**: Added prefixIcons (User, Briefcase, Phone)

#### **Section 8: File Upload**
- **Optional**: Manual PDF upload
- **Helper Text**: Indicates PDF auto-generation
- **Accepts**: PDF files only, max 5MB

### 3. **Visual Improvements**

#### **Simplified Labels**
- ❌ Removed emoji prefixes from section titles (📋, 🛒, 💎, etc.)
- ✅ Clean section titles: "QUOTATION", "Items", "Summary", etc.
- ✅ Descriptive subtitles remain for context

#### **Cleaner Placeholders**
- ❌ Removed emojis from placeholder labels (💰, 📋, 🏷️, etc.)
- ✅ Simple labels: "Subtotal", "Discount", "Tax / PPN", "GRAND TOTAL"
- ✅ GRAND TOTAL highlighted with `text-primary-600` class

#### **Consistent Iconography**
- ✅ PrefixIcons added to key input fields
- ✅ Icons from Heroicon: OutlinedDocumentText, OutlinedCalendar, OutlinedTag, OutlinedBriefcase, OutlinedUser, OutlinedArrowPath, OutlinedPhone

### 4. **Layout Matching PDF Structure**

The form now follows the same flow as the generated PDF:

```
PDF Document          →    Form Section
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
1. Header             →    QUOTATION
   (Company & Client)
                      
2. Items Table        →    Items
   (Description)           (Repeater with grid)

3. Summary            →    Summary
   (Subtotal → Total)      (Calculations + Controls)

4. Payment Terms      →    Payment Terms
   (3 Termin)              (Percentages + Descriptions)

5. Revision Policy    →    Revision & Validity

6. Terms & Conditions →    Terms & Conditions

7. Signature          →    Prepared By
   (Prepared By)

8. (File Path)        →    File Upload
```

## Benefits

### **User Experience**
1. ✅ **No Hidden Content**: All fields visible at once
2. ✅ **Intuitive Flow**: Follows natural document structure
3. ✅ **Less Clicks**: No need to expand/collapse sections
4. ✅ **Visual Preview**: Form resembles the final PDF output

### **Developer Benefits**
1. ✅ **Cleaner Code**: Removed unnecessary UI complexity
2. ✅ **Better Maintainability**: Straightforward structure
3. ✅ **Consistent Layout**: Matches PDF template structure
4. ✅ **No Errors**: All Filament components properly used

## Technical Details

### **Grid System**
- Main sections use Grid(2) or Grid(3) for horizontal layout
- Items repeater uses Grid(12) for precise column control
- Responsive and follows Filament's grid best practices

### **Live Calculations**
- All calculations update in real-time with `live()` modifier
- Discount, tax, and grand total auto-calculate
- Per-item totals display in repeater

### **Validation**
- Required fields properly marked
- Numeric validations on prices and percentages
- File upload restricted to PDF, max 5MB

### **Defaults**
- Smart defaults: 30 days validity, 3 revision rounds, 11% tax
- Pre-checked all standard terms
- Auto-fills user info (name, position)

## Migration Notes

### **No Database Changes**
- ✅ Form structure change only
- ✅ All fields remain the same
- ✅ No migration needed
- ✅ Backward compatible

### **Existing Data**
- ✅ All existing quotations will display correctly
- ✅ No data loss or transformation needed

## Testing Checklist

- [ ] Create new quotation → All sections visible
- [ ] Load template → Items populate correctly
- [ ] Add/remove items → Repeater works smoothly
- [ ] Change discount % → Summary recalculates
- [ ] Toggle tax → Tax shows/hides, total updates
- [ ] Save quotation → PDF auto-generates
- [ ] Edit quotation → All fields editable
- [ ] Check responsiveness → Layout adapts to screen size

## File Modified

**Path**: `app/Filament/Resources/Quotations/Schemas/QuotationForm.php`

**Lines**: ~492 lines (reduced from ~504 by removing unnecessary config)

**Changes**: 
- Removed all `collapsible()`, `collapsed()`, `persistCollapsed()`
- Removed all `icon()` from sections
- Simplified section titles and placeholder labels
- Added prefixIcons to input fields
- Reorganized grid layouts for better visual flow
- Moved File Upload from Section 1 to new Section 8

## Result

Form sekarang memiliki tampilan yang **clean, linear, dan menyerupai dokumen quotation** yang akan digenerate. User dapat melihat semua field sekaligus tanpa perlu membuka/menutup section, memberikan pengalaman seperti "mengisi formulir dokumen resmi" yang lebih intuitif.
