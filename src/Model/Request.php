<?php

namespace Tiway\DhlEcommerce\Model;

use Tiway\DhlEcommerce\Common\EcommerceModel;

class Request extends EcommerceModel
{
    //    private $hdr;
    //    private $bd;
    //    private $trackingReferenceNumber;
    //    private $messageLanguage;
    //    private $messageVersion;
    //    private $token;

    /**
     * @return mixed
     */
    public function getTrackingReferenceNumber() {
        return $this->trackingReferenceNumber;
    }

    /**
     * @param mixed $trackingReferenceNumber
     */
    public function setTrackingReferenceNumber($trackingReferenceNumber) {
        $this->trackingReferenceNumber = $trackingReferenceNumber;
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

    /**
     * @return mixed
     */
    public function getToken() {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token) {
        $this->token = $token;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getHdr() {
        return $this->hdr;
    }

    /**
     * @param mixed $hdr
     */
    public function setHdr($hdr) {
        $this->hdr = $hdr;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBd() {
        return $this->bd;
    }

    /**
     * @param mixed $bd
     */
    public function setBd($bd) {
        $this->bd = $bd;
        return $this;
    }
}