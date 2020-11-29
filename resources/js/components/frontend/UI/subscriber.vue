<template>
	<div class="subscription mt-4">
		
		<div class="row">
			<div class="container">
				<div class="row justify-content-center">
					<h2 style="margin-right:20px;font-size: 1.5rem;">Subscribe our newsletter for latest updates!!</h2>
					<form @submit.prevent='createSubscriber'>
						<div class="row" style='margin-left: 5px;'>
							<input v-model="form.email" type="email" name="email"
					        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Your Email">
					      <has-error :form="form" field="email"></has-error>
					      <div class="spinner-border"v-if='this.loading'role="status">
							  <span class="sr-only">Loading...</span>
							</div>
							<input  v-else type="submit" class='btn btn-info font-white form-control' value='Subscribe'>
							
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
					email:'',
				}),
			}
		},
		methods:{
			createSubscriber(){
				this.loading=true
				this.form.post('/subscriber/create').then(()=>{
					Toast.fire({
	          icon: 'success',
	          title: 'Thank you for subscribing!!'
        	});
        	this.form.clear();
        	this.form.reset();
        	this.loading=false
        	
				}).catch(()=>{
							        	this.loading=false

				})
			}
		}
	}
</script>
<style scoped>
	.subscription{
		border-bottom:2px solid #0071db;
		padding:2em;
		background-color: white;
		border-top:2px solid #0071db;
	}
	.subscription input{
		width:auto;
	};
	
</style>