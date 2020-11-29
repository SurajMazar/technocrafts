<template>
	<section class="pt-4 pb-4">
	<div class="container">
		<div class="row">
			<!-- {{-- laptop images --}} -->
			<div class="col-md-4">
				<div class="laptop__slider">
					<div class="laptop__preview__image">
						<div v-for='(image,index) in laptopImages' :key='index' :class="index==active_index ?'item active' : 'item'" >
							<figure> 
								<img :src="'/images/laptops/'+ imagefolder(foldername)+'/'+image" alt="">
								<div class="img-preview" title='Preview' @click='openImagePreview()'>
									<i class="fas fa-expand"></i>
								</div>
								<figcaption>
									<i class='fas fa-angle-left' @click='prev_slide'></i>
									<i class='fas fa-angle-right' @click='next_slide'></i>
								</figcaption>
							</figure>
						</div>
					</div> 
					<div class="laptop__image">
						<div v-for='(image,index) in laptopImages' :key='index' :class="index==active_index ?'item active' : 'item'" @click='setImageActive(index)'>
							<figure> 
								<img :src="'/images/laptops/'+ imagefolder(foldername)+'/'+image" alt="">
							</figure>
						</div>
					</div>
				</div>
			</div>
<!-- 			// {{-- end laptop images --}}  -->		


<!-- 			{{-- laptop basic details --}} -->	
			<div class="col-md-5">

				<div class="laptop__basic__details">
					<h3>{{ laptop.name }}<hr></h3>
					<div class="laptop">
						<div class="price">
							<p><span>Price</span>{{ laptop.price | dollar }}</p>
						</div>
						<div class="brand">
							<a v-for='brand in laptop.laptopbrand' :key='brand.id'  ><p>{{ brand.name }}</p></a>
						</div>
					</div>
					<ul class="laptop__feature">
						<li><span><i class=" fas fa-microchip mr-2"></i>CPU:</span>{{ laptop.cpu }}</li>
						<li><span><i class="fas fa-memory mr-2"></i>GPU:</span>{{ laptop.gui }}</li>
						<li><span><i class="far fa-hdd mr-2"></i>Storage:</span>{{ laptop.hdd }}</li>
						<li><span><i class="fas fa-memory mr-2"></i>RAM:</span>{{ laptop.RAM }}</li>
						<li><span><i class="fas fa-laptop mr-2"></i>Dimension:</span>{{ laptop.dimension }}</li>
						<li><span><i class="fas fa-weight mr-2"></i>Weight:</span>{{ laptop.weight }}</li>
						<li><span><i class="fas fa-battery-full mr-2"></i>Battery:</span>{{ laptop.battery }}</li>
						<li><span><i class="fas fa-power-off mr-2"></i>OS:</span>{{ laptop.os }}</li>
					</ul>
				</div>
			</div>	
<!-- 			{{-- end laptop basic details --}}-->
				
				<div class="col-md-3">
					<ads-1-col slug='laptop-detail-page'></ads-1-col>
				</div>
		</div>

		<div class="row pt-3">
			<div class="col-md-6">
				<h3 class="lap_title">Features<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class="far fa-eye mr-2"></i>Web Camera:</span>
						<span class='spec' v-if='laptop.webcamera=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>
						{{ laptop.webcamera_name }}  
					</li>
					<li><span><i class=" 	fas fa-keyboard mr-2"></i>Backlit Keyboard:</span>
						<span class='spec' v-if='laptop.backlit_keyboard=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>
					</li>
					<li><span><i class="fas fa-microphone mr-2"></i>Microphone:</span>
						<span class='spec' v-if='laptop.microphone=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>  
					</li>
					<li><span><i class="fa fa-volume-up mr-2"></i>Speakers:</span>
						<span class='spec' v-if='laptop.speakers=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>
						{{ laptop.speaker_name }}  
					</li>
					<li><span><i class="fas fa-compact-disc mr-2"></i>Optical drive:</span>
						<span class='spec' v-if='laptop.optical_drive=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>  
					</li>
					<li><span><i class="fas fa-lock mr-2"></i>Security lock:</span>
						<span class='spec' v-if='laptop.security_lock=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>
						{{ laptop.security_lock_name }}  
					</li>
					<li><span><i class="fas fa-fingerprint mr-2"></i>Finger Print:</span>
						<span class='spec' v-if='laptop.finger_print=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>
					</li>
				</ul>
			</div>
			<div class="col-md-6">
				<h3 class="lap_title">Display<hr></h3>
				<ul class="laptop__feature">
					<li><span><i class=" 	fas fa-tv mr-2"></i>Display:</span>{{ laptop.display }}</li>
					<li><span><i class="fas fa-ruler mr-2"></i>Diagonal:</span>{{ laptop.diagonal }}</li>
					<li><span><i class="fas fa-ruler-combined mr-2"></i>Resolution:</span>{{ laptop.resolution }}</li>
					<li><span><i class="far fa-dot-circle mr-2"></i>Pixel Density:</span>{{ laptop.pixel_density }}</li>
				</ul>
			</div>

		</div>

		<div class="row pt-3">
			<div class="col-md-12">
				<h3 class="lap_title">Port and Connectivity<hr></h3>
			</div>
			<div class="col-md-6">
				<ul class="laptop__feature">
					<li><span><i class="fa fa-plug mr-2"></i>USB:</span>{{ laptop.usb }}</li>
					<li><span><i class="fa fa-plug mr-2"></i>HDMI:</span>
						<span class='spec' v-if='laptop.hdmi=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>  
					</li>
					<li><span><i class="fa fa-plug mr-2"></i>VGA:</span>
						<span class='spec' v-if='laptop.vga=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>  
					</li>
					<li><span><i class="fa fa-plug mr-2"></i>DVI:</span>
						<span class='spec' v-if='laptop.dvi=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>  
					</li>
					<li><span><i class="fas fa-ethernet mr-2"></i>Ethernet:</span>
						<span class='spec' v-if='laptop.ethernet=="yes"'><i class="fas fa-check mr-2"></i>Yes</span>
						<span class='spec' v-else><i class="fas fa-times mr-2"></i>No</span>  
					</li>
					
				</ul>
			</div>
			<div class="col-md-6">
				<ul class="laptop__feature">
					<li><span><i class="fas fa-sd-card  mr-2"></i>Card Reader:</span>{{ laptop.card_reader }}</li>
					<li><span><i class="fas fa-wifi mr-2"></i>WIFI:</span>{{ laptop.wifi }}</li>
					<li><span><i class="fab fa-bluetooth mr-2"></i>Bluetooth:</span>{{ laptop.bluetooth }}</li>
					<li><span><i class=" 	fas fa-headphones-alt mr-2"></i>Audiojack:</span>{{ laptop.audiojack }}</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- image preview modal	 -->
	<div class="modal fade bd-example-modal-lg" id='laptop_preview' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel " aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
	    <div class="modal-content">
        
	    		<div class="laptop__modal__image">
	    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
						<div v-for='(image,index) in laptopImages' :key='index' :class="index==active_index ?'item active' : 'item'" >
							<figure> 
								<img :src="'/images/laptops/'+ imagefolder(foldername)+'/'+image" alt="">
								<figcaption>
									<i class='fas fa-angle-left' @click='prev_slide'></i>
									<i class='fas fa-angle-right' @click='next_slide'></i>
								</figcaption>
							</figure>
						</div>
					</div>
				 
	    </div>
	  </div>
	</div>
	<!-- image preview modal -->
</section>
</template>

<script>
	export default{
		name:'laptop-detail',
		props:['home_url','laptop'],
		data(){
			return{
				active_index:0,
				laptopImages:null,
				foldername:this.laptop.name,
			}
		},
		methods:{
			next_slide(){
				let slideCount=this.laptopImages.length;
				if(this.active_index+1<slideCount){
					this.active_index++;
				}else{
					this.active_index=0;
				}
			},
			prev_slide(){
				let slideCount=this.laptopImages.length;
				if(this.active_index==0){
					this.active_index=slideCount-1;
				}else{
					this.active_index--;
				}
			},
			setImageActive(index){
				this.active_index=index;
			},
			openImagePreview(){
				$('#laptop_preview').modal('show');
			},
			imagefolder(string){
				return string.replace(/\s/g,'_');
			},
			allimages(){
				let featured_image=[this.laptop.featured_image];
				let related_images=this.laptop.related_images
				this.laptopImages=featured_image.concat(related_images);
			}

		},
		created(){
			this.allimages();
			// setInterval(() => this.next_slide(),6000);
		}
	}
</script>
<style lang='scss' scoped>
	.lap_title{
		font-size: 24px;
	}
	.spec{
		font-weight: 400;
		color: #161616;
		.fa-check{
			color:#30ae0d;
			font-weight: 900;
			font-size: 18px;
		}
		.fa-times{
			color:#ee1818;
			font-weight: 900;
			font-size: 18px;
		}
	}
</style>