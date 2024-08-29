<x-mail::message>
# Payment made to the CPR

Your payment to the Chartered Practitioners Register has been successfully processed.

<x-mail::panel>
## Payment Details

Type: CPR {{ str($order->product_name)->headline() }} <br>
Amount: {{ Number::currency($order->price_ex_vat, 'GBP') }} + VAT<br>
Date: {{ now()->format('jS F Y') }}
</x-mail::panel>

<br>You will receive another email including a payment receipt from our payment processor, Stripe.<br><br>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
