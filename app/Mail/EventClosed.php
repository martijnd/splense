<?php

namespace App\Mail;

use App\Models\Event;
use App\Services\ExpenseCalculator;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $users = ExpenseCalculator::calculate($this->event);
        $pdf = Pdf::loadView('pdfs.closed-event', ['event' => $this->event, 'users' => $users]);

        return $this->markdown('emails.events.closed', ['url' => $url])
            ->attachData($pdf->output(), 'TEST.pdf', [
                'mime' => 'application/pdf',
            ])
            ->subject('\'' . $this->event->title . '\' has been closed. - ' . config('app.name'));
    }
}
