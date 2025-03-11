<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Participant;

class ParticipantsPerProgramChart
{
    public function build()
    {
        $programs = Participant::selectRaw('program_title, COUNT(*) as total')
        ->groupBy('program_title')
        ->pluck('total', 'program_title');
    
    return (new LarapexChart)->lineChart()
        ->setTitle('Jumlah Peserta Per Program')
        ->setXAxis($programs->keys()->toArray()) // X-Axis berdasarkan program
        ->setDataset([
            [
                'name' => 'Jumlah Peserta',
                'data' => $programs->values()->toArray()
            ]
        ])
        ->setColors(['#36a2eb']) // Warna garis
        ->setHeight(400)
        ->setGrid(true); // Mengaktifkan grid
    
    }
}
