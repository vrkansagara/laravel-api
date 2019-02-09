<?php

namespace App\Listeners\User;

use App\Events\ActiveInactiveStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActiveInactiveStatusListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActiveInactiveStatus  $event
     * @return void
     */
    public function handle(ActiveInactiveStatus $event)
    {
        //
    }
}
