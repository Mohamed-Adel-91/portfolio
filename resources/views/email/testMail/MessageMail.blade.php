<x-mail::message>
# Introduction

The body of your message.

The Laravel Message Email Test
<hr/>
{{ $dataEmail }}

<x-mail::button :url="url('/')">
Visit Us
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
