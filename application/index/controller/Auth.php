<?php
/**
 * Des :
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/8/24
 * Time: 11:06
 */

namespace app\index\controller;


use Firebase\JWT\JWT;
use servers\JwtHander;
use think\Controller;
use think\Env;
use think\Log;
use think\Request;

class Auth extends Controller
{
    /**
     * 登陆接口
     */
    public function dologin()
    {
        $request = request();
        $params = $request->param();
        if (!empty($params['username']) && !empty($params['password']) && $params['username'] == "root" && $params['password'] == "123456") {
            $resp['jwt'] = JwtHander::getInstance()->generateJwt($params['username'], $request->host());
            return echoJson($resp);
        } else {
            $resp['code'] = 2;
            return echoJson($resp,'用户名或密码错误');
        }
    }

    /**
     * 判断用户登陆接口
     */
    public function checkLogin()
    {
        $request = request();
        $header = Request::instance()->header();
        $decoded_array = JwtHander::getInstance()->decodeJwt($header);
        if ($decoded_array) {
            $resp['decoded_jwt'] = $decoded_array;
            // 重新生成jwt
            $resp['jwt'] = JwtHander::getInstance()->generateJwt($decoded_array['sub'], $request->host());
            return echoJson($resp);
        } else {
            $resp['code'] = 2;
            return echoJson($resp,"用户登陆超时");
        }
    }
}