<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\NewsletterSubscriber;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BusinessStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $activeLeads = Lead::whereNotIn('status', [Lead::STATUS_DEAL, Lead::STATUS_LOST])->count();

        $activeProjects = Project::whereNotIn('status', [
            Project::STATUS_COMPLETED,
            Project::STATUS_CANCELLED,
            Project::STATUS_ON_HOLD,
        ])->count();

        $revenueThisMonth = Invoice::where('status', Invoice::STATUS_PAID)
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        $unpaidInvoices = Invoice::whereIn('status', [
            Invoice::STATUS_PENDING,
            Invoice::STATUS_SENT,
            Invoice::STATUS_OVERDUE,
        ]);
        $unpaidCount = $unpaidInvoices->count();
        $unpaidTotal = $unpaidInvoices->sum('amount');

        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $activeSubscribers = NewsletterSubscriber::where('is_active', true)->count();

        return [
            Stat::make('Leads Aktif', $activeLeads)
                ->description('Belum deal atau lost')
                ->icon('heroicon-o-user-group')
                ->color('info'),

            Stat::make('Proyek Berjalan', $activeProjects)
                ->description('Sedang dikerjakan')
                ->icon('heroicon-o-briefcase')
                ->color('warning'),

            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format((float) $revenueThisMonth, 0, ',', '.'))
                ->description('Invoice lunas bulan ' . now()->translatedFormat('F Y'))
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Invoice Belum Lunas', $unpaidCount)
                ->description('Rp ' . number_format((float) $unpaidTotal, 0, ',', '.') . ' tertunggak')
                ->icon('heroicon-o-exclamation-triangle')
                ->color($unpaidCount > 0 ? 'danger' : 'success'),

            Stat::make('Pesan Belum Dibaca', $unreadMessages)
                ->description('Dari form kontak')
                ->icon('heroicon-o-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'success'),

            Stat::make('Newsletter Subscriber', $activeSubscribers)
                ->description('Subscriber aktif')
                ->icon('heroicon-o-at-symbol')
                ->color('gray'),
        ];
    }
}
