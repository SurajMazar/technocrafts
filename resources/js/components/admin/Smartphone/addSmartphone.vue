<template>
	<div class="container pt-4">
		<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
				<a href="/admin/smartphones" id='backToSmartphone' class="btn btn-danger btn-red mr-1">
					<i class="fas fa-arrow-left mr-1"></i>Back to smartphones
				</a>
			</div>

			<div class="col-md-12 pt-3">
				<form @submit.prevent='createSmartphone'>

					<div class="col-md-12">
						
           <!-- //basic features -->
          <div class="card">
           	<div class="card-header">
           		<div class="card-title">
           			Add New Smartphone
           		</div>
           	</div>

           	<div class="card-body">
           			
           			<div class="row">
           				
           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="name">Name</label>
           						<input type="text" name='name' v-model='form.name' :class="{ 'is-invalid': form.errors.has('name') }" class='form-control' >
           						<has-error :form="form" field="name"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="technology">Technology</label>
           						<input type="text" name='technology' v-model='form.technology' :class="{ 'is-invalid': form.errors.has('technology') }" class='form-control'>
           						<has-error :form="form" field="technology"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="dimension">Dimension</label>
           						<input type="text" name='dimension' v-model='form.dimension' :class="{ 'is-invalid': form.errors.has('dimension') }" class='form-control'>
           						<has-error :form="form" field="dimension"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="weight">Weight</label>
           						<input type="text" name='weight' v-model='form.weight' :class="{ 'is-invalid': form.errors.has('weight') }" class='form-control'>
           						<has-error :form="form" field="weight"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="price">price</label>
           						<input type="text"  name='price' v-model='form.price' :class="{ 'is-invalid': form.errors.has('price') }" class='form-control' >
           						<has-error :form="form" field="price"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="sim">Sim</label>
           						<input type="text" name='sim' v-model='form.sim' :class="{ 'is-invalid': form.errors.has('sim') }" class='form-control'>
           						<has-error :form="form" field="sim"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="battery">Battery</label>
           						<input type="text" name='battery' v-model='form.battery' :class="{ 'is-invalid': form.errors.has('battery') }" class='form-control'>
           						<has-error :form="form" field="battery"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="os">OS</label>
           						<input type="text" name='os' v-model='form.os' :class="{ 'is-invalid': form.errors.has('os') }" class='form-control'>
           						<has-error :form="form" field="os"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="chipset">Chipset</label>
           						<input type="text" name='chipset' v-model='form.chipset' :class="{ 'is-invalid': form.errors.has('chipset') }" class='form-control'>
           						<has-error :form="form" field="chipset"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="cpu">CPU</label>
           						<input type="text" name='cpu' v-model='form.cpu' :class="{ 'is-invalid': form.errors.has('cpu') }" class='form-control'>
           						<has-error :form="form" field="cpu"></has-error>
           					</div>
           				</div>

           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="gpu">GPU</label>
           						<input type="text" name='gpu' v-model='form.gpu' :class="{ 'is-invalid': form.errors.has('gpu') }" class='form-control'>
           						<has-error :form="form" field="gpu"></has-error>
           					</div>
           				</div>


           				<div class="col-md-4">
           					<div class="form-group ">
           						<label for="ram">RAM</label>
           						<input type="text" name='ram' v-model='form.ram' :class="{ 'is-invalid': form.errors.has('ram') }" class='form-control'>
           						<has-error :form="form" field="ram"></has-error>
           					</div>
           				</div>

           				<div class="col-md-6">
           					<div class="form-group ">
           						<label for="colors">Colors</label>
           						<input type="text" name='colors' v-model='form.colors' :class="{ 'is-invalid': form.errors.has('colors') }" class='form-control'>
           						<has-error :form="form" field="colors"></has-error>
           					</div>
           				</div>


           				<div class="col-md-6">
           					<div class="form-group ">
           						<label for="smartphone_brand_id">Brand</label>
           						<select v-model='form.smbrand_id' class='form-control' required>
           							<option value="" selected disabled>Select brand</option>
           							<option  v-for='b in brands' :key='b.id' :value="b.id">{{ b.name }}</option>
           						</select>
           						<has-error :form="form" field="smartphone_brand_id"></has-error>
           					</div>
           				</div>

           			</div>
         		</div>
          </div>
           <!-- end basic features -->


           <!-- images -->
          <div class="card">
           	<div class="card-header">
           		<div class="card-title">Images</div>
           	</div>
           	<div class="card-body">
           		<div class="row" v-if='form.images.length'>

           				<div class="sm-image"  v-for='image in form.images'>
           					<figure>
           						<img :src="image" alt="">
           						<figcaption @click='removeimage(image)'>
           							<i class="fas fa-times"></i>
           						</figcaption>
           					</figure>
           				</div>
           				

           		</div>
           		<div class="row text-center justify-content-center" v-else>
           			<p class="">Please add an image!</p>
           		</div>
           	</div>
           	<div class="card-footer">
           		<div class="file-field  row justify-content-center">
						  	<button class="btn btn-danger btn-red mr-2" v-if='form.images.length>1' @click='removeAllRelatedImage'><i class="fa fa-trash mr-1"></i>Clear all</button>
						    <div class="file btn btn-primary btn-blue font-white">
									<i class="fa fa-plus mr-1"></i>Add related images
									<input type="file" multiple id='relatedimages' @change='relatedImagesSelected'>
								</div>
						  </div>
           	</div>
          </div>
           <!-- end images -->


           <!-- memory -->
            <div class="card">
	           	<div class="card-header">
	           		<div class="card-title">Memory</div>
	           	</div>
	           	<div class="card-body">
	           		<div class="row">

	           			<div class="col-md-4 ">
		           			<div class="form-group text-center">
								      <h6 class="mr-10px">Card Reader</h6>
								      <p class="onoff"><input v-model="form.card_reader" type="checkbox" name="card_reader":class="{ 'is-invalid': form.errors.has('card_reader') }" value="1" id="card_reader">
							         <label for="card_reader"></label>
							        </p>
								        <has-error :form="form" field="card_reader"></has-error>
							      </div>
						    	</div>

	           			<div class="col-md-4" v-if='form.card_reader'>
		           			<div class="form-group">
		           				<label for="card_reader_description">Card reader description</label>
           						<input type="text" name='card_reader_description' v-model='form.card_reader_description' :class="{ 'is-invalid': form.errors.has('card_reader_description') }" class='form-control'>
           						<has-error :form="form" field="card_reader_description"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="internal_memory">Internal memory</label>
           						<input type="text" name='internal_memory' v-model='form.internal_memory' :class="{ 'is-invalid': form.errors.has('internal_memory') }" class='form-control'>
           						<has-error :form="form" field="internal_memory"></has-error>
		           			</div>
	           			</div>

	           		</div>
	           	</div>
	          </div>
           <!-- end memory -->


           <!-- display -->
            <div class="card">
	           	<div class="card-header">
	           		<div class="card-title">Display</div>
	           	</div>
	           	<div class="card-body">
	           		<div class="row">
	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="display">Display</label>
           						<input type="text" name='display' v-model='form.display' :class="{ 'is-invalid': form.errors.has('display') }" class='form-control'>
           						<has-error :form="form" field="display"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="size">Size</label>
           						<input type="text" name='size' v-model='form.size' :class="{ 'is-invalid': form.errors.has('size') }" class='form-control'>
           						<has-error :form="form" field="size"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="resolution">Resolution</label>
           						<input type="text" name='resolution' v-model='form.resolution' :class="{ 'is-invalid': form.errors.has('resolution') }" class='form-control'>
           						<has-error :form="form" field="resolution"></has-error>
		           			</div>
	           			</div>

	           		</div>
	           	</div>
	          </div>
           <!-- end display -->


           <!-- front camera -->
            <div class="card">
	           	<div class="card-header">
	           		<div class="card-title">Front Camera</div>
	           		<div class="card-tools">
           			  <p class="onoff"><input v-model="frontcamera" type="checkbox" name="card_reader" value="1" id="front">
						         <label for="front"></label>
					        </p>
	           		</div>
	           	</div>
	           	<div class="card-body" v-if='frontcamera'>
	           		<div class="row">
									<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="frontcamera_type">Type</label>
           						<textarea  name='frontcamera_type' v-model='form.frontcamera_type' :class="{ 'is-invalid': form.errors.has('frontcamera_type') }" class='form-control' rows='4'></textarea>
           						<has-error :form="form" field="frontcamera_type"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="frontcamera_feature">Feature</label>
		           				<textarea  name='frontcamera_feature' v-model='form.frontcamera_feature' :class="{ 'is-invalid': form.errors.has('frontcamera_feature') }" class='form-control' rows='4'></textarea>
           						<has-error :form="form" field="frontcamera_feature"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="frontcamera_video">Video</label>
           						<input type="text" name='resolution' v-model='form.frontcamera_video' :class="{ 'is-invalid': form.errors.has('frontcamera_video') }" class='form-control'>
           						<has-error :form="form" field="frontcamera_video"></has-error>
		           			</div>
	           			</div>

	           		</div>
	           	</div>
	          </div>
           <!-- end front camera -->


           <!-- backcamera -->
           	<div class="card">
	           	<div class="card-header">
	           		<div class="card-title">Main Camera</div>
	           		<div class="card-tools">
           			  <p class="onoff"><input v-model="maincamera" type="checkbox" name="card_reader" value="1" id="maincam">
						         <label for="maincam"></label>
					        </p>
	           		</div>
	           	</div>
	           	<div class="card-body" v-if='maincamera'>
	           		<div class="row">
									<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="maincamera_type">Type</label>
           						<textarea  name='maincamera_type' v-model='form.maincamera_type' :class="{ 'is-invalid': form.errors.has('maincamera_type') }" class='form-control' rows='4'></textarea>
           						<has-error :form="form" field="maincamera_type"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="maincamera_feature">Feature</label>
		           				<textarea  name='maincamera_feature' v-model='form.maincamera_feature' :class="{ 'is-invalid': form.errors.has('maincamera_feature') }" class='form-control' rows='4'></textarea>
           						<has-error :form="form" field="maincamera_feature"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="maincamera_video">Video</label>
           						<input type="text" name='maincamera_video' v-model='form.maincamera_video' :class="{ 'is-invalid': form.errors.has('maincamera_video') }" class='form-control'>
           						<has-error :form="form" field="maincamera_video"></has-error>
		           			</div>
	           			</div>

	           		</div>
	           	</div>
	          </div>
           <!-- end back camera -->

           <!-- sound -->
           	<div class="card">
	           	<div class="card-header">
	           		<div class="card-title">Sound</div>
	           	</div>
	           	<div class="card-body">
	           		<div class="row">
								  <div class="col-md-4 ">
		           			<div class="form-group text-center">
								      <h6 class="mr-10px">Loudspeaker</h6>
								      <p class="onoff"><input v-model="form.loudspeaker" type="checkbox" name="loudspeaker":class="{ 'is-invalid': form.errors.has('loudspeaker') }" value="1" id="loudspeaker">
							         <label for="loudspeaker"></label>
							        </p>
								        <has-error :form="form" field="loudspeaker"></has-error>
							      </div>
						    	</div>

						    	<div class="col-md-4" v-if='form.loudspeaker'>
		           			<div class="form-group">
		           				<label for="loudspeaker_description">Loudspeaker description</label>
           						<input type="text" name='loudspeaker_description' v-model='form.loudspeaker_description' :class="{ 'is-invalid': form.errors.has('loudspeaker_description') }" class='form-control'>
           						<has-error :form="form" field="loudspeaker_description"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="headphone_jack">Headphone jack</label>
           						<input type="text" name='headphone_jack' v-model='form.headphone_jack' :class="{ 'is-invalid': form.errors.has('headphone_jack') }" class='form-control'>
           						<has-error :form="form" field="headphone_jack"></has-error>
		           			</div>
	           			</div>


	           		</div>

	           	</div>
	          </div>
           <!-- end sound -->


           <!-- commons -->
           	<div class="card">
	           	<div class="card-header">
	           		<div class="card-title">Commons</div>
	           	</div>
	           	<div class="card-body">
	           		<div class="row">
								<div class="col-md-4 ">
		           			<div class="form-group text-center">
								      <h6 class="mr-10px">GPS</h6>
								      <p class="onoff"><input v-model="form.gps" type="checkbox" name="gps":class="{ 'is-invalid': form.errors.has('gps') }" value="1" id="gps">
							         <label for="gps"></label>
							        </p>
								        <has-error :form="form" field="gps"></has-error>
							      </div>
						    	</div>

						    	<div class="col-md-4 ">
		           			<div class="form-group text-center">
								      <h6 class="mr-10px">NFC</h6>
								      <p class="onoff"><input v-model="form.nfc" type="checkbox" name="nfc":class="{ 'is-invalid': form.errors.has('nfc') }" value="1" id="nfc">
							         <label for="nfc"></label>
							        </p>
								        <has-error :form="form" field="nfc"></has-error>
							      </div>
						    	</div>

						    	<div class="col-md-4 ">
		           			<div class="form-group text-center">
								      <h6 class="mr-10px">Radio</h6>
								      <p class="onoff"><input v-model="form.radio" type="checkbox" name="radio":class="{ 'is-invalid': form.errors.has('radio') }" value="1" id="radio">
							         <label for="radio"></label>
							        </p>
								        <has-error :form="form" field="radio"></has-error>
							      </div>
						    	</div>

						    	<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="wlan">WLAN</label>
           						<input type="text" name='wlan' v-model='form.wlan' :class="{ 'is-invalid': form.errors.has('wlan') }" class='form-control'>
           						<has-error :form="form" field="wlan"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4">
		           			<div class="form-group">
		           				<label for="bluetooth">Bluetooth</label>
           						<input type="text" name='bluetooth' v-model='form.bluetooth' :class="{ 'is-invalid': form.errors.has('bluetooth') }" class='form-control'>
           						<has-error :form="form" field="bluetooth"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-4" v-if='form.gps'>
		           			<div class="form-group">
		           				<label for="gps_description">GPS description</label>
           						<input type="text" name='gps_description' v-model='form.gps_description' :class="{ 'is-invalid': form.errors.has('gps_description') }" class='form-control'>
           						<has-error :form="form" field="gps_description"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-12">
		           			<div class="form-group">
		           				<label for="usb">USB</label>
           						<input type="text" name='usb' v-model='form.usb' :class="{ 'is-invalid': form.errors.has('usb') }" class='form-control'>
           						<has-error :form="form" field="usb"></has-error>
		           			</div>
	           			</div>

	           		</div>
	           	</div>
	          </div>
           <!-- end commons -->


           <!-- seo -->
           	<div class="card">
	           	<div class="card-header">
	           		<div class="card-title">SEO</div>
	           	</div>
	           	<div class="card-body">
	           		<div class="row">
	           			<div class="col-md-12">
		           			<div class="form-group">
		           				<label for="meta_title">Meta title</label>
           						<input type="text" name='meta_title' v-model='form.meta_title' :class="{ 'is-invalid': form.errors.has('meta_title') }" class='form-control'>
           						<has-error :form="form" field="meta_title"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-12">
		           			<div class="form-group">
		           				<label for="meta_keyword">Meta keyword</label>
           						<input type="text" name='meta_keyword' v-model='form.meta_keyword' :class="{ 'is-invalid': form.errors.has('meta_keyword') }" class='form-control'>
           						<has-error :form="form" field="meta_keyword"></has-error>
		           			</div>
	           			</div>

	           			<div class="col-md-12">
		           			<div class="form-group">
		           				<label for="meta_description">Meta description</label>
           						<textarea  name='meta_description' v-model='form.meta_description' :class="{ 'is-invalid': form.errors.has('meta_description') }" class='form-control' rows='4'></textarea>
           						<has-error :form="form" field="meta_description"></has-error>
		           			</div>
	           			</div>
	           		</div>
	           	</div>
	          </div>
           <!-- end seo -->


           <button class="btn btn-success btn-grn mt-2" type='submit'><i class="fas fa-check mr-1"></i>
           	Add Smartphone
           </button>


					</div>
				</form>
			</div>

		</div>
		
	</div>
</template>

<script>
	export default{
		data(){
			return{
				loading:false,
				frontcamera:false,
				maincamera:false,
				form:new Form({
					smbrand_id:'',
					name:'',
					technology:'',
					dimension:'',
					weight:'',
					sim:'',
					price:'',
					battery:'',
					os:'',
					chipset:'',
					cpu:'',
					gpu:'',
					ram:'',
					images:[],
					colors:'',

					// memory
					card_reader:false,
					card_reader_description:'',
					internal_memory:'',

					// display
					display:'',
					size:'',
					resolution:'',

					//front camera
					frontcamera_type:'',
					frontcamera_feature:'',
					frontcamera_video:'',


					// main camera
					maincamera_type:'',
					maincamera_feature:'',
					maincamera_video:'',

					// sound
					loudspeaker:false,
					loudspeaker_description:'',
					headphone_jack:'',

					// commons
					wlan:'',
					bluetooth:'',
					gps:false,
					gps_description:'',
					nfc:false,
					radio:false,
					usb:'',

					// seo
					meta_title:'',
					meta_keyword:'',
					meta_description:'',
				}),
				brands:[],
			}
		},
		methods:{
			removeimage(image){
				let files = this.form.images;
				let filtered = files.filter(file => file !== image);
				this.form.images=filtered;
			},
			removeAllRelatedImage(){
				this.form.images=[];
			},
			resetImage(){
				this.form.featured_image=null;
				document.getElementById("featuredImage").value ="";
			},
			relatedImagesSelected(event){
      	let fileList = Array.prototype.slice.call(event.target.files);

      	fileList.forEach(f => {
        let reader = new FileReader();
        let that = this;
      	if (f['size'] < 2111775) {
	        reader.onload = function (event) {
	          that.form.images.push(event.target.result);
	        }
	      }else{
	      	Swal.fire(
            'Opps!!',
            'File size exceeds 2MB.',
            'error'
          );
	      }
        reader.readAsDataURL(f); 
      });
			},

			createSmartphone(){
				this.loading=true;
				this.form.post('/admin/smartphones/create').then(res=>{
					Toast.fire({
            icon: 'success',
            title: 'Smartphone added successfully',
          });
          document.getElementById('backToSmartphone').click();
          this.loading=false;
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},

			loadBrands(){
				axios.get('admin/smartphones/brands/all').then(res=>{
					this.brands=res.data
					this.loading=false;
				})
			}

		},

		mounted(){
			this.loadBrands()
		}
	}
</script>

<style scoped lang="scss">
	.sm-image{
		width:100px;
		padding:10px 5px;
		figure{
			width:100%;
			height: 100%;
			position: relative;
			img{
				width:100%;
				height: 100%;
				object-fit: cover;
			}
			figcaption{
				position: absolute;
				top: 0;
				right: 0;
				background: white;
				padding:1px 3px;
				border:1px solid #bcbcbc;
				cursor: pointer;
				pointer-events: s
			}
		}
	}
</style>