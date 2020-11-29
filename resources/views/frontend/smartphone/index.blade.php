@extends('frontend.layout')
@section('og')
<title>Technocrafts - Smartphones</title>
@endsection

@section('content')
<div id="app">
	<section class="pt-4 pb-4">
		<div class="container">

			<div class="row pt-3">
				<div class="laptop_page col-md-9">



					<div class="row">
						<div class="col-md-8">

							<form action="{{ route('smartphone.search') }}" method="GET">
			
							<div class="input-group">
		            <input type="text" class="form-control float-right" name='search' 
								@if(isset($search))
		            	value='{{ $search }}'
								@endif
		            	placeholder="Search by name">
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
									<option value="{{ route('smartphone') }}">All Smartphones</option>
									<option value="{{ route('smartphone.price_dec') }}">Price(High to Low)</option>
									<option value="{{ route('smartphone.price_asc') }}">Price(Low to High)</option>
									<option value="{{ route('smartphone.alpha_asc') }}">Alphabetical(Asc)</option>
									<option value="{{ route('smartphone.alpha_dec') }}">Alphabetical(Dec)</option>
								</select>
							</div>
						</div>
					</div>

					<h4>Smartphones 
						@if(isset($title))
							- {{ $title }}
						@endif
						@if(isset($search))
							- {{ $search }}
						@endif
						<hr></h4>
					<div class="container pt-4">
					  <div class="row">
					  	@if(count($smartphones)>0)
						  	@foreach($smartphones as $smartphone)
						    <div class="col-md-3">
						      <smartphone-list :smartphone='{{ json_encode($smartphone) }}'></smartphone-list>
						    </div>
						    @endforeach
						    @else
						    	<div class="col-md-12">
						    		Sorry nothing found!!
						    	</div>
						  @endif
					  </div>
					</div>
					<div class="pt-2">
						{{  $smartphones->links() }}
					</div>
					<ads-3-col slug='smartphone-page'></ads-3-col>
				</div>

				<smartphone-sidebar :brands="{{ json_encode($brands) }}"></smartphone-sidebar>
			</div>

		</div>
	</section>
</div>

@endsection