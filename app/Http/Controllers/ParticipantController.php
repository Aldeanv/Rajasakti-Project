<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Mail\RegistrationSuccess;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;


class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Participant::query();

        // Pencarian berdasarkan nama atau NIP
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('nip', 'like', "%$search%");
            });
        }
        
        // Ambil daftar program untuk dropdown
        $programs = Participant::select('program_title')->distinct()->pluck('program_title');
        
        
        // Filter berdasarkan program
        if ($request->has('program') && $request->program != '') {
            $query->where('program_title', $request->program);
        }

        $participants = $query->latest()->paginate(10);

        return view('dashboard.participant', compact('participants', 'programs'));
    }


    public function export(Request $request)
    {
        $program = $request->program ?? 'Semua Program';
        $filename = 'Peserta_' . str_replace(' ', '_', $program) . '.xlsx';

        return Excel::download(new ParticipantsExport($request->program), $filename);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Program $program)
    {
        return view('main.form', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $programSlug)
    {
        $program = Program::where('slug', $programSlug)->firstOrFail();

        // Validasi berdasarkan jenis pendaftaran
        if ($request->registration_type === 'perorangan') {
            $request->validate([
                'nama' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'nip' => 'required|string|max:50',
                'dinas' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'pemda' => 'required|string|max:255',
                'alamat' => 'required|string',
                'telepon' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'bukti_pembayaran' => 'required|file|mimes:jpg,png,pdf|max:2048',
            ]);
        } elseif ($request->registration_type === 'kelompok') {
            $request->validate([
                'anggota' => 'required|file|mimes:xls,xlsx',
                'bukti_pembayaran_kelompok' => 'required|file|mimes:jpg,png,pdf|max:2048',
            ]);
        }

        try {
            if ($request->registration_type === 'perorangan') {
                // Cek apakah peserta dengan NIP yang sama sudah terdaftar dalam program ini
                $existingParticipant = Participant::where('program_title', $program->title)
                    ->where('nip', $request->nip)
                    ->first();

                if ($existingParticipant) {
                    return redirect()->back()->with('error', 'Anda sudah terdaftar dalam program ' . $program->title);
                }

                // Simpan bukti pembayaran
                $buktiPembayaranPath = null;
                if ($request->hasFile('bukti_pembayaran')) {
                    $file = $request->file('bukti_pembayaran');

                    // Cek ukuran file
                    if ($file->getSize() > 2048000) { // 2MB dalam byte
                        return redirect()->back()->with('error', 'Ukuran file bukti pembayaran tidak boleh lebih dari 2MB.');
                    }

                    $buktiPembayaranPath = $file->store('bukti_pembayaran', 'public');
                }

                // Simpan data peserta
                $participant = Participant::create([
                    'program_title' => $program->title,
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nip' => $request->nip,
                    'dinas' => $request->dinas,
                    'jabatan' => $request->jabatan,
                    'pemda' => $request->pemda,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'email' => $request->email,
                    'bukti_pembayaran' => $buktiPembayaranPath,
                    'registration_type' => 'perorangan',
                ]);

                // Kirim email dengan QR Code
                Mail::to($participant->email)->queue(new RegistrationSuccess($participant));


                return redirect()->route('participant.create', ['program' => $program->slug])
                    ->with('success', 'Pendaftaran perorangan berhasil untuk program ' . $program->title);

            } elseif ($request->registration_type === 'kelompok') {
                // Simpan bukti pembayaran kelompok
                $buktiPembayaranPath = null;
                if ($request->hasFile('bukti_pembayaran_kelompok')) {
                    $file = $request->file('bukti_pembayaran_kelompok');

                    // Cek ukuran file
                    if ($file->getSize() > 2048000) { // 2MB dalam byte
                        return redirect()->back()->with('error', 'Ukuran file bukti pembayaran tidak boleh lebih dari 2MB.');
                    }

                    $buktiPembayaranPath = $file->store('bukti_pembayaran', 'public');
                }

                // Simpan file Excel
                $anggotaPath = $request->file('anggota')->store('anggota', 'public');

                // Import data dari file Excel
                $import = new ParticipantsImport($program->title, $buktiPembayaranPath);
                Excel::import($import, $request->file('anggota'));

                return redirect()->route('participant.create', ['program' => $program->slug])
                    ->with('success', 'Pendaftaran kelompok berhasil untuk program ' . $program->title);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
