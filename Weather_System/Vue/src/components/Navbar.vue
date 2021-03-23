<template>
<div>
    <el-row  style="background:#99a9bf">
     <el-row :gutter="12">
      <el-col :span="4">

          <el-button class="title" type="text" @click="to('/')">天氣景點收藏系統</el-button>
         

      </el-col>
      

      <el-col :span="10" >
          <span class="grid-content"> <h3></h3></span>
      </el-col>

      <el-col :span="6" >
          <span class="grid-content"><q></q>{{nickname}}</span>
      </el-col>
      <el-col :span="4" > 
 
          <el-button v-if="visible" class="logout" type="text" @click="logout">登出</el-button>

      </el-col>
  </el-row>
  <!-- <el-row :gutter="12">
    <el-col :span="4"><div class="grid-content bg-purple">      
        <el-button type="text" @click="to('/')" id="cars">地圖</el-button>    
    </div></el-col>
    
    <el-col :span="4"><div class="grid-content bg-purple">
        <el-button type="text" @click="to('/popular')" id="cars" size="medium">熱門</el-button>
    </div></el-col>
    <el-col :span="4"><div class="grid-content bg-purple">
        <el-button type="text" @click="to('/favorites')" id="cars">收藏</el-button>
    </div></el-col>
    
    <el-col :span="8"><div class="grid-content bg-purple"> -->
     <!-- <el-input placeholder="請輸入城市或景點" v-model="input3" class="input">
        <el-button slot="append" icon="el-icon-search"></el-button>
    </el-input> -->
    <!-- </div></el-col>
    <el-col :span="4"><div class="grid-content bg-purple">
        <el-button type="text" @click="to('/member')" id="cars">個人中心</el-button>
    </div></el-col>
  </el-row> -->
  <!--new version navbar!!!-->
  <el-row>
      <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect"   active-text-color="#99a9bf">
          <el-menu-item index="1" @click="to('/')">地圖</el-menu-item>
          <el-menu-item index="2" @click="to('/popular')">熱門</el-menu-item>
          <el-menu-item index="3" @click="to('/favorites')">收藏</el-menu-item>
          <el-menu-item index="4" @click="to('/member')">個人中心</el-menu-item>
      </el-menu>
  </el-row>
</el-row>

</div>

</template>

<script>
import axios from 'axios'
import {API_BASE_URL} from './config.js'

export default {
    data(){
        return{
            opened: false,
            logourl: "https://i.ibb.co/V2mXwbq/storm.png",
            //logourl: "./assets/storm.png"
            visible: true,
            activeIndex: '1',
            nickname:'',
            username:'',
        }

    },
    // watch:{
    //   routepath: function(){
    //     if(this.routepath == '/login'){         
    //       console.log('you must login first!')
    //     }else{
    //       //this.mounted
    //     }
    //   }

    // },
    mounted(){
        const Islogin =  sessionStorage.getItem('token');
        this.username = sessionStorage.getItem('username');
        if(Islogin == 'Imlogin'){
            //this.visible = true;
            this.getnickname();
        }
    },
    methods: {
        handleSelect(key,keyPath){
            console.log(key,keyPath);
        },
        to(path) {
            this.opened = false;
            this.$router.push({path: path});
        },
        getnickname(){
            axios({
              method: 'get',
              url: API_BASE_URL + '/member/'+this.username,
              headers : { 

              },
            }).catch(function (error) {
                          // alert(error)
                          console.log(error);    
            }).then((res)=>{
              console.log(res)
               this.nickname = '歡迎，'+res.data.name
               //this.gender = res.data.gender

              
                           
            })                
        }, 
        logout(){
            sessionStorage.removeItem('token');
            this.$router.push('/login');
            this.nickname = '';
            //this.visible = false;
            axios({
              method: 'post',
              url: API_BASE_URL + '/logout',
              headers : {  
 
              },
              data:{
                  'email': this.username
              }

            }).catch(function (error) {
                          // alert(error)
                          console.log('error:'+error);    
            }).then((res)=>{
              console.log(res)

                           
            })
        }
    },

}
</script>

<style scoped>
    .grid-content {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 1em;
        color: rgb(0, 0, 0);
        text-decoration: none;
    }
    .logout{
        font-size: 1em;
        text-decoration: none;
        color: #333333;
    }
    .title{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 1.5em;
        color: #fff;
        text-decoration: none;
    }
    q{
        color:#99a9bf ;
    }

</style>