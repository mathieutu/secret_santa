<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $user)
    {
        $company = config('secret_santa.company_name');

        return (new MailMessage)
            ->subject("Te voilà Secret Santa $company ! 🎅")
            ->greeting('Ho ! Ho ! Ho !')
            ->line("Bonjour $user->name ,")
            ->line("J'ai bien reçu ton courrier, et c'est très gentil de ta part de bien vouloir m'aider à organiser le Noël de $company $user->city !")
            ->line('Tu recevras très bientôt une missive avec le nom du collègue à qui tu devras faire un cadeau.')
            ->salutation('Merci et à très vite, <br> Le Père Noël.')
        ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
