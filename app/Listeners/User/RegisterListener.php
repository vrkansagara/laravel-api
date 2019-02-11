<?php

namespace App\Listeners\User;

use App\Entities\User;
use App\Events\User\RegisterEvent;
use App\Notifications\User\Email\UserRegisterNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class RegisterListener implements ShouldQueue
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
        $user = User::where('email',env('SUPERMOST_ADMIN_EMAIL'))->first();
        return Notification::send($user , new UserRegisterNotification($event->user));
    }
}
