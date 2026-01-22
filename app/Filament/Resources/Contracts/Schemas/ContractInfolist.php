<?php

namespace App\Filament\Resources\Contracts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContractInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('contract_number'),
                TextEntry::make('project.name')
                    ->numeric(),
                TextEntry::make('customer.id')
                    ->numeric(),
                TextEntry::make('quotation.id')
                    ->numeric(),
                TextEntry::make('contract_value')
                    ->numeric(),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date(),
                TextEntry::make('file_path'),
                TextEntry::make('status'),
                TextEntry::make('signed_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
