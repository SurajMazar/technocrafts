<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary btn-blue font-white mr-2" @click='openModal()'>
					<i class="fas fa-plus mr-2"></i>Create Ads Category
				</button>
				<a :href="ads_category_url+'/trash/'">
					<button class="btn btn-danger btn-red">
						<i class="fas fa-trash mr-2"></i>Trash
					</button>
				</a>
			</div>
		</div>

		<!-- ads category listing -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Ads Categories</h6>
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
	                <th>Name</th>
	                <th>No of ads</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody v-if='!adCatCount'>
	            	<tr>
	            		<td colspan="4">Sorry! no data found.</td>
	            	</tr>
	            </tbody>
	            <tbody v-else>
	            	<tr v-for='cat in adCats.data' :key='cat.id'>
	            		<td>{{ cat.name }}</td>
	            		<td>{{ cat.ads_category.length }}</td>
	            		<td>
	            			<button class="btn btn-primary btn-blue font-white mr-2" @click='editForm(cat.id)'>
	            				<i class="fas fa-edit mr-2"></i>Edit
	            			</button>
	            			<button class="btn btn-danger btn-red mr-2 " @click='trash(cat.id)'>
	            				<i class="fas fa-trash mr-2"></i>Trash
	            			</button>
	            		</td>
	            	</tr>
	            </tbody>
	          </table>
					</div>	
					<div class="card-footer">
		        <pagination :data="adCats" @pagination-change-page="getResults"></pagination>
		      </div>	
				</div>
			</div>
		</div>
		<!-- end ads category listing -->

		<!-- modal for ads categoory -->
		<div class="modal fade" id="ads_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h5 class="modal-title" v-if='editmode' id="exampleModalLongTitle">Edit Ads Category</h5>
		        <h5 class="modal-title" v-else id="exampleModalLongTitle">Create Ads Category</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent="editmode? updateCategory() : createCategory()">
			      <div class="modal-body">
			        <div class="col-md-12">
			        	<div class="form-group">
			        		<label for="name">Category name</label>
			        		<input v-model="form.name" type="text" name="name" @change='slugGenerate' @keyup='slugGenerate' class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Category Name">
					      <has-error :form="form" field="name"></has-error>
			        	</div>
			        	<div class="form-group">
			        		<label for="slug">Slug</label>
				        		<input v-model="form.slug" type="text" name="slug"
						        class="form-control" :class="{ 'is-invalid': form.errors.has('slug') }" placeholder="Slug">
						      <has-error :form="form" field="slug"></has-error>
			        	</div>
			        	<div class="form-group">
			        		<label for="description">Description</label>
			        		<textarea name="description" cols="30" rows="10" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" v-model="form.description"></textarea>
			        		<has-error :form="form" field="description"></has-error>
			        	</div>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
			        <button type="submit" v-if='!editmode' class="btn btn-primary btn-blue font-white">Create</button>
			        <button type="submit" v-else class="btn btn-primary btn-blue font-white">Update</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<!-- end modal for ads category -->

	</div>
</template>
<script>
	export default{
		name:'admin-ads-category',
		props:['ads_category_url'],
		data(){
			return{
				loading:false,
				form:new Form({
					id:'',
					name:'',
					slug:'',
					description:'',
				}),
				adCats:{},
				adCatCount:'',
				editmode:false,
			}
		},
		methods:{
			openModal(){
				this.editmode=false;
				this.form.clear();
				this.form.reset();
				$('#ads_category').modal('show');
			},

			slugGenerate(){
        let slug = this.form.name.replace(/\s/g,'-');
        return this.form.slug=slug.toLowerCase();
      },

      loadAdscategory(){
      	axios.get(this.ads_category_url+'/ads-cat-pagination/').then(({data})=>{
      		this.adCats=data;
      		let cats=data.data;
      		this.adCatCount=cats.length;
      	}).catch(()=>{
      		Toast.fire({
            icon: 'error',
            title: "Error Fetching Categories"
          })
      	});
      },

      getResults(page = 1) {
        this.loading=true;
        axios.get(this.ads_category_url+'/ads-cat-pagination' +'/?page=' + page)
        .then(response => {
            this.adCats = response.data;
            this.loading=false;
        });
      },

      // create category
      createCategory(){
      	this.loading=true;
      	this.form.post(this.ads_category_url+'/create/').then(()=>{
      		Toast.fire({
            icon: 'success',
            title: "Ads' Category Created successfully"
          })
          $('#ads_category').modal('hide');
          this.loadAdscategory();
          this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					Toast.fire({
            icon: 'error',
            title: "An issue occured"
          })
					this.loading=false;
				});
      },
      // end create category
      editForm(id){
      	this.loading=true;
      	this.editmode=true;
      	let vm=this;
      	axios.get(this.ads_category_url+'/edit/'+id).then(function(response){
      		vm.form.fill(response.data);
      		$('#ads_category').modal('show');
      		this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      updateCategory(){
      	this.loading=true;
      	this.form.put(this.ads_category_url+'/update/'+this.form.id).then(()=>{
          this.loading= false;
          this.loadAdscategory();
          $('#ads_category').modal('hide');
          Toast.fire({
            icon: 'success',
            title: "Ads category updated successfully"
          });
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      trash(id){
      	this.loading=true;
      	axios.get(this.ads_category_url+'/trash/'+id).then(()=>{
      		this.loadAdscategory();
      		Toast.fire({
            icon: 'success',
            title: "Ads moved to trash successfully"
          });
          this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      }

		},
		created(){
			this.loadAdscategory();
		}
	}
</script>