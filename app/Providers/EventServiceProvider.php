<?php

namespace App\Providers;

use App\Events\User\ActiveInactiveStatusEvent;
use App\Events\User\ForgetpasswordEvent;
use App\Events\User\LoginEvent;
use App\Events\User\LogoutEvent;
use App\Events\User\RegisterEvent;
use App\Events\User\ResetpasswordEvent;
use App\Listeners\MediaLogger;
use App\Listeners\User\ActiveInactiveStatusListener;
use App\Listeners\User\ForgetpasswordListener;
use App\Listeners\User\LoginListener;
use App\Listeners\User\LogoutListener;
use App\Listeners\User\RegisterListener;
use App\Listeners\User\ResetpasswordListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;

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
        ],
        MediaHasBeenAdded::class => [
            MediaLogger::class
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
