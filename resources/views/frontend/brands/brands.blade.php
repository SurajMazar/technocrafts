@extends('frontend.layout')
@section('og')
<title>Technocrafts - Brands</title>
@endsection
@section('content')
<div id="app">
	<div class="container pt-3">
		<ul class="nav nav-tabs justify-content-center">
		  <li class="active"><a data-toggle="tab" class="active" href="#home">Laptop Brands</a></li>
		  <li><a data-toggle="tab" href="#menu2">Smart phone Brands</a></li>
		</ul>

		<div class="tab-content">
		  <div id="home" class="tab-pane fade in active show">
		    <brand-listing type='laptop' imgfolder='/images/brands/' :brands='{{ json_encode($lbrands) }}'></brand-listing>
		    {{-- {{  $lbrands->links() }} --}}
		  </div>
		  <div id="menu2" class="tab-pane fade">
		    <brand-listing  type='smartphones' imgfolder='' :brands='{{ json_encode($sbrands) }}'></brand-listing>
		    {{-- {{  $sbrands->links() }} --}}
		  </div>
		</div>
	</div>
</div>
@endsection