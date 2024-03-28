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
use Illuminate\Support\Facades\Log;

class RaportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $email;

    public function __construct($user, $token, $email)
    {
        $this->user = $user;
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        $user = User::where('email', $this->user->email)->first();
        $mail = Email::where('name', '=', $this->email)->first();
        if (!$mail) {
            Log::error('Șablonul de e-mail nu există: ' . $this->email);
            return;
        }

        $replace = [
            '[user]' => 'firstname' . ' ' . 'lastname',
            '[token]' => $this->token,
        ];

        $content = $mail->description;
        foreach ($replace as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($mail->subject)
            ->view('frontend.email.general')->with(
                [
                    'values' => $content,
                ]
            );
    }
}
