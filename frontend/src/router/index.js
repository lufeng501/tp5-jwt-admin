import Vue from 'vue'
import Router from 'vue-router'
import axios from 'axios'
import layout from '@/components/layout/index'
import jwt from '@/components/index/jwt'
import login from '@/components/auth/login'


Vue.prototype.$http = axios

Vue.use(Router)

// 获取API地址
const API_ROOT = process.env.API_ROOT

import HttpServer from '../librarys/http_server'

export default new Router({
  routes: [
    {
      beforeEnter: (to, from, next) => {
        let http_server = new HttpServer()
        http_server.get(API_ROOT+"/index/auth/checkLogin").then(function (resp) {
          if (resp.data &&  resp.data.sub) {
            next();
          } else {
            next('/login');
          }
        },function (error) {
          console.log(error)
        })
      },
      path: '/',
      component: layout,
      children: [
        {
          path: '/',
          component: jwt
        },
        {
          path: '/jwt',
          component: jwt
        }
      ]
    },
    {
      path: '/login',
      component: login
    }
  ]
})
