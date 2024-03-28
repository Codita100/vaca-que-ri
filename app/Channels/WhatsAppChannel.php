<?php

namespace App\Channels;

use App\Models\WhatsappInfo;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);
        $to = $notifiable->routeNotificationFor('whatsapp');
        $from = config('twilio.whatsapp_from');

        //save in WhatsappInfo
        $data_info = New WhatsappInfo();
        $data_info->messageTo = $notifiable->id;
        $data_info->messageFrom = $notifiable->salesforce_id;
        $data_info->message = $message->content;
        $data_info->save();

        $twilio = new Client(config('twilio.sid'), config('twilio.token'));

        return $twilio->messages->create("whatsapp:{$to}", [
            "from" => "whatsapp:{$from}",
            "body" => $message->content,
        ]);
    }
}
