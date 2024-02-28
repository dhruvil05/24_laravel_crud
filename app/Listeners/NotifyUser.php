<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

use function PHPSTORM_META\map;

class NotifyUser
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
    public function handle(UserCreated $event): void
    {
        // $users = User::get();
        
        // foreach($users as $user){

            Mail::to('dspatel0657@gmail.com')->send(new UserMail($event->user));
        // }
    }
}