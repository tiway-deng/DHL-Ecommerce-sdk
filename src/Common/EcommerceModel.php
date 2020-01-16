<?php


namespace Tiway\DhlEcommerce\Common;


class EcommerceModel
{
    private $_propMap = [];

    /**
     * Magic Get Method
     *
     * @param $key
     * @return mixed
     */
    public function __get($key) {
        if ($this->__isset($key)) {
            return $this->_propMap[$key];
        }
        return null;
    }

    /**
     * Magic Set Method
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value) {
        if (!is_array($value) && $value === null) {
            $this->__unset($key);
        } else {
            $this->_propMap[$key] = $value;
        }
    }

    /**
     * Magic Isset Method
     *
     * @Date: 2020/1/16
     * @param $key
     * @return bool
     */
    public function __isset($key) {
        return isset($this->_propMap[$key]);
    }

    /**
     * Magic Unset Method
     *
     * @Date: 2020/1/16
     * @param $key
     */
    public function __unset($key) {
        unset($this->_propMap[$key]);
    }

    /**
     * Converts Params to Array
     *
     * @param $param
     * @return array|EcommerceModel
     */
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


    /**
     * Returns Array representation
     *
     * @Auth: tiway
     * @Date: 2020/1/16
     * @return array|EcommerceModel
     */
    public function toArray() {
        return $this->_convertToArray($this->_propMap);
    }

    /**
     * Returns object JSON representation
     *
     * @param int $options http://php.net/manual/en/json.constants.php
     * @return string
     */
    public function toJSON($options = 0) {
        if (version_compare(phpversion(), '5.4.0', '>=') === true) {
            return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
        }
        return str_replace('\\/', '/', json_encode($this->toArray(), $options));
    }

}