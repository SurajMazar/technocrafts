<template>
  <div class='row'>
    <div class="col-md-3" v-for='game in games' :key='game.id'>
      <h1>{{ game.title }}</h1>
      <p>{{ game.released }}</p>
    </div>
  </div>
</template>


<script>
  export default{
    data(){
      return{
        likes:0,
        color:'red',
        games:[
          {
            id:'1',
            title:'Mario',
            released:"2075/1/4"
          },

          {
            id:'2',
            title:'Street Fighters',
            released:"2075/12/4"
          },

          {
            id:'3',
            title:'Kun fu panda',
            released:"2074/1/4"
          },
        ]
      }
    },

    methods:{

      // increment(){
      //     this.likes++;
      // },

      // changeToblue(){
      //   if(this.color === 'red'){
      //     this.color='blue';
      //   }else{
      //     this.color='red';
      //   }
      // }

    }
  }
</script>


<style scoped>
  
</style>
