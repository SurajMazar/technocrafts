<template>
	<li class="item">
    <div class="product-img">
      <img :src="smartphone.images[0]" alt="Product Image" class="img-size-50">
    </div>
    <div class="product-info">
      <h6 class="product-title">{{ smartphone.name | Trim_title(15) }}
        <span class="badge badge-warning float-right">{{ smartphone.price | dollar }}</span></h6>
    </div>
  </li>
</template>

<script>
	export default{
		props:['smartphone'],
		
		}
</script>