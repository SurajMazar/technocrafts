<template>
	
</template>
<script>
	export default{
		name:'editForm',
		props:['user'],
		data(){
			return{
				loading:false,
				

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

      formReset(){
      	this.form.reset()
      	this.form.clear()
      },

      updateUser(){
      	this.loading=true;
      	this.form.post('/admin/users/create-user').then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'User Created successfully'
          })
          this.formReset()
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
			
		}
	}
</script>
<style scoped>
	figure{
		width:200px;
		height:200px;
	}

	.feature-image{
		display: flex;
justify-content: center;
	}

	.feature-image figcaption {
    position: absolute;
    top: 0;
    right: 0;
}
</style>