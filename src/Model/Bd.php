<?php

namespace Tiway\DhlEcommerce\Model;

use Tiway\DhlEcommerce\Common\EcommerceModel;

class Bd extends EcommerceModel
{

    //    //DHL Soldto Account
    //    private $pickupAccountId;
    //    //soldToAccountId DHL Pickup Account
    //    private $soldToAccountId;
    //    //pickupDateTime 提货日期和时间
    //    private $pickupDateTime;
    //    //提货地址详情
    //    private $pickupAddress;
    //    //发件人地址详情
    //    private $shipperAddress;
    //    //发货包裹信息详情
    //    private $shipmentItems;
    //    //仅可定义三个值： Y – 直接返回面单 N – 不返回面单，仅获取追踪号 U – 返回URL面单链接
    //    private $inlineLabelReturn;
    //    //label
    //    private $label;
    //    private $shipmentItems;


    /**
     * @return mixed
     */
    public function getPickupAccountId() {
        return $this->pickupAccountId;
    }

    /**
     * @param mixed $pickupAccountId
     */
    public function setPickupAccountId($pickupAccountId) {
        $this->pickupAccountId = $pickupAccountId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSoldToAccountId() {
        return $this->soldToAccountId;
    }

    /**
     * @param mixed $soldToAccountId
     */
    public function setSoldToAccountId($soldToAccountId) {
        $this->soldToAccountId = $soldToAccountId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPickupDateTime() {
        return $this->pickupDateTime;
    }

    /**
     * @param mixed $pickupDateTime
     */
    public function setPickupDateTime($pickupDateTime) {
        $this->pickupDateTime = $pickupDateTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPickupAddress() {
        return $this->pickupAddress;
    }

    /**
     * @param mixed $pickupAddress
     */
    public function setPickupAddress($pickupAddress) {
        $this->pickupAddress = $pickupAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipperAddress() {
        return $this->shipperAddress;
    }

    /**
     * @param mixed $shipperAddress
     */
    public function setShipperAddress($shipperAddress) {
        $this->shipperAddress = $shipperAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentItems() {
        return $this->shipmentItems;
    }

    /**
     * @param mixed $shipmentItems
     */
    public function setShipmentItems($shipmentItems) {
        $this->shipmentItems = $shipmentItems;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInlineLabelReturn() {
        return $this->inlineLabelReturn;
    }

    /**
     * @param mixed $inlineLabelReturn
     */
    public function setInlineLabelReturn($inlineLabelReturn) {
        $this->inlineLabelReturn = $inlineLabelReturn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

}