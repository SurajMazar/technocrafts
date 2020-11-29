<template>
  <div class="row pt-1 pb-1">

    <div class="col-md-6  mt-1"  v-for="ad in ads" :key='ad.id'>
      <a :href="ad.ads_url" target='_blank'>
        <img :src='"/images/advertisement/"+ad.ads_image' alt="" class='ads-img'>
      </a>
    </div>

  </div>
</template>

<script>
  export default {
    props:['slug'],
    data(){
      return{
        ads:[]
      }
    },
    methods:{
      loadAds(){
        axios.get('/ads/'+ this.slug).then((response)=>{
          this.ads=response.data
        })
      }
    },
    mounted(){
      this.loadAds();
    }
  }
</script>

<style lang="scss" scoped>
.ads-img{
  width:100%;
}
</style>