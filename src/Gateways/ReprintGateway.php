<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Core\ApiContext;

/**
 * Class ReprintGateway
 * @package Tiway\DhlEcommerce\Gateways
 */
class ReprintGateway extends EcommerceResourceModel implements GatewayInterface
{
    /**
     * label label reprint path
     * @var string
     */
    private $_path = '/rest/v2.Label.Reprint';

    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
        if ($this->apiContext->isPro()) {
            $this->path = '/rest/v2.Label/Reprint';
        }
    }

    /**
     * Execute SDK Call to get label reprint
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