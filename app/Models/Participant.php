<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /** @use HasFactory<\Database\Factories\ParticipantFactory> */
    use HasFactory;
    protected $fillable = [
        'program_title','nama', 'jenis_kelamin', 'nip', 'dinas', 'jabatan',
        'pemda', 'alamat', 'telepon', 'email', 'bukti_pembayaran', 
        'qrcode_path', 'certificate', 'material'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_title', 'title');
    }
}
