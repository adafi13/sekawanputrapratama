<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Schema;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!Schema::hasColumn('customers', 'password') || empty($data['password'])) {
            unset($data['password']);
        }

        if (!Schema::hasColumn('customers', 'is_portal_active')) {
            unset($data['is_portal_active']);
        }

        return $data;
    }
}
