<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->event->user_id === auth()->id();
    }
}
