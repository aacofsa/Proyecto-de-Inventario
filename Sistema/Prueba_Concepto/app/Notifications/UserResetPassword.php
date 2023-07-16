<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserResetPassword extends Notification
{
    use Queueable;

    protected $token;//corresponde al token de user

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
    { //aqui se le da forma al email de reinicio de contraseña
        return (new MailMessage)

                    ->subject('Cambiar contraseña')
                    ->greeting('¡Hola!')
                    ->line('Estás recibiendo este email porque se ha solicitado un cambio de contraseña para tu cuenta.')
                    ->action('Cambiar mi contraseña', url('/password/reset/'. $this->token))
                    ->line('Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este e-mail.')
                    ->salutation('Saludos, EasyControl.');
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
