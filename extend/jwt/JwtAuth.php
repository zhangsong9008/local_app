<?php
/**
 * Created by PhpStorm.
 * User: zhangs
 * Date: 2019/4/22
 * Time: 17:07
 */

namespace jwt;

use app\common\apicode\ApiErrDesc;
use app\common\exception\ApiException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class JwtAuth
{
    private static $instance;

    /**
     * 密码
     * @var string
     * @ses https://www.jianshu.com/p/dcdcf0f29f93
     */
    private $secret = 'suspn@)!*';

    /**
     * claim iss
     * @var string
     */
    private $iss = 'wwwscn';

    /**
     * claim aud
     * @var string
     */
    private $aud = 'verify_app';

    /**
     * claim id
     * @var string
     */
    private $id = 'wwwscn';


    /**
     * token
     * @var
     */
    private $token;


    /**
     * claim uid
     * @var
     */
    private $uid;

    /**
     * 获取对象实例
     * @return JwtAuth
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 根据业务设置用户uid
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 生成token
     * @return string
     */
    public function getToken()
    {
        $builder = new Builder();
        $signer = new Sha256();

        //设置header和payload，以下的字段都可以自定义
        $builder->setIssuer($this->iss)//发布者
        ->setAudience($this->aud)//接收者
        ->setId($this->id, true)//对当前token设置的标识
        ->setIssuedAt(time())//token创建时间
        ->setExpiration(time() + 3600)//过期时间
        ->setNotBefore(time() + 5)//当前时间在这个时间前，token不能使用
        ->set('uid', $this->uid); //自定义数据

        //设置签名
        $builder->sign($signer, $this->secret);
        //获取加密后的token，转为字符串
        $token = (string)$builder->getToken();
        return $token;
    }

    /**
     * 设置token值
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * 验证token是否合法
     * @return bool
     */
    public function verify()
    {
        $signer = new Sha256();
        //解析token
        $parse = (new Parser())->parse($this->token);
        //验证token合法性
        if (!$parse->verify($signer, $this->secret)) {
            throw new ApiException(ApiErrDesc::ERROR_JWT_TOKEN_INVALID);
        }

        //验证是否已经过期
        if ($parse->isExpired()) {
            throw new ApiException(ApiErrDesc::ERROR_JWT_TOKEN_EXPIRED);
        }

        $this->setUid($parse->getClaim('uid'));
        return true;
    }

    /**
     * 验证token是否有效
     * @return bool
     */
    public function validate()
    {
        $parse = (new Parser())->parse($this->token);
        $validate = new ValidationData();
        $validate->setIssuer($this->iss);
        $validate->setAudience($this->aud);
        $validate->setId($this->id);

        $res = $parse->validate($validate);
        if (!$res) {
            throw new ApiException(ApiErrDesc::ERROR_JWT_TOKEN_INVALID);
        }
        return true;
    }


    /**
     * 获取用户id
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }
}
