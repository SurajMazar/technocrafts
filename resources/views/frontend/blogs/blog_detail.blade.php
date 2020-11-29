@extends('frontend.layout')

@section('og')

	{{-- Search Engine Optimization --}}
	<meta name="title" content="{{ $blog->meta_title}}">
	<meta name="description" content="{{ $blog->meta_description}}">
	<meta name="keywords" content="{{ $blog->meta_keyword}}">
	<meta property="og:title" content="{{ $blog->title }}" />
	{{-- Search Engine Optimization --}}

	
	<meta property="og:type" content="blog" />
	<meta property="og:url" content="{{ route('home') }}/blog/{{ $blog->slug }}" />
	<meta property="og:image" content="{{ route('home') }}/images/blogs/{{ $blog->featured_image }}" />
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f0d95dd985401a2"></script> 
	<title>{{ $blog->title }}</title>
@endsection


@section('content')
<div id="app">
<section class='pt-3'>
	<div class="container">
		<div class="row">
			<div class="col-md-9">

			{{-- 	@php
				echo '<pre>';
				print_r($blog);
				echo '<pre>';
				@endphp --}}
				
				<div class="blog__detail">
					<div class="blog__image">
						<figure>
							<img src="/images/blogs/{{ $blog->featured_image }}" alt="">
							<figcaption>
								<div class="blog">
									@foreach($blog->blogcategory as $blogcat)
									<span class="category mrn-1"><a href="{{ route('blogs.by_category',['slug' => $blogcat->slug]) }}" class="font-white">{{ $blogcat->name }}</a></span>
									@endforeach
								</div>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-12">
						<div class="row">
							<p><i class="far fa-calendar mr-2"></i> {{ date_format($blog->created_at,'d M Y') }}</p>
							@foreach($blog->bloguser as $user)
								<p style="margin-left: auto"><i class="fas fa-user-tag mr-2"></i>{{ $user->name }}</p>
							@endforeach
						</div>
					</div>
					<h1>{{ $blog->title }} <hr></h1>
					<div class="col-md-12">
					<p><i class="fas fa-eye mr-2"></i>{{ $blog->views }} views</p>
					</div>
					<div class="description">
						{!! $blog->description !!}
					</div>

					<div class="fb-comments" data-href="{{ route('blogs.detail',['slug' => $blog->slug]) }}" data-numposts="5" data-width="800"></div>

				</div>

				<ads-2-col slug='blogs-detail-page'></ads-2-col>
				
			</div>

			<blog-sidebar :blog_categories='{{ json_encode($blog_categories) }}' home_url='{{ route('home') }}'></blog-sidebar>
		</div>
		<h5 class="pt-4">Related Blogs<hr></h5>
		<div class="row pt-4">
			@if(count($related_blogs)>0)
				<blogs-listing :blogs='{{ json_encode($related_blogs) }}'></blogs-listing>
				@else
				<p>No related Blogs</p>
			@endif
		</div>
	</div>
</section>
</div>
<div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="SsOSghRN"></script>
@endsection