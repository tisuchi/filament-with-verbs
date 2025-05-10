<?php

namespace App\Events;

use App\Listeners\ListenVerbEvents;
use Thunk\Verbs\Event;
use Illuminate\Support\Facades\Log;

class Foo extends Event
{
    public function handle()
    {
        Log::info(__CLASS__ . ' event triggered.');

        // Manually invoke the listener
        app(ListenVerbEvents::class)->handle($this);
    }
}
