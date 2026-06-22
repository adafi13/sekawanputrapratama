<?php

namespace App\Filament\Resources\NewsletterSubscribers\Pages;

use App\Filament\Resources\NewsletterSubscribers\NewsletterSubscriberResource;
use App\Models\NewsletterSubscriber;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->action(function () {
                    return new StreamedResponse(function () {
                        $handle = fopen('php://output', 'w');
                        fputcsv($handle, ['Email', 'Status', 'Tanggal Subscribe']);

                        NewsletterSubscriber::where('is_active', true)
                            ->orderBy('created_at')
                            ->each(function (NewsletterSubscriber $subscriber) use ($handle) {
                                fputcsv($handle, [
                                    $subscriber->email,
                                    $subscriber->is_active ? 'Aktif' : 'Nonaktif',
                                    $subscriber->created_at?->format('Y-m-d H:i'),
                                ]);
                            });

                        fclose($handle);
                    }, 200, [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="newsletter-subscribers-' . now()->format('Y-m-d') . '.csv"',
                    ]);
                }),
            CreateAction::make(),
        ];
    }
}
