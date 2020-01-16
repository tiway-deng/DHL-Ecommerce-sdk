<?php

namespace Tiway\DhlEcommerce\Model;

use Tiway\DhlEcommerce\Common\EcommerceModel;

class ItemList extends EcommerceModel
{
    /**
     * List of items.
     *
     * @param \PayPal\Api\Item[] $items
     *
     * @return \PayPal\Api\ItemList
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * List of items.
     *
     * @return \PayPal\Api\Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Append Items to the list.
     *
     * @param \PayPal\Api\Item $item
     * @return $this
     */
    public function addItem($item)
    {
        if (!$this->getItems()) {
            return $this->setItems($item);
        } else {
            return $this->setItems(
                array_merge($this->getItems(), $item)
            );
        }
    }

    /**
     * Remove Items from the list.
     *
     * @param \PayPal\Api\Item $item
     * @return $this
     */
    public function removeItem($item)
    {
        return $this->setItems(
            array_diff($this->getItems(), array($item))
        );
    }
}