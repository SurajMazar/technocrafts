<template>
	<section class='pt-4'>
  <div class="container">
    <a class='title'><h2>Latest blogs<hr></h2></a>
    <div class="blog">

    	<div class="blog_card">
        <div class="blog__front__card__1" v-for='blog in latest_blogs.data.slice(0, 2)' :key='blog.id'>
          <figure>
            <img :src="'/images/blogs/'+ blog.featured_image" alt="">
            <figcaption>
            	<div class="blog">
              <span class="category mrn-1" v-for='cat in blog.blogcategory' :key='cat.id'><a :href="'/blog_category/'+cat.slug" class='font-white' :title='"Category: "+cat.name'>{{ cat.name }}</a></span>
              </div>
              <a :href="'/blog/'+blog.slug"  :title='blog.title'><h6>{{ blog.title | Trim_title(55) }}</h6></a>
              <div class="blog_detail">
              	<p class="mr-2"><i class="far fa-calendar mr-2"></i>{{ blog.created_at | myDate }}</p>
              	<p v-for='a in blog.bloguser' :key="a.id" :title='a.name'><i class="fas fa-user-tag mr-2"></i>{{ a.name|Trim_title(9)}}</p>
              </div>
            </figcaption>
          </figure>
        </div>
      </div>
    
      <div class="blog_card" v-for='blog in latest_blogs.data.slice(2, 4)' :key='blog.id'>
        <div class="blog__front__card__2">
          <figure>
            <img :src="'/images/blogs/'+ blog.featured_image" alt="">
            <figcaption>
              <div class="blog">
              <span class="category mrn-1" v-for='cat in blog.blogcategory' :key='cat.id'><a :href="'/blog_category/'+cat.slug" class='font-white' :title='"Category: "+cat.name'>{{ cat.name }}</a></span>
              </div>
              <a :href="'/blog/'+blog.slug"  :title='blog.title' ><h6>{{ blog.title | Trim_title(55) }}</h6></a>
              <div class="blog_detail">
              	<p class="mr-2"><i class="far fa-calendar mr-2"></i>{{ blog.created_at | myDate }}</p>
              	<p v-for='a in blog.bloguser' :key="a.id" :title='a.name'><i class="fas fa-user-tag mr-2"></i>{{ a.name|Trim_title(9)}}</p>
              </div>
            </figcaption>
          </figure>
        </div>
      </div>

      
      

        <!-- ads space -->
      <ads-single-row slug="home-page-beside-latest-news"></ads-single-row>

    </div>
  </div>
</section>
</template>
<script>
	export default{
		name:'latest-blogs',
		props:['latest_blogs'],
		data(){
			return{

			}
		}
	}
</script>