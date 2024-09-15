<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    protected $store;
    protected $reservation;

    public function __construct($user, $store, $reservation)
    {
        $this->user = $user;
        $this->store = $store;
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail_reminder')
                    ->with([
                        'user' => $this->user,
                        'store' => $this->store,
                        'reservation' => $this->reservation
                    ]);
    }
}
