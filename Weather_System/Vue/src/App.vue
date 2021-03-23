<template>
  <div id="app">
    <el-container>
      <el-header height="120px"><Navbar/></el-header>
      <!--<el-main><Map/></el-main> -->

        <el-main class="main"><router-view></router-view></el-main>

      <el-footer> 資料來源:
      <el-link href="https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-C0032-008?Authorization=rdec-key-123-45678-011121314&format=JSON" target="_blank" type="primary" :underline="false">亞洲最大最齊全開放資料入口網站Dataportal.asia</el-link>
      </el-footer>
    </el-container>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
//import Map from './components/Map.vue'
//import axios from 'axios'

export default {
  name: 'App',
  components: {
      Navbar
  },
  created(){
    
  },
  methods:{

  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  
}
  .el-header {
    background-color:#90B0CA;
    color: #333;
    text-align: center;
    line-height: 60px;

  }
  body > .el-container {
    margin-bottom: 0px;

    
    
  }
  .el-main {
    background-color: #E9EEF3;
    color: #333;
    text-align: center;

    
  }
  .el-footer {
    background-color: #B3C0D1;
    color: #333;
    text-align: center;
    line-height: 60px;
    font-size: 1em;
  }

</style>
