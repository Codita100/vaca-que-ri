<?php

namespace App\Mail\Frontend;

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

class StatusChangedSalesEmail extends Mailable
{
    use Queueable, SerializesModels;

       public function __construct($order, $user, $farm, $email)
    {
        $this->order = $order;
        $this->user = $user;
        $this->farm = $farm;
        $this->email = $email;
    }

    public function build()
    {
        $user = User::findOrFail($this->user->id);
        $mail = Email::where('name', '=', $this->email)->first();
        $farm = Farmers::find($this->farm);

        if (!$mail) {
            return;
        }

        $statusName = Order::getStatusName($this->order->status);

        $replace = [
            '[username]' => $user->firstname . " " . $user->lastname,
            '[order_id]' => $this->order->id,
            '[status]' => $statusName,
            '[farm]' => $farm->farm_name,
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
