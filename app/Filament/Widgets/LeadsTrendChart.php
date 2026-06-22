<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadsTrendChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Leads Masuk (6 Bulan Terakhir)';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn (int $i) => now()->subMonths($i));

        $counts = $months->map(
            fn ($month) => Lead::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count()
        );

        return [
            'datasets' => [
                [
                    'label' => 'Leads Baru',
                    'data' => $counts->values()->all(),
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $months->map(fn ($month) => $month->translatedFormat('M Y'))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
