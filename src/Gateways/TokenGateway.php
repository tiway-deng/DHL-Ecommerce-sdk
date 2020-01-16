<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Core\ApiContext;

class TokenGateway extends EcommerceResourceModel implements GatewayInterface
{
    /**
     * label token path
     * @var string
     */
    private $_path = '/rest/v1/OAuth/AccessToken';

    /**
     * TokenGateway constructor.
     * @param ApiContext $apiContext
     */
    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
        $config = $this->apiContext->getConfig();
        $this->_path .= '?clientId=' . $config['clientId'] . '&password=' . $config['password'] . '&returnFormat=json';
    }

    /**
     * Execute SDK Call to get token
     * @return bool|mixed|string
     * @throws \Tiway\DhlEcommerce\Exception\EcommerceException
     */
    public function execute($payLoad) {
        $result = self::executeCall(
            $this->_path,
            self::HTTP_GET,
            $payLoad,
            [],
            $this->apiContext
        );
        return $result;
    }
}