<x-mail::message>
# Membership Enquiry via wc-ec.com website

<strong>Name:</strong> {{ $name }}<br>
<strong>Email:</strong> {{ $email }}

Message:
<x-mail::panel>
{{ $detail }}
</x-mail::panel>
{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
</x-mail::message>
