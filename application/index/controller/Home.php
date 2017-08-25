<?php
/**
 * Des :
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/8/24
 * Time: 10:38
 */

namespace app\index\controller;


use think\Controller;
use think\Hook;

class Home extends Controller
{
    public function _initialize()
    {
        // 判断是否登录
        Hook::listen('jwt_auth');
    }

    public function index()
    {
        $resp['code'] = 1;
        $resp['msg'] = "hehehe";
        echo json_encode($resp);
    }
}