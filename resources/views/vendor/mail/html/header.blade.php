@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{--<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/wcec-crest-small.png'))) }}" class="logo" alt="WC-EC Crest" style="width: 254px; height: 100px; max-height: 100px;">--}}
{{--<img src="{{ $message->embed('/resources/img/wcec-crest-sml.png') }}" alt="WC-EC Crest">--}}
<img src="data:image/png;base64,{{ base64_encode(file_get_contents(Vite::asset('resources/img/wcec-crest-small.png'))) }}" alt="WC-EC Crest" style="height: 100px; width: 63px;">
{{--@if (trim($slot) === 'Laravel')--}}
{{--<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">--}}
{{--@else--}}
{{--{{ $slot }}--}}
{{--@endif--}}
</a>
</td>
</tr>
