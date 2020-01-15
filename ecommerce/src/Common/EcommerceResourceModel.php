<?php


namespace Tiway\DhlEcommerce\Common;

use Tiway\DhlEcommerce\Core\ApiContext;
use Tiway\DhlEcommerce\Core\EcommerceRestCall;

class EcommerceResourceModel extends EcommerceModel
{
    const HTTP_GET  = 'GET';
    const HTTP_POST = 'POST';

    protected static function executeCall($path, $method, $data, $headers = [], $apiContext = null)
    {
        $apiContext = $apiContext ? $apiContext : new ApiContext();
        //Make the execution call
        return  (new EcommerceRestCall($apiContext))->execute($path, $method, $data, $headers);
    }

}