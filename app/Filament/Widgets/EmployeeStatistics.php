<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeStatistics extends ChartWidget
{
    protected static ?string $heading = 'Statistik Karyawan';
    protected static ?string $description = 'Jumlah karyawan dalam 6 bulan terakhir';

    protected function getData(): array
    {
        // Ambil jumlah karyawan dalam 6 bulan terakhir
        $months = collect(range(5, 0))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('F');
        });

        $employeeCounts = $months->map(function ($month) {
            return Employee::whereMonth('created_at', Carbon::parse($month)->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        });

        return [
            'labels' => $months->toArray(),
            'datasets' => [
                [
                    'label' => 'Jumlah Karyawan',
                    'data' => $employeeCounts->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
