<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MatchUpdated extends Notification
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
        $receiver = $user->receiver;

        return (new MailMessage)
            ->subject('Modification de ton secret santa ! 🎅')
            ->greeting('Ho ! Ho ! Ho !')
            ->line('Bonjour ' . $user->name . ',')
            ->line('Ce message juste pour t\'indiquer que suite à des ajouts tardifs, ton secret santa a changé !')
            ->line("Il s'agit maintenant de $receiver->name ($receiver->email)")
            ->line('Je te remercie pour ta gentillesse, et je repars manager mes petits lutins.')
            ->salutation('À très bientôt ! <br> Le Père Noël.');
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
