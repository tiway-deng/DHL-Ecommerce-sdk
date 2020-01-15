<?php

namespace Tiway\DhlEcommerce\Model;

use Tiway\DhlEcommerce\Common\EcommerceModel;

class ShipmentItems extends EcommerceModel
{
    //    //收件人地址详情
    //    private $consigneeAddress;
    //    //退件地址详情
    //    private $returnAddress;
    //    //发货号码（物流商流水号） 由客户自定义，必须以客户唯一前缀为首。 举例：HKABC1234567890
    //    private $shipmentID;
    //    //追踪号，默认为null
    //    private $deliveryConfirmationNo;
    //    //包裹品类概括描述： 例如：Fashion/Watch/Electronic
    //    private $packageDesc;
    //    //包裹总重量
    //    private $totalWeight;
    //    //包裹总重量单位：默认为“G”
    //    private $totalWeightUOM;
    //    //货到付款金额，默认为0.00
    //    private $codValue;
    //    //包裹属性标识。 如客户未开通带电，则默认null。 如客户开通带电，则00 - 普货，04 - 带电。
    //    private $contentIndicator;
    //    //包裹总价值
    //    private $totalValue;
    //    //包裹总价值币种
    //    private $currency;
    //    private $customerReference1;
    //    private $customerReference2;
    //    //货运费，默认为0.00。
    //    private $freightCharge;
    //    //包裹高
    //    private $height;
    //    //长
    //    private $length;
    //    //宽
    //    private $width;
    //    //包裹长度单位
    //    private $dimensionUOM;
    //    //国际贸易简制 （DDU - 平邮、挂号、中英、中澳） （DDP - 中美、中以）
    //    private $incoterm;
    //    //包裹保险金额
    //    private $insuranceValue;
    //    //包裹产品编码
    //    private $productCode;
    //    //此字段只针对WS客户，直客无需填写。
    //    private $workshareIndicator;
    //    //包裹备注（会出现在报关标签中的Remarks中）
    //    private $remarks;
    //    //包裹物品详细描述
    //    private $shipmentContents;

    /**
     * @return mixed
     */
    public function getConsigneeAddress() {
        return $this->consigneeAddress;
    }

    /**
     * @param mixed $consigneeAddress
     */
    public function setConsigneeAddress($consigneeAddress) {
        $this->consigneeAddress = $consigneeAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnAddress() {
        return $this->returnAddress;
    }

    /**
     * @param mixed $returnAddress
     */
    public function setReturnAddress($returnAddress) {
        $this->returnAddress = $returnAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentID() {
        return $this->shipmentID;
    }

    /**
     * @param mixed $shipmentID
     */
    public function setShipmentID($shipmentID) {
        $this->shipmentID = $shipmentID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryConfirmationNo() {
        return $this->deliveryConfirmationNo;
    }

    /**
     * @param mixed $deliveryConfirmationNo
     */
    public function setDeliveryConfirmationNo($deliveryConfirmationNo) {
        $this->deliveryConfirmationNo = $deliveryConfirmationNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackageDesc() {
        return $this->packageDesc;
    }

    /**
     * @param mixed $packageDesc
     */
    public function setPackageDesc($packageDesc) {
        $this->packageDesc = $packageDesc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalWeight() {
        return $this->totalWeight;
    }

    /**
     * @param mixed $totalWeight
     */
    public function setTotalWeight($totalWeight) {
        $this->totalWeight = $totalWeight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalWeightUOM() {
        return $this->totalWeightUOM;
    }

    /**
     * @param mixed $totalWeightUOM
     */
    public function setTotalWeightUOM($totalWeightUOM) {
        $this->totalWeightUOM = $totalWeightUOM;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodValue() {
        return $this->codValue;
    }

    /**
     * @param mixed $codValue
     */
    public function setCodValue($codValue) {
        $this->codValue = $codValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentIndicator() {
        return $this->contentIndicator;
    }

    /**
     * @param mixed $contentIndicator
     */
    public function setContentIndicator($contentIndicator) {
        $this->contentIndicator = $contentIndicator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalValue() {
        return $this->totalValue;
    }

    /**
     * @param mixed $totalValue
     */
    public function setTotalValue($totalValue) {
        $this->totalValue = $totalValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerReference1() {
        return $this->customerReference1;
    }

    /**
     * @param mixed $customerReference1
     */
    public function setCustomerReference1($customerReference1) {
        $this->customerReference1 = $customerReference1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerReference2() {
        return $this->customerReference2;
    }

    /**
     * @param mixed $customerReference2
     */
    public function setCustomerReference2($customerReference2) {
        $this->customerReference2 = $customerReference2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFreightCharge() {
        return $this->freightCharge;
    }

    /**
     * @param mixed $freightCharge
     */
    public function setFreightCharge($freightCharge) {
        $this->freightCharge = $freightCharge;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length) {
        $this->length = $length;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDimensionUOM() {
        return $this->dimensionUOM;
    }

    /**
     * @param mixed $dimensionUOM
     */
    public function setDimensionUOM($dimensionUOM) {
        $this->dimensionUOM = $dimensionUOM;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIncoterm() {
        return $this->incoterm;
    }

    /**
     * @param mixed $incoterm
     */
    public function setIncoterm($incoterm) {
        $this->incoterm = $incoterm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsuranceValue() {
        return $this->insuranceValue;
    }

    /**
     * @param mixed $insuranceValue
     */
    public function setInsuranceValue($insuranceValue) {
        $this->insuranceValue = $insuranceValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductCode() {
        return $this->productCode;
    }

    /**
     * @param mixed $productCode
     */
    public function setProductCode($productCode) {
        $this->productCode = $productCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkshareIndicator() {
        return $this->workshareIndicator;
    }

    /**
     * @param mixed $workshareIndicator
     */
    public function setWorkshareIndicator($workshareIndicator) {
        $this->workshareIndicator = $workshareIndicator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemarks() {
        return $this->remarks;
    }

    /**
     * @param mixed $remarks
     */
    public function setRemarks($remarks) {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentContents() {
        return $this->shipmentContents;
    }

    /**
     * @param mixed $shipmentContents
     */
    public function setShipmentContents($shipmentContents) {
        $this->shipmentContents = $shipmentContents;
        return $this;
    }
}