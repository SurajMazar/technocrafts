<template>
	<div class="container">
		<loader v-if='loading'></loader>

		<div class="col-md-12">
			<h3 class="text-center">Our Users</h3>
			<div class="col-md-12 text-center">
			<a href='/admin/users/create' class="btn btn-primary btn-blue font-white card-tools"><i class="fas fa-plus mr-1"></i>Create new  User</a>
			</div>
		</div>
		

		<div class="row pt-4 justify-content-center">
			
			<div class="col-md-3" v-for="user in users.data" :key='user.id'>
				<div class="card">
					<div class="card-image">
						<img class="card-img-top" :src="user.image" :alt="user.name">
						<div class="role">
							{{ user.role }}
						</div>
					</div>
				  <div class="card-body pb-0">
				    <h6 class="font text-center" :title='user.name'>{{ user.name | Trim_title(22) }}</h6>
				  </div>
				  <div class="card-body flex">
				    <a  class="btn btn-primary btn-blue font-white mb-1 mr-1" @click='editModal(user.id)'><i class="fas fa-edit mr-1" ></i>Edit</a>
				    <a class="btn btn-dannger btn-red font-white mb-1 mr-1"><i class="fas fa-trash mr-1"></i>Delete</a>
				  </div>
				</div>
			</div>
			
		</div>

		<div class="col-md-12">
			<pagination :data="users" @pagination-change-page="getResults"></pagination>
		</div>
		
		<div class="modal fade " id="user-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
				  <form @submit.prevent='update'>
				  	<div class="col-md-12">
							<div class="row">
								<div class="col-md-12"> 
									<div class="row justify-content-center">
										<!-- brand image -->
										<div class="col-md-4">
							 				<div class="form-group">
							   				<div class="feature-image text-center" v-if='form.image'>
													<figure>
														<img  :src="form.image" alt="">
														<figcaption>
															<i class="fas fa-times" @click='removeImage'></i>
														</figcaption>
													</figure>
												</div>
												
												<div class="file-field text-center pt-2">
											    <div class="file btn btn-primary btn-blue font-white">
														<i class="fas fa-image mr-2"></i>
														<span v-if='form.image==null'>Add profile image</span>
														<span v-else>Change profile image</span>
														<input type="file" class="form-control" @change='onFileSelected'> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="name">Name</label>
		     						<input type="text" name='name' v-model='form.name' :class="{ 'is-invalid': form.errors.has('meta_keyword') }" class='form-control'>
		     						<has-error :form="form" field="meta_keyword"></has-error>
		     						<has-error :form="form" field="name"></has-error>
		         			</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="contact">Contact</label>
		     						<input type="text" name='contact' v-model='form.contact' :class="{ 'is-invalid': form.errors.has('contact') }" class='form-control'>
		     						<has-error :form="form" field="contact"></has-error>
		         			</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="address">Address</label>
		     						<input type="text" name='address' v-model='form.address' :class="{ 'is-invalid': form.errors.has('address') }" class='form-control'>
		     						<has-error :form="form" field="address"></has-error>
		         			</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="gender">Gender</label>
		     						<select class="form-control" v-model='form.gender' required>
		     							<option selected disabled value='' >Select gender</option>
		     							<option value='male'>Male</option>
		     							<option value='female'>Female</option>
		     						</select>
		     						<has-error :form="form" field="gender"></has-error>
		         			</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="role">Role</label>
		     						<select class="form-control" v-model='form.role' required>
		     							<option selected disabled value='' >Select role</option>
		     							<option value='admin'>Admin</option>
		     							<option value='author'>Author</option>
		     						</select>
		     						<has-error :form="form" field="role"></has-error>
		         			</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="email">Email</label>
		     						<input type="email" name='email' v-model='form.email' :class="{ 'is-invalid': form.errors.has('email') }" class='form-control'>
		     						<has-error :form="form" field="email"></has-error>
		         			</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
		         				<label for="password">Password</label>
		     						<input type="password" name='password' v-model='form.password' :class="{ 'is-invalid': form.errors.has('password') }" class='form-control'>
		     						<has-error :form="form" field="password"></has-error>
		         			</div>
								</div>


								<div class="col-md-4">
									<div class="form-group">
		         				<label for="password_confirmation">Confirm password</label>
		     						<input type="password" name='password_confirmation' v-model='form.password_confirmation' :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class='form-control'>
		     						<has-error :form="form" field="password_confirmation"></has-error>
		         			</div>
								</div>
							</div>
							<div class="col-md-12 pb-4">
								<button class="btn btn-success btn-grn mr-1"> <i class="fas fa-check mr-1"></i> Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</template>
<script>
	export default{
		data(){
			return{
				users:{},
				loading:true,
				editUser:{},
				form:new Form({
					id:'',
					name:'',
					email:'',
					contact:'',
					password:'',
					gender:'',
					role:'',
					image:null,
					address:'',
					password_confirmation:'',
				}),
			}
		},
		methods:{


			//load user
			loadUsers(){
				axios.get('/admin/users/paginated').then( res => {
					this.users = res.data 
					this.loading = false
				})
			},
			//end load user function


			// pagination
			getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/users/paginated/?page=' + page)
        .then(response => {
            this.users = response.data;
            this.loading=false;

        }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },
			// end pagination


			// edit user form
			editModal(id){
				this.loading=true

				axios.get('/admin/users/show-user/'+id).then(res=>{
					this.form.fill(res.data)

					const user = res.data
					if(user.image=='/images/users/no-male-image.jpg'){
						this.form.image = null
					}
					if(user.image=='/images/users/no-female-image.jpg'){
						this.form.image = null
					}
					$('#user-edit').modal('show')
					
					this.loading=false
				}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},
			// end edit user form


			onFileSelected(e){
      	let selectedFile= e.target.files[0];
      	let reader = new FileReader;
      	reader.onload=(selectedFile)=>{
      		this.form.image=reader.result;
      	}
      	reader.readAsDataURL(selectedFile);
      },

      removeImage(){
      	this.form.image=null;
      },

      update(){
      	this.loading= true
      	this.form.put('admin/users/update/'+ this.form.id ).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'User Created successfully'
          })
          $('#user-edit').modal('hide')
          this.loadUsers()
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      }


		},

		mounted(){
			this.loadUsers()
		}
	}
</script>
<style scoped>

  .role{
  	position:absolute;
  	top:0;
  	right:0;
  	background:#0071db;
  	padding:0.5em;
  	color:white;
  	width: auto;
  	white-space: nowrap;
  }

	.role::first-letter{
		text-transform: uppercase;
	}

	.card-image{
		height:200px;
		width:100%;
		position:relative;
	}

	.card-image img{
		width:100%;
		height: 100%;
		object-fit:cover;
	}

	.font{
		font-size:14px;
	}

	.flex{
		justify-content: center;
display: flex;
flex-wrap: wrap;
	}

</style>