<?php

namespace App\Mail\Frontend;

use App\Models\Backend\Email;
use App\Models\Backend\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($userId, $order, $email)
    {
        $this->userId = $userId;
        $this->order = $order;
        $this->email = $email;
    }

    public function build()
    {
        $user = User::find($this->userId);
        $mail = Email::where('name', '=', $this->email)->first();
        $order = Order::find($this->order->id);

        $replace = [
            '[username]' => $user->name,
            '[product]' => $order->productCatalog->name,
        ];

        //replace the content with tags from the above
        $content = $mail->description;
        foreach ($replace as $key => $value) {
            $content = str_replace($key, $value, $content);
        }


        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($mail->subject)
            ->view('frontend.email.general')->with(
                [
                    'values' => $content
                ]
            );
    }
}
