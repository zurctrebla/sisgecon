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

        if ($event->user->sheets->last()) {                 // verifica se já existe algum registro.

            // dd('dentro do if');
            foreach ($event->user->sheets as $sheet) {

                if (!$sheet['rest_out']) {

                    $sheet['rest_out'] = date('Y-m-d H:m:s');

                } else if (!$sheet['rest_in']) {

                    $sheet['rest_in'] = date('Y-m-d H:m:s');

                } else if (!$sheet['out']) {

                    $sheet['out'] = date('Y-m-d H:m:s');

                }

            }

        } else {

            foreach ($event->user->sheets as $sheet) {

                $sheet['in'] = date('Y-m-d H:m:s');
                dd('ultimo if');


            }

            // $event->user->sheets()->create($data);
            // dd($event->user->sheets->last());
            // dd('dentro do else');

        }

        $event->user->sheets->save();

        // $event->guest->save();

        //$user->sheets()->create($data);

        // $data['in'] = $date;
        // $data['rest_out'] = $date;
        // $data['rest_in'] = $date;
        // $data['out'] = $date;

    }
}
