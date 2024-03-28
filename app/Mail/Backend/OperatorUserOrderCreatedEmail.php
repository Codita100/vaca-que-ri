<?php

namespace App\Mail\Backend;

use App\Models\Backend\Email;
use App\Models\Backend\Order;
use App\Models\User;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OperatorUserOrderCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($order, $email)
    {
        $this->order = $order;
        $this->email = $email;
    }

    public function build()
    {
        $mail = Email::where('name', '=', $this->email)->first();
        if (!$mail) {
            return;
        }

        $order = Order::find($this->order->id);

        if (!$order) {
            Log::warning('Comanda nu a fost găsită pentru emailul cu id-ul: ' . $this->order->id);
            return redirect()->route('orders.index')->with('error', 'Comanda nu a fost găsită.');
        }

        $replace = [
            '[ORDER_ID]' => $order->id,
            '[ORDER_CREATED_AT]' => $order->created_at,
        ];

        $content = $mail->description;
        foreach ($replace as $key => $value) {
            $content = str_replace($key, $value, $content);
        }


        $pdf = PDF::loadView('backend.orders.pdf.order', ['order' => $order]);
        $attachmentPath = storage_path('app/public/attachments/');
        $attachmentName = 'voucher_' . $order->id . '.pdf';
        $pdf->save($attachmentPath . $attachmentName);

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($mail->subject)
            ->view('frontend.email.general')->with(
                [
                    'values' => $content
                ]
            )
            ->attach($attachmentPath . $attachmentName, [
                'as' => $attachmentName,
                'mime' => 'application/pdf',
            ]);
    }
}
