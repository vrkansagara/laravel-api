<?php

namespace App\Listeners\User;

use App\Events\Changepassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangepasswordListener
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
     * @param  Changepassword  $event
     * @return void
     */
    public function handle(Changepassword $event)
    {
        //
    }
}
