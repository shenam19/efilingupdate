<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use App\Models\UserActivity;
class LogSuccessfulLogout
{
    /**
     * Create a new event instance.     
     */
    public function __construct()
    {
        //        
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {        
        // dd($event->user->name, Carbon::now(), request()->ip());
        $activity = new UserActivity;
        $activity->user_id = $event->user->id;
        $activity->ip_address = request()->ip();
        $activity->activity = 'logout';
        $activity->save();
    }
}
