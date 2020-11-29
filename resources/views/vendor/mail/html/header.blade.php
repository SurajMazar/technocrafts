<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Technocrafts')
<img src="{{asset('/images/technocrafts-logo.png')}}" style="width:200px;height:auto" class="logo" alt="Technocrafts Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
