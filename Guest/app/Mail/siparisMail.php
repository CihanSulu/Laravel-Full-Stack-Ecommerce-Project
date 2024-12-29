<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\siparisler;

class siparisMail extends Mailable
{
    use Queueable, SerializesModels;
    public $siparis;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(siparisler $siparis)
    {
        $this->siparis = $siparis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Siparişiniz Alındı')->view('emails.siparis');
    }
}
