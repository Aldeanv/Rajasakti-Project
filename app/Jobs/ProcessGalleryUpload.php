<?php

namespace App\Jobs;

use App\Models\Gallery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Log;

class ProcessGalleryUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $imagePath;

    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function handle()
    {
        try {
            // Simpan data ke database
            Gallery::create(['image' => basename($this->imagePath)]);
        } catch (Exception $e) {
            Log::error("Gagal memproses gambar: " . $e->getMessage());
        }
    }
}
