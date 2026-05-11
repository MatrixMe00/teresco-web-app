<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ApplicantionTrendChartWidget extends ChartWidget
{
    protected ?string $heading = 'Application Trend';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        // Use SQLite-compatible date formatting
        $applications = DB::table('applications')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("DATE_FORMAT(created_at, '%Y') as year"), // Added year grouping
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('year', 'month') // Group by both year and month
            ->orderBy('year')       // Order by year first
            ->orderBy('month')
            ->get();

        $labels = $applications->pluck('month')->toArray();
        $data   = $applications->pluck('count')->toArray();
        $years  = $applications->pluck('year')->toArray(); // Get years for potential separate display

        return [
            'datasets' => [
                [
                    'label' => 'Number of Applicants',
                    'data' => $data,
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    // 'fill' => false,
                    // 'tension' => 0.5,
                ],
            ],
            'labels' => $labels,
            'years' => $years, // Optionally include years as a separate data series or context
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
