<template>
<div>
    <transition name="el-zoom-in-top">
        <Spot :spots="spots" :username="username" :degree="degree" :weather="weather"/>        
    </transition>

</div>
</template>

<script>
import Spot from './Spot.vue'
import axios from 'axios'
import { API_BASE_URL } from "./config.js";

export default {
    name:'popular',
    components:{
        Spot
    },
    data(){
        return{
            spots:[

            ],
            username: '',
            degree: null,
            weather: '',

        }
    },
    mounted(){
      if(this.username == ''){
        this.username = sessionStorage.getItem('username')
        console.log('username is'+this.username)
      }
      this.getpop();
    },
    methods:{
      getpop(){
        console.log('start getpop')
        axios({
              method: 'get',
              url: API_BASE_URL + '/pop/'+this.username,
              headers : { 
                
              },

            }).catch(function (error) {
                          // alert(error)
                          console.log(error);    
            }).then((res)=>{
                console.log(res)
              this.spots = res.data
              this.weather = res.data.weather;
              this.degree = res.data.degree;
                           
            })

      }

    },

//send: username, [post] like
//recieve: [get]userfavlist, spot 
}
</script>

<style>

</style>