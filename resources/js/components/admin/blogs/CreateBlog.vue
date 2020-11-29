<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
				<a :href="blog_page" id='blog-page'>
					<button class="btn btn-danger">
						<i class="fas fa-arrow-left mr-2"></i>
						back to blogs 
					</button>
				</a>
			</div>
		</div>
		<form @submit.prevent='createBlog'>
			<div class="row pt-3">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h6>Create new Post</h6>
						</div>
						<div class="card-body">
							<div class="form-group">
		        		<label for="title">Title</label>
		        		<input v-model="form.title" type="text" name="title" @change='slugGenerate' @keyup='slugGenerate' class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
					      <has-error :form="form" field="title"></has-error>
							</div>

							<div class="form-group">
		        		<label for="slug">Slug</label>
		        		<input v-model="form.slug" type="text" name="slug"  class="form-control" :class="{ 'is-invalid': form.errors.has('slug') }">
					      <has-error :form="form" field="slug"></has-error>
							</div>

							<div class="form-group">
		        		<label for="excerpt">Excerpt</label>
		        		<textarea v-model="form.excerpt"  rows="5"name="excerpt"  class="form-control" :class="{ 'is-invalid': form.errors.has('excerpt') }"></textarea>
					      <has-error :form="form" field="excerpt"></has-error>
							</div>

							<div class="form-group bg-white">
		        		<vue-editor id='editor'v-model="form.description"></vue-editor>
					      <has-error :form="form" field="description"></has-error>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h6>For SEO (Search Engine Optimization)</h6>
						</div>
						<div class="card-body">
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
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h4 class="text-center">
								Actions
							</h4>
						</div>
						<div class="card-body text-center">
							<button class="btn btn-success">
								<i class="fas fa-check mr-2"></i>
								Publish
							</button>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h6>Categories</h6>
						</div>
						<div class="card-body blog-cat">
							<div v-for='category in blogCategories' :key='category.id'>
            		<input type="checkbox" :value='category.id' v-model="form.category_id" class="mr-2" name='category_id'>
            		<label class="cat">{{ category.name }}</label>
            	</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="form-group text-center">
					      <h6 class="mr-10px">Featured Blog</h6>
					      <p class="onoff"><input v-model="form.featured" type="checkbox" name="featured":class="{ 'is-invalid': form.errors.has('featured') }" value="1" id="featured">
				         <label for="featured"></label>
				        </p>
					        <has-error :form="form" field="featured"></has-error>
				      </div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="form-group text-center">
					      <h6 class="mr-10px">Notify Subscribers</h6>
					      <p class="onoff"><input v-model="form.notify_subscriber" type="checkbox" name="notify_subscriber":class="{ 'is-invalid': form.errors.has('notify_subscriber') }" value="1" id="notify_subscriber">
				         <label for="notify_subscriber"></label>
				        </p>
					        <has-error :form="form" field="featured"></has-error>
				      </div>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h6>Featured Image</h6>
						</div>
						<div class="card-body">
							<div class="feature-image text-center" v-if='form.featured_image'>
								<figure>
									<img :src="form.featured_image" alt="">
									<figcaption>
										<i class="fas fa-times" @click='removeFeaturedImage'></i>
									</figcaption>
								</figure>
							</div>
							<div class="form-group">
								<div class="file-field text-center">
							    <div class="file btn btn-primary">
										<i class="fa fa-plus mr-2"></i><span v-if='form.featured_image==null'>Add featured image</span><span v-else>Change featured image</span>
										<input type="file" class="form-control" @change='onFileSelected'> 
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
</template>
<script>
	import { VueEditor } from "vue2-editor";
	export default{
		props:['category','create','blog_page','logged_in_user'],
		components:{
			VueEditor,
		},
		data(){
			return{
				loading:false,
				form:new Form({
					title:'',
					slug:'',
					excerpt:'',
					description:'',
					featured_image:null,
					category_id:[],
					notify_subscriber:false,
					featured:false,
					meta_title:'',
					meta_description:'',
					meta_keyword:'',
					user_id:this.logged_in_user,
				}),
				blogCategories:[],
			}
		},
		methods:{
			slugGenerate(){
        let slug = this.form.title.replace(/\s/g,'-');
        return this.form.slug=slug.toLowerCase();
      },
      onFileSelected(e){
      	let selectedFile= e.target.files[0];

      	let reader = new FileReader;

      	reader.onload=(selectedFile)=>{
      		this.form.featured_image=reader.result;
      	}
      	reader.readAsDataURL(selectedFile);
      },
      removeFeaturedImage(){
      	this.form.featured_image=null;
      },
      loadcategories(){
      	axios.get(this.category).then(({data})=>{
      		this.blogCategories=data;
      	})
      },
      createBlog(){
      	this.loading=true;
      	this.form.post(this.create).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Blog Created successfully'
          })
        	this.form.reset();
        	this.form.clear();
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
			this.loadcategories();
		}
	}
</script>
<style>
	.bg-white{
		background: white;
	}
	.feature-image img{
		max-width: 100%;
	}
	.feature-image figure{
		position: relative;
	}
	.feature-image figcaption{
		position: absolute;
		top: -2%;
		right: 5%;
	}
	.feature-image figcaption i{
		padding: 10px;
		border: 1px solid #bcbcbc;
		background: #fff;
		width: 35px;
		border-radius: 50%;
		box-shadow: 1px 2px 5px rgba(0,0,0,0.2);
		cursor: pointer;
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
	.cat{
		font-weight: 400 !important;
	}
	.blog-cat{
		max-height: 350px;
		overflow-y:scroll;
	}
	.modal{
		transition: all 0.5s ease-in-out; 
	}
</style>
	
