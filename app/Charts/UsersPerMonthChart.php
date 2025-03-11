<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Carbon\Carbon;

class UsersPerMonthChart
{
    public function build()
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->translatedFormat('M');
        });

        $userCounts = collect(range(1, 12))->map(function ($month) {
            return User::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->count();
        });

        return (new LarapexChart)->lineChart()
            ->setTitle('Jumlah User per Bulan')
            ->setXAxis($months->toArray())
            ->setDataset([
                [
                    'name' => 'Users',
                    'data' => $userCounts->toArray()
                ]
            ])
            ->setColors(['#36a2eb']) // Warna garis
            ->setHeight(400)
            ->setGrid(true); // Mengaktifkan grid
    }
}
