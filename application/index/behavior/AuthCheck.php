<?php
/**
 * Des :
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/8/24
 * Time: 10:50
 */

namespace app\index\behavior;


use servers\JwtHander;
use think\Request;

class AuthCheck
{
    public function run(&$params)
    {
        $header = Request::instance()->header();
        if (Request::instance()->isOptions()) {
            die;
        }
        if (!JwtHander::getInstance()->decodeJwt($header)) {
            $resp['code'] = 2;
            return echoJson($resp,"用户登陆超时");
        }
    }
}