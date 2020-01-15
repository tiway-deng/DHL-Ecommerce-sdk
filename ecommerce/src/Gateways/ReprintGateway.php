<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Contracts\GatewayInterface;
use Tiway\DhlEcommerce\Core\ApiContext;

class ReprintGateway extends EcommerceResourceModel implements GatewayInterface
{
    private $path = '/rest/v2.Label.Reprint';

    protected $apiContext;

    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
        if ($this->apiContext->isPro()) {
            $this->path = '/rest/v2.Label/Reprint';
        }
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