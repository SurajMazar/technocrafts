<template>
   <div class="blog_card">
      <div class="ads_home_beside_latests_news" v-for="ad in ads" :key="ad.id">
        <a :href="ad.ads_url" target="_blank">
          <figure>
            <img :src="'/images/advertisement/'+ad.ads_image" alt=""/>
          </figure>
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

</style>