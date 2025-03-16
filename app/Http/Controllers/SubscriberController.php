<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriber = Subscriber::latest()->paginate(10);
        return view('dashboard.subscriber', compact('subscriber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriberRequest $request) : RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
        ]);
        
        Subscriber::create(['email' => $request->email]); // Simpan email ke database

        return redirect()->back()->with('success', 'Berhasil berlangganan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriberRequest $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $user = auth::user();

        if ($user->subscriber) {
            $user->subscriber?->delete();
            return redirect()->back()->with('success', 'Anda telah berhenti berlangganan.');
        }
    
        return redirect()->back()->with('error', 'Anda belum berlangganan.');
    }
}
