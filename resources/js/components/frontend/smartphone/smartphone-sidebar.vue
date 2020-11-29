<template>
	<aside class="col-md-3">
		<div class="categories">
			<h4 class="category__title">Brands</h4>
			<ul class="category__list">
				<li class="category_item" v-for='bc in brands' :key='bc.id'>
					<a :href="'/smartphone-brand/'+ bc.id" class="">
						<i class="fas fa-check mr-2"></i>{{ bc.name }}
					</a>
				</li>
			</ul>
		</div>
	</aside>
</template>
<script>
	export default{
		props:['brands'],
		data(){
			return{

			}
		}
	}
</script>
