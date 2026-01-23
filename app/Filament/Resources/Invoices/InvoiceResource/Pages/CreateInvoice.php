<?php

namespace App\Filament\Resources\Invoices\InvoiceResource\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use App\Services\InvoicePdfService;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function afterCreate(): void
    {
        // Auto-generate PDF after creating invoice
        InvoicePdfService::generate($this->record);
    }
}
