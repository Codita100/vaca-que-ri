<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class OrderPlaced extends Notification
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @param mixed $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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

    /**
     * Get the WhatsApp representation of the notification.
     */
    public function toWhatsApp($notifiable): WhatsAppMessage
    {
        $orderUrl = url("/orders/view/{$this->order->token}");
        $message = "Comanda dvs. a fost plasată cu succes. Detalii: $orderUrl";


        return (new WhatsAppMessage())
            ->content($message);
    }
}
