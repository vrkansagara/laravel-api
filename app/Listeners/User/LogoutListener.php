<?php

namespace App\Listeners\User;

use App\Entities\User;
use App\Events\Logout;
use App\Events\User\LogoutEvent;
use App\Notifications\User\Email\UserLogoutNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class LogoutListener implements  ShouldQueue
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(LogoutEvent $event)
    {

        $user = User::where('email',env('SUPERMOST_ADMIN_EMAIL'))->first();
        return Notification::send($user, new UserLogoutNotification($event->user));
    }
}
