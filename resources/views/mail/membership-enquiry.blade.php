<x-mail::message>
# Membership Enquiry via wc-ec.com website

<strong>Name:</strong> {{ $name }}<br>
<strong>Email:</strong> {{ $email }}

Message:
<x-mail::panel>
{{ $detail }}
</x-mail::panel>

</x-mail::message>
