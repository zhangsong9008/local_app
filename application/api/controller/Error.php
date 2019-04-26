<?php
/**
 * Created by wwwscn.com
 * User: zhangs
 * Date: 2019/4/23
 * Time: 11:48
 */

namespace app\api\controller;


use app\common\apicode\ApiErrDesc;
use app\common\exception\ApiException;

class Error
{
    public function _empty()
    {
        throw new ApiException(ApiErrDesc::ERROR_REQUEST_URI);
    }

}
