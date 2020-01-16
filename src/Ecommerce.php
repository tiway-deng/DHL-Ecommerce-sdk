<?php


namespace Tiway\DhlEcommerce;


use Tiway\DhlEcommerce\Core\ApiContext;
use Tiway\DhlEcommerce\Exception\EcommerceException;
use Tiway\DhlEcommerce\Gateways\GatewayInterface;
use Tiway\DhlEcommerce\Gateways\LabelGateway;
use Tiway\DhlEcommerce\Gateways\ReprintGateway;
use Tiway\DhlEcommerce\Gateways\TokenGateway;
use Tiway\DhlEcommerce\Gateways\TrackingGateway;

/**
 * Class Ecommerce
 * @method static LabelGateway label(ApiContext $apiContext) 预报Ecommerce
 * @method static ReprintGateway reprint(ApiContext $apiContext) 获取打印标签
 * @method static TokenGateway token(ApiContext $apiContext) 获取token
 * @method static TrackingGateway tracking(ApiContext $apiContext) 获取物流轨迹
 * @package Tiway\DhlEcommerce
 */
class Ecommerce
{
    /**
     * 配置类
     * @var ApiContext
     */
    protected $apiContext;

    /**
     * Ecommerce constructor.
     * @param ApiContext $apiContext
     */
    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
    }

    /**
     * static self instance
     *
     * @param $method
     * @param $params
     * @return mixed
     * @throws EcommerceException
     */
    public static function __callStatic($method, $params) {
        $app = new self(...$params);
        return $app->create($method);
    }

    /**
     * find and create gateway
     *
     * @param $method
     * @return mixed
     * @throws EcommerceException
     */
    protected function create($method) {
        $gateway = __NAMESPACE__.'\\Gateways\\'.ucfirst($method).'Gateway';

        if (class_exists($gateway)) {
            return self::make($gateway);
        }

        throw new EcommerceException("Gateway [{$method}] Not Exists");
    }

    /**
     * make the instance of gateway
     *
     * @param $gateway
     * @return mixed
     * @throws EcommerceException
     */
    protected function make($gateway) {
        $app = new $gateway($this->apiContext);

        if ($app instanceof GatewayInterface) {
            return $app;
        }

        throw new EcommerceException("Gateway [{$gateway}] Must Be An Instance Of GatewayInterface");
    }
}