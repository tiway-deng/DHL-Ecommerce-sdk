<?php


namespace Tiway\DhlEcommerce\Common;


class EcommerceModel
{

    private $_propMap = [];

    public function __get($key) {
        if ($this->__isset($key)) {
            return $this->_propMap[$key];
        }
        return null;
    }

    public function __set($key, $value) {
        if (!is_array($value) && $value === null) {
            $this->__unset($key);
        } else {
            $this->_propMap[$key] = $value;
        }
    }


    public function __isset($key) {
        return isset($this->_propMap[$key]);
    }


    public function __unset($key) {
        unset($this->_propMap[$key]);
    }


    private function _convertToArray($param) {
        $ret = [];
        foreach ($param as $k => $v) {
            if ($v instanceof EcommerceModel) {
                $ret[$k] = $v->toArray();
            } else if (sizeof($v) <= 0 && is_array($v)) {
                $ret[$k] = [];
            } else if (is_array($v)) {
                $ret[$k] = $this->_convertToArray($v);
            } else {
                $ret[$k] = $v;
            }
        }
        if (sizeof($ret) <= 0) {
            $ret = new EcommerceModel();
        }
        return $ret;
    }


    public function toArray() {
        return $this->_convertToArray($this->_propMap);
    }


    public function toJSON($options = 0) {
        if (version_compare(phpversion(), '5.4.0', '>=') === true) {
            return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
        }
        return str_replace('\\/', '/', json_encode($this->toArray(), $options));
    }

}