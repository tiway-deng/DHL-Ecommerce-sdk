<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Common\EcommerceModel;

class LabelRequest extends EcommerceModel
{
    //    private $labelRequest;

    /**
     * @return mixed
     */
    public function getLabelRequest() {
        return $this->labelRequest;
    }

    /**
     * @param mixed $labelRequest
     */
    public function setLabelRequest($labelRequest) {
        $this->labelRequest = $labelRequest;
        return $this;
    }


}