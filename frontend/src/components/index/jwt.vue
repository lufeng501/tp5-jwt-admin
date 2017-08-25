<style>
    .pull-left {
        float: left !important;
    }
    .pull-right {
        float: right !important;
    }
</style>
<template>
    <div>
        <el-card class="box-card box-breadcrumb">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">后台管理</el-breadcrumb-item>
                <el-breadcrumb-item>首页</el-breadcrumb-item>
            </el-breadcrumb>
        </el-card>
        <div class="layout-content">
            <el-row>
                <el-card class="box-card">
                    <h1>
                        jwt
                    </h1>
                </el-card>
            </el-row>
        </div>
    </div>
</template>
<script>

  // 获取API地址
  const API_ROOT = process.env.API_ROOT

  import $ from "jquery"
  import HttpServer from '../../librarys/http_server'

    export default {
        data () {
            return {
                editModel: false,
                http_server: {},
            }
        },
        created() {
          this.http_server = new HttpServer()
//          this.getData();
        },
        methods: {
          getData() {
            let _me = this
            this.http_server.get(API_ROOT + '/index/home/index').then(function (data) {
              console.log('this.http_server')
              console.log(data)
            })
          }
        }
    }
</script>
