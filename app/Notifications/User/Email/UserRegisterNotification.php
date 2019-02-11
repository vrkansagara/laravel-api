<?php

namespace App\Notifications\User\Email;

use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class UserRegisterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private  $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $usre)
    {
        $this->user = $usre;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $salutation =  <<< EOF
Kind Regards
EOF;
        $userName = $this->user->name;
        $greeting = <<< GREAT
Hello $userName ,
GREAT;


        $verifyNow = url('/');

        return (new MailMessage)
            ->subject('User account registered successfully!')
            ->greeting($greeting)
            ->line('You account has been created successfully !')
            ->line('Kindly verify by clicking on Verify now')
            ->action('Verify now', $verifyNow)->level('success')
            ->salutation($salutation)
            ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
