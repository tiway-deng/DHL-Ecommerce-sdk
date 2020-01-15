<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Model;

class TrackingItemRequest extends Model
{
    //    private $trackItemRequest;

    /**
     * @return mixed
     */
    public function getTrackItemRequest() {
        return $this->trackItemRequest;
    }

    /**
     * @param mixed $trackItemRequest
     */
    public function setTrackItemRequest($trackItemRequest) {
        $this->trackItemRequest = $trackItemRequest;
        return $this;
    }

}