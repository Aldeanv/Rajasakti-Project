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
        $programs = $user->programs; // Ambil program yang telah user ikuti

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

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

        if ($request->has('program') && $request->program !== '') {
            $query->where('program_title', $request->program);
        }

        $participants = $query->paginate(10);
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
            $certificatePath = $request->file('certificate')->store('sertifikat' , 'public');
            $participant->certificate = ($certificatePath);
        }

        if ($request->hasFile('material')) {
            $materialPath = $request->file('material')->store('materials' , 'public');
            $participant->material = ($materialPath);
        }

        $participant->save();

        return redirect()->route('admin.programs.index')->with('success', 'File berhasil diunggah.');
    }

    public function downloadFile($type, $filename)
    {
        $path = '';

        if ($type === 'certificate') {
            $path = storage_path('app/public/sertifikat/' . $filename);
        } elseif ($type === 'material') {
            $path = storage_path('app/public/materials/' . $filename);
        }

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($path);
    }

}
