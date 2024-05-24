<x-mail::message>
__Name:__ {{ $contact['name'] }}<br>
__Email:__ {{ $contact['email'] }}<br>
__Phone:__ {{ $contact['phone'] }}<br>
{{-- __Preferred:__ {{ $contact->preferred }}<br> --}}

__Message__<br>
{{ $contact['message'] }}

{{-- <x-mail::button :url="/">
Pushiii
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
