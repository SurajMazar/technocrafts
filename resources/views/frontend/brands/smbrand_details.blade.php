@extends('frontend.layout')
@section('og')
<title>Technocrafts - Brands</title>
<meta name="title" content="{{ $brand->meta_title}}">
	<meta name="description" content="{{ $brand->meta_description}}">
	<meta name="keywords" content="{{ $brand->meta_keyword}}">
@endsection
@section('content')
<div id="app">
	<div class="container pt-4">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<h1 class="text-center">{{ $brand->name }}<hr style="margin-left: auto"></h1>
			</div>
			
			<div class="col-md-6">
				<div class="brand_detail_image">
					<img src="{{ $brand->image }}" alt="" style="width: 100%">

					<div class="col-md-12 text-center pt-4">
					 <a class="btn btn-blue view-product" style="color: white" href="{{ route('smartphone.brands',['id'=>$brand->id]) }}" target="_blank">View Products</a>
						</div>
				</div>
			</div>
			<div class="row justify-content-center pt-4">
				<div class="col-md-8 text-center">
					<div class="brand_detail_description">
					{!! $brand->description !!}
					</div>
					<ads-2-col slug='brand-detail-page'></ads-2-col>
				</div>
				

			</div>
		</div>
	</div>
</div>
@endsection