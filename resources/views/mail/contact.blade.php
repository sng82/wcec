<x-mail::message>
# Enquiry via wc-ec.com website

<strong>Name:</strong> {{ $name }}<br>
<strong>Email:</strong> {{ $email }}<br>
<strong>Phone:</strong> {{ $phone }}

Message:
<x-mail::panel>
 {{ $message }}
</x-mail::panel>
{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
</x-mail::message>
