<?php

namespace App\Providers;

use App\Events\User\ActiveInactiveStatusEvent;
use App\Events\User\ForgetpasswordEvent;
use App\Events\User\LoginEvent;
use App\Events\User\LogoutEvent;
use App\Events\User\RegisterEvent;
use App\Events\User\ResetpasswordEvent;
use App\Listeners\ActiveInactiveStatusListener;
use App\Listeners\ForgetpasswordListener;
use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use App\Listeners\RegisterListener;
use App\Listeners\ResetpasswordListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],


        LoginEvent::class => [
            LoginListener::class
        ],
        LogoutEvent::class => [
            LogoutListener::class
        ],
        RegisterEvent::class => [
            RegisterListener::class
        ],
        ForgetpasswordEvent::class => [
            ForgetpasswordListener::class
        ],
        ResetpasswordEvent::class => [
            ResetpasswordListener::class
        ],
        ActiveInactiveStatusEvent::class => [
            ActiveInactiveStatusListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
