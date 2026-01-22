<?php

namespace App\Filament\Resources\Contracts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('contract_number')
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'id')
                    ->required(),
                Select::make('quotation_id')
                    ->relationship('quotation', 'id'),
                TextInput::make('contract_value')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                Textarea::make('terms')
                    ->columnSpanFull(),
                TextInput::make('file_path'),
                Select::make('status')
                    ->options([
            'draft' => 'Draft',
            'sent' => 'Sent',
            'signed' => 'Signed',
            'active' => 'Active',
            'completed' => 'Completed',
            'terminated' => 'Terminated',
        ])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('signed_at'),
            ]);
    }
}
