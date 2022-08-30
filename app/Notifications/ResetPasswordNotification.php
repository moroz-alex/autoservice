<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword implements ShouldQueue
{
    use Queueable;

    protected function buildMailMessage($url)
    {
        $count = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->subject('Сброс пароля')
            ->line('Нами был получен запрос на сброс пароля для вашего аккаунта.')
            ->action('Сбросить пароль', $url)
            ->line('Срок действия ссылки для сброса пароля ' . $count . ' минут.')
            ->line('Если вы не делали запрос на сброс пароля, просто проигнорируйте данное письмо.');
    }

}
