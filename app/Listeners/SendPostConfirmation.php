<?php

namespace App\Listeners;

use App\Events\PostPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class SendPostConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info('Listener __construct() Called');
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostPlaced  $event
     * @return void
     */
    public function handle(PostPlaced $event)
    {
        $post = $event->post;
        Log::info('Success:: Listener handle() Called');
        // Mail::to($order->customer_email)->send(new OrderConfirmation($order));
    }
}
