<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use App\Events\ProgramCreated;
use App\Listeners\ProgramList;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Event::listen(
        //     ProgramCreated::class,
        //     [ProgramList::class, 'handle']
        // );
    }
}
