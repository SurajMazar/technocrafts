<template>
	<li>
		<div class="most-viewed-blog">
			<div class="blog-img">
				<img :src="'/images/blogs/'+blog.featured_image">
			</div>
			<a :href="'/blog/'+blog.slug" :title='blog.title'><h6>{{ blog.title | Trim_title(35) }}</h6></a>
		</div>
	</li>
</template>

<script>
	export default{
		props:['blog'],
	}
</script>