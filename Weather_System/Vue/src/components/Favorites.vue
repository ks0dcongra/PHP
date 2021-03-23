<template>  
  <div>
    <transition name="el-zoom-in-top">
        <Spot :spots="spots" :username="username"/>        
    </transition>
  </div>
</template>

<script>
import Spot from './Spot.vue';
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
    
      this.getfav();
    },
    methods:{
      getfav(){
        axios({
              method: 'get',
              url: API_BASE_URL + '/fav/' + this.username,
              headers : { 
                
              },

            }).catch(function (error) {
                          // alert(error)
                          console.log(error);    
            }).then((res)=>{
              console.log(res.data)   
               this.spots = res.data        
              // let newarray = Array.from(res.data)
              // newarray.forEach((e) => {
              //   e.status = true
                
              // });
              // this.spots = newarray
              
              // let newarray = Array.from(res.data).map((element) =>{
              //   return{
              //     ...element,
              //     status: true
              //   }
              // });
              // this.spots = newarray
              console.log(this.spots)


            })

      }
    },


//send: username, [post] like
//recieve: [get]userfavlist, spot 
}
</script>

<style>

</style>