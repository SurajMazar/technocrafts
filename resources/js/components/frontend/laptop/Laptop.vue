<template>
	<div class="laptop">
		<h3 class="text-center" v-if='!laptops.data.length'>
			Sorry no laptop found!!
		</h3>
		<div class="laptop__card" v-else v-for='l in laptops.data' :key='l.id'>
			<div class="laptop__image">
				<figure>
					<img :src="'/images/laptops/'+ imagefolder(l.name) + '/'+ l.featured_image" alt="">
					<div class="brand">
						<a href="">
							<span class="category mrn-1" v-for='brand in l.laptopbrand'>{{ brand.name }}</span>
						</a>
					</div>
					<figcaption>
						<a :href="home_url+'/laptop_detail/'+l.slug"><button>View Details</button></a>
					</figcaption>

				</figure>
			</div>
			<div class="laptop__details">
				<h5 class="laptop__title">{{l.name | Trim_title(20)  }}</h5>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		name:'laptop-lisitng',
		props:['home_url','laptops'],
		data(){
			return{
			}
		},
		methods:{
			imagefolder(string){
				return string.replace(/\s/g,'_');
			},
		}
	}
</script>