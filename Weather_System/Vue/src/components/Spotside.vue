<template>
  <div>
      <el-row :type="flex" align="middle"> 
        <main> 

        
          <div class="box">
            <a href="javascript:;"             
            @click="
              toContent(
                Spot.id,
                Spot.name,
                Spot.image,
                Spot.city_name,
                Spot.info,
                Spot.status,
                degree,
                weather,
                Spot.address
              )
            ">
            
                <div class="img_level" style="color: rgb(70, 69, 90)"></div>
                <div class="img_box">
                <el-image
                class="img"
                style="width: 150px; height: 150px"
                :src="Spot.image"
                :fit="fit"
                ></el-image>
                </div>
                <div class="img_level"></div>
          
          </a>
          </div>
          <div class="box" style="vertical-align: center">
          <a href="javascript:;"  style="text-decoration:none;" @click="toContent(Spot.id, Spot.name, Spot.image, Spot.city, Spot.info, Spot.status, Spot.degree ,weather)">
            <div class="level_box"></div>
            <div class="level_box spot_tx">{{ Spot.name }}</div>
            <div class="level_box"></div>
          </a>
          </div>
        
        
          
            <div class="box">
              <div class="level_box"></div>
              <div class="level_box">
                <svg width="3em" height="3em" viewBox="0 0 16 16" :class="'bi bi-heart'+(state==true?'-fill':'')" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color:#99a9bf" @click="addtofav">
                  
                  <path v-if="state" fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                  <path v-if="costate" fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
              </div>
              <div class="level_box"> </div>  
            </div>
          
        
        </main>
      </el-row>
      <el-divider></el-divider>
  </div>
</template>

<script>
import axios from 'axios'
import {API_BASE_URL} from './config.js'

export default {
    name:'spotside',
    props: ["Spot", "username", "weather", "degree"],
    data(){
        return{
            state: this.Spot.status,
            costate: this.Spot.status,

        }
    },
    mounted(){
      console.log(this.degree)

      if(this.state == false){this.costate = true}
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
        updatestate(){
            axios({
                method: 'put',
                url: API_BASE_URL + '/update/'+this.Spot.id+'/'+this.username,
                headers : { 
                    
                },
                  'state': this.state,
                  'username': sessionStorage.getItem('username')

                }).catch(function (error) {
                            // alert(error)
                            console.log(error);    
                }).then((res)=>{

                console.log(res)
                            
                })

        },
        toContent(id, spotname, image, city_name, info, state, degree, weather,address ) {
              this.$router.push({
                path: "/spot",
                query: {
                  spot_id:id,
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
    },
}
</script>

<style>
.spotname{
    font-size: 2em;
    font-weight: bold;
    text-align: right;
    color: #333333;
    vertical-align: bottom;
  }
body {
  font-size: 20px;
  font-family: "微軟正黑體";
}
main {
  /* 容器 */
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  
}
main > .box {
  /* 項目 */
  flex: none;
  width: 25%;
  margin: 3%;
  height: 200px;
}
.img_level {
  height: 8%;
}
.level_box {
  height: 33.3%;
}
.spot_tx {
  margin-top: 5%;
  margin-left: 2%;
  font-size: 1.5rem;
  font-weight: bold;
  color: rgb(70, 69, 90);
}
.fav_bt {
  margin-top: 5%;
  height: 80%;
}
@media screen and (max-width: 1150px) {
  .spot_tx {
    margin-left: 10%;
    font-size: 1.4rem;
  }
}
@media screen and (max-width: 1000px) {
  .spot_tx {
    margin-left: 15%;
    font-size: 1.5rem;
  }
}
@media screen and (max-width: 930px) {
  .spot_tx {
    font-size: 1.3rem;
    margin-left: 18%;
  }
}
@media screen and (max-width: 880px) {
  .spot_tx {
    font-size: 1.1rem;
    margin-left: 27%;
  }
  /*  圖片無法縮放QQQ 
img {
    width: 130px;
    height: 90%;
  } */
}
@media screen and (max-width: 830px) {
  .spot_tx {
    font-size: 1rem;
    margin-left: 35%;
  }
  /*  圖片無法縮放QQQ 
img {
    width: 130px;
    height: 90%;
  } */
}
@media screen and (max-width: 830px) {
  main > .box {
    /* 項目 */
    flex: none;
    width: 50%;
    /* margin: 3%; */
  }
  .level_box {
  height: auto;
}
  .spot_tx {
  margin-top: 2%;
  margin-left: 2%;
  font-size: 1.5rem;
}
.fav_bt {
  height: 40px;
}
}
</style>