<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MatchFound extends Notification
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
            ->subject('Ton secret santa ! 🎅')
            ->greeting('Ho ! Ho ! Ho !')
            ->line('Bonjour ' . $user->name . ',')
            ->line('Ça y est, plus Noël approche, et plus mes petits lutins sont débordés.')
            ->line('J\'ai reçu beaucoup d\'inscriptions de la part de tes collègues, et je ne vais pas pouvoir m\'occuper de tout. J\'ai besoin de toi !')
            ->line("Tu vas devoir offrir un cadeau à $receiver->name ($receiver->email)")
            ->line('Garde ça bien secret, je compte sur toi ! Et n\'oublie pas, les cadeaux ne doivent pas dépasser 15€ !')
            ->line('Sur ce, je repars manager mes petits lutins.')
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
