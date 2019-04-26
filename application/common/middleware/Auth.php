<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:33
 */

namespace app\common\middleware;


use app\common\apicode\ApiErrDesc;
use app\common\exception\ApiException;
use jwt\JwtAuth;

class Auth
{

    /**
     * 接口鉴权
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $token = input('token');
        if (!$token) {
            throw new ApiException(ApiErrDesc::ERROR_JWT_TOKEN);
        }
        $jwtAuth = JwtAuth::getInstance();
        $jwtAuth->setToken($token);
        $jwtAuth->verify();
        $jwtAuth->validate();
        $request->uid = $jwtAuth->getUid();

        return $next($request);
    }
}
