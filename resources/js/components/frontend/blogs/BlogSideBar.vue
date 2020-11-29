<template>
	<aside class="col-md-3">
		<div class="categories">
			<h4 class="category__title">Blog categories</h4>
			<ul class="category__list">
				<li class="category_item" v-for='bc in blog_categories' :key='bc.id'>
					<a :href="'/blog_category/'+ bc.slug" class="">
						<i class="fas fa-check mr-2"></i>{{ bc.name }}
					</a>
				</li>
			</ul>
		</div>
	</aside>
</template>	
<script>
	export default{
		name:'blog-sidebar',
		props:['blog_categories'],
		data(){
			return{

			}
		}
	}
</script>