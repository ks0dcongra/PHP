<template>
  <div>
    <transition name="el-zoom-in-top">
       <el-card class="box-card">
         <el-row>
         <a href="javascript:;" 
            @click="
              toContent(
                Spot.id,
                Spot.name,
                Spot.image,
                Spot.city_name,
                Spot.info,
                Spot.status,
                Spot.address,
                Spot.weather,
                Spot.degree
              )
            ">
              <el-col :span="6">
                <div class="imagediv">
                <el-image
                style="width: 200px; height: 200px"
                :src="Spot.image"
                :fit="fit"
                ></el-image>
                </div>
              </el-col>
              <el-col :span="16">

                <el-row ><el-col :span="8"><span class="spotname">{{Spot.name}}</span></el-col>
                         <el-col :span="12"><span class="city">{{Spot.city}} {{ Spot.degree }}℃             
              <el-image
              style="width: 30px; height: 30px"
              :src="weather_icon"
              :fit="fit"
              id="weather_img"
            ></el-image></span></el-col>               
                </el-row>
                <el-row ><div class="info"><v-clamp autoresize :max-lines="5">{{Spot.info}}</v-clamp></div></el-row>
            
              </el-col>
        </a>
          <el-col :span="2">
                <!--<el-button type="warning" icon="el-icon-star-off" circle @click="addtofav"></el-button>-->
                <svg width="3em" height="3em" viewBox="0 0 16 16" :class="'bi bi-heart'+(state==true?'-fill':'')" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color:#99a9bf" @click="addtofav">
                  
                  <path v-if="state" fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                  <path v-if="costate" fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
                <i class="bi bi-heart"></i>
                <svg class="bi" width="32" height="32" fill="currentColor">
  <use xlink:href="bootstrap-icons.svg#heart-fill"/>
</svg>
          </el-col>
         </el-row>
      </el-card>
    </transition>
  </div>
</template>

<script>
import axios from 'axios'
import VClamp from 'vue-clamp'
import {API_BASE_URL} from './config.js'

export default {
    name:'spotitem',
    props: ["Spot", "username","weather", "degree"],
    components: {
      VClamp
    },
    data(){
        return{
            url: "https://www.meway.com.tw/jp/wp-content/uploads/2016/05/%E5%B7%A5%E4%BA%8B%E4%B8%AD.png",
            state: this.Spot.status,
            costate: this.Spot.status,
            info: this.Spot.info,
            path: '',
            weather_icon:'https://i.imgur.com/uhahPmK.png',
        }
    },
    mounted(){
      if(this.state == false){this.costate = true}
      this.change_weather_img(this.Spot.weather)
      console.log('weather:'+this.Spot.weather)
      console.log('icon:'+this.weather_icon)
      
    },
    watch:{
      state: function(){
        if(this.state){
          this.costate = false;
        }else{
          this.costate = true;
        }
      }

    },
    methods:{
        addtofav(){
            const h = this.$createElement;

            if(this.state){
              this.$notify({
              title: '通知',
              message: h('i', { style: 'color: #ff661a'}, '已將'+this.Spot.name+'移出收藏！')
              });
              this.state = false;
              
            }else{
              this.$notify({
              title: '通知',
              message: h('i', { style: 'color: teal'}, '已將'+this.Spot.name+'加入收藏！')
              });
              this.state = true;
              
            }
            //axios update
            this.updatestate();


        },
    //send event parameter to the reward page
    toContent(id, spotname, image, city_name, info, state, address, weather, degree) {
      this.$router.push({
        path: "/spot",
        query: {
          spot_id: id,
          spotname: spotname,
          image: image,
          city_name: city_name,
          info: info,
          state: state,
          address: address,
          weather: weather,
          degree: degree,
        },
      });
    },
    updatestate(){
              axios({
                  method: 'put',
                  url: API_BASE_URL + '/update/'+this.Spot.id+'/'+this.username,
                  headers : { 
                      
                  },

                  }).catch(function (error) {
                              // alert(error)
                              console.log(error);    
                  }).then((res)=>{

                  console.log(res)
                              
                  })

     },
      change_weather_img(weather) {
            if (weather == "CLOUDY") {
              this.weather_icon = "https://i.imgur.com/uhahPmK.png";
            } else if (weather == "RAINY") {
              this.weather_icon = "https://i.imgur.com/BPoKiYc.png";
            } else if (weather == "SNOW") {
              this.weather_icon = "https://i.imgur.com/OFgTy0C.png";
            } else if (weather == "SHOWERS") {
              this.weather_icon = "https://i.imgur.com/BtlI7Vi.png";
            } else if (weather == "CLEAR") {
              this.weather_icon = "https://i.imgur.com/jsCwuWF.png";
            } else if (weather == "SUNNY") {
              this.weather_icon = "https://i.imgur.com/sH1g2c7.png";
            } else if (weather == "PARTLY_CLOUDY") {
              this.weather_icon = "https://i.imgur.com/q7l3jHA.png";
            }
          }

    },
}
</script>

<style >
  .box-card {
    margin-bottom: 20px;
    width: 100%;
    height: 300px;
  }
  .el-row{
      align-content: left;
      vertical-align: bottom;

  }
  .spotname{
    font-size: 1em;
    font-weight: bold;
    text-align: right;
    color: #333333;
    left: 30px;
    vertical-align: bottom;
  }
  .city{
    font-size: 2em;
    font-family: "Lucida Console", "Courier New", monospace;
    text-align: left;
    color: #999999;
    
  }
  .info{
    font-size: 1em;
    color: #333333;
    text-align: left;
    text-indent: 50px;
    padding: 20px 25px 25px 25px;
    height: 4.5em;

  }
  .imagediv{
    padding-top: 20px;
  }
</style>

