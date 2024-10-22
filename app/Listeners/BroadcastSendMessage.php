<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ChatBroadcast;

class BroadcastSendMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChatBroadcast $event): void
    {
        broadcast(new ChatBroadcast($event->user, $event->message));
    }
}
