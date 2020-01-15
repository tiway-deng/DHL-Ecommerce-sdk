<?php


namespace Tiway\DhlEcommerce;


use Tiway\DhlEcommerce\Core\ApiContext;
use Tiway\DhlEcommerce\Exception\EcommerceException;
use Tiway\DhlEcommerce\Gateways\GatewayInterface;

class Ecommerce
{
    protected $apiContext;

    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
    }

    public static function __callStatic($method, $params)
    {
        $app = new self(...$params);

        return $app->create($method);
    }

    protected function create($method)
    {
        $gateway = __NAMESPACE__.'\\Gateways\\'.ucfirst($method).'Gateway';

        if (class_exists($gateway)) {
            return self::make($gateway);
        }

        throw new EcommerceException("Gateway [{$method}] Not Exists");
    }

    protected function make($gateway)
    {
        $app = new $gateway($this->apiContext);

        if ($app instanceof GatewayInterface) {
            return $app;
        }

        throw new EcommerceException("Gateway [{$gateway}] Must Be An Instance Of GatewayInterface");
    }
}