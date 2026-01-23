# Lead Workflow Changes - Quotation Sent Status

## Overview
Modified the lead workflow to enforce logical data integrity: leads can only reach "Quotation Sent" status by creating an actual quotation record.

## Changes Made

### 1. Lead Model (app/Models/Lead.php)

#### getNextStatus() Method
- **Before**: Contacted → Quotation Sent → Negotiation
- **After**: Contacted → Negotiation (skips quotation_sent)
- **Reason**: Forces users to create actual quotation via button

```php
// Line 93
self::STATUS_CONTACTED => self::STATUS_NEGOTIATION, // SKIPS quotation_sent
```

#### getPreviousStatus() Method
- **Before**: Negotiation → Quotation Sent → Contacted
- **After**: Negotiation → Contacted (skips quotation_sent)
- **Reason**: Maintains consistency with forward movement

```php
// Line 111
self::STATUS_NEGOTIATION => self::STATUS_CONTACTED, // Skip quotation_sent
```

### 2. LeadResource (app/Filament/Resources/Leads/LeadResource.php)

#### getAdvanceStageForm() Method
- **Removed**: Quotation Details form field
- **Reason**: No longer needed since manual advancement skips quotation_sent

#### next_stage Action
- **Removed**: quotation_notes and quotation_sent_at handling
- **Reason**: This data is now set automatically when creating quotation

## New Workflow

### Manual Status Advancement (Next Stage Button)
```
New → Qualified → Contacted → Negotiation → Deal
                            ↑
                   (skips quotation_sent)
```

### Create Quotation Button
```
Contacted → [Click "Create Quotation"] → Creates Quotation → Auto-updates to "Quotation Sent"
```

### Backward Movement (Previous Stage Button)
```
Deal → Negotiation → Contacted → Qualified → New
                   ↑
         (skips quotation_sent)
```

## Benefits

1. **Data Integrity**: Every "Quotation Sent" status has a corresponding quotation record
2. **Audit Trail**: Proper tracking of when quotations were actually created
3. **Workflow Logic**: Users must follow proper business process
4. **No Fake Status**: Prevents marking leads as "Quotation Sent" without actual quotation

## User Experience

### To Advance to Quotation Sent:
1. Lead must be at "Contacted" status
2. Click "Create Quotation" button (orange briefcase icon)
3. Fill quotation form with lead data pre-populated
4. Submit quotation
5. Status automatically updates to "Quotation Sent"

### To Skip Quotation:
1. Lead at "Contacted" status
2. Click "Next Stage" button
3. Lead advances directly to "Negotiation" status
4. Can create quotation later if needed (status won't change)

## Technical Details

### Auto-Update Logic
Located in: `app/Filament/Resources/Quotations/Pages/CreateQuotation.php`

```php
protected function afterCreate(): void
{
    // ... PDF generation ...
    
    // Update lead status to Quotation Sent
    if ($lead) {
        $lead->update([
            'status' => Lead::STATUS_QUOTATION_SENT,
            'quotation_sent_at' => now(),
            'notes' => ($lead->notes ? $lead->notes . "\n\n" : '') . 
                '[' . now()->format('Y-m-d H:i') . '] Quotation created: ' . 
                $this->record->quotation_number,
        ]);
    }
}
```

### Status Constants
```php
const STATUS_NEW = 'new';
const STATUS_QUALIFIED = 'qualified';
const STATUS_CONTACTED = 'contacted';
const STATUS_QUOTATION_SENT = 'quotation_sent'; // Only via button
const STATUS_NEGOTIATION = 'negotiation';
const STATUS_DEAL = 'deal';
const STATUS_LOST = 'lost';
```

## Testing Checklist

- [ ] Create new lead
- [ ] Advance to "Contacted" status
- [ ] Click "Next Stage" - should go to "Negotiation" (skip quotation_sent)
- [ ] Move back to "Contacted"
- [ ] Click "Create Quotation" - should create quotation and set status to "Quotation Sent"
- [ ] Verify quotation record exists
- [ ] Verify lead notes updated with timestamp
- [ ] Click "View Quotations" - should show the quotation
- [ ] Test backward movement from "Negotiation" - should go to "Contacted"

## Notes

- "Quotation Sent" status is still valid and used in the system
- Existing leads already at "Quotation Sent" are not affected
- Users can still view/filter by "Quotation Sent" status
- The change only affects how leads REACH that status going forward
