<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use Illuminate\Support\Facades\Bus;
use App\Jobs\SendReminderEmail;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Store;
use Carbon\Carbon;

class SendReminders extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send reminder emails to all users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $reservations = Reservation::where('reservation_day', $tomorrow)->get();
        foreach($reservations as $reservation){
            $user = User::find($reservation->user_id);
            $store = Store::find($reservation->store_id);

            if($user){
                SendReminderEmail::dispatch($user,$store,$reservation);
            }
        }
        $this->info('Reminders have been sent!');
    }
}