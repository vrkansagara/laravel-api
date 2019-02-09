<?php

namespace App\Listeners\User;

use App\Events\Forgetpassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetpasswordListener
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
     * @param  Forgetpassword  $event
     * @return void
     */
    public function handle(Forgetpassword $event)
    {
        //
    }
}
