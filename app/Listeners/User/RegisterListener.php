<?php

namespace App\Listeners\User;

use App\Events\Register;
use App\Events\User\RegisterEvent;
use App\Notifications\UserRegisterNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterListener
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
     * @param  Register  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        return new UserRegisterNotification($event->user);
    }
}
