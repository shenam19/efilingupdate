<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use App\Models\UserActivity;
class LogSuccessfulLogin
{    
    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct()
    {    
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        
        // dd($event->user->name, Carbon::now(), request()->ip());
        $activity = new UserActivity;
        $activity->user_id = $event->user->id;
        $activity->ip_address = request()->ip();
        $activity->activity = 'login';
        $activity->save();
    }
}
