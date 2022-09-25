@component('mail::message')
# Introduction

You have been added to a new event by {{ $creator->name }}.

@component('mail::button', ['url' => $url])
    Go to Event
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
