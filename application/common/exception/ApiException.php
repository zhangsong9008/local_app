<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:48
 */

namespace app\common\exception;


use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiErrCodeConst, Throwable $previous = null)
    {
        $code = $apiErrCodeConst[0];
        $message = $apiErrCodeConst[1];
        parent::__construct($message, $code, $previous);
    }


}
