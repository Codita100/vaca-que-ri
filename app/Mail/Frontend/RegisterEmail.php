<?php

namespace App\Mail\Frontend;

use App\Models\Backend\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct($id, $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function build()
    {
        $user = User::find($this->id);
        $mail = Email::where('name', '=', $this->email)->first();

        $replace = [
            '[username]' => $user->name,
            '[token]' => $user->token
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
