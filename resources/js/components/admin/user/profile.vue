<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<form @submit.prevent='update'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">Profile setting</div>
				</div>
				<div class="card-body">
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
										
										<div class="file-field text-center">
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

						<!-- <div class="col-md-4">
							<div class="form-group">
         				<label for="role">Role</label>
     						<select class="form-control" v-model='form.role' required>
     							<option selected disabled value='' >Select role</option>
     							<option value='admin'>Admin</option>
     							<option value='author'>Author</option>
     						</select>
     						<has-error :form="form" field="role"></has-error>
         			</div>
						</div> -->

						<!-- <div class="col-md-4">
							<div class="form-group">
         				<label for="email">Email</label>
     						<input type="email" name='email' v-model='form.email' :class="{ 'is-invalid': form.errors.has('email') }" class='form-control'>
     						<has-error :form="form" field="email"></has-error>
         			</div>
						</div> -->
					</div>
				</div>

				<div class="card-footer">
					<button class="btn btn-success btn-grn mr-1"> <i class="fas fa-check mr-1"></i>Update</button>
				</div>
			</div>

		</form>

	</div>
</template>
<script>
  export default{
    props:['user'],
    data(){
      return{
        loading:false,
        form:new Form({
          id:'',
					name:'',
					email:'',
					contact:'',
					gender:'',
					role:'',
					image:null,
					address:'',
				}),
      }
    },
    methods:{
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
            title: 'User updated successfully'
          })
          location.reload();
         this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      } 
    },
    mounted(){
      this.form.fill(this.user)
    }
  }
</script>