<template>
	<div class="modal fade h100" id="rbads" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog h100" role="document">
	    <div class="modal-content h100">
	      <div class="container h100">			
	 				<div class="row h100 justify-content-center align-item-center">
	 					<div class="col-md-8">
	 						<div class="row justify-content-center pt-4">
	 							<div class="col-md-12 text-center ">
			 						<button class="btn btn-primary btn-blue font-white" @click='closeModal'>Skip ad <i class="fas fa-angle-right ml-1">
			 						</i></button>
		 						</div>
		 						<p class='pt-4 font-blue'>Ads ends in {{ counter }}s</p>
	 						</div>
	 					</div>
	 					<div class="col-md-8"  v-for="ad in ads" :key='ad.id'>
	 						<a :href="ad.ads_url" target='_blank'>
	 							<img :src='"/images/advertisement/"+ad.ads_image' alt="" class="ads-img">
	 						</a>
	 					</div>
	 				</div>
	 			</div>
	    </div>
	  </div>
	</div>
</template>

<script>
  export default {
    props:['slug'],
    data(){
      return{
        ads:[],
        counter:10,
      }
    },
    methods:{
      loadAds(){
        axios.get('/ads/'+ this.slug).then((response)=>{
          this.ads=response.data
          if(this.ads.length){
	      		$('#rbads').modal('show')
	      	}
	      	setTimeout(()=>{
			      	this.closeModal()
			      },10000);

	      		this.timer();
    		})
        	
      },
      timer(){
  		 setInterval(()=>{
					  if(this.counter <= 0){
					    clearInterval(this.timer());
					  }
					  this.counter -= 1;
					}, 1000);
      },

      closeModal(){
      	$('#rbads').modal('hide')
      }
     
    },
    mounted(){
    	
      this.loadAds()
      
    }
  }
</script>

<style lang="scss" scoped>
.ads-img{
  width:100%;
}
.modal{
	padding-right: 0 !important;
}
.modal-dialog {
    max-width: 100%;
    margin: 0;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    min-height: 100%;
}

.h100{
	height: 100%;
}

.align-item-center{
	align-items: center;
}

.btn-blue{
	font-size: 16px;
	border-radius:25px;
	padding: 0.5em 1em;
}

.font-blue{
	font-size: 22px;
	color:#0071db;
}
</style>