<template>
    <!--<div class="google-map" id="map"></div>-->
    <div>
        <h2>請選擇一個城市</h2>
        <h2>你選擇的是：{{location}}</h2>
        <div class="imgarea">
            <!-- <img src="../assets/asiacity_map.png" alt="Workplace" usemap="#workmap" width="400" height="379"> -->
                <el-image
                style="width: 860px; height: 857px"
                :src="'https://i.imgur.com/TgcPtEb.png'"
                :fit="fit" alt="Workplace" usemap="#workmap"></el-image>

            <map name="workmap">
                <area shape="rect" coords="795,266,859,297" alt="Honolulu" href="javascript:;" @click="selectloc('Honolulu')">
                <area shape="circle" coords="322,181,7" alt="Xi An" href="javascript:;" @click="selectloc('Xi An')">
                <area shape="circle" coords="271,164,7" alt="Lanzhou" href="javascript:;" @click="selectloc('Lanzhou')">
                <area shape="circle" coords="421,146,7" alt="Shenyang" href="javascript:;" @click="selectloc('Shenyang')">
                <area shape="circle" coords="378,164,7" alt="Beijing" href="javascript:;" @click="selectloc('Beijing')">
                <area shape="circle" coords="406,196,7" alt="Qingdao" href="javascript:;" @click="selectloc('Qingdao')">
                <area shape="circle" coords="311,227,7" alt="Chongqing" href="javascript:;" @click="selectloc('Chongqing')">
                <area shape="circle" coords="392,220,7" alt="Nanjing" href="javascript:;" @click="selectloc('Nanjing')">
                <area shape="circle" coords="368,236,7" alt="Wuhan" href="javascript:;" @click="selectloc('Wuhan')">
                <area shape="circle" coords="413,231,7" alt="Shanghai" href="javascript:;" @click="selectloc('Shanghai')">
                <area shape="circle" coords="368,292,7" alt="Hong Kong" href="javascript:;" @click="selectloc('Hong Kong')">
                <area shape="circle" coords="312,305,7" alt="Hanoi" href="javascript:;" @click="selectloc('Hanoi')">
                <area shape="circle" coords="281,352,7" alt="Bangkok" href="javascript:;" @click="selectloc('Bangkok')">
                <area shape="circle" coords="321,371,7" alt="Ho Chi Minh" href="javascript:;" @click="selectloc('Ho Chi Minh')">
                <area shape="circle" coords="415,341,7" alt="Maynila" href="javascript:;" @click="selectloc('Maynila')">
                <area shape="circle" coords="290,416,7" alt="Kuala Lumpur" href="javascript:;" @click="selectloc('Kuala Lumpur')">
                <area shape="circle" coords="306,433,7" alt="Singapore" href="javascript:;" @click="selectloc('Singapore')">
                <area shape="circle" coords="322,475,7" alt="Jakarta" href="javascript:;" @click="selectloc('Jakarta')">
                <area shape="circle" coords="387,645,7" alt="Perth" href="javascript:;" @click="selectloc('Perth')">
                <area shape="circle" coords="526,666,7" alt="Adelaide" href="javascript:;" @click="selectloc('Adelaide')">
                <area shape="circle" coords="567,689,7" alt="Melbourne" href="javascript:;" @click="selectloc('Melbourne')">
                <area shape="circle" coords="605,661,7" alt="Sydney" href="javascript:;" @click="selectloc('Sydney')">
                <area shape="circle" coords="616,618,7" alt="Brisbane" href="javascript:;" @click="selectloc('Brisbane')">
                <area shape="rect" coords="538,323,585,349" alt="Guam" href="javascript:;" @click="selectloc('Guam')">
                <area shape="circle" coords="749,679,7" alt="Auckland" href="javascript:;" @click="selectloc('Auckland')">
                <area shape="circle" coords="748,704,7" alt="Wellington" href="javascript:;" @click="selectloc('Wellington')">
                <area shape="circle" coords="533,198,7" alt="Tokyo" href="javascript:;" @click="selectloc('Tokyo')">
                <area shape="circle" coords="500,208,7" alt="Osaka" href="javascript:;" @click="selectloc('Osaka')">
                <area shape="circle" coords="454,187,7" alt="Seoul" href="javascript:;" @click="selectloc('Seoul')">
                <area shape="circle" coords="509,88,7" alt="Vladivostok" href="javascript:;" @click="selectloc('Vladivostok')">
                
            </map>
        </div>

        <el-drawer
        title="" :visible.sync="drawer" :direction="'ltr'" :before-close="handleClose" :with-header="false" size='50%'>
        <h1>{{ location }}的相關景點：</h1>
        <div class="box">
        <div class="weather_row">
          <el-row>
            <el-col span="7">{{ location }}</el-col>
            <el-col span="2" offset="2">{{ degree }} </el-col>
            <el-col span="2" offset="2"
              ><el-image
                style="width: 30px; height: 30px"
                :src="weather_icon"
                :fit="fit"
                id="weather_img"
              ></el-image
            ></el-col>
          </el-row>
        </div>
      </div>
      <hr class="line_1" />
            
            
            <vuescroll>
            <div class="spotsection" v-for="spot in spots" :key="spot.name">
                
                    <Spotside :Spot="spot" :username="username" :weather="weather" :degree="degree"/>      
                       
            </div>
            </vuescroll>
            
            
        </el-drawer>

    </div>
</template>

<script>
import axios from 'axios'
import Spotside from './Spotside.vue'
import vuescroll from 'vuescroll';
import {API_BASE_URL} from './config.js'

export default {
    components: {
        Spotside,
        vuescroll
    },
    data(){
        return{
            map: null,
            lat: 25.0325917,
            lng: 121.5624999,
            ops:{

            },
            spots:[],
            location: '',
            drawer: false,
            username: '',
            weather:'',
            weather_icon:"https://i.imgur.com/uhahPmK.png",
            degree: 0,
        }

    },
    mounted(){
      if(this.username == ''){
        this.username = sessionStorage.getItem('username')
        console.log('username is'+this.username)
      }
        //this.initMap();
        //this.setMarker();
    },
    methods: {
        // initMap(){
        //     // 透過 Map 物件建構子建立新地圖 map 物件實例，並將地圖呈現在 id 為 map 的元素中
        //     this.map = new google.maps.Map(document.getElementById("map"), {
        //     // 設定地圖的中心點經緯度位置
        //     center: { lat: this.lat, lng: this.lng },
        //     // 設定地圖縮放比例 0-20
        //     zoom: 15,
        //     // 限制使用者能縮放地圖的最大比例
        //     maxZoom: 20,
        //     // 限制使用者能縮放地圖的最小比例
        //     minZoom: 3,
        //     // 設定是否呈現右下角街景小人
        //     streetViewControl: false,
        //     // 設定是否讓使用者可以切換地圖樣式：一般、衛星圖等
        //     mapTypeControl: false
        //     });
            
        // },
        // setMarker() {
        //     // 建立一個新地標
        //     const marker = new google.maps.Marker({
        //         // 設定地標的座標
        //         position: { lat: this.lat, lng: this.lng },
        //         // 設定地標要放在哪一個地圖
        //         map: this.map
        //     });
        // },
        selectloc(value){
            //console.log('current env:'+process.env.WEATHER_API)
            this.drawer = true;
            this.location = value;
            this.getSpot();
            //this.degrees = this.spots[0].degrees;
            //this.change_weather_img(this.weather);
        },
        getSpot(){
          axios({
              method: 'get',
              url: API_BASE_URL + '/select/'+this.location+'/'+this.username,
              headers : {  
 
              },

            }).catch(function (error) {
                          // alert(error)
                          console.log('error:'+error);    
            }).then((res)=>{
              console.log(res.data)
              this.spots = []
              this.spots = res.data.spot_info
              this.weather = res.data.weather
              console.log('weather:'+this.weather)
              console.log('weather_icon:'+this.weather_icon)
              this.degree = res.data.degree
              console.log('degree:'+this.degree)
              this.change_weather_img(this.weather);
              console.log('weather_icon:'+this.weather_icon)
                           
            })
        },
      change_weather_img(weather_desc) {
      if (weather_desc == "CLOUDY") {
        this.weather_icon = "https://i.imgur.com/uhahPmK.png";
      } else if (weather_desc == "RAINY") {
        this.weather_icon = "https://i.imgur.com/BPoKiYc.png";
      } else if (weather_desc == "SNOW") {
        this.weather_icon = "https://i.imgur.com/OFgTy0C.png";
      } else if (weather_desc == "SHOWERS") {
        this.weather_icon = "https://i.imgur.com/BtlI7Vi.png";
      } else if (weather_desc == "CLEAR") {
        this.weather_icon = "https://i.imgur.com/jsCwuWF.png";
      } else if (weather_desc == "SUNNY") {
        this.weather_icon = "https://i.imgur.com/sH1g2c7.png";
      } else if (weather_desc == "PARTLY_CLOUDY") {
        this.weather_icon = "https://i.imgur.com/q7l3jHA.png";
      }
    },

        //send:city
        //recieve:[get] spot,userfavlist
    },
}
</script>

<style>
.spotsection{
    height: 100%;
    overflow:auto;
}
.el-drawer__body {
    height: 100%;
	box-sizing: border-box;
	
    
}
/*
.city{
    font-size: 3em;
    font-family: "Lucida Console", "Courier New", monospace;
    text-align: left;
    color: #999999;
}*/
.stext{
    font-weight:bold;
    font-size: 1.5em;
}
.imgarea {
  background-color: white;
}
h1 {
  background: #90b0ca;
  font-size: 22px;
  color: #fff;
  height: 50px;
  text-align: center;
  padding: 10px;
  margin-top: 0px;
  margin-bottom: 15px;
}
body {
  font-family: "微軟正黑體";
}
.box {
  line-height: 30px;
  margin-left: 3%;
  margin-right: 40%;
}
.weather_row {
  font-size: 20px;
  margin: 1%;
  color: #90b0ca;
  font-weight: bold;
  height: 30px;
}
.line_1 {
  border: none;
  border-top: 1px dashed;
  /* margin-bottom: 10px; */
  color: #90b0ca;
  height: 2px;
  width: 100%;
}
@media screen and (max-width: 1150px) {
  .box {
    line-height: 30px;
    margin-left: 3%;
    margin-right: 25%;
  }
}
@media screen and (max-width: 900px) {
  .box {
    line-height: 30px;
    margin-left: 3%;
    margin-right: 20%;
  }
}
@media screen and (max-width: 850px) {
  .box {
    line-height: 30px;
    margin-left: 3%;
    margin-right: 15%;
  }
}
@media screen and (max-width: 800px) {
  .box {
    line-height: 30px;
    margin-left: 3%;
    margin-right: 12%;
  }
}
@media screen and (max-width: 730px) {
  .box {
    line-height: 30px;
    margin-left: 3%;
    margin-right: 9%;
  }
  .weather_row {
    font-size: 19px;
  }
}
@media screen and (max-width: 710px) {
  .box {
    line-height: 30px;
    margin-left: 2%;
    margin-right: 6%;
  }
  .weather_row {
    font-size: 19px;
  }
}
@media screen and (max-width: 650px) {
  .box {
    line-height: 30px;
    margin-left: 1%;
    margin-right: 2%;
  }
  .weather_row {
    font-size: 18px;
    margin: 10px;
  }
}
@media screen and (max-width: 635px) {
  .box {
    line-height: 30px;
    margin-left: 8px;
    margin-right: 5%;
  }
  .weather_row {
    font-size: 17px;
    margin: 2px;
  }
}
@media screen and (max-width: 600px) {
  .box {
    line-height: 30px;
    margin-left: 8px;
    margin-right: 8%;
  }
  .weather_row {
    font-size: 15px;
    margin: 2px;
  }
  h1{
    font-size: 20px;
  }
}
@media screen and (max-width: 550px) {
  .box {
    line-height: 30px;
    margin-left: 8px;
    margin-right: 10%;
  }
  .weather_row {
    font-size: 13px;
    margin: 2px;
  }
  h1{
    font-size: 19px;
  }
}
@media screen and (max-width: 500px) {
  .box {
    line-height: 30px;
    margin-left: 8px;
    margin-right: 10%;
  }
  .weather_row {
    font-size: 11px;
    margin: 2px;
  }
  h1{
    font-size: 17px;
  }
}


</style>