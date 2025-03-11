<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class RegistrationSuccess extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $participant;
    public $qrcodePath;
    public $qrcodeBase64;

    /**
     * Create a new message instance.
     */
    public function __construct($participant)
    {
        $this->participant = $participant;

        // Format nama file: Nama_id.png
        $qrcodeFilename = "{$participant->nama}_{$participant->id}.png";
        $qrcodePath = "qrcodes/{$qrcodeFilename}";

        // Data peserta dalam QR Code
        $qrcodeData = json_encode([
            'nama'    => $participant->nama,
            'nip'     => $participant->nip,
            'dinas'   => $participant->dinas,
            'email'   => $participant->email,
            'telepon' => $participant->telepon,
            'program' => $participant->program_title,
        ], JSON_PRETTY_PRINT);

        // Generate QR Code dan simpan sebagai PNG
        $qrcodePng = QrCode::format('png')
                            ->size(300)
                            ->margin(2)
                            ->errorCorrection('H')
                            ->generate($qrcodeData);

        Storage::disk('public')->put($qrcodePath, $qrcodePng);

        // Simpan path QR Code ke database
        $participant->qrcode_path = $qrcodePath;
        $participant->save();

        // Simpan path untuk digunakan di email
        $this->qrcodePath = asset('storage/' . $qrcodePath);

        // Alternatif: Simpan QR Code sebagai Base64 untuk inline image di email
        $this->qrcodeBase64 = 'data:image/png;base64,' . base64_encode($qrcodePng);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftaran Berhasil: ' . $this->participant->program_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.registration_success',
            with: [
                'participant'   => $this->participant,
                'qrcodeUrl'     => $this->qrcodePath,   // Untuk tampilan gambar QR
                'qrcodeBase64'  => $this->qrcodeBase64  // Untuk inline image di email
            ],
        );
    }

    public function build()
    {
        return $this->subject('Pendaftaran Berhasil: ' . $this->participant->program_title)
                    ->view('emails.registration_success')
                    ->with([
                        'participant'   => $this->participant,
                        'qrcodeUrl'     => $this->qrcodePath,
                        'qrcodeBase64'  => $this->qrcodeBase64
                    ])
                    ->attach(storage_path('app/public/' . $this->participant->qrcode_path), [
                        'as'   => 'qrcode.png',
                        'mime' => 'image/png',
                    ]);
    }
}
