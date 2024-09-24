<?php

namespace App\Listeners;

use App\Events\EventTest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;
class EventListenerTest
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
     * @param  \App\Events\EventTest  $event
     * @return void
     */
    public function handle(EventTest $event)
    {
        Storage::put('test_new_data.text',$event->new_data);
    }
}
