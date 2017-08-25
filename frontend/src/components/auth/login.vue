<style scoped>
</style>
<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="6" :offset="9">
                <el-card class="box-card" style="margin-top: 200px">
                    <div slot="header" class="clearfix">
                        <span>用户登陆</span>
                    </div>
                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px">
                        <el-form-item label="用户名：" prop="username">
                            <el-input type="text" v-model="ruleForm.username" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="密　码：" prop="password">
                            <el-input type="password" v-model="ruleForm.password" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">登陆</el-button>
                        </el-form-item>
                    </el-form>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>
<script>

  // 获取API地址
  const API_ROOT = process.env.API_ROOT

  import qs from 'qs';

  export default {
    data() {
      var validateUser = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入用户名'));
        } else {
          callback();
        }
      };
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else {
          callback();
        }
      };
      return {
        ruleForm: {
          username: '',
          password: ''
        },
        rules: {
          username: [
            {validator: validateUser, trigger: 'blur'}
          ],
          password: [
            {validator: validatePass, trigger: 'blur'}
          ]
        }
      };
    },
    created() {
    },
    methods: {
      submitForm(formName) {
        let _me = this
        this.$refs[formName].validate((valid) => {
          if (valid) {
            console.log(_me.ruleForm)
            let data = _me.ruleForm
            _me.$http.post(API_ROOT + '/index/auth/dologin', qs.stringify(data))
              .then((response) => {
                let resp = response.data
                if (resp.code === 1) {
                  _me.$message.success('登陆成功,正在跳转...');
                  localStorage.username = _me.ruleForm.username
                  localStorage.jwt = resp.jwt
                  _me.$router.push("/")
                } else {
                  _me.$message.error('用户名或密码错误');
                }
              })
              .catch(function(response) {
                _me.$message.error('服务器出错，无法登陆');
                console.log(response)
              });
          } else {
            _me.$message.error('请检查用户名和密码！');
            return false;
          }
        });
      }
    }
  }
</script>
