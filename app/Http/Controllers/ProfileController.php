<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil program yang telah diikuti user dan urutkan dari yang terbaru
        $programs = $user->programs->sortByDesc('created_at');
    
        // Hitung jumlah sertifikat dan materi yang telah diunggah
        $certificateCount = $programs->whereNotNull('pivot.certificate')->count();
        $materialCount = $programs->whereNotNull('pivot.material')->count();
    
        return view('profile.profile', compact('user', 'programs', 'certificateCount', 'materialCount'));
    }     

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function admin(Request $request)
    {
        $query = Participant::query();
    
        // Filter berdasarkan nama atau NIP
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }
    
        // Filter berdasarkan program
        if ($request->filled('program')) {
            $query->where('program_title', $request->program);
        }
    
        // Ambil daftar peserta dan program untuk dropdown
        $participants = $query->latest()->paginate(10);
        $programs = Participant::select('program_title')->distinct()->pluck('program_title');
    
        return view('dashboard.material', compact('participants', 'programs'));
    }
    

    public function uploadFiles(Request $request)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'certificate' => 'nullable|mimes:pdf,jpg,png|max:2048',
            'material' => 'nullable|mimes:pdf,docx,pptx|max:5120',
        ]);

        $participant = Participant::findOrFail($request->participant_id);

        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $filename = $file->getClientOriginalName(); // Tambahkan timestamp agar unik
            $file->storeAs('certificates', $filename, 'public');
            $participant->certificate = $filename; // Simpan nama file saja di database
        }

        if ($request->hasFile('material')) {
            $file = $request->file('material');
            $filename = $file->getClientOriginalName();
            $file->storeAs('materials', $filename, 'public');
            $participant->material = $filename;
        }

        $participant->save();

        return redirect()->route('material.index')->with('success', 'File berhasil diunggah.');
    }

    public function downloadFile($type, $filename)
    {
        $path = match ($type) {
            'certificate' => storage_path("app/public/certificates/{$filename}"),
            'material' => storage_path("app/public/materials/{$filename}"),
            default => abort(404, 'Tipe file tidak valid.'),
        };

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($path);
    }

}
