<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Common\EcommerceModel;

class ContentItem extends EcommerceModel
{
    //    //产品属性标识。 如客户未开通带电，则默认null。 如客户开通带电，则00 - 普货，04 - 带电。
    //    private $contentIndicator;
    //    //产品原产国。
    //    private $countryOfOrigin;
    //    //产品描述。
    //    private $description;
    //    //产品中文出口描述。
    //    private $descriptionExport;
    //    //产品英文进口描述。
    //    private $descriptionImport;
    //    //产品净重。
    //    private $grossWeight;
    //    //产品净重单位。
    //    private $weightUOM;
    //    //产品海关编码（如果不确定就定义为null，或1234567890）
    //    private $hsCode;
    //    //产品数量。
    //    private $itemQuantity;
    //    //产品单价。
    //    private $itemValue;
    //    //产品SKU编码。
    //    private $skuNumber;

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
    public function getCountryOfOrigin() {
        return $this->countryOfOrigin;
    }

    /**
     * @param mixed $countryOfOrigin
     */
    public function setCountryOfOrigin($countryOfOrigin) {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionExport() {
        return $this->descriptionExport;
    }

    /**
     * @param mixed $descriptionExport
     */
    public function setDescriptionExport($descriptionExport) {
        $this->descriptionExport = $descriptionExport;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionImport() {
        return $this->descriptionImport;
    }

    /**
     * @param mixed $descriptionImport
     */
    public function setDescriptionImport($descriptionImport) {
        $this->descriptionImport = $descriptionImport;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrossWeight() {
        return $this->grossWeight;
    }

    /**
     * @param mixed $grossWeight
     */
    public function setGrossWeight($grossWeight) {
        $this->grossWeight = $grossWeight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeightUOM() {
        return $this->weightUOM;
    }

    /**
     * @param mixed $weightUOM
     */
    public function setWeightUOM($weightUOM) {
        $this->weightUOM = $weightUOM;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHsCode() {
        return $this->hsCode;
    }

    /**
     * @param mixed $hsCode
     */
    public function setHsCode($hsCode) {
        $this->hsCode = $hsCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemQuantity() {
        return $this->itemQuantity;
    }

    /**
     * @param mixed $itemQuantity
     */
    public function setItemQuantity($itemQuantity) {
        $this->itemQuantity = $itemQuantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemValue() {
        return $this->itemValue;
    }

    /**
     * @param mixed $itemValue
     */
    public function setItemValue($itemValue) {
        $this->itemValue = $itemValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSkuNumber() {
        return $this->skuNumber;
    }

    /**
     * @param mixed $skuNumber
     */
    public function setSkuNumber($skuNumber) {
        $this->skuNumber = $skuNumber;
        return $this;
    }


}