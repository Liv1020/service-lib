<?php
/**
 * User: Liv
 * Date: 15/3/19
 * Time: 上午9:52
 */

namespace Liv\Lib\Service;


use JohnLui\AliyunOSS\AliyunOSS;

class OSS {

    public $ossServer;

    public $ossServerIntranet;

    public $isIntranet;

    public $accessKeyId;

    public $accessKeySecret;

    private $ossClient;

    public function __construct()
    {
        $serverAddress = $this->isInternal ? $this->ossServerIntranet : $this->ossServer;
        $this->ossClient = AliyunOSS::boot(
            $serverAddress,
            $this->accessKeyId,
            $this->accessKeySecret
        );
    }

    public function upload($ossKey, $filePath)
    {
        $this->ossClient->setBucket('提前设置好的Bucket的名称');
        $this->ossClient->uploadFile($ossKey, $filePath);
    }

    public function getUrl($ossKey)
    {
        $this->ossClient->setBucket('提前设置好的Bucket的名称');
        return $this->ossClient->getUrl($ossKey, new \DateTime("+1 day"));
    }

    public function createBucket($bucketName)
    {
        return $this->ossClient->createBucket($bucketName);
    }

    public function getAllObjectKey($bucketName)
    {
        return $this->ossClient->getAllObjectKey($bucketName);
    }

}