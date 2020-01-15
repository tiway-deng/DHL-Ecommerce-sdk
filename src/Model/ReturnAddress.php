<?php

namespace Tiway\DhlEcommerce\Model;


class ReturnAddress extends BaseAddress
{
    //    private $address1;
    //    private $address2;
    //    private $address3;

    /**
     * @return mixed
     */
    public function getAddress1() {
        return $this->address1;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1) {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress2() {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2) {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress3() {
        return $this->address3;
    }

    /**
     * @param mixed $address3
     */
    public function setAddress3($address3) {
        $this->address3 = $address3;
        return $this;
    }

}