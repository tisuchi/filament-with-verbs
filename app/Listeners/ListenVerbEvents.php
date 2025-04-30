<?php

namespace App\Listeners;

use App\Events\Foo;
use Illuminate\Support\Facades\Log;
use Thunk\Verbs\Attributes\Hooks\Listen;

class ListenVerbEvents
{
    public function handle(Foo $event): void
    {
        Log::info(__CLASS__ . ' event listener triggered for ' . get_class($event));
    }
}
