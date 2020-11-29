<template>
  <section class="pt-2">
    <div class="container">
      <div class="ads_below_latest_news" v-for="ad in ads" :key='ad.id' >
        <a :href='ad.ads_url' target='_blank'><img :src='"/images/advertisement/"+ad.ads_image' alt=""></a> 
      </div>
    </div>
  </section> 
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

</style>