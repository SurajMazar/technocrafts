<template>
	<div class="col-md-12 text-center">
		<button class="btn btn-primary btn-blue font-white" @click='open'>
			<i class="fas fa-pen-nib mr-1"></i>
		Submit writting</button>

		<div class="modal fade " id="writing" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		         <h5 class="modal-title" id="exampleModalLongTitle">Submit Writing</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form @submit.prevent='submit'>
			      <div class="modal-body">
			     		<div class="row">
			     			<div class="col-md-4">
			     				<div class="form-group">
				        		<label for="name">Name</label>
				        		<input v-model="form.name" type="text" name="name"  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
							      <has-error :form="form" field="name"></has-error>
									</div>
			     			</div>

			     			<div class="col-md-4">
			     				<div class="form-group">
				        		<label for="email">Email</label>
				        		<input v-model="form.email" type="email" name="email"  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
							      <has-error :form="form" field="email"></has-error>
									</div>
			     			</div>

			     			<div class="col-md-4">
			     				<div class="form-group">
				        		<label for="contact">Contact</label>
				        		<input v-model="form.contact" type="text" name="name"  class="form-control" :class="{ 'is-invalid': form.errors.has('contact') }">
							      <has-error :form="form" field="contact"></has-error>
									</div>
			     			</div>

			     			<div class="col-md-12">
			     				
			     				<!-- brand image -->
			     				<!-- end brand image -->

			     				<div class="form-group">
				        		<label for="name">Title</label>
				        		<input v-model="form.title" type="text" name="name"  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
							      <has-error :form="form" field="title"></has-error>
									</div>

				

									<div class="form-group">
				        		<label for="content">Content</label>
				        		<vue-editor id='editor' v-model="form.content"></vue-editor>
							      <has-error :form="form" field="content"></has-error>
									</div>


			     			</div>
			     		</div>
			      </div>
			      <div class="modal-footer">
		      	 	<div class="spinner-border m-5" role="status" v-if='loading'>
							  <span class="sr-only">Please wait...</span>
							</div>
							<div v-else>
				        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary btn-blue font-white">Submit </button>
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
				loading:false,
				form:new Form({
					title:'',
					name:'',
					email:'',
					contact:'',
					content:''
				})
			}
		},
		methods:{
			open(){
				$('#writing').modal('show')
			},

			submit(){
				this.loading=true
				this.form.post('/become-a-writer/create').then(()=>{
					this.form.clear()
					this.form.reset()
					Toast.fire({
            icon: 'success',
            title: 'Writing submitted successfully',
          });
          $('#writing').modal('hide')
          this.loading=false
				}).catch(()=>{
					this.loading=false
				})
			}
		}
	}
</script>