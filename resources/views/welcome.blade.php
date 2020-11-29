@extends('frontend.layout')
@section('og')
<title>Technocrafts - Online Gadget Information System</title>
@endsection
@section('content')
<div id="app">
<ads-full-page slug='road-block-ads'></ads-full-page>

<latest-blogs :latest_blogs='{{ json_encode($blogs) }}'></latest-blogs>
<recommendated-blogs></recommendated-blogs>
<ads-long slug='home-page-below-latest-news'></ads-long>

<section class="pt-4 pb-4" >
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<featured-blogs  :featured_blogs="{{ json_encode($featured_blogs) }}"></featured-blogs>
			</div>

			<div class="col-md-3">
				<h2>Most viewed<hr></h2>
				<ul class="most-viewed">
					@foreach($mostViewed as $m)
						<most-viewed-list :blog='{{ json_encode($m) }}'></most-viewed-list>
					@endforeach
				</ul>
			</div>


		</div>
	</div>
</section>


<ads-long slug='home-page-below-featured-news'></ads-long>

<section class="pt-4 pb-4">
	<div class="container">
		<a class='title'><h2>Latest Laptops<hr></h2></a>
		<laptop-listing home_url='{{ route('home') }}' :laptops="{{ json_encode($laptops) }}"></laptop-listing>
	</div>	
</section>

<ads-long slug='home-page-below-latest-laptops'></ads-long>


<section class="pt-4 pb-4">
	<div class="container">
		<a class='title'><h2>Latest Smartphones<hr></h2></a>
		<div class="row">
			@foreach($smartphones as $s)
				<div class='col-md-2'>
					<smartphone-list :smartphone='{{ json_encode($s) }}'></smartphone-list>
				</div>
			@endforeach
		</div>
	</div>	
</section>

<ads-long slug='home-page-below-latest-smartphones'></ads-long>

</div>

@endsection
