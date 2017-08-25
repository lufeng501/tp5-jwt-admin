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
use think\Controller;
use think\Env;
use think\Log;
use think\Request;

class Auth extends Controller
{
    public function dologin()
    {
        $request = request();
        $params = $request->param();
        if (!empty($params['username']) && !empty($params['password']) && $params['username'] == "root" && $params['password'] == "123456") {
            $resp['code'] = 1;
            $resp['msg'] = "用户登陆成功";
            $resp['jwt'] = $this->getJwt($params['username'], $request->host());
            echo json_encode($resp);
            die;
        } else {
            $resp['code'] = -1;
            $resp['msg'] = "用户登陆失败";
            echo json_encode($resp);
            die;
        }
    }

    public function checkLogin()
    {
        $info = Request::instance()->header();
        if (!empty($info['x-jwt-header'])) {
            $key = Env::get('jwt_key');
            $jwt = $info['x-jwt-header'];
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $resp['data'] = $decoded;
            $resp['code'] = 1;
            echo json_encode($resp);
            die;
        } else {
            $resp['code'] = 1;
            $resp['msg'] = "用户登陆超时";
            echo json_encode($resp);
            die;
        }
    }

    /**
     * 获取jwt
     * @return string
     */
    public function getJwt($username, $host)
    {
        $key = Env::get('jwt_key');
        $token = array(
            "sub" => $username,
            "iss" => $host."/index/auth/dologin",
            "iat" => time(),
            "exp" => time() + 3600,
            "nbf" => time()
        );
        $jwt = JWT::encode($token, $key);
        return $jwt;
    }
}