<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/23
 * Time: 9:51
 */

namespace app\common\traits;


trait JsonResponse
{
    /**
     * @param $code
     * @param $msg
     * @param array $data
     */
    public function jsonData($code, $msg, $data = [])
    {
        $output = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        echo json_encode($output, 256);
        exit;
    }

    /**
     * 返回成功的调用
     * @param $data
     */
    public function jsonSuccess($data)
    {
        $this->jsonData(0, 'SUCCESS', $data);
    }

}
