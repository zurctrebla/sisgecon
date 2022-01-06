<?php

namespace App\Listeners;

use App\Events\CheckGuest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckGuests
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CheckGuest  $event
     * @return void
     */
    public function handle(CheckGuest $event)
    {

        if ($event->guest->expired_at < date('d/m/Y', strtotime(now()) )) {

            $event->guest->status = "Expirado";

            $event->guest->save();

        }

    }
}
