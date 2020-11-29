<template>
	<div class="smartphone-card">
    <div class="smartphone-image">
      <figure>
        <img :src="smartphone.images[0]" alt="">
        <figcaption>
          <div class="category">
            {{ smartphone.brand.name }}
          </div>
          <div class="price">
            <p class="card-price">{{ smartphone.price | dollar }}</p>
          </div>
        </figcaption>
      </figure>
    </div>
    <div class="smartphone-detail">
      <h6><a :href="'/smartphones/'+smartphone.id" :title='smartphone.name'>{{ smartphone.name | Trim_title(12) }}</a></h6>
    </div>
  </div>
</template>
<script>
	export default{
		props:['smartphone'],
		data(){
			return{

			}
		}
	}
</script>