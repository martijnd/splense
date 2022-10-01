@component('mail::message')
# Introduction

The event has closed.

@component('mail::button', ['url' => $url])
    See who you need to pay
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
