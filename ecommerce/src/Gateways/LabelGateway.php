<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Contracts\GatewayInterface;
use Tiway\DhlEcommerce\Core\ApiContext;

class LabelGateway extends EcommerceResourceModel implements GatewayInterface
{
    private $path = '/rest/v2/Label';

    protected $apiContext;

    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
    }

    public function execute() {
        $payLoad = $this->toJSON();
        $result = self::executeCall(
            $this->path,
            self::HTTP_POST,
            $payLoad,
            [],
            $this->apiContext
        );
        return $result;
    }
}