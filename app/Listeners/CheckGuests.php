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

            // dd('event');

            $event->guest->status = "Expirado";

            $event->guest->update();

        } else if (($event->guest->expires_at    >=   date('Y-m-d')) AND ($event->guest->status == "Expirado") ) { //   Pendente, Autorizado, Expirado, Bloqueado.

            // $event->guest->status = "Pendente";

            // $event->guest->update();

        }

    }
}
