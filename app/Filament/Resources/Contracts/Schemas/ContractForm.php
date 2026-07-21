<?php

namespace App\Filament\Resources\Contracts\Schemas;

use App\Models\Customer;
use App\Models\Project;
use App\Models\Quotation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                    ->label('Nomor Kontrak')
                    ->default(fn () => 'CTR-' . date('Ym') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT))
                    ->required(),
                Select::make('project_id')
                    ->label('Proyek Terkait')
                    ->options(Project::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('customer_id')
                    ->label('Customer / Klien')
                    ->options(Customer::pluck('company_name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('quotation_id')
                    ->label('Quotation (Opsional)')
                    ->options(Quotation::pluck('quotation_number', 'id'))
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('contract_value')
                    ->label('Nilai Kontrak (Rp)')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tanggal Selesai'),
                Textarea::make('terms')
                    ->label('Syarat & Ketentuan')
                    ->columnSpanFull(),
                FileUpload::make('file_path')
                    ->label('Upload Berkas PDF Kontrak / SPK')
                    ->disk('public')
                    ->directory('contracts')
                    ->acceptedFileTypes(['application/pdf'])
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status Kontrak')
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
                DateTimePicker::make('signed_at')
                    ->label('Tanggal Ditandatangani'),
            ]);
    }
}
