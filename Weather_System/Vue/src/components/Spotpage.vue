<template>
 <div>
    <section>
        <el-card class="box-card-page" :body-style="{ padding: '10px'}">
        <div slot="header" class="clearfix">
            <span class="spotname">{{spotname}}</span>
        </div>
        

        
        <div>
            <el-image
                style="width: 400px; height: 400px"
                :src="image"
                :fit="contain"
            ></el-image>
        </div>
        <el-row>
        <el-col :span="18">
          <h3></h3>
        </el-col>
        <el-col :span="6">
        <div class="heart">         
              <!-- <svg width="3em" height="3em" viewBox="0 0 16 16" :class="'bi bi-heart'+(state==true?'-fill':'')" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color:#99a9bf" @click.native="addtofav">                
                  <path v-if="state" fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                  <path v-if="costate" fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
              </svg> -->

              <el-button type="warning" :icon="'el-icon-star'+(state==true?'-on':'-off')" circle @click="addtofav">

              </el-button>
          
        </div>
        </el-col>

        </el-row>
        <main>
          <div class="weather">{{ city_name }}</div>
          <div class="weather icon">
            <el-image
              style="width: 30px; height: 30px"
              :src="weather_icon"
              :fit="fit"
              id="weather_img"
            ></el-image>
          </div>
          <div class="weather">{{ degree }} ℃ </div>
        </main>

        <div class="address">{{ address }}</div>
        <el-divider></el-divider>
        <div class="info_tx">
          {{ info }}
        </div>
        </el-card>
    </section>


 </div>
</template>

<script>
import axios from 'axios'
import {API_BASE_URL} from './config.js'

export default {
    name: "",
    data (){
        return { 
            content: {},
            spotid:'',
            spotname: '',
            image: '',
            city: '',
            info: '',
            state: false,
            costate: false,
            username:'',
            weather_icon: "https://i.imgur.com/uhahPmK.png",
            address: '',
            weather: '',
            degree: '',
        }
    },
    beforeMount(){
        //assign the query content to this variables
        this.username = sessionStorage.getItem('username')
        this.content = this.$route.query;
        this.spotid = this.content.spot_id;
        this.spotname = this.content.spotname;
        this.image = this.content.image;
        this.city = this.content.city_name;
        this.info = this.content.info;
        this.state = this.content.state;
        this.weather = this.content.weather;
        this.address = this.content.address;
        this.degree = this.content.degree;
        
    },
    mounted(){
      if(this.state == 'true'){this.state = true; this.costate = false}else if(this.state == 'false'){this.state = false; this.costate = true}
      this.change_weather_img(this.weather);
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
      updatestate(){
          axios({
                method: 'put',
                url: API_BASE_URL + '/update/'+this.spotid+'/'+this.username,
                headers : { 

                },

              }).catch(function (error) {
                            // alert(error)
                            console.log(error);    
              }).then((res)=>{
                console.log(res)
                
                            
              })

      },
      addtofav(){
        //console.log('HIHI')
            const h = this.$createElement;

            if(this.state){
              this.$notify({
              title: '通知',
              message: h('i', { style: 'color: #ff661a'}, '已將'+this.spotname+'移出收藏！')
              });
              this.state = false;
              this.costate = true;
              
            }else{
              this.$notify({
              title: '通知',
              message: h('i', { style: 'color: teal'}, '已將'+this.spotname+'加入收藏！')
              });
              this.state = true;
              this.costate = false;
              
            }
            //axios update
            this.updatestate();


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
          },
    },

}
</script>

<style >
 .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }
  .el-image {
    width: 100%;
    
  }
  .box-card-page {
    height: 100%;
  }

</style>