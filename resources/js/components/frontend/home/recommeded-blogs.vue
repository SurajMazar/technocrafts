<template>
	<section class="pb-3" v-if='recommended_blogs.length'>
		<div class="container">
			<div class="container pt-3 ">
				<a class='title'><h5>Recommended for you<hr></h5></a>
			    <div class="blog pt-1 ">
			      <div class="blog__listing" v-for='blog in recommended_blogs' :key='blog.id' :title="blog.title">
			        <div class="blog__listing__card">
						<figure>
							<img  :src="'/images/blogs/'+ blog.featured_image" alt="">
		          <div class="blog__date__author">
		            <span class="date mr-2"><i class="far fa-calendar mr-2"></i>{{ blog.created_at | myDate }}</span>
		            <span class="author" v-for='a in blog.bloguser' :key='a.id' :title="'Author : '+ a.name"><i class="fas fa-user-tag  mr-2"></i>{{ a.name | Trim_title(12) }}</span>
		          </div>
		          <figcaption>
		            <div class="blog">
		      				<span class="category mrn-1" v-for='cat in blog.blogcategory' :key='cat.id'><a :href="'/blog_category/'+cat.slug" class='font-white' :title='"Category: "+cat.name'>{{ cat.name }}</a></span>
		        		</div>
		        		<a :href="'/blog/'+blog.slug"  :title="blog.title"><h6 class="blog__title">{{ blog.title | Trim_title(90) }}</h6></a>
		          </figcaption>
						</figure>
					</div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</section>
</template>
<script>
	export default{
		data(){
			return{
				recommended_blogs:[],
			}
		},
		methods:{
			loadBlog(){
				axios.get('/blog/recommendation').then(res=>{
					this.recommended_blogs = res.data
				})
			}
		},
		mounted(){
      this.loadBlog()
		}

	}
</script>
<style scoped>
	.blog__listing{
		width:24%;
	}
</style>