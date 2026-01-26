# 🗄️ Database Structure

Dokumentasi struktur database dan relasi antar tabel.

---

## 📊 Entity Relationship Diagram (ERD)

```
Users ─── Leads ─── Quotations ─── Contracts ─── Projects ─── Invoices
  │         │                                       │
  │         └─────────────────────────────────────┘
  │
  ├─── BlogPosts
  ├─── Portfolios
  └─── ContactMessages
```

---

## 🔐 Users Table

**Table**: `users`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(255) | User full name |
| email | varchar(255) | Unique email |
| email_verified_at | timestamp | Email verification date |
| password | varchar(255) | Hashed password |
| remember_token | varchar(100) | Remember me token |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relations:**
- `hasMany` → Leads (assigned_to)
- `hasMany` → BlogPosts (author_id)
- `hasMany` → Projects (project_manager_id)

---

## 📞 Leads Table

**Table**: `leads`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(255) | Lead name |
| email | varchar(255) | Email address |
| phone | varchar(50) | Phone number |
| company | varchar(255) | Company name |
| position | varchar(100) | Job position |
| source | varchar(50) | Lead source (website, referral, etc) |
| service_interest | varchar(100) | Service type interested |
| budget_range | varchar(50) | Budget estimate |
| status | enum | new_lead, contacted, quotation_sent, negotiation, deal_won, lost |
| priority | enum | low, medium, high |
| assigned_to | bigint | FK to users.id |
| notes | text | Initial notes |
| follow_up_date | date | Next follow up |
| deal_value | decimal(15,2) | Expected/actual deal value |
| lost_reason | text | Reason if lost |
| contacted_at | datetime | First contact date |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `status` (for filtering)
- `assigned_to` (foreign key)
- `email` (unique)

**Relations:**
- `belongsTo` → User (assigned_to)
- `hasMany` → Quotations
- `hasMany` → Contracts

---

## 💰 Quotations Table

**Table**: `quotations`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| quotation_number | varchar(50) | Unique quotation number |
| lead_id | bigint | FK to leads.id |
| quotation_date | date | Date created |
| valid_until | date | Expiry date |
| items | json | Array of quotation items |
| subtotal | decimal(15,2) | Subtotal amount |
| tax_percentage | decimal(5,2) | Tax rate (%) |
| tax_amount | decimal(15,2) | Tax amount |
| discount | decimal(15,2) | Discount amount |
| total | decimal(15,2) | Final total |
| payment_terms | text | Payment conditions |
| notes | text | Additional notes |
| terms_conditions | text | Terms & conditions |
| status | enum | draft, sent, accepted, rejected, expired |
| sent_at | datetime | Email sent date |
| version | int | Revision version |
| parent_id | bigint | FK to quotations.id (for revisions) |
| created_by | bigint | FK to users.id |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structure for `items`:**
```json
[
  {
    "name": "Website Development",
    "description": "Custom website with CMS",
    "quantity": 1,
    "unit_price": 15000000,
    "amount": 15000000
  }
]
```

**Relations:**
- `belongsTo` → Lead
- `belongsTo` → User (created_by)
- `hasOne` → Contract
- `belongsTo` → Quotation (parent_id, for revisions)

---

## 📄 Contracts Table

**Table**: `contracts`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| contract_number | varchar(50) | Unique contract number |
| quotation_id | bigint | FK to quotations.id |
| lead_id | bigint | FK to leads.id |
| contract_date | date | Contract date |
| start_date | date | Project start |
| end_date | date | Project end |
| contract_value | decimal(15,2) | Total value |
| scope_of_work | text | Project scope |
| payment_schedule | json | Payment milestones |
| terms_conditions | text | Contract terms |
| status | enum | draft, sent, signed, active, completed, cancelled |
| signed_date | date | Client signature date |
| signed_by | varchar(255) | Signatory name |
| attachment | varchar(255) | Signed contract file path |
| created_by | bigint | FK to users.id |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structure for `payment_schedule`:**
```json
[
  {
    "milestone": "Down Payment",
    "percentage": 30,
    "amount": 4500000,
    "due_date": "2026-02-01"
  },
  {
    "milestone": "Development Complete",
    "percentage": 50,
    "amount": 7500000,
    "due_date": "2026-03-15"
  },
  {
    "milestone": "Final Delivery",
    "percentage": 20,
    "amount": 3000000,
    "due_date": "2026-04-01"
  }
]
```

**Relations:**
- `belongsTo` → Quotation
- `belongsTo` → Lead
- `belongsTo` → User (created_by)
- `hasOne` → Project
- `hasMany` → Invoices

---

## 🎯 Projects Table

**Table**: `projects`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| project_code | varchar(50) | Unique project code |
| name | varchar(255) | Project name |
| contract_id | bigint | FK to contracts.id |
| lead_id | bigint | FK to leads.id (client) |
| description | text | Project description |
| category | varchar(100) | Project type |
| start_date | date | Start date |
| estimated_end_date | date | Target completion |
| actual_end_date | date | Actual completion |
| project_manager_id | bigint | FK to users.id |
| team_members | json | Array of user IDs |
| estimated_budget | decimal(15,2) | Budget estimate |
| actual_cost | decimal(15,2) | Actual cost |
| status | enum | not_started, in_progress, on_hold, review, completed, closed |
| progress_percentage | int | Progress % (0-100) |
| priority | enum | low, medium, high, critical |
| notes | text | Internal notes |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structure for `team_members`:**
```json
[1, 3, 5, 7]  // Array of user IDs
```

**Relations:**
- `belongsTo` → Contract
- `belongsTo` → Lead (client)
- `belongsTo` → User (project_manager_id)
- `belongsToMany` → Users (team_members)
- `hasMany` → Invoices

---

## 🧾 Invoices Table

**Table**: `invoices`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| invoice_number | varchar(50) | Unique invoice number |
| contract_id | bigint | FK to contracts.id |
| project_id | bigint | FK to projects.id |
| lead_id | bigint | FK to leads.id (billing to) |
| invoice_date | date | Invoice date |
| due_date | date | Payment due date |
| items | json | Invoice line items |
| subtotal | decimal(15,2) | Subtotal |
| tax_percentage | decimal(5,2) | Tax rate |
| tax_amount | decimal(15,2) | Tax amount |
| total | decimal(15,2) | Total amount |
| paid_amount | decimal(15,2) | Amount paid |
| balance | decimal(15,2) | Outstanding balance |
| payment_status | enum | unpaid, partial, paid, overdue, cancelled |
| payment_method | varchar(50) | Payment method |
| payment_date | date | Date paid |
| payment_proof | varchar(255) | Receipt file path |
| notes | text | Invoice notes |
| sent_at | datetime | Email sent date |
| created_by | bigint | FK to users.id |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structure for `items`:**
```json
[
  {
    "description": "Website Development - Phase 1",
    "quantity": 1,
    "price": 7500000,
    "amount": 7500000
  },
  {
    "description": "Hosting Setup",
    "quantity": 1,
    "price": 500000,
    "amount": 500000
  }
]
```

**Relations:**
- `belongsTo` → Contract
- `belongsTo` → Project
- `belongsTo` → Lead (client)
- `belongsTo` → User (created_by)

---

## 📝 Blog Posts Table

**Table**: `blog_posts`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| title | varchar(255) | Post title |
| slug | varchar(255) | Unique slug for URL |
| excerpt | text | Short description |
| content | longtext | Full content |
| featured_image | varchar(255) | Image file path |
| category_id | bigint | FK to blog_categories.id |
| author_id | bigint | FK to users.id |
| status | enum | draft, published |
| published_at | datetime | Publish date/time |
| views | int | View count |
| meta_title | varchar(255) | SEO title |
| meta_description | text | SEO description |
| meta_keywords | varchar(255) | SEO keywords |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `slug` (unique)
- `category_id` (foreign key)
- `author_id` (foreign key)
- `status`, `published_at` (for filtering)

**Relations:**
- `belongsTo` → BlogCategory
- `belongsTo` → User (author)

---

## 🏷️ Blog Categories Table

**Table**: `blog_categories`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(100) | Category name |
| slug | varchar(100) | Unique slug |
| description | text | Category description |
| order | int | Display order |
| active | boolean | Active status |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**Relations:**
- `hasMany` → BlogPosts

---

## 💼 Portfolios Table

**Table**: `portfolios`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| title | varchar(255) | Project title |
| slug | varchar(255) | Unique slug |
| short_description | text | Brief description |
| description | text | Full description |
| content | longtext | Detailed content |
| featured_image | varchar(255) | Main image path |
| images | json | Array of gallery images |
| challenge | text | Project challenge |
| solution | text | Solution provided |
| results | text | Project results |
| metrics | json | Key metrics (label, value pairs) |
| category_id | bigint | FK to portfolio_categories.id |
| service_id | bigint | FK to services.id |
| client_name | varchar(255) | Client name (optional) |
| client_industry | varchar(100) | Client industry |
| project_date | date | Project completion date |
| project_duration | varchar(50) | Duration (e.g., "3 months") |
| project_url | varchar(255) | Live project URL |
| technologies | json | Array of tech stack |
| is_featured | boolean | Featured project flag |
| order | int | Display order |
| meta_title | varchar(255) | SEO title |
| meta_description | text | SEO description |
| meta_keywords | varchar(255) | SEO keywords |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structures:**

`images`:
```json
[
  "portfolios/1/gallery/image1.webp",
  "portfolios/1/gallery/image2.webp"
]
```

`metrics`:
```json
[
  {"label": "Performance Increase", "value": "150%"},
  {"label": "User Engagement", "value": "+85%"},
  {"label": "Load Time", "value": "0.8s"}
]
```

`technologies`:
```json
["Laravel", "Vue.js", "MySQL", "Redis", "AWS"]
```

**Relations:**
- `belongsTo` → PortfolioCategory
- `belongsTo` → Service

---

## 📁 Portfolio Categories Table

**Table**: `portfolio_categories`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(100) | Category name |
| slug | varchar(100) | Unique slug |
| description | text | Description |
| icon | varchar(100) | Icon class/path |
| order | int | Display order |
| active | boolean | Active status |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**Relations:**
- `hasMany` → Portfolios

---

## 🛠️ Services Table

**Table**: `services`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(255) | Service name |
| slug | varchar(255) | Unique slug |
| icon | varchar(100) | Icon class/path |
| short_description | text | Brief description |
| description | longtext | Full description |
| features | json | Array of features |
| price_range | varchar(100) | Price indication (optional) |
| order | int | Display order |
| active | boolean | Active status |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structure for `features`:**
```json
[
  "Responsive Design",
  "SEO Optimized",
  "Content Management System",
  "E-commerce Integration"
]
```

**Relations:**
- `hasMany` → Portfolios
- `hasMany` → Leads (service_interest)

---

## 👥 Team Members Table

**Table**: `team_members`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(255) | Member name |
| position | varchar(100) | Job position |
| photo | varchar(255) | Photo file path |
| bio | text | Biography |
| email | varchar(255) | Contact email |
| phone | varchar(50) | Contact phone |
| social_links | json | Social media URLs |
| order | int | Display order |
| active | boolean | Active status |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**JSON Structure for `social_links`:**
```json
{
  "linkedin": "https://linkedin.com/in/username",
  "twitter": "https://twitter.com/username",
  "github": "https://github.com/username"
}
```

---

## ⭐ Testimonials Table

**Table**: `testimonials`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| client_name | varchar(255) | Client name |
| company | varchar(255) | Company name |
| position | varchar(100) | Job position |
| testimonial | text | Testimonial content |
| rating | int | Rating (1-5) |
| photo | varchar(255) | Photo file path (optional) |
| project_id | bigint | FK to portfolios.id (optional) |
| order | int | Display order |
| active | boolean | Active status |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**Relations:**
- `belongsTo` → Portfolio (optional)

---

## ❓ FAQs Table

**Table**: `faqs`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| question | varchar(500) | Question text |
| answer | text | Answer text |
| category | varchar(100) | Category (optional) |
| order | int | Display order |
| active | boolean | Active status |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

---

## 📧 Contact Messages Table

**Table**: `contact_messages`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| name | varchar(255) | Sender name |
| email | varchar(255) | Sender email |
| phone | varchar(50) | Sender phone |
| service_interest | varchar(100) | Service interested in |
| message | text | Message content |
| status | enum | new, in_progress, resolved |
| ip_address | varchar(45) | Sender IP |
| user_agent | text | Browser info |
| replied_at | datetime | Reply timestamp |
| replied_by | bigint | FK to users.id |
| created_at | timestamp | |
| updated_at | timestamp | |
| deleted_at | timestamp | Soft delete |

**Relations:**
- `belongsTo` → User (replied_by)

---

## ⚙️ Settings Table

**Table**: `settings`

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary Key |
| key | varchar(100) | Setting key (unique) |
| value | text | Setting value |
| type | varchar(50) | Data type (string, json, boolean) |
| group | varchar(50) | Settings group |
| created_at | timestamp | |
| updated_at | timestamp | |

**Common Settings:**
- `site_name`: Company name
- `site_tagline`: Tagline
- `contact_email`: Contact email
- `contact_phone`: Contact phone
- `address`: Office address
- `social_media`: JSON with social links
- `google_analytics`: GA tracking ID
- `smtp_config`: JSON with SMTP settings

---

## 🔍 Indexes & Performance

### Recommended Indexes:
- **leads**: `(status, assigned_to)`, `(email)`
- **quotations**: `(quotation_number)`, `(lead_id, status)`
- **contracts**: `(contract_number)`, `(status)`
- **projects**: `(project_code)`, `(status, project_manager_id)`
- **invoices**: `(invoice_number)`, `(payment_status, due_date)`
- **blog_posts**: `(slug)`, `(status, published_at)`
- **portfolios**: `(slug)`, `(is_featured, order)`

### Foreign Key Constraints:
- All FK columns have `onDelete('cascade')` or `onDelete('nullOnDelete')`
- Referential integrity enforced

---

**Last Updated**: January 26, 2026  
**Version**: 1.0
