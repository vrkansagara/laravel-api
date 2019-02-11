<?php

namespace App\Listeners\User;


use App\Entities\User;
use App\Events\User\LoginEvent;
use App\Notifications\User\Email\UserLoginNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class LoginListener
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
     * @param  Login  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $user = User::where('email',env('SUPERMOST_ADMIN_EMAIL'))->first();
        return Notification::send( $user , new UserLoginNotification($event->user));
    }
}
