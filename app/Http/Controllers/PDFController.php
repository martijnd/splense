<?php

namespace App\Http\Controllers;

use App\Models\Event;

class PDFController extends Controller
{
    public function closedEvent(Event $event)
    {
        $data = [
            'event' => $event
        ];

        return view('pdfs.closed-event', $data);
    }
}
