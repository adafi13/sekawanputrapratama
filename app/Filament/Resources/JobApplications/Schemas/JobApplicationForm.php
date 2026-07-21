<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pelamar Pekerjaan')
                    ->schema([
                        Select::make('job_opening_id')
                            ->label('Posisi Pekerjaan')
                            ->relationship('jobOpening', 'title')
                            ->required(),
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email Pelamar')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Nomor WhatsApp / HP')
                            ->required(),
                        TextInput::make('portfolio_link')
                            ->label('Link Portofolio (Opsional)'),
                        Select::make('status')
                            ->label('Status Seleksi')
                            ->options([
                                'pending' => 'Pending (Menunggu Review)',
                                'reviewed' => 'Review HR',
                                'interviewed' => 'Wawancara (Interview)',
                                'accepted' => 'Diterima (Hired)',
                                'rejected' => 'Ditolak',
                            ])
                            ->default('pending')
                            ->required(),
                    ])->columns(2),

                Section::make('Dokumen CV / Resume & Cover Letter')
                    ->schema([
                        FileUpload::make('resume_path')
                            ->label('Berkas Resume / CV (PDF)')
                            ->disk('public')
                            ->directory('resumes')
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                        Textarea::make('cover_letter')
                            ->label('Surat Lamaran (Cover Letter)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
