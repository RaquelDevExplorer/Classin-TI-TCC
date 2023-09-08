<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RecuperarSenha extends Notification implements ShouldQueue
{
    use Queueable;

    private $token = [];

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->from('noreply@classin.com.br', 'Equipe Classin')
                    ->subject(__('Password Recovery'))
                    ->greeting(__('Oh no! It seems like someone forgot the password :P'))
                    ->line(__('You are receiving this email because we received a password reset request for your account.'))
                    ->line(__('But don\'t worry! Just click the button below to reset your password.'))
                    ->action(__('Reset Password'), route('password.reset', $this->token))
                    ->salutation(new HtmlString(__('Regards') . ', <br>' . config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
