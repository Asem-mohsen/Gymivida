<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductFeaturesChart extends ChartWidget
{
    protected static ?string $heading = 'Products and Their Features';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $products = Product::withCount('features')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Number of Features',
                    'data' => $products->pluck('features_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.5)',
                        'rgba(16, 185, 129, 0.5)',
                        'rgba(245, 158, 11, 0.5)',
                        'rgba(239, 68, 68, 0.5)',
                        'rgba(139, 92, 246, 0.5)',
                    ],
                    'borderColor' => [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(139, 92, 246, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $products->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }
}
