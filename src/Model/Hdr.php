<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Common\EcommerceModel;

class Hdr extends EcommerceModel
{
    //    //token
    //    private $accessToken;
    //    //请求日期和时间 格式：CCYY-MMDDThh:mm:ssTZD 举例：2017-03-27T15:28:15+08:00
    //    private $messageDateTime;
    //    //语言：en/zh_CH/th_TH (英文、中文、泰语)
    //    private $messageLanguage = 'zh_CH';
    //    //类型
    //    private $messageType;
    //    //版本
    //    private $messageVersion;

    /**
     * @return mixed
     */
    public function getAccessToken() {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageDateTime() {
        return $this->messageDateTime;
    }

    /**
     * @param mixed $messageDateTime
     */
    public function setMessageDateTime($messageDateTime) {
        $this->messageDateTime = $messageDateTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageLanguage() {
        return $this->messageLanguage;
    }

    /**
     * @param mixed $messageLanguage
     */
    public function setMessageLanguage($messageLanguage) {
        $this->messageLanguage = $messageLanguage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageType() {
        return $this->messageType;
    }

    /**
     * @param mixed $messageType
     */
    public function setMessageType($messageType) {
        $this->messageType = $messageType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageVersion() {
        return $this->messageVersion;
    }

    /**
     * @param mixed $messageVersion
     */
    public function setMessageVersion($messageVersion) {
        $this->messageVersion = $messageVersion;
        return $this;
    }

}