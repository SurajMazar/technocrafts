<template>
	<div class="container">
		<loader v-if='loading'></loader>
	  <div class="row">
	  	<div class="col-md-12">
	  		<a :href="create">
	  			<button class="btn btn-primary btn-blue font-white mr-2"><i class="fas fa-plus mr-2"></i>Create new Blog</button>
	  		</a>
	  		<a :href="blog_edit+'/trash/'">
	  			<button class="btn btn-danger btn-red"><i class="fas fa-trash mr-2"></i>Trash</button>
	  		</a>
	  	</div>
	  </div>
	  <div class="row pt-3">
	  	<div class="col-md-12">
		  	<div class="card">
					<div class="card-header">
						<h3 class="card-title">Blogs</h3>
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
				          <th>Views</th>
				          <th>Created at</th>
				          <th>Action</th>
				        </tr>
				      </thead>
				      <tbody v-if='!blogcount'>
				      	<tr>
				      		<td colspan="5">Sorry! no data found.</td>
				      	</tr>
				      </tbody>
				      <tbody v-else>
				      	<tr v-for='blog in allblogs.data' :key='blog.id'>
				      		<td>{{ blog.title | Trim_title(20) }}<span class='featured_article' v-if='blog.featured'>Featured</span></td>
				      		<td class='cat-list'>
				      			<!-- <span v-for='cat in blog.blogcategory' :key='cat.id'>{{ cat.name }}<br></span> -->
				      			{{ listCats(blog.blogcategory) }}
				      		</td>
				      		<td>
				      			<span v-for='author in blog.bloguser' :title='author.name' :key='author.id'>{{ author.name | Trim_title(9)}}</span>
				      		</td>
				      		<td>
				      			{{ blog.views }}
				      		</td>
				      		<td>{{ blog.created_at | myDate }}</td>
				      		<td>
				      			<a  v-if='(user.id==blog.bloguser[0].id) || (user.role=="admin") ' class="btn btn-primary btn-blue font-white mr-1" :href="blog_edit+'/edit/'+ blog.id"><i class="fas fa-edit mr-2"></i>Edit</a>
				      			<button  v-if='(user.id==blog.bloguser[0].id) || (user.role=="admin") ' class="btn btn-danger btn-red" @click='trash(blog.id)'><i class="fas fa-trash mr-2"></i>Trash</button>
				      		</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
				  <div class="card-footer" >
		        <pagination :data="allblogs" @pagination-change-page="getResults"></pagination>
		      </div>
		  	</div>	
		  </div>
		</div>
	</div>
</template>
<script>
	export default{
		props:['create','blogs','blog_edit','user'],
		data(){
			return{
				allblogs:{},
				loading:false,
				blogcount:'',
			}
		},
		methods:{
			loadblogs(){
				axios.get(this.blogs).then(({data})=>{
					this.allblogs=data;
					let blog=data.data;
					this.blogcount=blog.length;
				}).catch();
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
			getResults(page = 1) {
        this.loading=true;
        axios.get(this.blogs+'/?page=' + page)
        .then(response => {
            this.allblogs = response.data;
            this.loading=false;
        });
      },
			trash(id){
				axios.get(this.blog_edit+'/trash/'+id).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Move to trash successfully'
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
<style scoped>
	.featured_article{
		font-size:12px;
		margin-left:10px;
		background: green;
		color:white;
		border-radius:5px;
		padding:2px 6px;
	}
	.cat-list{
		font-size: 12px;
		white-space:normal;
	}
</style>