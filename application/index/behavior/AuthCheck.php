<?php
/**
 * Des :
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/8/24
 * Time: 10:50
 */

namespace app\index\behavior;


use Firebase\JWT\JWT;
use think\Env;
use think\Log;
use think\Request;
use think\Response;

class AuthCheck
{
    public function run(&$params)
    {
        $info = Request::instance()->header();
        Log::info($info);
        Log::info($_SERVER);
        if (Request::instance()->isOptions()) {
            die;
        }
        if (!empty($info['x-jwt-header'])) {
            $key = Env::get('jwt_key');
            $jwt = $info['x-jwt-header'];
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $decoded_array = (array) $decoded;
            if (empty($decoded_array) || empty($decoded_array['sub'])) {
                $resp['code'] = 1;
                $resp['msg'] = "用户登陆超时";
                echo json_encode($resp);
                die;
            }
        } else {
            $resp['code'] = 1;
            $resp['msg'] = "用户登陆超时";
            echo json_encode($resp);
            die;
        }
    }
}