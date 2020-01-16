<?php


namespace Tiway\DhlEcommerce\Common;

use Tiway\DhlEcommerce\Core\ApiContext;
use Tiway\DhlEcommerce\Core\EcommerceRestCall;

class EcommerceResourceModel extends EcommerceModel
{
    const HTTP_GET  = 'GET';
    const HTTP_POST = 'POST';

    /**
     * api config class
     * @var ApiContext
     */
    protected $apiContext;

    /**
     * Execute SDK Call to Ecommerce services
     * @param $path
     * @param $method
     * @param $data
     * @param array $headers
     * @param null $apiContext
     * @return bool|mixed|string
     * @throws \Tiway\DhlEcommerce\Exception\EcommerceException
     */
    protected static function executeCall($path, $method, $data, $headers = [], $apiContext = null) {
        $apiContext = $apiContext ? $apiContext : new ApiContext();
        //Make the execution call
        return  (new EcommerceRestCall($apiContext))->execute($path, $method, $data, $headers);
    }

}