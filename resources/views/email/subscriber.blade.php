@component('mail::message')

 {{-- 	@slot('header')
    @component('mail::header', ['url' => config('app.url')])
			[logo]: <img src="{{asset('/images/technocrafts-logo.png')}}" style="height: 100px;"/>
    @endcomponent
	@endslot --}}
@php
$url =  route('home').'/blog/'.$blog->slug;
 $img_url = route('home')."/images/blogs/$blog->featured_image";
@endphp


# {{ $blog->title }}

<img src="{{ $img_url }}" alt="">

@component('mail::button', ['url' => $url ])
view full blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
