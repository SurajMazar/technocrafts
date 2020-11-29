@extends('frontend.layout')
@section('og')
<title>Technocrafts - {{ $title }}</title>
@endsection

@section('content')
<div id="app">
	<section class="pt-4 pb-4">
		<div class="container">

			<div class="row pt-3">
				<div class="laptop_page col-md-9">

					<div class="row">
						<div class="col-md-8">

							<form action="{{ route('laptop.search') }}" method="GET">
			
							<div class="input-group">
		            <input type="text" class="form-control float-right" name='search' 
									@if(isset($search))
		            	value='{{ $search }}'
		            	@endif

		            	placeholder="Search">
		            <div class="input-group-append">
		              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
		            </div>
		          </div>

		          </form>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<select class="form-control" onchange='document.location.href=this.options[this.selectedIndex].value;'>
									<option disabled selected>Sort By</option>
									<option value="{{ route('laptop') }}">All Laptops</option>
									<option value="{{ route('laptop.price_dec') }}">Price(High to Low)</option>
									<option value="{{ route('laptop.price_asc') }}">Price(Low to High)</option>
									<option value="{{ route('laptop.alpha_asc') }}">Alphabetical(Asc)</option>
									<option value="{{ route('laptop.alpha_dec') }}">Alphabetical(Dec)</option>
								</select>
							</div>
						</div>
					</div>

					<h4>
						@if(isset($title))
						{{ $title }}
						@endif
						<hr></h4>
					<laptop-listing home_url='{{ route('home') }}' :laptops="{{ json_encode($laptops) }}"></laptop-listing>
					<div class="pt-2">
					{{  $laptops->links() }}
					</div>

					<ads-3-col slug='laptops-page'></ads-3-col>

				</div>

				<laptop-sidebar :brands='{{ json_encode($brands) }}' home_url='{{ route('home') }}'></laptop-sidebar>
			</div>

		</div>
	</section>
</div>

@endsection