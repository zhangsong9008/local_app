<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:34
 */

namespace app\api\controller;


use app\common\apicode\ApiErrDesc;
use app\common\controller\Base;
use app\common\exception\ApiException;
use app\common\traits\JsonResponse;
use jwt\JwtAuth;

class User extends Base
{
    use JsonResponse;

    /**
     * 获取用户基本信息
     */
    public function info()
    {
        $data = [
            'user' => [
                'uid' => $this->request->uid,
                'date' => date('Y-m-d H:i:s')
            ]
        ];
        $this->jsonSuccess($data);
    }

    /**
     * 登录接口
     */
    public function login()
    {
        $userName = $this->request->param('name');
        if (!$userName || strlen($userName) < 10) {
            throw new ApiException(ApiErrDesc::ERROR_FORMAT_USERNAME);
        }
        $jwt = JwtAuth::getInstance();
        $token = $jwt->setUid(1)->getToken();
        $data = [
            'token' => $token
        ];
        $this->jsonSuccess($data);
    }
}
