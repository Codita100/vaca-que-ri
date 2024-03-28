<?php

namespace App\Mail\Backend;

use App\Models\Backend\Email;
use App\Models\Backend\Farmers;
use App\Models\Backend\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConsentEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($salesId, $farmeId, $orderId, $email)
    {
        $this->salesId = $salesId;
        $this->farmeId = $farmeId;
        $this->orderId = $orderId;
        $this->email = $email;
    }
    public function build()
    {
        $sales = User::find($this->salesId);
        $farmer = Farmers::find($this->farmeId);
        $order = Order::find($this->orderId);
        $date_sign = Carbon::now();

        $mail = Email::where('name', '=', $this->email)->first();

        $replace = [
            '[sales]' => $sales->firstname . ' ' . $sales->lastname,
            '[farm]' => $farmer->farm_name,
            '[order]' => $order->id,
            '[date]' => $date_sign->toDateString(),
        ];


        //replace the content with tags from the above
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
