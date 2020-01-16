<?php


namespace Tiway\DhlEcommerce\Gateways;


use Tiway\DhlEcommerce\Common\EcommerceResourceModel;
use Tiway\DhlEcommerce\Core\ApiContext;

class LabelGateway extends EcommerceResourceModel implements GatewayInterface
{
    /**
     * label path
     * @var string
     */
    private $_path = '/rest/v2/Label';

    /**
     * LabelGateway constructor.
     * @param ApiContext $apiContext
     */
    public function __construct(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
    }

    /**
     * Execute SDK Call to get label
     * @Date: 2020/1/16
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