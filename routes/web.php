<?php

use Illuminate\Http\Request;
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ParticipantController;


   /*
    |--------------------------------------------------------------------------
    | 
    | Home routes
    |
    |--------------------------------------------------------------------------
    */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event', [ProgramController::class, 'index'])->name('event');
Route::get('/event/{program:slug}', [ProgramController::class, 'show']);
Route::get('/galeri', [GalleryController::class, 'index']);
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{post:slug}', [NewsController::class, 'show']);
Route::get('/about', function () {
    return view('main.about');
});

   /*
    |--------------------------------------------------------------------------
    | 
    | Registrations routes
    |
    |--------------------------------------------------------------------------
    */

Route::get('/registrasi/{program:slug}', [ParticipantController::class, 'create'])->name('participant.create');
Route::post('/registrasi/{program:slug}', [ParticipantController::class, 'store'])->name('participant.store');

   /*
    |--------------------------------------------------------------------------
    | 
    | Profile and subscribers routes
    |
    |--------------------------------------------------------------------------
    */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profiles', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');
    Route::delete('/unsubscribe', [SubscriberController::class, 'destroy'])->name('unsubscribe');
    Route::get('/download/{type}/{filename}', [ProfileController::class, 'downloadFile'])
    ->where('type', 'certificate|material')
    ->name('user.download');
});

   /*
    |--------------------------------------------------------------------------
    | 
    | Dashboard admin routes
    |
    |--------------------------------------------------------------------------
    */

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/UsersList', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/post', [NewsController::class, 'admin'])->name('posts.index');
    Route::delete('/post/{id}', [NewsController::class, 'destroy'])->name('posts.destroy');
    Route::get('/post/{id}/edit', [UserController::class, 'edit'])->name('posts.edit');

    Route::get('/programs', [ProgramController::class, 'admin'])->name('programs.index');
    Route::delete('/programs/{id}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    Route::get('/programs/{id}/edit', [UserController::class, 'edit'])->name('programs.edit');

    Route::get('/programs/create', [ProgramController::class, 'create'])->name('program.create');
    Route::post('/program', [ProgramController::class, 'store'])->name('program.store');

    Route::get('/post/create', [NewsController::class, 'create'])->name('posts.create');
    Route::post('/post', [NewsController::class, 'store'])->name('posts.store');

    Route::get('/gallery', [GalleryController::class, 'admin'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/participant', [ParticipantController::class, 'index'])->name('participant.index');
    Route::get('/participant/export', [ParticipantController::class, 'export'])->name('participant.export');
    Route::get('/participants/export', function (Request $request) {
        $program = $request->query('program');
        return Excel::download(new ParticipantsExport($program), 'participants.xlsx');
    })->name('participants.export');

    Route::post('/import-participants', [ParticipantController::class, 'import'])->name('participants.import');

    Route::get('/material', [ProfileController::class, 'admin'])->name('material.index');
    Route::post('/admin/upload', [ProfileController::class, 'uploadFiles'])->name('admin.upload.files');

    Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscribe');
});

// Route::get('/regis/{id}', function ($id) {
//     $participant = Participant::findOrFail($id);

//     // Pastikan path QR Code tersedia
//     $qrcodeBase64 = null;
//     if ($participant->qrcode_path && file_exists(storage_path('app/public/' . $participant->qrcode_path))) {
//         $qrcodeBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents(storage_path('app/public/' . $participant->qrcode_path)));
//     }

//     return view('registrations.registration_success', compact('participant', 'qrcodeBase64'));
// });

require __DIR__.'/auth.php';
