<?php
/**
 * 七牛服务类
 * User: Liv
 * Date: 15/3/19
 * Time: 上午9:45
 */

namespace Liv\Lib\Service;


class QiNiu {

    /**
     * @var string
     */
    public $accessKey;

    /**
     * @var string
     */
    public $secretKey;

    /**
     * @var string
     */
    public $bucketName;

    /**
     * 上传
     * @param $key
     * @param $data
     * @param null $params
     * @param string $mime
     * @param bool $checkCrc
     * @return array
     * @throws \Exception
     */
    public function put($key,$data,$params = null,$mime = 'application/octet-stream',$checkCrc = false){
        $upManager = new UploadManager();
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucketName);
        list($ret, $error) = $upManager->put($token, $key, $data, $params, $mime, $checkCrc);

        if($error){
            throw new \Exception($error);
        }

        return $ret;
    }

    /**
     * 上传文件
     * @param $key
     * @param $filePath
     * @param null $params
     * @param string $mime
     * @param bool $checkCrc
     * @return array
     * @throws \Exception
     */
    public function putFile($key,$filePath,$params = null,$mime = 'application/octet-stream',$checkCrc = false){
        $upManager = new UploadManager();
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucketName);
        list($ret, $error) = $upManager->putFile($token, $key, $filePath, $params, $mime, $checkCrc);

        if($error){
            throw new \Exception($error);
        }

        return $ret;
    }

    /**
     * 删除
     * @param $key
     * @return bool
     */
    public function delete($key){
        $auth = new Auth($this->accessKey, $this->secretKey);
        $manager = new BucketManager($auth);
        $manager->delete($this->bucketName,$key);

        return true;
    }
}