<?php

namespace App\Notifications\User\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserLoginNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private  $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usre)
    {
        $this->user = $usre;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = \Auth::user();
        $salutation =  <<< EOF
Kind Regards
EOF;
        $userName = $user->name;
        $greeting = <<< GREAT
Hello $userName ,
GREAT;


        return (new MailMessage)
            ->subject(' [User] - [ Login ] event fired on '. route('front.home'))
            ->greeting($greeting)
            ->line('User settings updated for '. $user->name)
            ->salutation($salutation)
            ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
