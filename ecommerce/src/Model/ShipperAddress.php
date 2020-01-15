<?php

namespace Tiway\DhlEcommerce\Model;


class ShipperAddress extends BaseAddress
{
    //address1 地址栏位1  M
    //    private $address1;

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
}