<template>
	<li class="item">
    <div class="product-img">
      <img :src="'images/laptops/'+imagefolder(laptop.name)+'/'+laptop.featured_image" alt="Product Image" class="img-size-50">
    </div>
    <div class="product-info">
      <h6 class="product-title">{{ laptop.name | Trim_title(15) }}
        <span class="badge badge-warning float-right">{{ laptop.price | dollar }}</span></h6>
    </div>
  </li>
</template>

<script>
	export default{
		props:['laptop'],
		methods:{
			imagefolder(string){
				return string.replace(/\s/g,'_');
			},
		}
	}
</script>