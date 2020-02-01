@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent
<p>your reset code is . {{$code}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
