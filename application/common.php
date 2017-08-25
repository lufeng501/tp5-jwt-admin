<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 统一JSON规范返回数据API
 *
 * @param array $data
 * @param string $msg
 * @param int $code
 * @return \think\response\Json
 */
function echoJson($data = [], $msg = "OK", $code = 200)
{
    if (empty($data['code'])) {
        $data['code'] = 1;
    }
    $resp['data'] = $data;
    $resp['ret'] = $code;
    $resp['msg'] = $msg;
    return json($resp, 200);
}