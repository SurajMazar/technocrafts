<template>
	<div class="row pt-4 justify-content-center">
		<loader v-if='loading'></loader>
		<div class="col-md-7" v-if='user.role == "admin" '>
			<button class='btn btn-success btn-grn' @click='openModal'><i class="fas fa-plus mr-1"></i>Create Notice</button>
		</div>
		<div class="col-md-7 pt-4" >
			

			<div class="card" style="width: 100%;" v-for='n in notices.data'  :key='n.id'>
			  <img class="card-img-top" :src="n.image" alt="Card image cap" v-if='n.image!="no-image.jpg"'>
			  <div class="dropdown" v-if='n.user_id===user.id'>
					  <button class="btn dropdown-toggle " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
					    <button class="dropdown-item" type="button" @click='editNotice(n.id)'>Edit</button>
					    <button class="dropdown-item" type="button" @click='deleteNotice(n.id)'>Delete</button>
					  </div>
				</div>
			  <div class="card-body">
			    <h5 class="card-title">{{ n.title }}<hr></h5>
			    <p class="card-text grey mb-1">{{ n.created_at | myDate }}</p>
			    <p class="card-text" v-html="n.description"></p>

			    <p class="card-link" style='font-weight: bold'>Posted By : {{ n.user.name }}</p>
			  </div>
			</div>
		</div>


		<div class="col-md-7 pt-2">
			<pagination :data="notices" @pagination-change-page="getResults"></pagination>
		</div>	


		<div class="modal fade " id="notice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" v-if='!editMode' id="exampleModalLongTitle">Create Notice</h5>
		         <h5 class="modal-title" v-else id="exampleModalLongTitle">Edit Notice</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent='editMode? updateNotice() : createNotice()'>
			      <div class="modal-body">
			     		<div class="row">
			     			<div class="col-md-12">
			     				
			     				<!-- brand image -->
			     				<div class="form-group">
				     				<div class="feature-image text-center" v-if='form.image'>
											<figure>
												<img  :src="form.image" alt="">
												<figcaption>
													<i class="fas fa-times" @click='removeImage'></i>
												</figcaption>
											</figure>
										</div>
										
										<div class="file-field text-center">
									    <div class="file btn btn-primary btn-blue font-white">
												<i class="fas fa-image mr-2"></i>
												<span v-if='form.image==null'>Add notice image</span>
												<span v-else>Change notice image</span>
												<input type="file" class="form-control" @change='onFileSelected'> 
											</div>
										</div>
									</div>
			     				<!-- end brand image -->

			     				<div class="form-group">
				        		<label for="name">Title</label>
				        		<input v-model="form.title" type="text" name="name"  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
							      <has-error :form="form" field="title"></has-error>
									</div>

				

									<div class="form-group">
				        		<label for="description">Description</label>
				        		<vue-editor id='editor' v-model="form.description"></vue-editor>
							      <has-error :form="form" field="description"></has-error>
									</div>


			     			</div>
			     		</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
			        <button v-if='editMode' type="submit" class="btn btn-primary  btn-blue font-white">Update</button>
			        <button v-else type="submit" class="btn btn-primary btn-blue font-white">Create </button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>

	</div>
</template>

<script>
	import Swal from 'sweetalert2'
	export default{
		props:['user'],
		data(){
			return{
				loading:true,
				editMode:false,
				form:new Form({
					id:'',
					title:'',
					image:null,
					description:'',
					user_id:'',
				}),
				notices:{},
			}
		},
		methods:{
			openModal(){
				this.editMode=false;
				this.form.reset();
				this.form.clear();
				this.form.user_id=this.user.id;
				$('#notice').modal('show');
			},

			onFileSelected(e){
      	let selectedFile= e.target.files[0];
      	let reader = new FileReader;
      	reader.onload=(selectedFile)=>{
      		this.form.image=reader.result;
      	}
      	reader.readAsDataURL(selectedFile);
      },

      removeImage(){
      	this.editMode_image=false;
      	this.form.image=null;
      },

      createNotice(){
      	this.loading=true;
      	axios.post('/admin/noticeboard/create',this.form).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Notice Created successfully'
          });
          this.loadNotice();
          $('#notice').modal('hide');
          this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      loadNotice(){
      	axios.get('/admin/noticeboard/allNotices').then(res=>{
      		this.notices=res.data;
      		this.loading=false;
      	})
      },

      getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/noticeboard/allNotices/?page=' + page)
        .then(response => {
            this.notices = response.data;
            this.loading=false;
        });
      },

      editNotice(id){
      	this.loading=true
      	this.editMode=true
      	axios.get('/admin/noticeboard/show/'+id).then(res=>{
      		this.form.clear()
      		this.form.reset()
      		this.form.fill(res.data)
      		$("#notice").modal('show')
      		this.loading=false
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },


      updateNotice(){
      	this.loading=true
      	axios.put('/admin/noticeboard/update/'+this.form.id,this.form).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Notice updated successfully'
          });
      		this.loadNotice();
      		$('#notice').modal('hide');
      		this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      deleteNotice(id){
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
		      	axios.get('/admin/noticeboard/delete/'+id).then(()=>{
		      		Toast.fire({
		            icon: 'success',
		            title: 'Notice deleted successfully'
		          });
		      		this.loadNotice();
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


		},
		mounted(){
			this.loadNotice();
		}
	}
</script>

<style scoped lang='scss'>
.card,.card-img-top{
	position: relative;
}
	.dropdown{
		position: absolute;
		top:0;
		right:0;
		background: white;
		color:black;
		border-radius: 0px;
	}
	.feature-image{
		display: flex;
		flex-wrap: wrap;
		justify-content:center;
	}
	.feature-image figure {
    position: relative;
    width: 200px;
}
.card-title{
	font-size: 18px !important;
}
hr{
	width:50%;
}

.grey{
	color:grey;
}
</style>