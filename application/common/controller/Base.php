<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:26
 */

namespace app\common\controller;


use app\common\apicode\ApiErrDesc;
use app\common\exception\ApiException;
use think\Controller;

class Base extends Controller
{

    /**
     * 权限验证中间件
     * @var array
     */
    protected $middleware = [
        'Auth' => ['except' => ['sendMsg', 'login', ' captcha']],//短信码 登录 图形验证码 不用鉴权
    ];


    /**
     * 定义空方法
     */
    public function _empty()
    {
        throw new ApiException(ApiErrDesc::ERROR_REQUEST_URI);
    }
}
