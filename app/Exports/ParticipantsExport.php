<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    protected $program;
    protected $participants;

    public function __construct($program = null)
    {
        $this->program = $program;
        $this->participants = $this->collection();
    }

    public function collection()
    {
        $query = Participant::query();

        if ($this->program) {
            $query->where('program_title', $this->program);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jenis Kelamin',
            'Dinas',
            'Jabatan',
            'NIP',
            'Email', 
            'Telepon', 
            'Program', 
            'Tanggal Daftar',
            'QR Code', // Kolom ini akan berisi gambar QR Code
            'Bukti Pembayaran'
        ];
    }

    public function map($participant): array
    {
        return [
            $participant->nama,
            $participant->jenis_kelamin,
            $participant->dinas,
            $participant->jabatan,
            $participant->nip,
            $participant->email,
            $participant->telepon,
            $participant->program_title,
            \Carbon\Carbon::parse($participant->created_at)->format('d-m-Y'),
            '', // Kolom ini kosong karena QR Code akan ditampilkan sebagai gambar
            $participant->bukti_pembayaran ? asset('storage/' . $participant->bukti_pembayaran) : 'Tidak Ada'
        ];
    }

    public function drawings()
    {
        $drawings = [];
        
        foreach ($this->participants as $index => $participant) {
            if ($participant->qrcode_path && file_exists(storage_path('app/public/' . $participant->qrcode_path))) {
                $drawing = new Drawing();
                $drawing->setName('QR Code');
                $drawing->setDescription('QR Code untuk ' . $participant->nama);
                $drawing->setPath(storage_path('app/public/' . $participant->qrcode_path));
                $drawing->setHeight(100); // Sesuaikan ukuran QR Code
                $drawing->setCoordinates('K' . ($index + 2)); // Kolom K, mulai dari baris ke-2
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
