<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
					<button class="btn btn-primary btn-blue font-white mr-1" @click='openModel'>
						<i class="fas fa-plus mr-2"></i> Create new Ad
					</button>
					<button class="btn btn-danger btn-red font-white" @click='openTrash'>
						<i class="fas fa-trash mr-2"></i> Trash
					</button>
			</div>
		</div>

		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Ads</h6>
						<div class="card-tools">
	            <!-- <div class="input-group input-group-sm" style="width: 150px;">
	              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
	              <div class="input-group-append">
	                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
	              </div>
	            </div> -->
	          </div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
	            <thead>
	              <tr>
	                <th>Name</th>
	                <th>Category</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	            	<tr v-if='ads_length==0'>
	            		<td colspan="4">Sorry! no data found.</td>
	            	</tr>
	            	<tr v-else v-for='ad in ads.data' :key='ad.id'>
	            		<td>{{ ad.name }}</td>
	            		<td class="cat-list">{{ listCats(ad.ads_category) }}</td>
	            		<td>
	            			<button class="btn btn-primary btn-blue font-white mr-1" @click='editAds(ad.id)'>
	            				<i class="fas fa-edit mr-2"></i>Edit
	            			</button>
	            			<button class="btn btn-danger btn-red font-white" @click='trash(ad.id)'>
	            				<i class="fas fa-edit mr-2"></i>Edit
	            			</button>
	            		</td>
	            	</tr>
	            </tbody>
	          </table>
	        </div>
	        <div class="card-body">
	        	<pagination :data="ads" @pagination-change-page="getResults"></pagination>
	        </div>	
				</div>
			</div>
		</div>

		<!-- model for creating ads -->
		<div class="modal fade" id="ad-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" v-if='editmode' id="exampleModalLongTitle">Edit Advertisement</h5>
		        <h5 class="modal-title" v-else id="exampleModalLongTitle">Create Advertisement</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent="editmode? updateAd() : createAd()">
			      <div class="modal-body">
			      	<div class="row">
				        <div class="col-md-6">

				        	<div class="form-group">
				        		<label for="name">Title</label>
				        		<input v-model="form.name" type="text" name="name"  class='form-control' :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Title">
						      <has-error :form="form" field="name"></has-error>
				        	</div>

				        	<div class="form-group">
				        		<label for="ads_url">External url</label>
				        		<input v-model="form.ads_url" type="url" name="ads_url"  class='form-control' :class="{ 'is-invalid': form.errors.has('ads_url') }" placeholder="https://">
						      <has-error :form="form" field="ads_url"></has-error>
				        	</div>

				        	<div class="form-group">
				        		<label for="start_date">Start date</label>
				        		<input v-model="form.start_date" type="date" name="start_date"  class='form-control' :class="{ 'is-invalid': form.errors.has('start_date') }" >
						      <has-error :form="form" field="start_date"></has-error>
				        	</div>

				        	<div class="form-group">
				        		<label for="end_date">End date</label>
				        		<input v-model="form.end_date" type="date" name="end_date"  class='form-control' :class="{ 'is-invalid': form.errors.has('end_date') }">
						      <has-error :form="form" field="end_date"></has-error>
				        	</div>
				        </div>

				        <div class="col-md-6">
				        	<div class="card">
				        		<div class="card-header">
				        			<h6>Category</h6>
				        		</div>
				        		<div class="card-body" style="padding-top: 0;padding-bottom: 0">
				        			<ul class="category">
				        				<li v-for='cat in ads_cats' :key='cat.id'>
				        					<input type="checkbox" class="mr-2" :value='cat.id' v-model='form.category_id'>{{ cat.name }}
				        				</li>
				        			</ul>
				        		</div>
				        	</div>

				        	<div class="card">
				        		<div class="card-header">
				        			<h6>Ads Image</h6>
				        		</div>
				        		<div class="card-body">
				        			<div class="feature-image text-center" v-if='form.ads_image'>
												<figure>
													<img v-if='editmode_image' :src="'/images/advertisement/'+form.ads_image" alt="">
													<img :src="form.ads_image" alt="" v-else>


													<figcaption>
														<i class="fas fa-times" @click='removeFeaturedImage'></i>
													</figcaption>
												</figure>
											</div>
											<div class="form-group">
												<div class="file-field text-center">
											    <div class="file btn btn-primary">
														<i class="fa fa-plus mr-2"></i><span v-if='form.ads_image==null'>Add Ads Image</span><span v-else>Change Ads Image</span>
														<input type="file" class="form-control" @change='onFileSelected'> 
													</div>
												</div>
											</div>
				        		</div>
				        	</div>
				        </div>
				      </div>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="Submit" v-if='editmode' class="btn btn-primary">Update</button>
			        <button type="Submit" v-else class="btn btn-primary">Create</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>

		<div class="modal fade " id="trashAds" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"  id="exampleModalLongTitle">Trash</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
					<div class="modal-body">
						<trash
						 :trashed='trashed' 
						 :trashedCount='trashedCount' 
						 :restore='restore'
						 :getTrashed='getTrashed'
						 ></trash>
					</div>
					 <div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
			      </div>
				</div>
			</div>
		</div>

	</div>
</template>
<script>
	import trash from './AdsTrash.vue';
	export default{
		name:'admin-adsmanager',
		components:{
			trash
		},
		data(){
			return{
				loading:true,
				form:new Form({
					id:'',
					name:'',
					ads_url:'',
					start_date:'',
					end_date:'',
					ads_image:null,
					category_id:[],
				}),
				ads_cats:[],
				ads:{},
				ads_length:'',
				editmode:false,
				editmode_image:false,
				trashed:{},
				trashedCount:0,
			}
		},
		methods:{
			openTrash(){
				$('#trashAds').modal('show')
			},
			openModel(){
				this.editmode=false
				this.editmode_image=false
				this.form.clear();
				this.form.reset();
				$('#ad-model').modal('show')
			},
			loadAds(){
				axios.get('/admin/advertisement/ads_paginated/').then(({data})=>{
					this.ads=data
					this.ads_length=data.data.length
					this.loading=false
				})
			},
			loadTrashed(){
				axios.get('/admin/advertisement/trashed').then(({data})=>{
					this.trashed=data
					this.trashedCount=data.data.length
				})
			},
			loadAdscat(){
				axios.get('/admin/advertisement/category/all_ads_cat/').then(({data})=>{
					this.ads_cats=data
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},
			getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/advertisement/ads_paginated/?page=' + page)
        .then(response => {
            this.ads = response.data;
            this.loading=false;
        });
      },
      getTrashed(page = 1) {
        this.loading=true;
        axios.get('/admin/advertisement/trashed/?page=' + page)
        .then(response => {
            this.trashed = response.data;
            this.loading=false;
        });
      },

      trash(id){
      	this.loading=true
				axios.get('/admin/advertisement/trash/'+ id).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Ad moved to trash successfully'
          })
          this.loadTrashed()
          this.loadAds()
          this.loading=false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

       restore(id){
      	this.loading=true
				axios.get('/admin/advertisement/restore/'+ id).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Ad restored successfully'
          })
          this.loadTrashed()
          this.loadAds()
          this.loading=false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },


			listCats(array){
				let cats='';
				if(array.length){
					if(array.length==1){
						cats=array[0].name;
					}else{
						let catsname=[];
						for (let i=0;i<array.length;i++){
							catsname[i]=array[i].name;
						}
						cats=catsname.join(' , ');
					}
				}else{
					cats='no category'
				}

				return cats;
				
			},
			onFileSelected(e){
				this.editmode_image=false
				let selectedFile= e.target.files[0]

      	let reader = new FileReader;

      	if (selectedFile['size'] < 5242880){
	      	reader.onload=(selectedFile)=>{
	      		this.form.ads_image=reader.result
	      	}
	      }else{
					this.removeFeaturedImage()
          Swal.fire(
            'Opps!!',
            'File size exceeds 5MB.',
            'error'
        	)
        }
      	reader.readAsDataURL(selectedFile)
			},
			removeFeaturedImage(){
				this.editmode_image=false
				this.form.ads_image=null
			},
			createAd(){
				this.loading=true
				axios.post('/admin/advertisement/store/',this.form).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Ad Created successfully'
          })
          this.loadAds()
          $('#ad-model').modal('hide')
          this.loading=false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},

			updateAd(){
				this.loading=true
				axios.put('/admin/advertisement/update/'+this.form.id,this.form).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Ad Updated successfully'
          })
          this.loadAds()
          $('#ad-model').modal('hide')
          this.loading=false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},
			 countNumberofArrayObjectsReturnID(array){
        let i=0;
        let noOfCategory=array.length;
          let categories_id=[];
             for (i = 0; i < array.length; i++){
              categories_id[i] = array[i]["id"];
           }
          return categories_id;
       },
			editAds(id){
				this.editmode=true
				this.editmode_image=true
				let vm=this;
				this.loading=true
				axios.get('/admin/advertisement/show/'+id).then(function(response){
					vm.form.fill(response.data);
          let adscat = response.data.ads_category;
          vm.form.category_id = vm.countNumberofArrayObjectsReturnID(adscat);
           $('#ad-model').modal('show')
          vm.loading=false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			}
		},
		created(){
			this.loadAdscat()
			this.loadTrashed()
			this.loadAds()
		}
	}
</script>

<style scoped lang='scss'>
	.category{
		list-style: none;
		padding:0;
		max-height: 100px;
		overflow: auto;
		li{
			padding-bottom: 10px;
		}
	}
	.feature-image figcaption {
    position: absolute;
    top: -2%;
    right: 0;
	}
	.feature-image img {
    width: 300px;
	}
	.cat-list{
		font-size: 12px;
		white-space:normal;
	}
</style>