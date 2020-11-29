<template>
	<div class="row pt-3">
		<div class="col-md-3 " v-for='b in brands' :key='b.id'>
			<div class="brand_card">
				<div class="brand_image">
					<figure>
						<img :src='imgfolder+b.brand_image' alt="">
					</figure>
				</div>
				 <h5><a :href='"/brand-"+type+"/"+b.id'>{{ b.name }}</a></h5>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		name:'brand-listing',
		props:['brands','type','imgfolder'],
		data(){
			return{

			}
		}
	}
</script>
<style lang='scss' scoped>
	.brand_card h5{
		text-align: center;
		padding-bottom: 1em;
	}

	.brand_card{
		 h5 a{
			color:black;
			&:hover{
				text-decoration: none;
				text-shadow: 0px 0px 7px rgba(0,0,0,0.5);
			}
		}
	}

	
</style>