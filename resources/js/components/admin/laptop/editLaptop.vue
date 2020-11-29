<template>
	<div class="addLaptop">
		<loader v-if='loading==true'></loader>
		<div class="card">
      <div class="card-header">
      	<div class="card-tools backbutton">
          <div class="input-group-append float-left">
          	<a :href='laptop_url'  class='mr-2'>
            <button class="btn btn-danger btn-red mr-2" id='back'><i class="fas fa-arrow-left mr-2"></i>Back to Laptop page</button>
            </a>
            <a :href='laptop_url+"/add-laptop/"'  class='mr-2'>
            <button class="btn btn-primary btn-blue font-white" id='back'><i class="fas fa-plus mr-2"></i>Add new Laptop</button>
            </a>
          </div>
        </div>
        <h5>Edit Laptop</h5>
      </div>
    </div>
   	<form class="md-form" @submit.prevent='UpdateLaptop'>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group ">
		    		<div class="card">
		    			<div class="card-header">
              	<h6 class="text-center">Featured Image</h6>
              </div>
              <div class="card-body text-center">
	              <figure class="featured-image-preview" v-if='form.featured_image!=null'>
	              	<img v-if='ImageArrayIsCurrentOrNot(current_related_images,form.featured_image)' :src="form.featured_image" id='preview_image' >
	                <img v-else :src="'/images/laptops/'+ imagefolder(foldername)+'/'+ form.featured_image" id='preview_image' alt="">
	                <figcaption>
	                  <a href="" class="reset_feature_image" @click.prevent='resetImage'>Remove</a>
	                </figcaption>
	              </figure>
	              <div class="file-field text-center">
							    <div class="file btn btn-info btn-blue font-white">
										<i class="fa fa-plus mr-2"></i>Add featured image
										<input type="file" id='featuredImage' @change='onFileSelected'>
									</div>
							  </div>
              </div>
            </div>
          </div>
					<div class="card">
						<div class="card-header">
							<h6 class="text-center">Related Images</h6>
						</div>
						<div class="card-body">
					 		<div class="row">
					
						 			<figure  class="image-preview" v-for='image in form.related_images'>
						 				<img v-if='ImageArrayIsCurrentOrNot(current_related_images,image)' :src="image" id='preview_image' >
						        <img v-else :src="'/images/laptops/'+ imagefolder(foldername)+'/'+ image" id='preview_image' alt="">
						        <figcaption>
						          <a href="" class="reset_image" @click.prevent='removeimage(image)'>Remove</a>
						        </figcaption>
						      </figure>

							</div>
						  <div class="file-field  row justify-content-center">
						  	<button class="btn btn-danger btn-red mr-2" v-if='form.related_images.length>1' @click='removeAllRelatedImage'><i class="fa fa-trash mr-2"></i>Clear all</button>
						    <div class="file btn btn-info btn-blue font-white">
									<i class="fa fa-plus mr-2"></i>Add related images
									<input type="file" multiple id='relatedimages' @change='relatedImagesSelected'>
								</div>
						  </div>
					  </div>
				  </div>
				</div>

				<div class="col-md-8">
								<div class="card">
									<div class="card-header">
										<h5 class="text-center">Laptop Specifications</h5>
									</div>
									<div class="card-body row">
										<div class="col-md-6 form-group">
								      <input v-model="form.name" type="text" name="name" @change='slugGenerate' @keyup='slugGenerate' class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name">
								      <has-error :form="form" field="name"></has-error>
								    </div>
								    <div class="col-md-6 form-group">
								      <input v-model="form.slug" type="text" name="slug"  class="form-control" :class="{ 'is-invalid': form.errors.has('slug') }">
				     					<has-error :form="form" field="slug"></has-error>
								    </div>
								    <div class="col-md-6 form-group">
								      <input v-model="form.dimension" type="text" name="dimension"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('dimension') }" placeholder="Dimension">
								      <has-error :form="form" field="dimension"></has-error>
								    </div>
								    <div class="col-md-6 form-group">
								      <input v-model="form.weight" type="text" name="weight"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('weight') }" placeholder="Weight">
								      <has-error :form="form" field="weight"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								      <input v-model="form.price" type="text" name="price"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }" placeholder="Price">
								      <has-error :form="form" field="price"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								      <input v-model="form.cpu" type="text" name="cpu"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('cpu') }" placeholder="CPU">
								      <has-error :form="form" field="cpu"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								      <input v-model="form.gui" type="text" name="gui"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('gui') }" placeholder="GUI">
								      <has-error :form="form" field="gui"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								      <input v-model="form.hdd" type="text" name="hdd"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('hdd') }" placeholder="HDD/SSD">
								      <has-error :form="form" field="hdd"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								      <input v-model="form.RAM" type="text" name="RAM"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('RAM') }" placeholder="RAM">
								      <has-error :form="form" field="RAM"></has-error>
								    </div>

								    <div class="col-md-6 form-group ">
								      <input v-model="form.battery" type="text" name="battery"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('battery') }" placeholder="Battery">
								      <has-error :form="form" field="battery"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								      <input v-model="form.os" type="text" name="os"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('os') }" placeholder="Operating System">
								      <has-error :form="form" field="os"></has-error>
								    </div>

								    <div class="col-md-6 form-group">
								    	<select class="form-control" v-model='form.brand' required>
								    		<option value="" disabled selected>Select Brand</option>
												<option v-for='brand in LaptopBrands' :key='brand.id' :value="brand.id">{{brand.name}}</option>
								    	</select>
								    </div>
									</div>
								</div>

								<!-- features -->

								<div class="card">
									<div class="card-header">
										<h5 class="text-center">Features</h5>
									</div>
									<div class="card-body row">
										<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Web Camera</h6>
								     <p class="onoff"><input v-model="form.webcamera" type="checkbox" name="webcamera"
								         :class="{ 'is-invalid': form.errors.has('webcamera') }" value="1" id="webcamera">
							         <label for="webcamera"></label>
							        </p>
								        <has-error :form="form" field="webcamera"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">backlit Keyboard</h6>
								     <p class="onoff"><input v-model="form.backlit_keyboard" type="checkbox" name="backlit_keyboard"
								         :class="{ 'is-invalid': form.errors.has('backlit_keyboard') }" value="1" id="backlit_keyboard">
							         <label for="backlit_keyboard"></label>
							        </p>
								        <has-error :form="form" field="hdmi"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Microphone</h6>
								     <p class="onoff"><input v-model="form.microphone" type="checkbox" name="microphone"
								         :class="{ 'is-invalid': form.errors.has('microphone') }" value="1" id="microphone">
							         <label for="microphone"></label>
							        </p>
								        <has-error :form="form" field="microphone"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Optical drive</h6>
								     <p class="onoff"><input v-model="form.optical_drive" type="checkbox" name="optical_drive"
								         :class="{ 'is-invalid': form.errors.has('optical_drive') }" value="1" id="optical_drive">
							         <label for="optical_drive"></label>
							        </p>
								        <has-error :form="form" field="optical_drive"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Speakers</h6>
								     <p class="onoff"><input v-model="form.speakers" type="checkbox" name="speakers"
								         :class="{ 'is-invalid': form.errors.has('speakers') }" value="1" id="speakers">
							         <label for="speakers"></label>
							        </p>
								        <has-error :form="form" field="speakers"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Security Lock</h6>
								     <p class="onoff"><input v-model="form.security_lock" type="checkbox" name="security_lock"
								         :class="{ 'is-invalid': form.errors.has('security_lock') }" value="1" id="security_lock">
							         <label for="security_lock"></label>
							        </p>
								        <has-error :form="form" field="security_lock"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Finger print</h6>
								     <p class="onoff"><input v-model="form.finger_print" type="checkbox" name="finger_print"
								         :class="{ 'is-invalid': form.errors.has('finger_print') }" value="1" id="finger_print">
							         <label for="finger_print"></label>
							        </p>
								        <has-error :form="form" field="finger_print"></has-error>
							    	</div>

							    	<div class="col-md-4 form-group text-center" v-if='form.webcamera'>
							    		<h6 class="mr-10px">Web camera info</h6>
								      <input v-model="form.webcamera_name" type="text" name="webcamera_name"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('webcamera_name') }" placeholder="webcam info (optional)....">
								      <has-error :form="form" field="webcamera_name"></has-error>
							    	</div>

							    	<div class="col-md-4 form-group text-center" v-if='form.speakers'>
							    		<h6 class="mr-10px">Speaker info</h6>
								      <input v-model="form.speaker_name" type="text" name="speaker_name"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('speaker_name') }" placeholder="Speaker info (optional)....">
								      <has-error :form="form" field="speaker_name"></has-error>
							    	</div>

							    	<div class="col-md-4 form-group text-center" v-if='form.security_lock'>
							    		<h6 class="mr-10px">Security Lock info</h6>
								      <input v-model="form.security_lock_name" type="text" name="security_lock_name"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('security_lock_name') }" placeholder="Info (optional)....">
								      <has-error :form="form" field="security_lock_name"></has-error>
							    	</div>


									</div>
								</div>

						    <!-- port conectivity -->
						   
							  <div class="card">
							    <div class="card-header" id="headingOne">
							      <h5 class="mb-0 text-center">
											Ports and connectivity					        
							      </h5>
							    </div>
						      <div class="card-body row">
						       	<div class="col-md-2 form-group text-center" style="padding-top:10px;">
						       		<h6>USB Type</h6>
						       	</div>
						       	<div class="col-md-10 form-group">
								      <input v-model="form.usb" type="text" name="usb"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('usb') }" placeholder="USB ports">
								      <has-error :form="form" field="usb"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">HDMI</h6>
								     <p class="onoff"><input v-model="form.hdmi" type="checkbox" name="hdmi"
								         :class="{ 'is-invalid': form.errors.has('hdmi') }" value="1" id="hdmi">
							         <label for="hdmi"></label>
							        </p>
								        <has-error :form="form" field="hdmi"></has-error>
							    	</div>
							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">VGA</h6>
						     			<p class="onoff"><input v-model="form.vga" type="checkbox" name="vga"
							         :class="{ 'is-invalid': form.errors.has('vga') }" value="1" id="vga">
							         <label for="vga"></label>
							        </p>
							        <has-error :form="form" field="vga"></has-error>
							    	</div>

							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">DVI</h6>
								     <p class="onoff"><input v-model="form.dvi" type="checkbox" name="dvi"
								         :class="{ 'is-invalid': form.errors.has('dvi') }" value="1" id="dvi">
							         <label for="dvi"></label>
							        </p>
								        <has-error :form="form" field="dvi"></has-error>
							    	</div>

							    	<div class="col-md-3 form-group text-center">
								     <h6 class="mr-10px">Ethernet</h6>
								     <p class="onoff"><input v-model="form.ethernet" type="checkbox" name="ethernet"
								         :class="{ 'is-invalid': form.errors.has('ethernet') }" value="1" id="ethernet">
							         <label for="ethernet"></label>
							        </p>
								        <has-error :form="form" field="ethernet"></has-error>
							    	</div>

							    	<div class="col-md-6 form-group">
							    		<h6 class="mr-10px">Card Reader</h6>
								      <input v-model="form.card_reader" type="text" name="card_reader"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('card_reader') }">
								      <has-error :form="form" field="card_reader"></has-error>
							    	</div>
							    	<div class="col-md-6 form-group">
							    		<h6 class="mr-10px">Wifi</h6>
								      <input v-model="form.wifi" type="text" name="wifi"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('wifi') }">
								      <has-error :form="form" field="wifi"></has-error>
							    	</div>

							    	<div class="col-md-6 form-group">
							    		<h6 class="mr-10px">Bluetooth</h6>
								      <input v-model="form.bluetooth" type="text" name="bluetooth"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('bluetooth') }">
								      <has-error :form="form" field="bluetooth"></has-error>
							    	</div>

							    	<div class="col-md-6 form-group">
							    		<h6 class="mr-10px">Audio Jack</h6>
								      <input v-model="form.audiojack" type="text" name="audiojack"
								        class="form-control" :class="{ 'is-invalid': form.errors.has('audiojack') }">
								      <has-error :form="form" field="audiojack"></has-error>
							    	</div>

						      </div>
							  </div>


							  <!-- display -->
								<div class="card">
									<div class="card-header">
										<h5 class="text-center">Display</h5>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6 form-group">
								    		<h6 class="mr-10px">Name</h6>
									      <input v-model="form.display" type="text" name="display"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('display') }">
									      <has-error :form="form" field="display"></has-error>
								    	</div>

								    	<div class="col-md-6 form-group">
								    		<h6 class="mr-10px">Diagonal</h6>
									      <input v-model="form.diagonal" type="text" name="diagonal"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('diagonal') }">
									      <has-error :form="form" field="diagonal"></has-error>
								    	</div>

								    	<div class="col-md-6 form-group">
								    		<h6 class="mr-10px">Resolution</h6>
									      <input v-model="form.resolution" type="text" name="resolution"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('resolution') }">
									      <has-error :form="form" field="resolution"></has-error>
								    	</div>

								    	<div class="col-md-6 form-group">
								    		<h6 class="mr-10px">Pixel Density</h6>
									      <input v-model="form.pixel_density" type="text" name="pixel_density"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('pixel_density') }">
									      <has-error :form="form" field="pixel_density"></has-error>
								    	</div>

										</div>
									</div>
								</div>

								<!-- search engine optimization -->
								<div class="card">
									<div class="card-header">
										<h5 class="text-center">For SEO</h5>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12 form-group">
								    		<h6 class="mr-10px">Meta Title</h6>
									      <input v-model="form.meta_title" type="text" name="meta_title"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('meta_title') }">
									      <has-error :form="form" field="meta_title"></has-error>
								    	</div>

								    	<div class="col-md-12 form-group">
								    		<h6 class="mr-10px">Meta Keyword</h6>
									      <input v-model="form.meta_keyword" type="text" name="meta_keyword"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('meta_keyword') }">
									      <has-error :form="form" field="meta_keyword"></has-error>
								    	</div>

								    	<div class="col-md-12 form-group">
								    		<h6 class="mr-10px">Meta Description</h6>
									      <input v-model="form.meta_description" type="text" name="meta_description"
									        class="form-control" :class="{ 'is-invalid': form.errors.has('meta_description') }">
									      <has-error :form="form" field="meta_description"></has-error>
								    	</div>

										</div>
									</div>
								</div>

								<!-- submit -->
								<div class="card">
									<div class="card-header text-center">
										<button class="btn btn-success btn-grn" type='submit'><i class="fa fa-check mr-2"></i>Update</button>
									</div>
								</div>
								
							</div>
			</div>
    </form>
	</div>
</template>
<script>
	export default{
		props:['laptop_url','brand_url','laptop'],
		data(){
			return{
				loading:false,
				LaptopBrands:[],
				foldername:'',
				current_related_images:{},
				current_Brand:'',
				form:new Form({
					id:'',
					featured_image:null,
					slug:'',
					related_images:[],
					brand:'',
					name:'',
					dimension:'',
					weight:'',
					price:'',
					cpu:'',
					gui:'',
					hdd:'',
					RAM:'',
					battery:'',
					os:'',
					// port connectivity
					usb:'',
					hdmi:'',
					vga:'',
					dvi:'',
					ethernet:'',
					card_reader:'',
					wifi:'',
					bluetooth:'',
					audiojack:'',
					// features
					webcamera:'',
					webcamera_name:'',
					backlit_keyboard:'',
					microphone:'',
					speakers:'',
					speaker_name:'',
					optical_drive:'',
					security_lock:'',
					security_lock_name:'',
					finger_print:'',
					//display
					display:'',
					diagonal:'',
					resolution:'',
					pixel_density:'',

					meta_title:'',
					meta_keyword:'',
					meta_description:'',
				}),
			}
		},
		methods:{
			slugGenerate(){
        let slug = this.form.name.replace(/\s/g,'-');
        return this.form.slug=slug.toLowerCase();
      },
			loadLaptopbrand(){
				this.form.get(this.brand_url+'/brandNoPagination/').then(({data})=>{
					this.LaptopBrands=data;
				});
			},
			removeimage(image){
				let files = this.form.related_images;
				let filtered = files.filter(file => file !== image);
				this.form.related_images=filtered;
			},
			imagefolder(string){
				return string.replace(/\s/g,'_');
			},
			removeAllRelatedImage(){
				this.form.related_images=[];
			},
			resetImage(){
				this.form.featured_image=null;
				document.getElementById("featuredImage").value ="";
			},
			onFileSelected(event){
				let selectedFile = event.target.files[0];
				let reader = new FileReader;
				let vm= this;
				if (selectedFile['size'] < 2111775) {
				reader.onload = function(selectedFile){
					vm.form.featured_image=reader.result;
				}
			}else{
				 Swal.fire(
            'Opps!!',
            'File size exceeds 2MB.',
            'error'
          );
			}

				reader.readAsDataURL(selectedFile);
			},
			relatedImagesSelected(event){
      	let fileList = Array.prototype.slice.call(event.target.files);

      	fileList.forEach(f => {
        let reader = new FileReader();
        let that = this;
      	if (f['size'] < 2111775) {
	        reader.onload = function (event) {
	          that.form.related_images.push(event.target.result);
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
			  countNumberofArrayObjectsReturnID(array){
          let categories_id=array[0]['id'];
           
          return categories_id;
       },
       ImageArrayIsCurrentOrNot(array,element){

			 var mCheckMatchResult = element.match(/^(?:[data]{4}:(text|image|application)\/[a-z]*)/);

       	let query='';
       	if (mCheckMatchResult === null || mCheckMatchResult.length <= 0) {
       	 query=false;
       	}else{
       		query=true;
       	}
       	return query;
       },
			loadLaptop(){
			
					if(this.laptop.vga=='no'){
						this.laptop.vga='';
					}
					if(this.laptop.hdmi=='no'){
						this.laptop.hdmi='';
					}
					if(this.laptop.webcamera=='no'){
						this.laptop.webcamera='';
					}
					if(this.laptop.backlit_keyboard=='no'){
						this.laptop.backlit_keyboard='';
					}
					if(this.laptop.microphone=='no'){
						this.laptop.microphone='';
					}
					if(this.laptop.speakers=='no'){
						this.laptop.speakers='';
					}
					if(this.laptop.optical_drive=='no'){
						this.laptop.optical_drive='';
					}
					if(this.laptop.security_lock=='no'){
						this.laptop.security_lock='';
					}
					if(this.laptop.finger_print=='no'){
						this.laptop.finger_print='';
					}
					if(this.laptop.dvi=='no'){
						this.laptop.dvi='';
					}
					if(this.laptop.ethernet=='no'){
						this.laptop.ethernet='';
					}
					if(this.laptop.related_images=='no-laptop-image.jpg'){
						this.laptop.related_images=[];
					}
					if(this.laptop.featured_image=='no-laptop-image.jpg'){
						this.laptop.featured_image=null;
					}
					this.form.fill(this.laptop);
					this.form.brand=this.countNumberofArrayObjectsReturnID(this.laptop.laptopbrand);
					this.foldername=this.laptop.name;
					this.current_related_images=this.laptop.related_images;
			},
			UpdateLaptop(){
				this.loading=true;
				this.form.put(this.laptop_url+'/update/'+this.form.id).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Updated successfully'
          });
					this.loading=false;
				}).catch(()=>{
					Toast.fire({
            icon: 'error',
            title: 'There is an issue'
          });
					this.loading=false;
				});
			}
		},
		created(){
			this.loadLaptopbrand();
			this.loadLaptop();
		}
	}

</script>

<style scoped>
	.addLaptop{
		padding-top:1em;
	}
	.file {
  position: relative;
  overflow: hidden;
  cursor: pointer!important;
}
.file input {
  position: absolute;
  opacity: 0;
  right: 0;
  top: 0;
  cursor: pointer!important
}
.image-preview {
    margin:0 !important;
  }
  .featured-image-preview{
  	margin:0 !important;
  	text-align: center;
  }
.os_check{
	margin-top:7px;
}
  .featured-image-preview
  	img{
    width:250px;
    padding:10px;
    filter:brightness(80%);
  }
	 .featured-image-preview:hover .reset_feature_image{
    visibility: visible;
  }
  .reset_feature_image{
    color: white;
    visibility:hidden;
    position: absolute;
    margin-top: -15%;
    padding:1em;
    left:15%;
    text-shadow: 0px 3px 4px black;
  }

  .image-preview img{
    width:100px;
    height: 100px;
    padding:10px;
    filter:brightness(80%)
  }
  .reset_image{
    color: white;
    visibility:hidden;
    position: absolute;
    margin-top:-15%;
    padding:1em;
    text-shadow: 0px 3px 4px black;
  }
   .image-preview:hover .reset_image{
    visibility: visible;
  }
</style>