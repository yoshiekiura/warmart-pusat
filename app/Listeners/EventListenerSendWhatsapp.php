<?php

namespace App\Listeners;

use App\Events\EventSendWhatsapp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lucasvdh\LaravelWhatsapp\Abstracts\Listener as WhatsappListener;


class EventListenerSendWhatsapp extends WhatsappListener
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
     * @param  EventSendWhatsapp  $event
     * @return void
     */
    public function handle(EventSendWhatsapp $event)
    {
        $phone_number = '+6285658780793'; // Your phone number including country code
        $type = "sms";

        $result = Whatsapp::CodeRequest($phone_number, $type);

    }
}
