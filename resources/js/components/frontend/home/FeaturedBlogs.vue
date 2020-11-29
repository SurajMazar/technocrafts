<template>
	<div class="row">
	  <div class="container">
	   <a class='title' :href="'/featured-blogs'"><h2>Featured blogs<hr></h2></a>
	    <div class="blog pt-1">
	      <div class="blog__listing" v-for='blog in featured_blogs.data' :key='blog.id' :title="blog.title">
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
</template>
<script>
	export default{
		name:'featured-blogs',
		props:['featured_blogs'],
		data(){
			return{

			}
		}
	}
</script>
<style scoped>
.title:hover{
	text-decoration: none;
	text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
}
.title{
	color: #161616;
}
</style>	