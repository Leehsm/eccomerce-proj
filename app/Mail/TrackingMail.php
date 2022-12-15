<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrackingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tracking_number;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tracking_number)
    {
        $this->tracking_number = $tracking_number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tracking_number = $this->tracking_number;
        return $this->from('gamesajee123@gmail.com')->view('mail.tracking_mail',compact('tracking_number'))->subject('Your Items Tracking Number From outfitbysahira.com');
    }
}
