<?php

namespace App\Listeners;

use App\Events\EventRegisterEmployee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterEmployee
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
     * @param  \App\Events\EventRegisterEmployee  $event
     * @return void
     */
    public function handle(EventRegisterEmployee $event)
    {
        dd($event->sheet->in);
    }
}
