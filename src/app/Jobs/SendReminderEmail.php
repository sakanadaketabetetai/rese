<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $store;
    protected $reservation;

    public function __construct($user, $store, $reservation)
    {
        $this->user = $user;
        $this->store = $store;
        $this->reservation = $reservation;
    }

    public function handle()
    {
        // リマインダーのメールを送信する処理
        Mail::to($this->user->email)->send(new ReminderEmail($this->user, $this->store, $this->reservation));
    }
}
