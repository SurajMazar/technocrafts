<template>
	<div class="container">
	  <div class="row">
	  	<div class="col-md-12">
	  		<a :href="blog_edit">
	  			<button class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i>Back to Blogs</button>
	  		</a>
	  	</div>
	  </div>
	  <div class="row pt-3">
	  	<div class="col-md-12">
		  	<div class="card">
					<div class="card-header">
						<h3 class="card-title">Trash (Blogs)</h3>
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
				          <th>Title</th>
				          <th>Category</th>
				          <th>Author</th>
				          <th>Created at</th>
				          <th>Action</th>
				        </tr>
				      </thead>
				      <tbody v-if='blogCount==0'>
				      	<tr>
				      		<td class='text-center'colspan="5">Sorry , no data found !!</td>
				      	</tr>
				      </tbody v-else>
				      <tbody>
				      	<tr v-for='blog in allblogs.data' :key='blog.id'>
				      		<td>{{ blog.title | Trim_title(40) }}</td>
				      		<td>
				      			<span v-for='cat in blog.blogcategory' :key='cat.id'>{{ cat.name }}<br></span>
				      		</td>
				      		<td>
				      			<span v-for='author in blog.bloguser' :key='author.id'>{{ author.name }}</span>
				      		</td>
				      		<td>{{ blog.created_at | myDate }}</td>
				      		<td>
				      			<button class="btn btn-primary mr-2" @click='restore(blog.id)'><i class="fas fa-recycle mr-2"></i>Restore</button>
				      			<button class="btn btn-danger mr-2"><i class="fas fa-trash mr-2"></i>Delete</button>
				      		</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
		  	</div>	
		  </div>
		</div>
	</div>
</template>
<script>
	export default{
		props:['blog_edit'],
		data(){
			return{
				allblogs:{},
				blogCount:'',
			}
		},
		methods:{
			loadblogs(){
				axios.get(this.blog_edit+'/trashed-blogs/').then(({data})=>{
					this.allblogs=data;
					let blogs=data.data;
					this.blogCount=blogs.length;
				}).catch();
			},
			restore(id){
				axios.get(this.blog_edit+'/restore/'+id).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Blog restored successfully'
          });
          this.loadblogs();
				})
			}
		},
		created(){
			this.loadblogs();
		}
	}
</script>