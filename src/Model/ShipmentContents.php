<?php

namespace Tiway\DhlEcommerce\Model;

use Tiway\DhlEcommerce\Common\EcommerceModel;

class ShipmentContents extends EcommerceModel
{
    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    public function getItems() {
        return $this->items;
    }

    public function addItem($item) {
        if (!$this->getItems()) {
            return $this->setItems([$item]);
        } else {
            return $this->setItems(array_merge($this->getItems(), [$item]));
        }
    }
}