<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFeedbackAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $orderId;
    private $rating;
    private $review;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($orderId, $rating, $review)
    {
        $this->orderId = $orderId;
        $this->rating = $rating;
        $this->review = $review;
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
            ->subject('Поступил новый отзыв')
            ->greeting('Здравствуйте!')
            ->line('Поступил отзыв к заказу №' . $this->orderId . '.')
            ->line('Оценка: ' . $this->rating)
            ->line('Текст отзыва: ' . $this->review);
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
