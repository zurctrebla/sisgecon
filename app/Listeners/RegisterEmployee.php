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
        // dd($event->user->sheets->last());
        if ($event->user->sheets->last()) {

            // dd('dentro do if');
        }

        $data['in'] = now();

        $event->user->sheets()->create($data);

        dd($event->user->sheets->last());

        // $data['in'] = $date;
        // $data['rest_out'] = $date;
        // $data['rest_in'] = $date;
        // $data['out'] = $date;

    }
}
