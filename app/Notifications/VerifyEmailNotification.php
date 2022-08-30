<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Подтвердите Email адрес')
            ->greeting('Здравствуйте!')
            ->line('Чтобы подтвердить адрес электронной почты нажмите на кнопку:')
            ->action('Подтвердить почту', $url)
            ->line('Если вы не регистрировались на нашем сайте, просто проигнорируйте данное сообщение.');
    }

}
