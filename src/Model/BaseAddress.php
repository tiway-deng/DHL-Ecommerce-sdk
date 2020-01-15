<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Common\EcommerceModel;

/**
 * Class BaseAddress
 * @package App\Packages\Ecommerce\Core\Src
 * @attribute
 */
class BaseAddress extends EcommerceModel
{
    //    //地址城市
    //    private $city;
    //    //公司名称
    //    private $companyName;
    //    //地址国家  M
    //    private $country;
    //    //地址地区
    //    private $district;
    //    //邮箱
    //    private $email;
    //    //姓名 M
    //    private $name;
    //    //手机
    //    private $phone;
    //    //邮编
    //    private $postCode;
    //    //州
    //    private $state;

    /**
     * @return mixed
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyName() {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDistrict() {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district) {
        $this->district = $district;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostCode() {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
     */
    public function setPostCode($postCode) {
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }


}