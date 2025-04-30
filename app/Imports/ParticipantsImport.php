<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccess;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    protected $programTitle;
    protected $buktiPembayaranPath;

    public function __construct($programTitle, $buktiPembayaranPath)
    {
        $this->programTitle = $programTitle;
        $this->buktiPembayaranPath = $buktiPembayaranPath;
    }

    public function model(array $row)
    {
        // Simpan data peserta
        $participant = Participant::create([
            'program_title' => $this->programTitle,
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'nip' => $row['nip'],
            'dinas' => $row['dinas'],
            'jabatan' => $row['jabatan'],
            'pemda' => $row['pemda'],
            'alamat' => $row['alamat'],
            'telepon' => $row['telepon'],
            'email' => $row['email'],
            'bukti_pembayaran' => $this->buktiPembayaranPath,
            // 'qrcode_path' => $qrCodeFileName, // Simpan path QR Code ke database
            'registration_type' => 'kelompok',
            'approved'            => false,
        ]);

        // // Kirim email ke peserta
        // Mail::to($participant->email)->send(new RegistrationSuccess($participant));
        return $participant;
    }
}