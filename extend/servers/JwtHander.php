<?php
/**
 * Des : jwt操作类
 * Created by PhpStorm.
 * User: lufeng501206@gmail.com
 * Date: 2017/8/25
 * Time: 15:26
 */

namespace servers;


use Firebase\JWT\JWT;
use think\Env;

class JwtHander
{
    /**
     * 类静态实例对象
     *
     * @var null
     */
    static private $_instance = null;

    /**
     * 获取单例
     *
     * @return null|JwtHander
     */
    static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * 构造方法
     *
     * JwtHander constructor.
     */
    private function __construct()
    {
    }

    /**
     * 生成jwt
     *
     * @param $username
     * @param $host
     * @param int $time
     * @return string
     */
    public function generateJwt($username, $host, $time = 3600)
    {
        $key = Env::get('jwt_key');
        $token = array(
            "sub" => $username,
            "iss" => $host . "/index/auth/dologin",
            "iat" => time(),
            "exp" => time() + $time,
            "nbf" => time()
        );
        $jwt = JWT::encode($token, $key);
        return $jwt;
    }

    /**
     * 解密jwt
     *
     * @param $header
     * @return bool
     */
    public function decodeJwt($header)
    {
        if (!empty($header['x-jwt-header'])) {
            $key = Env::get('jwt_key');
            $jwt = $header['x-jwt-header'];
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $decoded_array = (array)$decoded;
            if (empty($decoded_array) || empty($decoded_array['sub'])) {
                return false;
            } else {
                return $decoded_array;
            }
        } else {
            return false;
        }
    }
}