<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Program;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Charts\UsersPerMonthChart;
use App\Charts\ParticipantsPerProgramChart;
use App\Models\Gallery;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestParticipants = Participant::latest()->limit(5)->get();
        $newUsers = User::latest()->limit(5)->get();
        $totalUsers = User::count();
        $totalParticipants = Participant::count();
        $totalPrograms = Program::count();
        $totalPosts = Post::count();
        $totalImages = Gallery::count();
        
        $participantsChart = (new ParticipantsPerProgramChart())->build();
        $usersChart = (new UsersPerMonthChart())->build();
    
        return view('dashboard.dashboard', compact(
            'latestParticipants', 
            'newUsers', 
            'totalUsers', 
            'totalParticipants', 
            'totalPrograms',
            'totalPosts',
            'totalImages',
            'participantsChart',
            'usersChart'
        ));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
