<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $orderId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Заказ оформлен')
            ->greeting('Здравствуйте!')
            ->line('Оформлен новый заказ №' . $this->orderId . '.')
            ->line('Пожалуйста, ожидайте звонка нашего менеджера.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
