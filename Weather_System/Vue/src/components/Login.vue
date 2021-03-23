<template>
<div>
  <div class="loginform" v-if="showlogin">
    <el-form
      :rules="rules"
      :model="ruleForm"
      ref="ruleForm"
      label-width="100px"
      class="demo-ruleForm"
    >
      <el-form-item label="E-mail" prop="email" label-width="100px">
        <el-input v-model="ruleForm.email" size="medium"></el-input>
      </el-form-item>
      <el-form-item label="密碼" prop="password">
        <el-input v-model="ruleForm.password" show-password size="medium"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="text" round @click="toggle()"
          >建立帳號</el-button
        >
        <el-button type="primary" round @click="submit"
          >登入</el-button
        >
      </el-form-item>
    </el-form>
  </div>
  <div class="regisform" v-if="showregis">
    <el-form :rules="rules" :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">
    <el-form-item label="E-mail" prop="email" label-width="100px">
        <el-input v-model="ruleForm.email" size="medium"></el-input>
    </el-form-item>
    <el-form-item label="密碼" prop="password">
        <el-input v-model="ruleForm.password" show-password size="medium"></el-input>
    </el-form-item>
    <el-form-item label="暱稱" prop="nickname">
        <el-input v-model="nickname"  size="medium"></el-input>
    </el-form-item>

    <el-form-item prop="gender" label="性別">
            <el-radio-group v-model="ruleForm.gender">
              <el-radio  label="male">
                <span

                  >男
                </span></el-radio
              >

              <el-radio  label="female">
                <span

                  >女</span
                ></el-radio
              >
            </el-radio-group>
          </el-form-item>
    <el-form-item>
        <el-button type="text" round @click="toggle()">我要登入</el-button>
        <el-button type="primary" round @click="register">註冊</el-button>
    </el-form-item>
    </el-form>

  </div>
</div>
</template>

<script>
import axios from "axios";
import { API_BASE_URL } from "./config.js";

export default {
  name: "login",
  data() {
    return {
      token: "",
      username: "",
      password: "",
      nickname: "",
      sex: '0',
      test: [],
      showlogin: true,
      showregis: false,


      ruleForm: {
        email: "",
        password: "",
        gender: "",
      },
      rules: {
        email: [
          { required: true, message: "請輸入email", trigger: "blur" },
          { type: 'email', message: "請輸入正確email格式", trigger: ['blur', 'change'] },
          { min: 1, max: 30, message: "長度須介於1到30字元", trigger: "blur" },
        ],
        password: [
          { required: true, message: "密碼不得留空", trigger: "change" },
          { min: 8, max: 15, message: "長度須小於8到15字元", trigger: "blur" },
          {
            required: true,
            pattern: /^[a-zA-Z0-9]+$/,
            message: "請輸入英數字",
          },
        ],
        gender: [{ required: true, message: "請選擇性別", trigger: "blur" }],
        nickname: [
          { required: true, trigger: "blur" },
        ]
      },
    };
  },
  mounted() {
    this.checklogin();
    this.gettest();
    //console.log('router'+this.$router)
  },
  methods: {
    checklogin() {

    },
    //login function
    submit(){
          axios({
              method: 'post',
              url: API_BASE_URL + '/login',
              headers : { 

              },
              data: {
                'email' : this.ruleForm.email,
                'password' : this.ruleForm.password,
              },

            }).catch(function (error) {
                          // alert(error)
                          console.log(error);    
            }).then((res)=>{
                console.log(res)

              this.token = res.data
                //write login authencation logic here!
                if( this.token == 'Imlogin' ){
                sessionStorage.setItem('token', 'Imlogin')
                sessionStorage.setItem('username', this.ruleForm.email)
                console.log('session username: '+sessionStorage.getItem('username'))
                this.$router.push('/');
                } else{
                alert('login failed')
                }           
            })
    },

    //register function
    register(){
          axios({
              method: 'post',
              url: API_BASE_URL + '/register',
              headers : { 

              },
              data: {
                'email' : this.ruleForm.email,
                'password' : this.ruleForm.password,
                'name' : this.nickname,
                'gender' : this.ruleForm.gender,
              },

            }).catch(function (error) {
                          // alert(error)
                          console.log(error);    
            }).then((res)=>{
              console.log(res)
              //根據回傳判斷是否註冊成功
              if(res.data == 'Success'){
                sessionStorage.setItem('token', 'Imlogin')
                sessionStorage.setItem('username', this.ruleForm.email)
                this.$router.push('/');
              }

              
                           
            })
    },
    //general function
    to(path) {
      this.opened = false;
      this.$router.push({ path: path });
    },
    toggle(){
      if(this.showlogin == true){
        this.showregis = true;
        this.showlogin = false;
      }else if(this.showregis == true){
        this.showregis = false;
        this.showlogin = true;
      }
    },
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          alert("submit!");
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
  },

  //send:[post] username, password
  //recieve: token, login result
};
</script>

<style>
.loginform {
  width: 500px;
  margin: 0px auto;
}
.regisform {
  width: 500px;
  margin: 0px auto;
}
</style>