<?php

namespace App\Listeners;

use App\Models\ProgramList;
use App\Events\ProgramCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatedProgramList
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProgramCreated $event): void
    {
        ProgramList::create([
            'slug' => $event->program->slug,
            'title' => $event->program->title,
            'date' => $event->program->date,
            'location' => $event->program->location,
        ]);
    }
}
