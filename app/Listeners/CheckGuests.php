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

        if (    $event->guest->expires_at    <   date('Y-m-d')   ) {

            $event->guest->status = "Expirado";

        } /* else {

            $event->guest->status = "Pendente";

        } */

        $event->guest->save();

    }
}
