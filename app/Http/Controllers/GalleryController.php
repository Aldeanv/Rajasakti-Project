<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Jobs\ProcessGalleryUpload;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Gallery::select('image')->latest()->paginate(20);
        return view('main.gallery', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addimage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array', // Pastikan 'images' adalah array
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB per file
        ]);
        
        try {
            $imagePaths = [];
        
            // Loop setiap gambar yang diunggah
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $imagePaths[] = basename($path);
                }
            }
        
            // Simpan ke database (jika hanya 1 gambar per entri)
            foreach ($imagePaths as $path) {
                Gallery::create([
                    'image' => $path,
                ]);
            }
        
            return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }
    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = Gallery::findOrFail($id);
        $image->delete();

        return redirect()->route('gallery.index')->with('success', 'post berhasil dihapus.');
    }

    public function admin(Request $request)
    {
        $query = Gallery::query();
        $galleries = $query->latest()->paginate(5); 
        return view('dashboard.gallery',  compact('galleries'));
    }
}
