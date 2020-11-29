@extends('frontend.layout')
@section('og')
<title>Technocrafts - {{ $smartphone->name }}</title>
@endsection
@section('content')
<div id="app">
	<div class="container pt-4">
		<div class='row'>
			<div class="col-md-4">
				<product-detail-slider :images='{{ json_encode($smartphone->images) }}'></product-detail-slider>
			</div>	

			<div class="col-md-5">

				<div class="laptop__basic__details">
					<h3>{{ $smartphone->name }}<hr></h3>
					<div class="laptop">
						<div class="price">
							<p style="display: flex;"><span>Price</span> <price :price='{{ $smartphone->price }}'></price></p>
						</div>
						<div class="brand">
							<a   ><p>{{ $smartphone->brand->name }}</p></a>
						</div>
					</div>
					<ul class="laptop__feature">
						<li><span><i class=" fas fa-microchip mr-2"></i>Technology:</span>{{ $smartphone->technology }}</li>
						<li><span><i class=" fas fa-sim-card mr-2"></i>Sim:</span>{{ $smartphone->sim }}</li>
						<li><span><i class=" fas fa-microchip mr-2"></i>Chipset:</span>{{ $smartphone->chipset }}</li>
						<li><span><i class=" fas fa-microchip mr-2"></i>CPU:</span>{{ $smartphone->cpu }}</li>
						<li><span><i class="fas fa-memory mr-2"></i>GPU:</span>{{ $smartphone->gpu }}</li>
						<li><span><i class="fas fa-memory mr-2"></i>RAM:</span>{{ $smartphone->ram }}</li>
						<li><span><i class="fas fa-laptop mr-2"></i>Dimension:</span>{{ $smartphone->dimension }}</li>
						<li><span><i class="fas fa-weight mr-2"></i>Weight:</span>{{ $smartphone->weight }}</li>
						<li><span><i class="fas fa-battery-full mr-2"></i>Battery:</span>{{ $smartphone->battery }}</li>
						<li><span><i class="fas fa-palette mr-2"></i>colors:</span>{{ $smartphone->colors }}</li>
						<li><span><i class="fas fa-power-off mr-2"></i>OS:</span>{{ $smartphone->os }}</li>
					</ul>
				</div>
			</div>	
			<!-- 			{{-- end laptop basic details --}}-->
				
				<div class="col-md-3">
					<ads-1-col slug='smartphone-detail-page'></ads-1-col>
				</div>
		</div>

		<div class="row pt-3">
			<div class="col-md-6">
				<h3 class="lap_title">Memory<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class=" fas fa-sd-card mr-2"></i>Card Reader:</span>
						@if($smartphone->card_reader)
						Yes  {{ $smartphone->card_reader_description }}
						@else
							NO
						@endif
					</li>
					<li><span><i class="  	far fa-hdd mr-2"></i>Internal:</span>{{ $smartphone->internal_memory }}</li>
				</ul>
			</div>

			<div class="col-md-6">
				<h3 class="lap_title">Display<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class=" 	fas fa-tv mr-2"></i>Display:</span>{{ $smartphone->display }}</li>
					<li><span><i class="fas fa-ruler mr-2"></i>Size:</span>{{ $smartphone->size }}</li>
					<li><span><i class="fas fa-ruler-combined mr-2"></i>Resolution:</span>{{ $smartphone->resolution }}</li>
				</ul>
			</div>

		</div>

		<div class="row pt-3">
			<div class="col-md-6">
				<h3 class="lap_title">Front Camera<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class=" fas fa-camera mr-2"></i>Type:</span>{{ $smartphone->frontcamera_type }}</li>
					<li><span><i class=" far fa-image mr-2"></i>Feature:</span>{{ $smartphone->frontcamera_feature }}</li>
					<li><span><i class=" fas fa-film mr-2"></i>Video:</span>{{ $smartphone->frontcamera_video }}</li>
				</ul>
			</div>

			<div class="col-md-6">
				<h3 class="lap_title">Main Camera<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class=" fas fa-camera mr-2"></i>Type:</span>{{ $smartphone->maincamera_type }}</li>
					<li><span><i class=" far fa-image mr-2"></i>Feature:</span>{{ $smartphone->maincamera_feature }}</li>
					<li><span><i class=" fas fa-film mr-2"></i>Video:</span>{{ $smartphone->maincamera_video }}</li>
				</ul>
			</div>

		</div>

		<div class="row pt-3">
			<div class="col-md-6">
				<h3 class="lap_title">Sound<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class="  	fas fa-bullhorn mr-2"></i>Loudspeaker:</span>
						@if($smartphone->loudspeaker)
						Yes  {{ $smartphone->loudspeaker_description }}
						@else
							NO
						@endif
					</li>
					<li><span><i class=" fas fa-headphones-alt mr-2"></i>Headphone:</span>{{ $smartphone->headphone_jack }}</li>
				</ul>
			</div>

			<div class="col-md-6">
				<h3 class="lap_title">Commons<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class=" fas fa-wifi mr-2"></i>WLAN:</span>{{ $smartphone->wlan }}</li>
					<li><span><i class=" fab fa-bluetooth mr-2"></i>Bluetooth:</span>{{ $smartphone->bluetooth }}</li>
					<li><span><i class=" fas fa-map-marker-alt mr-2"></i>GPS:</span>
						@if($smartphone->gps)
						Yes  {{ $smartphone->gps_description }}
						@else
							No
						@endif
					</li>
					<li><span><i class="fas fa-credit-card mr-2"></i>NFC:</span>
						@if($smartphone->nfc)
						Yes  
						@else
							No
						@endif
					</li>
					<li><span><i class=" fas fa-broadcast-tower mr-2"></i>Radio:</span>
						@if($smartphone->radio)
						Yes  
						@else
							No
						@endif
					</li>

					<li><span><i class=" fa fa-plug mr-2"></i>USB:</span>{{ $smartphone->usb }}</li>
				</ul>
			</div>

		</div>



	</div>

	<emi :price='{{ $smartphone->price }}'></emi>

</div>

@endsection