<?php

namespace App\Listeners;

use App\Events\EventTest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
