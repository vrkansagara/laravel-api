<?php

namespace App\Listeners;

use App\Events\Resetpassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetpasswordListener
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
     * @param  Resetpassword  $event
     * @return void
     */
    public function handle(Resetpassword $event)
    {
        //
    }
}
