<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<!-- buttons -->
		<div class="row">
			<div class="col-md-12">
				
				<!-- create new brand -->
				<button class="btn btn-primary btn-blue font-white mr-2" @click='openModal'>
					<i class="fas fa-plus mr-2"></i>
					Create new Smartphone brand
				</button>

				<!-- trash page -->
					<button class="btn btn-danger btn-red" @click='openTrash'>
						<i class="fas fa-trash mr-2"></i>
						Trash
					</button>
			</div>
		</div>
		<!-- end buttons -->

		<!-- brands list -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Brands</h3>
						<div class="card-tools">
				      <div class="input-group input-group-sm" style="width: 150px;">
				        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
				        <div class="input-group-append">
				          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
				        </div>
				      </div>
				    </div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
				      <thead>
				        <tr>
				          <th>Logo</th>
				          <th>Name</th>
				          <th>Smartphones</th>
				          <th>Action</th>
				        </tr>
				      </thead>
				      <tbody v-if='brandsLength==0'>
				      	<tr>
				      		<td colspan="6">Sorry, no data found!!</td>
				      	</tr>
				      </tbody>
				      <tbody v-else>
				      	<tr v-for='brand in brands.data' :key='brand.id'>
				      		<td style="display: flex;justify-content: center;">
				      			<div class="brandImage">
				      				<img :src="brand.image"  alt="">
				      			</div>
				      		</td>
				      		<td>{{ brand.name }}</td>
				      		<td>{{ brand.smartphones.length }}</td>
				      		<td>
				      			<button class="btn btn-primary btn-blue font-white mr-2" @click='editModal(brand.id)'><i class="fas fa-edit mr-1"></i>Edit</button>
				      			<button class="btn btn-danger btn-red" @click='trash(brand.id)'><i class="fas fa-trash mr-1"></i>Trash</button>
				      		</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
				  <div class="card-footer">
				  	<pagination :data="brands" @pagination-change-page="getResults"></pagination>
				  </div>
				</div>
			</div>
		</div>
		<!-- end brand list -->

		<!-- create edit brand model  -->
		<div class="modal fade " id="brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" v-if='!editMode' id="exampleModalLongTitle">Create Brand</h5>
		         <h5 class="modal-title" v-else id="exampleModalLongTitle">Edit brand</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent='editMode? updateBrand() : createBrand()'>
			      <div class="modal-body">
			     		<div class="row">
			     			<div class="col-md-12">
			     				
			     				<!-- brand image -->
			     				<div class="form-group">
				     				<div class="feature-image text-center" v-if='form.image'>
											<figure>
												<img  :src="form.image" alt="">
												<figcaption>
													<i class="fas fa-times" @click='removeBrandImage'></i>
												</figcaption>
											</figure>
										</div>
										
										<div class="file-field text-center">
									    <div class="file btn btn-primary btn-blue font-white">
												<i class="fas fa-image mr-2"></i>
												<span v-if='form.image==null'>Add Brand image</span>
												<span v-else>Change featured image</span>
												<input type="file" class="form-control" @change='onFileSelected'> 
											</div>
										</div>
									</div>
			     				<!-- end brand image -->

			     				<div class="form-group">
				        		<label for="name">Name</label>
				        		<input v-model="form.name" type="text" name="name"  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" @change='slugGenerate' @keyup='slugGenerate'>
							      <has-error :form="form" field="name"></has-error>
									</div>

									<div class="form-group">
				        		<label for="slug">Slug</label>
				        		<input v-model="form.slug" type="text" name="slug"  class="form-control" :class="{ 'is-invalid': form.errors.has('slug') }">
							      <has-error :form="form" field="slug"></has-error>
									</div>

									<div class="form-group">
				        		<label for="description">Description</label>
				        		<vue-editor id='editor' v-model="form.description"></vue-editor>
							      <has-error :form="form" field="description"></has-error>
									</div>

									<h6 class="pt-3">
										For SEO (Search Engine Optimization)
										<hr>
									</h6>

									<div class="form-group">
				        		<label for="meta_title">Meta Title</label>
				        		<input v-model="form.meta_title" type="text" name="meta_title"  class="form-control" :class="{ 'is-invalid': form.errors.has('meta_title') }">
							      <has-error :form="form" field="meta_title"></has-error>
									</div>

									<div class="form-group">
				        		<label for="meta_keyword">Meta Keyword</label>
				        		<input v-model="form.meta_keyword" type="text" name="meta_keyword"  class="form-control" :class="{ 'is-invalid': form.errors.has('meta_keyword') }">
							      <has-error :form="form" field="meta_keyword"></has-error>
									</div>

									<div class="form-group">
				        		<label for="meta_description">Meta Description</label>
				        		<input v-model="form.meta_description" type="text" name="meta_description"  class="form-control" :class="{ 'is-invalid': form.errors.has('meta_description') }">
							      <has-error :form="form" field="meta_description"></has-error>
									</div>

			     			</div>
			     		</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
			        <button v-if='editMode' type="submit" class="btn btn-primary  btn-blue font-white">Update</button>
			        <button v-else type="submit" class="btn btn-primary btn-blue font-white">Create brand</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<!-- create edit brand model end -->
		<div class="modal fade " id="trashSmartphoneBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
						 :trashCount='trashCount' 
						 :restore='restore'
						 :getResultsTrashed='getResultsTrashed'
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
	import { VueEditor } from "vue2-editor";
	import trash from './Trash';
	export default{
		components:{
			VueEditor,
			trash
		},
		data(){
			return{
				loading:false,
				form:new Form({
					id:'',
					name:'',
					slug:'',
					image:null,
					description:'',
					meta_title:'',
					meta_description:'',
					meta_keyword:'',
				}),
				editMode:false,
				brands:{},
				brandsLength:'',
				trashed:{},
				trashCount:0,
			}
		},
		methods:{
			
			openModal(){
				this.editMode=false;
				this.form.reset();
				this.form.clear();
				$('#brand').modal('show');
			},
			openTrash(){
				$('#trashSmartphoneBrand').modal('show')
			},

			slugGenerate(){
        let slug = this.form.name.replace(/\s/g,'-');
        return this.form.slug=slug.toLowerCase();
      },

			onFileSelected(e){
      	let selectedFile= e.target.files[0];
      	let reader = new FileReader;
      	reader.onload=(selectedFile)=>{
      		this.form.image=reader.result;
      	}
      	reader.readAsDataURL(selectedFile);
      },

      removeBrandImage(){
      	this.form.image=null;
      },

      createBrand(){
      	this.loading=true;
      	axios.post('/admin/smartphones/brands/create/',this.form).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Brand Created successfully'
          });
          this.loadTrash();
          this.loadBrands();
          $('#brand').modal('hide');
          this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },
      loadBrands(){
      	axios.get('/admin/smartphones/brands/paginated').then(({data})=>{
      		this.brands=data;
      		let brand=data.data;
      		this.brandsLength=brand.length;
      	})
      },
      editModal(id){
      	this.loading=true;
      	this.form.reset();
				this.form.clear();
      	this.editMode=true;
      	let vm=this;
      	axios.get('/admin/smartphones/brands/show/'+id).then(function(response){
      		vm.form.fill(response.data);
      		$('#brand').modal('show');
      		vm.loading=false;
      	});
      },
      updateBrand(){
      	this.loading=true;
      	axios.put('/admin/smartphones/brands/update/'+this.form.id,this.form).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Brand Updated successfully'
          });
          this.loadTrash();
          this.loadBrands();
          $('#brand').modal('hide');
          this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },
      trash(id){
      	this.loading=true;
      	axios.get('/admin/smartphones/brands/trash/'+id).then(()=>{
      		this.loadTrash();
          this.loadBrands();
          this.loading=false;
          Toast.fire({
            icon: 'success',
            title: 'Brand moved to trash successfully'
          });
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
				});
      },
      loadTrash(){
      	axios.get('/admin/smartphones/brands/trashed/').then(res=>{
      		this.trashed=res.data
      		this.trashCount=this.trashed.data.length
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
				});
      },
       restore(id){
      	this.loading=true;
      	axios.get('/admin/smartphones/brands/restore/'+id).then(()=>{
      		this.loadTrash();
          this.loadBrands();
          this.loading=false;
          Toast.fire({
            icon: 'success',
            title: 'Brand restored successfully'
          });
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
				});
      },

      getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/smartphones/brands/paginated/?page=' + page)
        .then(response => {
            this.brands = response.data;
            this.loading=false;
        }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
				});;
      },

        getResultsTrashed(page = 1) {
        this.loading=true;
        axios.get('/admin/smartphones/brands/trashed/?page=' + page)
        .then(response => {
            this.trashed = response.data;
            this.loading=false;
        });
      },

		},
		created(){
			this.loadTrash();
			this.loadBrands();
		}
	}
</script>
<style lang="scss" scoped>
	.feature-image figcaption {
    position: absolute;
    top: -15%;
    right: 34%;
	}
	.brandImage{
		width: 100px;
		height: 100px;
		overflow: hidden;
		img{
			width: 100%;
			height: 100%;
			object-fit: cover;
			overflow: hidden;
			transition: all 0.3s ease-in-out;
			&:hover{
				transform: scale(1.1);
			}
		}
	}

</style>