<?php

namespace Tiway\DhlEcommerce\Gateways;

/**
 * Interface GatewayInterface
 * @package Tiway\DhlEcommerce\Gateways
 */
interface GatewayInterface
{
    /**
     * gateway execute
     * @Date: 2020/1/16
     * @return mixed
     */
    public function execute($payLoad);
}