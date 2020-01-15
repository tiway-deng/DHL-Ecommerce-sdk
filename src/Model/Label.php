<?php

namespace Tiway\DhlEcommerce\Model;


use Tiway\DhlEcommerce\Common\EcommerceModel;

class Label extends EcommerceModel
{
    //    private $format;
    //    private $layout;
    //    private $pageSize;

    /**
     * @return mixed
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format) {
        $this->format = $format;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLayout() {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout) {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageSize() {
        return $this->pageSize;
    }

    /**
     * @param mixed $pageSize
     */
    public function setPageSize($pageSize) {
        $this->pageSize = $pageSize;
        return $this;
    }

}