<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.news', [
            'posts' => Post::search()->latest()->paginate(5),
            'heroPost' => Post::latest()->take(1)->get(),
            'heroSide' => Post::latest()->skip(1)->take(2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addpost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        // Upload Image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
        } else {
            $imagePath = null;
        }

        // Simpan Event ke Database
        Post::create([
            'image' => $imagePath,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
    
        // Ambil berita terkait berdasarkan kesamaan kata di judul
        $relatedPosts = Post::where('id', '!=', $post->id)
                            ->where(function ($query) use ($post) {
                                foreach (explode(' ', $post->title) as $word) {
                                    $query->orWhere('title', 'LIKE', "%$word%");
                                }
                            })
                            ->latest()
                            ->limit(4)
                            ->get();
    
        // Jika tidak ada berita terkait berdasarkan judul, ambil berita terbaru sebagai fallback
        if ($relatedPosts->count() < 4) {
            $additionalPosts = Post::where('id', '!=', $post->id)
                                   ->latest()
                                   ->limit(4 - $relatedPosts->count())
                                   ->get();
            $relatedPosts = $relatedPosts->merge($additionalPosts);
        }
    
        return view('main.post', compact('post', 'relatedPosts'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.store')->with('success', 'post berhasil dihapus.');
    }

    public function admin(Request $request)
    {
        $query = Post::query();
                if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('id', $search);
        }
        $posts = $query->latest()->paginate(5); 
    
        return view('dashboard.post', compact('posts'));
    }
}
