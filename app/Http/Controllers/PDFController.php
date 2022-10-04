<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\ExpenseCalculator;

class PDFController extends Controller
{
    public function closedEvent(Event $event)
    {
        $users = ExpenseCalculator::calculate($event);
        $data = [
            'users' => $users,
            'event' => $event
        ];

        return view('pdfs.closed-event', $data);
    }
}
