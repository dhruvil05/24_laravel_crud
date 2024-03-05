<?php

namespace App\Listeners;

use App\Events\AttendancesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TimerListener
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
    public function handle(AttendancesEvent $event): void
    {
        dd($event);
    }
}
