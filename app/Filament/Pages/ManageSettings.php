<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageSettings extends Page
{
    protected string $view = 'filament.pages.manage-settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

    public static function getNavigationLabel(): string
    {
        return 'Pengaturan Situs';
    }

    public function getTitle(): string
    {
        return 'Pengaturan Situs';
    }

    /**
     * @var array<string, mixed>
     */
    public ?array $data = [];

    /**
     * Settings whose value should be saved as a textarea/long text.
     */
    protected static array $textareaFields = [
        'site.description',
        'banner.home_description',
        'footer.description',
    ];

    public function mount(): void
    {
        $data = [];

        foreach (Setting::all() as $setting) {
            [$group, $field] = array_pad(explode('.', $setting->key, 2), 2, 'value');
            $data[$group][$field] = $setting->value;
        }

        $this->form->fill($data);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->tabs([
                        Tab::make('Profil Situs')
                            ->schema([
                                TextInput::make('site.company_name')->label('Nama Perusahaan'),
                                TextInput::make('site.tagline')->label('Tagline'),
                                Textarea::make('site.description')->label('Deskripsi Perusahaan')->rows(3)->columnSpanFull(),
                            ]),
                        Tab::make('Kontak')
                            ->schema([
                                TextInput::make('contact.phone')->label('Nomor Telepon Utama'),
                                TextInput::make('contact.email')->label('Email Utama')->email(),
                                TextInput::make('contact.hr_phone')->label('Nomor WA / HP Rekrutmen (HRD)')->placeholder('085156412702'),
                                TextInput::make('contact.hr_email')->label('Email Rekrutmen (HRD)')->email()->placeholder('hr@sekawanputrapratama.com'),
                                TextInput::make('contact.address')->label('Alamat')->columnSpanFull(),
                                TextInput::make('contact.office_hours')->label('Jam Operasional'),
                            ]),
                        Tab::make('Media Sosial')
                            ->schema([
                                TextInput::make('social.whatsapp_url')->label('Link WhatsApp')->url(),
                                TextInput::make('social.instagram_url')->label('Link Instagram')->url(),
                                TextInput::make('social.linkedin_url')->label('Link LinkedIn')->url(),
                                TextInput::make('social.facebook_url')->label('Link Facebook')->url(),
                                TextInput::make('social.twitter_handle')->label('Twitter Handle'),
                            ]),
                        Tab::make('Banner Homepage')
                            ->schema([
                                TextInput::make('banner.home_title')->label('Judul Banner')->columnSpanFull(),
                                TextInput::make('banner.home_subtitle')->label('Subtitle Banner')->columnSpanFull(),
                                Textarea::make('banner.home_description')->label('Deskripsi Banner')->rows(3)->columnSpanFull(),
                            ]),
                        Tab::make('Statistik')
                            ->schema([
                                TextInput::make('stats.projects_completed')->label('Jumlah Proyek Selesai')->placeholder('50+'),
                                TextInput::make('stats.happy_clients')->label('Jumlah Klien Puas')->placeholder('20+'),
                                TextInput::make('stats.years_experience')->label('Tahun Pengalaman')->placeholder('5+'),
                            ]),
                        Tab::make('Footer')
                            ->schema([
                                Textarea::make('footer.description')->label('Deskripsi Footer')->rows(3)->columnSpanFull(),
                            ]),
                        Tab::make('Rekening Pembayaran')
                            ->schema([
                                TextInput::make('bank.bca_name')->label('Nama Bank 1 (Utama)')->default('Bank Central Asia (BCA)'),
                                TextInput::make('bank.bca_account')->label('Nomor Rekening Bank 1'),
                                TextInput::make('bank.bca_holder')->label('Atas Nama (A.N.) Bank 1')->default('PT Sekawan Putra Pratama'),
                                TextInput::make('bank.mandiri_name')->label('Nama Bank 2 (Opsional)'),
                                TextInput::make('bank.mandiri_account')->label('Nomor Rekening Bank 2 (Opsional)'),
                                TextInput::make('bank.mandiri_holder')->label('Atas Nama (A.N.) Bank 2 (Opsional)'),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $group => $fields) {
            foreach ($fields as $field => $value) {
                $key = "{$group}.{$field}";

                Setting::set(
                    key: $key,
                    value: $value,
                    type: in_array($key, static::$textareaFields, true) ? 'textarea' : 'text',
                    group: $group,
                );
            }
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
