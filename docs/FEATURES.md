# 🎯 Fitur-Fitur Aplikasi

Dokumentasi lengkap semua fitur yang tersedia di Sekawan Putra Pratama Website & CRM.

---

## 🌐 FRONTEND (Public Website)

### 1. Homepage
**URL**: `http://127.0.0.1:8000/`

**Sections:**
- Hero Banner dengan CTA
- About Company
- Services Overview (Cards)
- Featured Portfolio Projects
- Client Testimonials
- Team Members
- Latest Blog Articles
- Contact Information

**Fitur:**
- Responsive design (Mobile, Tablet, Desktop)
- Smooth scroll animations
- Modern UI dengan gradients

---

### 2. Services Page
**URL**: `/services`

**Fitur:**
- List semua layanan perusahaan
- Deskripsi lengkap per layanan
- Icon/gambar untuk setiap service
- CTA untuk request quotation
- SEO optimized

**Services:**
- Website Development
- Mobile App Development
- UI/UX Design
- Digital Marketing
- IT Consulting
- Infrastructure Setup

---

### 3. Portfolio Page
**URL**: `/portfolio`

**Fitur:**
- Grid layout portfolio projects
- Filter by category (Website, App, Infrastructure)
- Featured projects highlight
- Project thumbnail images
- Client name & year
- Click untuk detail

**Categories:**
- Website Development
- Mobile Applications
- Infrastructure Projects
- Design Projects

---

### 4. Portfolio Detail
**URL**: `/portfolio/{slug}`

**Informasi:**
- Project title & description
- Featured image & gallery
- Client information
- Project duration
- Technologies used
- Challenge, Solution, Results
- Key metrics
- Related projects

---

### 5. Blog Page
**URL**: `/blog`

**Fitur:**
- List semua artikel
- Filter by category
- Featured article highlight
- Horizontal list layout (news portal style)
- Author info, date, views
- Excerpt/preview
- Pagination

**Categories:**
- Technology
- Business
- Tutorial
- Company News

---

### 6. Blog Detail
**URL**: `/blog/{slug}`

**Content:**
- Full article content
- Featured image
- Author & publish date
- Category tags
- Share buttons
- Related articles
- Comments (optional)

---

### 7. About Page
**URL**: `/about`

**Sections:**
- Company history
- Mission & Vision
- Core values
- Team members dengan foto
- Company milestones
- Certifications

---

### 8. Contact Page
**URL**: `/contact`

**Fitur:**
- Contact form dengan validasi:
  - Name (required)
  - Email (required, valid format)
  - Phone (required)
  - Service Interest (dropdown)
  - Message (required)
- Company contact info
- Office address dengan Google Maps embed
- Social media links
- Business hours

**Form Submission:**
- Data tersimpan di database
- Email notification ke admin
- Success message ke user

---

## 🎛️ ADMIN PANEL (Filament)

**URL**: `http://127.0.0.1:8000/admin`

### Dashboard
- Welcome message
- Quick stats (Leads, Projects, Invoices)
- Recent activities
- Upcoming tasks/deadlines

---

## 📊 CRM MODULES

### 1. Leads Management

**List View:**
- Table dengan columns: Name, Company, Email, Status, Assigned To, Created Date
- Bulk actions (Delete, Export)
- Filters (Status, Assigned User, Date Range)
- Search (Name, Email, Company)
- Export to Excel

**Create/Edit Form:**
- Personal Information
  - Name (required)
  - Email (required, unique)
  - Phone (required)
  - Company Name
  - Position
- Lead Details
  - Source (Dropdown)
  - Service Interest (Select)
  - Budget Range (Select)
  - Status (Auto: New Lead)
  - Priority (High, Medium, Low)
- Notes & Follow-up
  - Initial Notes
  - Assigned To (User select)
  - Follow-up Date

**Kanban Board:**
- Drag & drop cards between status columns
- Visual workflow dari New → Deal Won/Lost
- Advance stage button dengan modal forms
- Card info: Contact, Deal Value, Assigned User

**Actions:**
- Advance Stage (dengan verification gates)
- Create Quotation
- Mark as Lost (dengan reason)
- Send Email
- Schedule Follow-up

---

### 2. Quotations Management

**Features:**
- Generate quotation dari Lead
- Dynamic items table (add/remove rows)
- Auto calculation (subtotal, tax, total)
- Version control (revisions)
- PDF generation
- Email quotation ke client

**Form Fields:**
- Client Info (auto-fill dari Lead)
- Quotation Date & Valid Until
- Items Table:
  - Service/Product Name
  - Description
  - Quantity
  - Unit Price
  - Amount (calculated)
- Subtotal
- Tax (%)
- Discount (optional)
- Total
- Payment Terms
- Notes & Terms

**Actions:**
- Send via Email
- Download PDF
- Create Revision
- Convert to Contract
- Mark as Expired

---

### 3. Contracts Management

**Features:**
- Generate dari accepted quotation
- Contract templates
- Digital signature support
- File attachment (signed contract scan)
- Status tracking

**Form Fields:**
- Contract Number (auto-generated)
- Client (linked)
- Project Scope (from quotation)
- Contract Value
- Start Date & End Date
- Payment Schedule
- Terms & Conditions
- Status (Draft, Sent, Signed, Active)
- Signed Date
- Attachments (PDF scans)

**Actions:**
- Send for Signature
- Upload Signed Contract
- Create Project
- Generate Invoice
- Terminate Contract

---

### 4. Projects Management

**Features:**
- Project tracking dari initiation hingga completion
- Task management
- Team assignment
- File storage
- Progress tracking
- Timeline view

**Form Fields:**
- Project Details
  - Name & Code (auto-generated)
  - Client (linked to contract)
  - Description
  - Category (Web, App, Infrastructure)
- Schedule
  - Start Date
  - Estimated End Date
  - Actual End Date
- Team
  - Project Manager (required)
  - Team Members (multi-select)
- Budget
  - Estimated Budget
  - Actual Cost
- Status (Not Started, In Progress, Review, Completed)

**Project Tabs:**
1. **Overview**: Basic info, timeline, budget
2. **Tasks**: Task list dengan status
3. **Team**: Members dan roles
4. **Files**: Document attachments
5. **Notes**: Internal notes
6. **Activity**: Audit log

**Actions:**
- Update Status
- Add Task
- Upload Files
- Add Team Member
- Mark as Completed

---

### 5. Invoices Management

**Features:**
- Generate dari project/contract
- Auto invoice numbering
- Payment tracking
- Overdue alerts
- PDF generation
- Email sending

**Form Fields:**
- Invoice Number (auto)
- Client (linked)
- Project/Contract Reference
- Invoice Date & Due Date
- Items:
  - Description
  - Quantity
  - Price
  - Amount
- Subtotal
- Tax
- Total
- Payment Status (Unpaid, Partial, Paid)
- Paid Amount
- Balance

**Actions:**
- Send Invoice
- Record Payment
- Download PDF
- Send Reminder
- Mark as Paid

---

## 📝 CONTENT MANAGEMENT

### 1. Blog Posts

**Features:**
- Rich text editor (WYSIWYG)
- Featured image upload (auto WebP conversion)
- Category tagging
- SEO fields (title, description, keywords)
- Publish scheduling
- Draft/Published status

**Form Fields:**
- Title (required)
- Slug (auto-generated)
- Content (rich editor)
- Featured Image (WebP, max 1920px)
- Category (select)
- Excerpt (for preview)
- Author (current user)
- Status (Draft, Published)
- Published Date
- SEO Meta Fields

---

### 2. Portfolio

**Features:**
- Case study format
- Featured image + gallery (multiple images)
- Category & technology tags
- Client info (optional)
- Key metrics display

**Form Fields:**
- Basic Info
  - Title & Slug
  - Short Description
  - Full Content (rich editor)
  - Category (select)
- Images
  - Featured Image (WebP)
  - Gallery Images (multiple, WebP)
- Case Study
  - Challenge (textarea)
  - Solution (textarea)
  - Results (textarea)
  - Metrics (repeater: label, value)
- Client Info
  - Client Name
  - Client Industry
  - Project Date & Duration
  - Project URL
- Technical
  - Technologies Used (tags)
  - Service Type (select)
- Settings
  - Featured (checkbox)
  - Display Order
  - SEO Fields

---

### 3. Services

**Form Fields:**
- Service Name
- Slug
- Icon (upload/select)
- Short Description
- Full Description (rich editor)
- Features List (repeater)
- Price Range (optional)
- Display Order
- Active Status

---

### 4. Team Members

**Form Fields:**
- Name
- Position/Role
- Photo (upload)
- Bio
- Email & Phone
- Social Media Links (LinkedIn, Twitter, etc)
- Display Order
- Active Status

---

### 5. Testimonials

**Form Fields:**
- Client Name
- Company
- Position
- Testimonial Text
- Rating (1-5 stars)
- Photo (optional)
- Project Reference (select)
- Display Order
- Active Status

---

### 6. FAQs

**Form Fields:**
- Question
- Answer (rich editor)
- Category (optional)
- Display Order
- Active Status

---

## 📧 CONTACT MESSAGES

**Features:**
- View all contact form submissions
- Mark as read/unread
- Reply directly
- Export to Excel
- Archive old messages

**Information:**
- Sender name, email, phone
- Service interest
- Message content
- Submitted date
- IP address
- Status (New, In Progress, Resolved)

---

## ⚙️ SETTINGS

### General Settings
- Site Name & Tagline
- Contact Information
- Social Media Links
- Business Hours
- Company Logo
- Favicon

### Email Settings
- SMTP Configuration
- Email Templates
- Notification Settings

### SEO Settings
- Default Meta Title
- Default Meta Description
- Google Analytics ID
- Facebook Pixel

---

## 👥 USER MANAGEMENT

**Features:**
- Create/edit users
- Role-based permissions
- Activity log tracking

**User Fields:**
- Name & Email
- Password (hashed)
- Role (Admin, Sales, Project Manager, Finance)
- Active Status
- Last Login

**Roles & Permissions:**
- **Super Admin**: Full access
- **Admin**: Manage content & CRM
- **Sales**: Leads, Quotations, Contracts
- **Project Manager**: Projects, Tasks
- **Finance**: Invoices, Payments
- **Content Editor**: Blog, Portfolio (read-only CRM)

---

**Last Updated**: January 26, 2026  
**Version**: 1.0
