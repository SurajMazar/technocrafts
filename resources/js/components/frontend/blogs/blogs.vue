<template>
	<div class="blog">
		<div class="blog__listing" v-for='blog in blogs.data' :key='blog.id' :title="blog.title">
			<div class="blog__listing__card">
				<figure>
					<img  :src="'/images/blogs/'+ blog.featured_image" alt="">
					<span class="featured">featured</span>
          <div class="blog__date__author">
            <span class="date mr-2"><i class="far fa-calendar mr-2"></i>{{ blog.created_at | myDate }}</span>
            <span class="author" v-for='a in blog.bloguser'  :title="'Author : '+a.name"><i class="fas fa-user-tag  mr-2"></i>{{ a.name | Trim_title(12) }}</span>
          </div>
          <figcaption>
            <div class="blog">
      				<span class="category mrn-1" v-for='cat in blog.blogcategory' :key='cat.id'><a :href="'/'+cat.slug" class='font-white' :title='"Category: "+cat.name'>{{ cat.name }}</a></span>
        		</div>
        		<a :href="'/blog/'+blog.slug" :title="blog.title"><h6 class="blog__title">{{ blog.title | Trim_title(28) }}</h6></a>
          </figcaption>
				</figure>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		name:'blogs-list',
		props:['blogs'],
		data(){
			return{

			}
		}
	}
</script>