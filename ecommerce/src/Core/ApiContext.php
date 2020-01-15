<?php

namespace Tiway\DhlEcommerce\Core;

/**
 * Class ConfigManager
 * @package App\Packages\Ecommerce\Core
 */
class ApiContext
{
    //沙箱
    const SANDBOX_HOST = "https://sandbox.dhlecommerce.asia";
    //生产
    const PRO_HOST = "https://api.dhlecommerce.dhl.com";

    private $is_pro = false;

    private $config = [
        'clientId'        => 'LTEzMDQ3ODk4NA==',
        'password'        => 'MjAzMDI5MTU',
        'sold_to_account' => '5999999201',
        'pick_up_account' => '5999999201',
    ];

    private $host;

    public function __construct($is_pro = false)
    {
        $this->is_pro = $is_pro;
        $this->host = self::SANDBOX_HOST;
        if ($is_pro) {
            $this->host = self::PRO_HOST;
        }
    }

    public function setConfig($config)
    {
        //修改配置
        $this->config = $config;
        return $this;
    }

    public function getConfig() {
        return $this->config;
    }

    public function getHost() {
        return $this->host;
    }

    public function isPro() {
        return $this->is_pro;
    }

}