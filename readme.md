tp5-jwt-admin
========

tp5-jwt-admin是前后端分离的后台系统模板，前端是SPA单页面，后端生成jwt完成用户认证及提供业务数据。

> 演示地址：[http://frontend.tp-jwt-admin.lusion-blog.cn/](http://frontend.tp-jwt-admin.lusion-blog.cn/)

> 账号：root 密码：123456

![nchat](http://7xpt3g.com1.z0.glb.clouddn.com/snipaste_20170829_113328.png)

![nchat](http://7xqb58.com1.z0.glb.clouddn.com/snipaste_20170822_110601.png)

## 前提

- 对SPA和前后端分离项目有一定的了解
- 会使用Composer安装php依赖包
- 本地生成环境有node环境
- 对json web token有一定的了解： [单页应用-Token验证](http://www.jianshu.com/p/1fe7ea398f91)


## 特点

- 前端使用vue2.0+vue-router+webpack+es6+element
- 后端框架使用thinkphp提供API服务
- jwt生成使用扩展包： [https://github.com/firebase/php-jwt](https://github.com/firebase/php-jwt)
- api格式统一返回结构参考： [phalapi](https://www.phalapi.net/wikis/1-14.html)
- 后台本身没有附加其它额外功能，仅有一个用户登陆注销功能，简洁，业务扩展性强

## 部署

- git clone https://github.com/lufeng501/tp5-jwt-admin.git
- 进入根目录`cd tp5-jwt-admin` 下载依赖包： `composer install`
- 后端nginx配置：

```
server {
    listen       80; 
    server_name  api.tp-jwt-admin.com;

    root    /data/web/tp5-jwt-admin/public;

    location / { 
        index  index.php index.html index.htm;
        if (!-e $request_filename) {
            rewrite  ^(.*)$  /index.php?s=/$1  last;
            break;
        }   
    }   

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
        add_header     Access-Control-Allow-Origin *;
        add_header     Access-Control-Allow-Headers X-JWT-Header;
    }   
} 
```

- 验证后端接口：访问`http://api.tp-jwt-admin.com/`,如果能正常返回json格式则后端部署成功

```
{
    data: {
        code: 1
    },
    ret: 200,
    msg: "hello tp5"
}
```

- 切换目录：`cd frontend` 运行命令：`npm install`
- 配置api地址：`cd frontend config`

```angular2html

// 开发环境修改文件dev.env.js
module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  API_ROOT: '"http://api.tp-jwt-admin.com"'
})

// 生产环境修改文件prod.env.js
module.exports = merge(prodEnv, {
  NODE_ENV: '"production"',
  API_ROOT: '"http://api.tp-jwt-admin.com"'
})

```

- 开发环境运行：`npm run dev`：运行效果访问：`localhost:8080`


- 生产环境打包: `npm run build`
- 前端Nginx配置：

```
server {
    listen       80; 
    server_name  frontend.tp-jwt-admin.com;

    root    /data/web/tp5-jwt-admin/frontend/dist;

    location / { 
        index index.html;
        try_files $uri $uri/ /index.html;
    }

}
```

访问:`http://frontend.tp-jwt-admin.com/#/login` 


## TODO 

> 添加默认的权限管理功能
