@component('mail::message')
# Introduction

Blood Bank Reset Password.

<p>Hello {{$user->name}},</p>

<p>Your reset code is : {{$user->pin_code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
