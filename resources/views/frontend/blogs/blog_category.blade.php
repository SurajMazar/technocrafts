@extends('frontend.layout')
@section('og')
<title>Technocrafts - Blogs</title>
@endsection
@section('content')
<div id="app">
<section class='container pt-3'>
	
		<div class="row">

			<div class="col-md-9">
				<h4>{{ $title }}<hr></h4>
				<blogs-list :blogs='{{ json_encode($blogs) }}'></blogs-list>
				<div class="pt-2">
					{{  $blogs->links() }}
				</div>
			</div>

			<blog-sidebar :blog_categories='{{ json_encode($blog_categories) }}' home_url='{{ route('home') }}'></blog-sidebar>

		</div>
	
</section>
</div>

@endsection