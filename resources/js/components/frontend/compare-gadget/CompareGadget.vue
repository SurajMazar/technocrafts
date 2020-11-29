<template>
	<div>
	<div class="row">
		<loader-front v-if='loading'></loader-front>
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">
						<h5 class="text-center">Compare Gadget</h5>
					</div>

					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-md-4">
								<div class="form-group">
									<h6 for="gadget" class='text-center'>Select Gadget Type</h6>
									<select class="form-control" name="gadget_type" v-model='gadget_type' @change='loadbrands'>
										<option value="" selected disabled>Select gadget</option>
										<option value="laptop">Laptops</option>
										<option value="phone">Smart phone</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">

							<div class="col-md-6">
								<h6 class="text-center">Gadget 1st brand</h6>
								<div class="form-group">
									<select class="form-control" name='first_brand' v-model='first_brand' @change="loadFirstGadgets" >
										<option value="" selected disabled>Select brand</option>
										<option v-for='b in gadget_brands' :key='b.id' :value="b.id" >{{ b.name }}</option>
									</select>
								</div>
								<div class="form-group">
									<h6 class="text-center">1st Gadget</h6>
									<select name="first_gadget" class="form-control" v-model='first_gadget'>
										<option value="" selected disabled>Select gadget</option>
										<option v-for='b in first_gadgets' :key='b.id' :value="b.id">{{ b.name }}</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<h6 class="text-center">Gadget 2nd brand</h6>
								<div class="form-group">
									<select class="form-control" name="second_brand" v-model='second_brand' @change="loadSecondGadgets">
										<option value="" selected disabled>Select brand</option>
										<option v-for='b in gadget_brands' :key='b.id' :value="b.id" >{{ b.name }}</option>
									</select>
								</div>
								<div class="form-group">
									<h6 class="text-center">2nd Gadget</h6>
									<select name="second_gadget" class="form-control" v-model='second_gadget'>
										<option value="" selected disabled>Select gadget</option>
										<option v-for='b in second_gadgets' :key='b.id' :value="b.id">{{ b.name }}</option>
									</select>
								</div>	
							</div>
						</div>
						<div class='row justify-content-center'>		
							<div class="col-md-6 text-center" v-if='comparable()'>
								<div class="form-group">
									<button class="btn btn-success btn-grn" type='submit' @click='compare'>Compare</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<ads-1-col slug='compare-gadget-page'></ads-1-col>

			</div>
	</div>
	<div class="rows" v-if='gadget_type=="laptop"'>
		<div class="col-md-12" v-if='(first_laptop!="")&&(second_laptop!="")'>
					<button class='btn btn-danger btn-red mr-2'  @click='Excel'><i class=" 	fas fa-file-excel mr-1"></i>Export excel</button>
					<button class='btn btn-primary btn-blue ' style="color:white" @click='laptopCompareTableJPG'><i class='fas fa-image mr-1'></i>Export as JPG</button>
		</div>
		<div class="row pt-3 justify-content-center" id='comparisionTable'>
			<div class="col-md-12" v-if='(first_laptop!="")&&(second_laptop!="")'>
				
					<div class="card width100">
						<div class="card-header" >
							<h3 class="text-center" >Comparision Table</h3>
						</div>
						<div class="card-body table-responsive p-0" style="overflow:auto">
	        		<table class="table table-hover text-nowrap comp-table" id='ltable'>
	    				<tbody>
	        			<tr>
	        				<td class='des-title'>Featured Image</td>
	        				<td><img :src="'images/laptops/'+imagefolder(first_laptop.name)+'/'+first_laptop.featured_image" alt="" style="width: 200px"></td>
	        				<td><img :src="'images/laptops/'+imagefolder(second_laptop.name)+'/'+second_laptop.featured_image" alt="" style="width: 200px"></td>
	        			</tr>
	        			<tr>
	        				<td class='des-title'>Name</td>
	        				<td>{{ first_laptop.name }}</td>
	        				<td>{{ second_laptop.name }}</td>
	        			</tr>
	        			 <tr>
	        				<td class='des-title'>Brand</td>
	        				<td v-for='brand in first_laptop.laptopbrand'>{{ brand.name}}</td>
	        				<td v-for='brand in second_laptop.laptopbrand'>{{ brand.name}}</td>
	        			</tr>
						 		<tr>
	        				<td class='des-title'>Dimension</td>
	        				<td>{{ first_laptop.dimension }}</td>
	        				<td>{{ second_laptop.dimension }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Weight</td>
	        				<td>{{ first_laptop.weight }}</td>
	        				<td>{{ second_laptop.weight }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Price</td>
	        				<td>{{ first_laptop.price | dollar }}</td>
	        				<td> {{ second_laptop.price | dollar }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>CPU</td>
	        				<td>{{ first_laptop.cpu }}</td>
	        				<td>{{ second_laptop.cpu }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>GUI</td>
	        				<td>{{ first_laptop.gui }}</td>
	        				<td>{{ second_laptop.gui }}</td>
	        			</tr>

								<tr>
	        				<td class='des-title'>Storage</td>
	        				<td>{{ first_laptop.hdd }}</td>
	        				<td>{{ second_laptop.hdd }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>RAM</td>
	        				<td>{{ first_laptop.RAM }}</td>
	        				<td>{{ second_laptop.RAM }}</td>
	        			</tr>
	        			<tr>
	        				<td class='des-title'>Battery</td>
	        				<td>{{ first_laptop.battery }}</td>
	        				<td>{{ second_laptop.battery }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Operating System</td>
	        				<td>{{ first_laptop.os }}</td>
	        				<td>{{ second_laptop.os }}</td>
	        			</tr>

								<tr>
									<td colspan="3" class="bg-blue" ><h3 class="text-center">Connectivity and Ports</h3></td>
								</tr>
						
								<tr>
	        				<td class='des-title'>USB</td>
	        				<td style='white-space: break-spaces;'>{{ first_laptop.usb }}</td>
	        				<td style='white-space: break-spaces;'>{{ second_laptop.usb }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>HDMI</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.hdmi=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='first_laptop.hdmi=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
								<tr>
	        				<td class='des-title'>VGA</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.vga=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='first_laptop.vga=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
								<tr>
	        				<td class='des-title'>DVI</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.dvi=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='first_laptop.dvi=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Ethernet</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.ethernet=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='first_laptop.ethernet=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Card Reader</td>
	        				<td>{{first_laptop.card_reader}}</td>
	        				<td>{{second_laptop.card_reader}}</td>
	        			</tr>
						
								<tr>
	        				<td class='des-title'>Wifi</td>
	        				<td>{{first_laptop.wifi}}</td>
	        				<td>{{second_laptop.wifi}}</td>
	        			</tr>
						
								<tr>
	        				<td class='des-title'>Bluetooth</td>
	        				<td>{{first_laptop.bluetooth}}</td>
	        				<td>{{second_laptop.bluetooth}}</td>
	        			</tr>
						
								<tr>
	        				<td class='des-title'>Audiojack</td>
	        				<td>{{first_laptop.audiojack}}</td>
	        				<td>{{second_laptop.audiojack}}</td>
	        			</tr>
								<tr>
									<td colspan="3"class="bg-blue" ><h3 class="text-center">Features</h3></td>
								</tr>
						    <tr>
	        				<td class='des-title'>Web Camera</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.webcamera=="yes"'></i> <i class='fa fa-ban' v-else></i>{{ first_laptop.webcamera_name }}</td>
	        				<td><i class='fa fa-check' v-if='second_laptop.webcamera=="yes"'></i> <i class='fa fa-ban' v-else></i>{{ second_laptop.webcamera_name }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Backlit Keyboard</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.backlit_keyboard=="yes"'></i> <i class='fa fa-ban' v-else></i>{{ first_laptop.security_lock_name }}</td>
	        				<td><i class='fa fa-check' v-if='second_laptop.backlit_keyboard=="yes"'></i> <i class='fa fa-ban' v-else></i>{{ second_laptop.security_lock_name }}</td>
	        			</tr>

								<tr>
	        				<td class='des-title'>Microphone</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.microphone=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='second_laptop.microphone=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
						
								<tr>
	        				<td class='des-title'>Speaker</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.speakers=="yes"'></i> <i class='fa fa-ban' v-else></i>{{ first_laptop.speaker_name }}</td>
	        				<td><i class='fa fa-check' v-if='second_laptop.speakers=="yes"'></i> <i class='fa fa-ban' v-else></i>{{ second_laptop.speaker_name }}</td>
	        			</tr>
					
						    <tr>
	        				<td class='des-title'>Optical Drive</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.optical_drive=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='second_laptop.optical_drive=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
						
						    <tr>
	        				<td class='des-title'>Security Lock</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.security_lock=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='second_laptop.security_lock=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
						
								<tr>
	        				<td class='des-title'>Finger Print</td>
	        				<td><i class='fa fa-check' v-if='first_laptop.finger_print=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        				<td><i class='fa fa-check' v-if='second_laptop.finger_print=="yes"'></i> <i class='fa fa-ban' v-else></i></td>
	        			</tr>
						<!-- display -->
								<tr>
									<td colspan="3" class="bg-blue" ><h3 class="text-center">Display Details</h3></td>
								</tr>
								<tr>
	        				<td class='des-title'>Display</td>
	        				<td>{{ first_laptop.display }}</td>
	        				<td>{{ second_laptop.display }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Diagonal</td>
	        				<td>{{ first_laptop.diagonal }}</td>
	        				<td>{{ second_laptop.diagonal }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Resolution</td>
	        				<td>{{ first_laptop.resolution }}</td>
	        				<td>{{ second_laptop.resolution }}</td>
	        			</tr>
								<tr>
	        				<td class='des-title'>Pixel Density</td>
	        				<td>{{ first_laptop.pixel_density }}</td>
	        				<td>{{ second_laptop.pixel_density }}</td>
	        			</tr>
	        			</tbody>
	        		</table>
						</div>
					</div>
				</div>
		</div>
	</div>

	<div class="row" v-else>
		<div class="col-md-12" v-if='(first_laptop!="")&&(second_laptop!="")'>
			<button class='btn btn-success btn-grn mr-2'  @click='Excel'><i class=" 	fas fa-file-excel mr-1"></i>Export excel</button>
			<button class='btn btn-primary btn-blue ' style="color:white" @click='smartphoneCompareTableJPG'><i class='fas fa-image mr-1'></i>Export as JPG</button>
			<div class="row pt-3 justify-content-center" id='comparisionTableSm'>
			<div class="col-md-12" v-if='(first_laptop!="")&&(second_laptop!="")'>
				
					<div class="card width100">
						<div class="card-header" >
							<h3 class="text-center" >Comparision Table</h3>
						</div>
						<div class="card-body table-responsive p-0" style="overflow:auto">
	        		<table class="table table-hover text-nowrap comp-table" id='smtable'>
	    				 <tbody>
		        			<tr>
		        				<td class='des-title'>Featured Image</td>
		        				<td>
		        					<figure class='sm-img'>
		        						<img :src="first_laptop.images[0]" alt="" >
		        					</figure></td>
		        				<td><figure class='sm-img'>
		        					<img :src="second_laptop.images[0]" alt="">
		        				</figure></td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Name</td>
		        				<td>{{ first_laptop.name }}</td>
		        				<td>{{ second_laptop.name }}</td>
		        			</tr>
		        			<tr>
		        				<td class='des-title'>Brand</td>
		        				<td>{{ first_laptop.brand.name }}</td>
		        				<td>{{ second_laptop.brand.name }}</td>
		        			</tr>


		        			<tr>
		        				<td class='des-title'>Technology</td>
		        				<td>{{ first_laptop.technology }}</td>
		        				<td>{{ second_laptop.technology }}</td>
		        			</tr>


		        			<tr>
		        				<td class='des-title'>Dimension</td>
		        				<td>{{ first_laptop.dimension }}</td>
		        				<td>{{ second_laptop.dimension }}</td>
		        			</tr>


		        			<tr>
		        				<td class='des-title'>Weight</td>
		        				<td>{{ first_laptop.weight }}</td>
		        				<td>{{ second_laptop.weight }}</td>
		        			</tr>


		        			<tr>
		        				<td class='des-title'>Sim</td>
		        				<td>{{ first_laptop.sim }}</td>
		        				<td>{{ second_laptop.sim }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Price</td>
		        				<td>{{ first_laptop.price | dollar }}</td>
		        				<td>{{ second_laptop.price | dollar  }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Battery</td>
		        				<td>{{ first_laptop.battery }}</td>
		        				<td>{{ second_laptop.battery }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Operating System</td>
		        				<td>{{ first_laptop.os }}</td>
		        				<td>{{ second_laptop.os }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Chipset</td>
		        				<td>{{ first_laptop.chipset }}</td>
		        				<td>{{ second_laptop.chipset }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>CPU</td>
		        				<td>{{ first_laptop.cpu }}</td>
		        				<td>{{ second_laptop.cpu }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>GPU</td>
		        				<td>{{ first_laptop.gpu }}</td>
		        				<td>{{ second_laptop.gpu }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>RAM</td>
		        				<td>{{ first_laptop.ram }}</td>
		        				<td>{{ second_laptop.ram }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Colors</td>
		        				<td>{{ first_laptop.colors }}</td>
		        				<td>{{ second_laptop.colors }}</td>
		        			</tr>


		        			<tr>
										<td colspan="3" class="bg-blue" ><h3 class="text-center">Memory</h3></td>
									</tr>

									<tr>
		        				<td class='des-title'>Card reader</td>
		        				<td>
		        					<span v-if='first_laptop.card_reader'>Yes, {{ first_laptop.card_reader_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        				<td>
		        				<span v-if='second_laptop.card_reader'>Yes, {{ second_laptop.card_reader_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Internal Memory</td>
		        				<td>{{ first_laptop.internal_memory }}</td>
		        				<td>{{ second_laptop.internal_memory }}</td>
		        			</tr>


									<tr>
										<td colspan="3" class="bg-blue" ><h3 class="text-center">Display </h3></td>
									</tr>

									<tr>
		        				<td class='des-title'>Name</td>
		        				<td>{{ first_laptop.display }}</td>
		        				<td>{{ second_laptop.display }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Size</td>
		        				<td>{{ first_laptop.size }}</td>
		        				<td>{{ second_laptop.size }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Resolution</td>
		        				<td>{{ first_laptop.resolution }}</td>
		        				<td>{{ second_laptop.resolution }}</td>
		        			</tr>

									<tr>
										<td colspan="3" class="bg-blue" ><h3 class="text-center">Front Camera</h3></td>
									</tr>
									
									<tr>
		        				<td class='des-title'>Type</td>
		        				<td>{{ first_laptop.frontcamera_type }}</td>
		        				<td>{{ second_laptop.frontcamera_type }}</td>
		        			</tr>
		        			<tr>
		        				<td class='des-title'>Feature</td>
		        				<td>{{ first_laptop.frontcamera_feature }}</td>
		        				<td>{{ second_laptop.frontcamera_feature }}</td>
		        			</tr>
		        			<tr>
		        				<td class='des-title'>Video</td>
		        				<td>{{ first_laptop.frontcamera_video }}</td>
		        				<td>{{ second_laptop.frontcamera_video }}</td>
		        			</tr>


									<tr>
										<td colspan="3" class="bg-blue" ><h3 class="text-center">Main Camera</h3></td>
									</tr>


									<tr>
		        				<td class='des-title'>Type</td>
		        				<td>{{ first_laptop.maincamera_type }}</td>
		        				<td>{{ second_laptop.maincamera_type }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Feature</td>
		        				<td>{{ first_laptop.maincamera_feature }}</td>
		        				<td>{{ second_laptop.maincamera_feature }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Video</td>
		        				<td>{{ first_laptop.maincamera_video }}</td>
		        				<td>{{ second_laptop.maincamera_video }}</td>
		        			</tr>

									<tr>
										<td colspan="3" class="bg-blue" ><h3 class="text-center">Sounds</h3></td>
									</tr>
								
		

									<tr>
		        				<td class='des-title'>Loudspeaker</td>
		        				<td>
		        					<span v-if='first_laptop.loudspeaker'>Yes, {{ first_laptop.loudspeaker_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        				<td>
		        				<span v-if='second_laptop.loudspeaker'>Yes, {{ second_laptop.loudspeaker_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Headphone jack</td>
		        				<td>{{ first_laptop.headphone_jack }}</td>
		        				<td>{{ second_laptop.headphone_jack }}</td>
		        			</tr>



									<tr>
										<td colspan="3" class="bg-blue" ><h3 class="text-center">Commons</h3></td>
									</tr>

									<tr>
		        				<td class='des-title'>Wlan</td>
		        				<td>{{ first_laptop.wlan }}</td>
		        				<td>{{ second_laptop.wlan }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Bluetooth</td>
		        				<td>{{ first_laptop.bluetooth }}</td>
		        				<td>{{ second_laptop.bluetooth }}</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>gps</td>
		        				<td>
		        					<span v-if='first_laptop.gps'>Yes, {{ first_laptop.gps_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        				<td>
		        				<span v-if='second_laptop.gps'>Yes, {{ second_laptop.gps_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>GPS</td>
		        				<td>
		        					<span v-if='first_laptop.gps'>Yes, {{ first_laptop.gps_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        				<td>
		        				<span v-if='second_laptop.gps'>Yes, {{ second_laptop.gps_description }}</span>
		        					<span v-else>No</span>
		        				</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>NFC</td>
		        				<td>
		        					<span v-if='first_laptop.nfc'>Yes</span>
		        					<span v-else>No</span>
		        				</td>
		        				<td>
		        				<span v-if='second_laptop.nfc'>Yes</span>
		        					<span v-else>No</span>
		        				</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>Radio</td>
		        				<td>
		        					<span v-if='first_laptop.radio'>Yes</span>
		        					<span v-else>No</span>
		        				</td>
		        				<td>
		        				<span v-if='second_laptop.radio'>Yes</span>
		        					<span v-else>No</span>
		        				</td>
		        			</tr>

		        			<tr>
		        				<td class='des-title'>USB</td>
		        				<td>{{ first_laptop.usb }}</td>
		        				<td>{{ second_laptop.usb }}</td>
		        			</tr>


		       
	        			</tbody>
	        		</table>
						</div>
					</div>
				</div>
		</div>
		</div>
	</div>
</div>
</template>

<script>
	
	export default{
		data(){
			return{
				loading:false,
				gadget_type:'',
				gadget_brands:[],
				first_brand:'',
				second_brand:'',
				first_gadgets:[],
				second_gadgets:[],
				first_gadget:'',
				second_gadget:'',
				first_laptop:'',
				second_laptop:'',
			}
		},
		methods:{

			loadbrands(){
				this.loading=true
				this.gadget_brands=[];
				let path = '/api/brands/smarphone'
				if(this.gadget_type=='laptop'){
					 path = '/api/brands/laptop'
				}
				axios.get(path).then(({data})=>{
						this.gadget_brands=data
						this.first_brand=''
						this.second_brand=''
						this.first_gadgets=''
						this.second_gadgets=""
						this.first_gadget=""
						this.second_gadget=""
						this.first_laptop=''
				    this.second_laptop=''
						this.loading=false
					})

			},

			loadFirstGadgets(){
				if(this.gadget_type=='laptop'){
					this.gadget_brands.map(b=>{
						if(b.id===this.first_brand){
							this.first_gadgets=b.laptopbrand
							this.first_gadget=""
						}
					})
				}else{
					this.gadget_brands.map(b=>{
						if(b.id===this.first_brand){
							this.first_gadgets=b.smartphones
							this.first_gadget=""
						}
					})
				}
				
			},

			loadSecondGadgets(){

				if(this.gadget_type=='laptop'){
					this.gadget_brands.map(b=>{
						if(b.id===this.second_brand){
							this.second_gadgets=b.laptopbrand
							this.second_gadget=""
						}
					})
				}else{
					this.gadget_brands.map(b=>{
						if(b.id===this.second_brand){
							this.second_gadgets=b.smartphones
							this.second_gadget=""
						}
					})
				}
			},

			comparable(){
				if(this.first_gadget!==''){
					if(this.second_gadget!==''){
						return true
					}
				}

				return false
			},

			imagefolder(string){
				return string.replace(/\s/g,'_');
			},

			compare(){
				this.loading=true
				if(this.gadget_type=='laptop'){
					axios.get('/api/get-laptop/'+this.first_gadget).then(res=>{
						this.first_laptop=res.data;
					})
					axios.get('/api/get-laptop/'+this.second_gadget).then(res=>{
						this.second_laptop=res.data;
						this.loading=false
					})
				}else{
					axios.get('/api/get-smartphone/'+this.first_gadget).then(res=>{
						this.first_laptop=res.data;
					})
					axios.get('/api/get-smartphone/'+this.second_gadget).then(res=>{
						this.second_laptop=res.data;
						this.loading=false
					})
				}
			},

			comparePDF(){
				let that= this
			  html2canvas(document.getElementById('comparisionTable'), {
              onrendered: function (canvas) {
                  var data = canvas.toDataURL();
                  var docDefinition = {
                      content: [{
                          image: data,
                          fit:[500,700]
                      }]
                  };
                  pdfMake.createPdf(docDefinition).download(that.first_laptop.slug+"-vs-"+that.second_laptop.slug+".pdf");
              }
          });
			},

			laptopCompareTableJPG(){
				let that= this
        var resultDiv = document.getElementById("result");
        html2canvas(document.getElementById("comparisionTable"), {
            onrendered: function(canvas) {
                var a = document.createElement('a');
			        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
			        a.href = canvas.toDataURL("image/jpg").replace("image/jpg", "image/octet-stream");
			        a.download = that.first_laptop.slug+"-vs-"+that.second_laptop.slug+".jpg"
			        a.click();
            }
        });  
			},
			smartphoneCompareTableJPG(){
				let that= this
        var resultDiv = document.getElementById("result");
        html2canvas(document.getElementById("comparisionTableSm"), {
            onrendered: function(canvas) {
                var a = document.createElement('a');
			        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
			        a.href = canvas.toDataURL("image/jpg").replace("image/jpg", "image/octet-stream");
			        a.download = that.first_laptop.name+"-vs-"+that.second_laptop.name+".jpg"
			        a.click();
            }
        });
			},

			Excel()
			{
			    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
			    var textRange; var j=0;
			    var tab
			    if(this.gadget_type=='laptop'){
 								tab = document.getElementById('ltable'); 
			    }else{
			     tab = document.getElementById('smtable'); 
			    }
			    // id of table

			    for(j = 0 ; j < tab.rows.length ; j++) 
			    {     
			        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
			        //tab_text=tab_text+"</tr>";
			    }

			    tab_text=tab_text+"</table>";
			    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
			    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
			    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

			    var ua = window.navigator.userAgent;
			    var msie = ua.indexOf("MSIE "); 

			    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
			    {
			        txtArea1.document.open("txt/html","replace");
			        txtArea1.document.write(tab_text);
			        txtArea1.document.close();
			        txtArea1.focus(); 
			        let sa=txtArea1.document.execCommand("SaveAs",true,"compare");
			    }  
			    else                 //other browser not tested on IE 11

			    return (window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text)));
			}



		}
	}
</script>

<style scoped lang='scss'>
	.sm-img{
		width:100%;
		height:130px;
		text-align: center;
		img{
			width:auto;
			height:100%;
			object-fit: cover;
		}
	}
	
	td{
		white-space: break-spaces;
	}
</style>