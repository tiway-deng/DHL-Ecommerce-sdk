<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Core\ApiContext;

class TokenGateway extends EcommerceResourceModel implements GatewayInterface
{
    private $path = '/rest/v1/OAuth/AccessToken';

    protected $apiContext;

    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
        $config = $this->apiContext->getConfig();
        $this->path .= '?clientId=' . $config['clientId'] . '&password=' . $config['password'] . '&returnFormat=json';
    }

    public function execute() {
        $payLoad = $this->toJSON();
        $result = self::executeCall(
            $this->path,
            self::HTTP_GET,
            $payLoad,
            [],
            $this->apiContext
        );
        return $result;
    }
}