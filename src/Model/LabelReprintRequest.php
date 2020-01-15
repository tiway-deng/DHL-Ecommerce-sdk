<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Common\EcommerceModel;

class LabelReprintRequest extends EcommerceModel
{
    //    private $labelReprintRequest;

    /**
     * @return mixed
     */
    public function getLabelReprintRequest() {
        return $this->labelReprintRequest;
    }

    /**
     * @param mixed $labelReprintRequest
     */
    public function setLabelReprintRequest($labelReprintRequest) {
        $this->labelReprintRequest = $labelReprintRequest;
        return $this;
    }


}