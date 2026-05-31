# Pharmacy Management — Drupal 10 Custom Module

A complete pharmacy management system for Drupal 10 with two custom content entities, full CRUD operations, alert systems, and permission-based access control.

---

## Features

### Custom Entities
- **Drug Entity** — Full inventory management with stock tracking, expiry monitoring, pricing, and categorization
- **Billing Entity** — Complete billing/invoicing system linked to drugs with auto-calculation of totals

### CRUD Operations
Each entity has:
- **Create** — Add new records via structured forms
- **Read** — List view and detail view
- **Update** — Edit forms with validation
- **Delete** — Confirmation-protected deletion

### Alert System
- **Low Stock Alert** — Triggered when drug quantity ≤ configurable threshold
  - Visual highlight on list pages (purple row tint)
  - Warning on save/edit
  - Dashboard badge and panel
  - Dedicated Alerts page
- **Expiration Alert** — 30-day expiration warning + hard expired flag
  - Visual highlight on list pages (red/yellow row tint)
  - Alert banners on entity forms
  - Dashboard summary
  - Dedicated Alerts page
- **Cron Integration** — Automatic checks via `hook_cron()`

### Permissions
| Permission | Description |
|-----------|-------------|
| `administer pharmacy` | Full admin access |
| `view drug entities` | Read drug records |
| `create drug entities` | Add new drugs |
| `edit drug entities` | Modify drugs |
| `delete drug entities` | Remove drugs |
| `view billing entities` | Read billing |
| `create billing entities` | Add billing |
| `edit billing entities` | Modify billing |
| `delete billing entities` | Remove billing |
| `view pharmacy alerts` | See alerts page |
| `view pharmacy dashboard` | See dashboard |

### Additional Features
- Auto-generated invoice numbers (`INV-YYYYMMDD-XXXXX`)
- Auto-deduction of stock when billing is created
- Live total calculation preview in billing forms (JS)
- Expiry date visual warning on drug forms (JS)
- Drug category, dosage form, storage conditions all use `list_string` fields

---

## Installation

1. Copy the `pharmacy_management/` folder to `modules/custom/`
2. Enable the module:
   ```bash
   drush en pharmacy_management
   drush cr
   ```
3. Assign permissions at `/admin/people/permissions`

---

## Module Structure

```
pharmacy_management/
├── pharmacy_management.info.yml        # Module metadata
├── pharmacy_management.module          # Hooks (theme, cron, page_attachments)
├── pharmacy_management.install         # Schema definitions
├── pharmacy_management.routing.yml     # Route definitions
├── pharmacy_management.permissions.yml # Permission definitions
├── pharmacy_management.links.menu.yml  # Admin menu links
├── pharmacy_management.links.action.yml # "Add" action buttons
├── pharmacy_management.libraries.yml   # CSS/JS library
├── css/
│   ├── pharmacy_management.css         # Main styles
│   └── billing_preview.css             # Billing total preview
├── js/
│   └── pharmacy_management.js          # Live billing calculator, expiry highlighter
├── templates/
│   ├── pharmacy-dashboard.html.twig    # Dashboard page
│   ├── drug-entity.html.twig           # Drug detail view
│   └── billing-entity.html.twig        # Billing detail view
└── src/
    ├── Entity/
    │   ├── Drug.php                    # Drug content entity
    │   └── Billing.php                 # Billing content entity
    ├── Access/
    │   ├── DrugAccessControlHandler.php
    │   └── BillingAccessControlHandler.php
    ├── Form/
    │   ├── DrugForm.php                # Drug add/edit form
    │   ├── DrugDeleteForm.php          # Drug delete confirmation
    │   ├── BillingForm.php             # Billing add/edit form
    │   └── BillingDeleteForm.php       # Billing delete confirmation
    ├── Controller/
    │   ├── PharmacyDashboardController.php
    │   ├── PharmacyAlertsController.php
    │   ├── DrugListController.php
    │   ├── DrugViewController.php
    │   ├── BillingListController.php
    │   └── BillingViewController.php
    ├── DrugListBuilder.php             # Drug entity list builder
    └── BillingListBuilder.php          # Billing entity list builder
```

---

## Admin URLs

| URL | Description |
|-----|-------------|
| `/admin/pharmacy` | Dashboard |
| `/admin/pharmacy/drugs` | Drug list |
| `/admin/pharmacy/drugs/add` | Add drug |
| `/admin/pharmacy/drugs/{id}/edit` | Edit drug |
| `/admin/pharmacy/drugs/{id}/delete` | Delete drug |
| `/admin/pharmacy/billing` | Billing list |
| `/admin/pharmacy/billing/add` | New billing |
| `/admin/pharmacy/billing/{id}/edit` | Edit billing |
| `/admin/pharmacy/billing/{id}/delete` | Delete billing |
| `/admin/pharmacy/alerts` | Alerts page |

---

## Drug Entity Fields

| Field | Type | Notes |
|-------|------|-------|
| name | string | Drug brand name (required) |
| generic_name | string | Generic/scientific name |
| batch_number | string | Manufacturing batch |
| manufacturer | string | Drug manufacturer |
| category | list_string | 12 categories |
| dosage_form | list_string | 10 forms (tablet, syrup, etc.) |
| strength | string | e.g. 500mg |
| quantity | integer | Current stock (required) |
| low_stock_threshold | integer | Alert trigger level |
| unit_price | decimal | Price per unit |
| manufacture_date | datetime | |
| expiry_date | datetime | Required, drives alerts |
| storage_conditions | list_string | 6 conditions |
| prescription_required | boolean | |
| description | text_long | Usage, side effects |

## Billing Entity Fields

| Field | Type | Notes |
|-------|------|-------|
| invoice_number | string | Auto-generated |
| patient_name | string | Required |
| patient_contact | string | |
| patient_age | integer | |
| doctor_name | string | Prescribing doctor |
| prescription_number | string | |
| drug | entity_reference | Links to Drug entity |
| quantity_sold | integer | Validated against stock |
| unit_price | decimal | |
| subtotal | decimal | Auto-calculated |
| discount | decimal | |
| tax_rate | decimal | % |
| tax_amount | decimal | Auto-calculated |
| total_amount | decimal | Final total |
| payment_method | list_string | Cash, Card, Insurance, etc. |
| payment_status | list_string | Paid, Pending, Partial, Refunded |
| billing_date | datetime | |
| notes | text_long | |
