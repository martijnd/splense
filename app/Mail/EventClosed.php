<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventClosed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Event $event,
        private string $email,
    ) {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('events.show.result', $this->event->id);

        return $this->markdown('emails.events.closed', ['url' => $url])
            ->subject('\'' . $this->event->title . '\' has been closed. - ' . config('app.name'));
    }
}
