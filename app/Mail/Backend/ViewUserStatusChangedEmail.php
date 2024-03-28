<?php

namespace App\Mail\Backend;

use App\Models\Backend\Email;
use App\Models\Backend\Farmers;
use App\Models\Backend\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViewUserStatusChangedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($order, $actionByUser, $email)
    {
        $this->order = $order;
        $this->actionByUser = $actionByUser;
        $this->email = $email;
    }

    public function build()
    {
        $user = User::findOrFail($this->actionByUser->id);
        $mail = Email::where('name', '=', $this->email)->first();
        $farm = Farmers::find($this->order->farmer_id);

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
