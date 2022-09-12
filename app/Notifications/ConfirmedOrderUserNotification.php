<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmedOrderUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $orderId;
    private $scheduled;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($orderId, $scheduled = null)
    {
        $this->orderId = $orderId;
        $this->scheduled = $scheduled ?? 'не назначены';
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
            ->subject('Заказ подтвержден')
            ->greeting('Здравствуйте!')
            ->line('Заказ №' . $this->orderId . ' подтвержден менеджером.')
            ->line('Дата и время проведения работ: ' . $this->scheduled . '.');
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
