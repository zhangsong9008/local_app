<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:44
 */

namespace app\common\apicode;


class ApiErrDesc
{

    /**
     * code<1000
     * 通用错误码和描述
     */
    const SUCCESS = [0, 'SUCCESS'];
    const ERROR_PARAMS = [1, '参数错误'];
    const ERROR_REQUEST_URI = [2, '调用的方法不存在'];
    const UNKNOWN_ERROR = [3, '未知错误'];


    /**
     * code>1000
     * 与业务相关的错误码
     */
    const ERROR_PASSWORD = [1001, '用户名或密码不正确'];
    const ERROR_FORMAT_USERNAME = [1002, '用户名格式不正确'];
    const ERROR_JWT_TOKEN = [1003, '缺少请求令牌'];
    const ERROR_JWT_TOKEN_INVALID = [1004, '令牌不正确'];
    const ERROR_JWT_TOKEN_EXPIRED = [1005, '令牌已过期'];

}
