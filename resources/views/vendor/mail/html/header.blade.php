@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="/img/logo HD.png" class="logo" alt="Rajasakti Training Center">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
