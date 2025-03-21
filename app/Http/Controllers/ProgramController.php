<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\ProgramCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProgramRequest;



class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.event', [
            'programs' => Program::search()->latest()->paginate(5),
            'Hero' => Program::oldest()->take(1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addprogram');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'maps' => 'required|string|max:255',
            'body' => 'required',
        ]);
    
        // Buat slug dari title
        $slug = Str::slug($request->title);
    
        // Cek apakah slug sudah ada
        if (Program::where('slug', $slug)->exists()) {
            return redirect()->back()->with('error', 'Judul ini sudah digunakan, silakan gunakan judul lain.');
        }
    
        // Simpan data
        $program = Program::create([
            'title' => $request->title,
            'slug' => $slug,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'maps' => $request->maps,
            'body' => $request->body,
        ]);

        // Panggil event ProgramCreated
        ProgramCreated::dispatch($program);
    
        return redirect()->route('programs.index')->with('success', 'Program berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('main.program', ['program' => $program]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        dd($program);
        return view('main.form', ['program' => $program]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         $program = Program::findOrFail($id);
         $program->delete();
     
         // Reset auto-increment ke nilai ID tertinggi saat ini
         DB::statement('ALTER TABLE programs AUTO_INCREMENT = 1');
     
         return redirect()->route('programs.index')->with('success', 'Program berhasil dihapus.');
     }
     

    public function admin(Request $request)
    {
        $query = Program::query();
                if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('id', $search);
        }
        $programs = $query->latest()->paginate(5); 
    
        return view('dashboard.program', compact('programs'));
    }
}
