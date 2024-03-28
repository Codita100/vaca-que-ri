<?php

namespace App\Mail\Backend;

use App\Models\Backend\Email;
use App\Models\Backend\Farmers;
use App\Models\Backend\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ViewUserStatusConsentChangedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $email)
    {
        $this->order = $order;
        $this->email = $email;
    }
    public function build()
    {
        $order = Order::find($this->order->id);
        $farmer = Farmers::where('id', $order->farmer_id)->first();
        $mail = Email::where('name', '=', $this->email)->first();

        if (!$mail) {
            return;
        }

        $replace = [
            '[order]' => $order->id,
            '[farm]' => $farmer->farm_name,
            '[username]' => $farmer->agent->firstname . ' ' . $farmer->agent->lastname ,
        ];


        $content = $mail->description;
        foreach ($replace as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->subject($mail->subject)
            ->view('frontend.email.general')->with(
                [
                    'values' => $content
                ]
            );
    }
}
