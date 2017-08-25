<style scoped>
  #logo-header {
    height: 60px;
    background-color: #324157;
    color: #F9FAFC;
    text-align: center;
    padding-top: 5px;
  }

  #logo-header img {
    height: 50px;
  }
</style>
<template>
  <div id="layout" ref="layout">
    <el-row class="tac">
      <el-col :span="4">
        <div id="logo-header">
          <a href="/">
            <img src="../../assets/logo.png">
          </a>
        </div>
        <el-menu id="leftnav" ref="leftnav" :default-active="activeMenu" class="el-menu-vertical-demo"
                 @open="handleOpen" @select="handleSelectMenu" @close="handleClose">
          <el-menu-item index="/"><i class="el-icon-menu"></i>首页</el-menu-item>
          <el-menu-item index="/jwt"><i class="el-icon-menu"></i>jwt</el-menu-item>
        </el-menu>
      </el-col>
      <el-col :span="20" id="main-content">
        <el-row>
          <el-col :span="24">
            <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
              <el-submenu class="pull-right" index="2">
                <template slot="title">我的工作台</template>
                <el-menu-item index="/dologout" @click="dologout">注销登陆</el-menu-item>
              </el-submenu>
            </el-menu>
            <div class="line"></div>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="24">
            <div class="layout-content-main">
              <router-view></router-view>
            </div>
          </el-col>
        </el-row>
      </el-col>
    </el-row>
  </div>
</template>
<script>
  import $ from 'jquery'

  export default {
    data() {
      return {
        activeMenu: '/',
        activeIndex: '1'
      };
    },
    mounted() {
      let height = $(window).height()
      $("#layout").css("min-height", height + "px")
      $("#leftnav").css("min-height", height - 60 + "px")
    },
    created() {
      // 计算获取激活导航
      let router = this.$route.path
      this.activeMenu = router.substring(router.lastIndexOf('/'))
    },
    methods: {
      handleOpen(key, keyPath) {
      },
      handleClose(key, keyPath) {
      },
      handleSelectMenu(key, keyPath) {
        let url = keyPath.join('')
        this.$router.push(url)
      },
      handleSelect(key, keyPath) {
      },
      dologout() {
        localStorage.removeItem("jwt");
        localStorage.removeItem("username");
        this.$router.push('/login');
      }
    }
  }
</script>
