<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary btn-blue font-white" @click='openmodel'><i class="fas fa-plus mr-2"></i>Create new Category</button>
			</div>
			<div class="col-md-12 pt-3">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Blogs Categories</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
	            <thead>
	              <tr>
	                <th>Name</th>
	                <th>No of Blogs</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            
	            <tbody v-for='category in blogcategories.data' :key='category.id'>
	            	<td>{{ category.name }}</td>
	            	<td>{{ category.blogcategory.length }}</td>
	            	<td>
	            		<button class="btn btn-primary btn-blue font-white mr-1" @click='edit(category.id)'>
	            			<i class="fas fa-edit mr-1"></i>Edit
	            		</button>

	            		<button class="btn btn-danger btn-red font-white mr-1" @click='deleteCat(category.id)'>
	            			<i class="fas fa-trash mr-1"></i>Delete
	            		</button>
	            	</td>
	            </tbody>
	          </table>
					</div>
					 <div class="card-footer" >
		        <pagination :data="blogcategories" @pagination-change-page="getResults"></pagination>
		      </div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="blogcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" v-if='editMode' id="exampleModalLongTitle">Edit Category</h5>
		        <h5 class="modal-title" v-else id="exampleModalLongTitle">Create New Category</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent="editMode ? updateCat() : createCategory()">
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
			        <button type="submit" v-if='editMode' class="btn btn-primary btn-blue font-white">Update Category</button>

			        <button type="submit" v-else class="btn btn-primary btn-blue font-white">Create Category</button>
			      </div>
			    </form>
		    </div>
		  </div>
		</div>

	</div>
</template>
<script>
	export default{
		props:['createroutes','categories'],
		data(){
			return{
				editMode:false,
				loading:false,
				blogcategories:{},
				form:new Form({
					id:'',
					name:'',
					slug:'',
					description:'',
				})
			}
		},
		methods:{
			loadcategories(){
				axios.get(this.categories).then(({data})=>{
					this.blogcategories=data;
				})
			},
			getResults(page = 1) {
        this.loading=true;
        axios.get(this.categories+'/?page=' + page)
        .then(response => {
            this.blogcategories = response.data;
            this.loading=false;
        });
      },
			openmodel(){
				this.editMode = false
				this.form.clear();
				this.form.reset();
				$('#blogcategory').modal('show');
			},
			 slugGenerate(){
        let slug = this.form.name.replace(/\s/g,'-');
        return this.form.slug=slug.toLowerCase();
      },
      pageReload(){
      	location.reload();
      },
			createCategory(){
				this.loading=true;
				this.form.post(this.createroutes).then(()=>{
					$('#blogcategory').modal('hide');
					this.form.clear();
					this.form.reset();
					Toast.fire({
            icon: 'success',
            title: 'Blog\'s Category Created successfully'
          })
					this.loadcategories();
					this.loading=false;
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},


			// edit category
			edit(id){
				this.editMode = true
				this.loading  = true
				axios.get('admin/blogs/category/show/'+id).then(res =>{
					this.form.fill(res.data)
					$('#blogcategory').modal('show');
					this.loadcategories();
					this.loading  = false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				})
			},
			// end edit category

			// updatecategory
			updateCat(){
				this.loading = true
				this.form.put('/admin/blogs/category/update/'+this.form.id).then(() =>{
					Toast.fire({
            icon: 'success',
            title: 'Blog\'s Category updated successfully'
          })
					$('#blogcategory').modal('hide');
					this.loading  = false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				})
			},
			// end update category function

			// delete cat
			deleteCat(id){
				Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
		      	this.loading=true
		      	axios.get('/admin/blogs/category/delete/'+id).then(()=>{
		      		Toast.fire({
		            icon: 'success',
		            title: 'Category deleted successfully'
		          });
		      		this.loadcategories();
		      		this.loading=false;
		      	}).catch((response)=>{
							if(response.message=='Request failed with status code 401'){
								location.reload();
							}
							this.loading=false;
						});
		      }
		    }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			}
			// end delete cat
		},
		created(){
			this.loadcategories();
		}
	}
</script>