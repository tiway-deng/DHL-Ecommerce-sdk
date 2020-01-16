<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Contracts\GatewayInterface;
use Tiway\DhlEcommerce\Core\ApiContext;

class TrackingGateway extends EcommerceResourceModel implements GatewayInterface
{
    /**
     * tracking path
     * @var string
     */
    private $_path = '/rest/v2/Tracking';

    /**
     * TrackingGateway constructor.
     * @param ApiContext $apiContext
     */
    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
    }

    /**
     * Execute SDK Call to get tracking
     * @return bool|mixed|string
     * @throws \Tiway\DhlEcommerce\Exception\EcommerceException
     */
    public function execute($payLoad) {
        $result = self::executeCall(
            $this->_path,
            self::HTTP_POST,
            $payLoad,
            [],
            $this->apiContext
        );
        return $result;
    }
}