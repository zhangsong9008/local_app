<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:55
 */

namespace app\common\exception;


use app\common\apicode\ApiErrDesc;
use app\common\traits\JsonResponse;
use think\exception\Handle;

class HttpException extends Handle
{
    use JsonResponse;

    public function render(\Exception $e)
    {
        // 参数验证错误
        if ($e instanceof ApiException) {
            $code = $e->getCode();
            $message = $e->getMessage();
        } else {
            $code = $e->getCode();
            if (!$code || $code < 0) {
                $code = ApiErrDesc::UNKNOWN_ERROR[0];
            }
            $message = $e->getMessage() ?: ApiErrDesc::UNKNOWN_ERROR[1];
        }
        $this->jsonData($code, $message, []);
    }

}
