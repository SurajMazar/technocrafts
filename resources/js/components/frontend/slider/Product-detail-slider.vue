<template>
	<div class="laptop__slider">
		<div class="laptop__preview__image">
			<div v-for='(image,index) in images' :key='index' :class="index==active_index ?'item active' : 'item'" >
				<figure> 
					<img :src="image" alt="">
					<div class="img-preview" title='Preview' @click='openImagePreview()'>
						<i class="fas fa-expand"></i>
					</div>
					<figcaption>
						<i class='fas fa-angle-left' @click='prev_slide'></i>
						<i class='fas fa-angle-right' @click='next_slide'></i>
					</figcaption>
				</figure>
			</div>
		</div> 
		<div class="laptop__image">
			<div v-for='(image,index) in images' :key='index' :class="index==active_index ?'item active' : 'item'" @click='setImageActive(index)'>
				<figure> 
					<img :src="image" alt="">
				</figure>
			</div>
		</div>

		<div class="modal fade bd-example-modal-lg" id='laptop_preview' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel " aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
	    <div class="modal-content">
        
	    		<div class="laptop__modal__image">
	    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
						<div v-for='(image,index) in images' :key='index' :class="index==active_index ?'item active' : 'item'" >
							<figure> 
								<img :src="image" alt="">
								<figcaption>
									<i class='fas fa-angle-left' @click='prev_slide'></i>
									<i class='fas fa-angle-right' @click='next_slide'></i>
								</figcaption>
							</figure>
						</div>
					</div>
				 
	    </div>
	  </div>
	</div>

	</div>
</template>
<script>
	export default{
		props:['images'],
			data(){
			return{
				active_index:0,
			}
		},
		methods:{
			next_slide(){
				let slideCount=this.images.length;
				if(this.active_index+1<slideCount){
					this.active_index++;
				}else{
					this.active_index=0;
				}
			},
			prev_slide(){
				let slideCount=this.images.length;
				if(this.active_index==0){
					this.active_index=slideCount-1;
				}else{
					this.active_index--;
				}
			},
			setImageActive(index){
				this.active_index=index;
			},
			openImagePreview(){
				$('#laptop_preview').modal('show');
			},
	}
}
</script>
<style lang='scss' scoped>
	.lap_title{
		font-size: 24px;
	}
	.spec{
		font-weight: 400;
		color: #161616;
		.fa-check{
			color:#30ae0d;
			font-weight: 900;
			font-size: 18px;
		}
		.fa-times{
			color:#ee1818;
			font-weight: 900;
			font-size: 18px;
		}
	}
</style>