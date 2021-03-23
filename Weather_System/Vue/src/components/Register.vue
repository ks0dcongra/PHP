<template>
  <div class="loginform">
    <el-form :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
    <el-form-item label="E-mail" prop="email" label-width="100px">
        <el-input v-model="username"></el-input>
    </el-form-item>
    <el-form-item label="密碼" prop="password">
        <el-input v-model="password" show-password></el-input>
    </el-form-item>
    <el-form-item>
        <el-button type="text" round @click="to('/login')">登入</el-button>
        <el-button type="primary" round @click="register">註冊</el-button>
    </el-form-item>
    </el-form>

</div>
  
</template>

<script>
import axios from 'axios'
import {API_BASE_URL} from './config.js'

export default {
    name:'login',
    data(){
        return{
            token: '',
            username: '',
            password: '',
            test: [],
            rules: {
                email: [
                    { required: true, message: '請輸入正確email格式', trigger: 'blur' },
                    { min:1, max: 30, message: '長度須介於1到30字元', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: '密碼不得留空', trigger: 'change' },
                    { min:8, max: 15, message: '長度須小於8到15字元', trigger: 'blur' }
                ]
            },

        }
    },
    mounted(){
        this.checklogin();
        this.gettest();
    },
    methods:{
        checklogin(){

        },
        login(){
            //write login authencation logic here!
            if( this.userName == 'abcd' && this.password == '1234' ){
            sessionStorage.setItem('token', 'ImLogin')
            this.$router.push('/');
            } else{
            alert('login failed')
            }
        },
        register(){
          axios({
              method: 'post',
              url: API_BASE_URL + '/register',
              headers : { 

              },
              data: {
                'email' : this.username,
                'password' : this.password,
              },

            }).catch(function (error) {
                          // alert(error)
                          console.log(error);    
            }).then((res)=>{
                console.log(res)
              this.token = res.data.token
                           
            })
        },
        to(path) {
            this.opened = false;
            this.$router.push({path: path});
        },
    }

}
</script>

<style>

</style>