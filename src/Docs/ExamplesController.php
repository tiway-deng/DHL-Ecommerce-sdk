<?php

namespace Tiway\DhlEcommerce\Docs;


use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Tiway\DhlEcommerce\Model\Bd;
use Tiway\DhlEcommerce\Model\ConsigneeAddress;
use Tiway\DhlEcommerce\Model\ContentItem;
use Tiway\DhlEcommerce\Model\Hdr;
use Tiway\DhlEcommerce\Model\ItemList;
use Tiway\DhlEcommerce\Model\Label;
use Tiway\DhlEcommerce\Model\LabelRequest;
use Tiway\DhlEcommerce\Model\PickUpAddress;
use Tiway\DhlEcommerce\Model\Request;
use Tiway\DhlEcommerce\Model\ReturnAddress;
use Tiway\DhlEcommerce\Model\ShipmentItem;
use Tiway\DhlEcommerce\Model\ShipperAddress;

class ExamplesController
{
    protected $apiContext;

    public function __construct(){
        //沙盒測試
        $apiContext = new \Tiway\DhlEcommerce\Core\ApiContext(false);
        //生產
//        $config = [
//            'clientId'        => 'LTEzMDQ3ODk4NA==',
//            'password'        => 'MjAzMDI5MTU',
//            'sold_to_account' => '5999999201',
//            'pick_up_account' => '5999999201',
//        ];
//        $apiContext = (new \Tiway\DhlEcommerce\Core\ApiContext(true))->setConfig($config);

        $this->apiContext = $apiContext;
    }

    public function getToken() {
        //请求token
        $result = \Tiway\DhlEcommerce\Ecommerce::token($this->apiContext)->execute(null);
        if (!isset($result['accessTokenResponse']['token'])) {
            echo '请求token 失败';
        }
        return $result['accessTokenResponse']['token'];
    }

    public function createLabel() {

        //获取token,最好添加缓存策略
        $token = $this->getToken();
        //---------------------- hdr ----------------------------
        $hdr = new Hdr();
        $hdr->setAccessToken($token)
            ->setMessageDateTime(Carbon::now()->toIso8601String())
            ->setMessageLanguage('zh_CN')
            ->setMessageType('LABEL')
            ->setMessageVersion('1.4');
        //---------------------- bd -----------------------------
        //提货地址详情
        $address = [
            'street'=> 'nanning lu',
            'street2'=> '520',
            'city'=> 'Senzhen',
            'post_code'=> '5688',
            'state'=> 'Guangdong',
            'country'=> 'CN',
            'first_name'=> 'tt',
            'last_name'=> 'tt',
        ];
        $pick_up_address = new PickUpAddress();
        $pick_up_address->setAddress1($address['street'])->setAddress2($address['street2'] ?? '')->setCity($address['city'])->setCountry($address['country'])->setName($address['first_name'] . $address['last_name'])->setState($address['state']);
        //发件人地址详情
        $shipper = [
            'street'=> 'nanning lu',
            'street2'=> '520',
            'city'=> 'Senzhen',
            'state'=> 'Guangdong',
            'country'=> 'CN',
            'name'=> 'tiway',
            'phone'=> '1383838438',
            'companyName'=> 'test',
        ];
        $shipper_address = new ShipperAddress();
        $shipper_address->setAddress1($shipper['street'])->setCity($shipper['city'])->setCountry($shipper['country'])->setCompanyName($shipper['companyName'])->setName($shipper['name'])->setPhone($shipper['phone']);
        //发货包裹信息详情
        $weight = 100;#重量g
        $paid_total = 100;#金額
        //收件人地址详情
        $consignee_address = new ConsigneeAddress();
        $consignee_address->setAddress1($address['street'])->setCity($address['city'])->setCountry($address['country'])->setName($address['first_name'] . $address['last_name'])->setPostCode($address['post_code'])->setState($address['state']);
        if (!empty($address['street2'] ?? '')){
            $consignee_address->setAddress2($address['street2'] ?? '');
        }
        //退件地址详情
        $return_address = new ReturnAddress();
        $return_address->setAddress1($shipper['street'])->setCity($shipper['city'])->setCountry('CN')->setCompanyName($shipper['companyName'])->setName($shipper['name'])->setPhone($shipper['phone']);
        //包裹物品详细描述
        $item         = new ContentItem();
        $item->setContentIndicator('00')
            ->setCountryOfOrigin('CN')
            ->setDescription("express test")
            ->setDescriptionExport('测试')
            ->setDescriptionImport('ceshi')
            ->setGrossWeight($weight)
            ->setWeightUOM('G')
            ->setHsCode(null)
            ->setItemQuantity(1)
            ->setItemValue(round($paid_total,2))
            ->setSkuNumber('sku_'.rand(100000,999999));
        $shipment_contents = new ItemList();
        $shipment_contents->addItem($item);
        //
        /**
         * //    //收件人地址详情
        //    private $consigneeAddress;
        //    //退件地址详情
        //    private $returnAddress;
        //    //发货号码（物流商流水号） 由客户自定义，必须以客户唯一前缀为首。 举例：HKABC1234567890
        //    private $shipmentID;
        //    //追踪号，默认为null
        //    private $deliveryConfirmationNo;
        //    //包裹品类概括描述： 例如：Fashion/Watch/Electronic
        //    private $packageDesc;
        //    //包裹总重量
        //    private $totalWeight;
        //    //包裹总重量单位：默认为“G”
        //    private $totalWeightUOM;
        //    //货到付款金额，默认为0.00
        //    private $codValue;
        //    //包裹属性标识。 如客户未开通带电，则默认null。 如客户开通带电，则00 - 普货，04 - 带电。
        //    private $contentIndicator;
        //    //包裹总价值
        //    private $totalValue;
        //    //包裹总价值币种
        //    private $currency;
        //    private $customerReference1;
        //    private $customerReference2;
        //    //货运费，默认为0.00。
        //    private $freightCharge;
        //    //包裹高
        //    private $height;
        //    //长
        //    private $length;
        //    //宽
        //    private $width;
        //    //包裹长度单位
        //    private $dimensionUOM;
        //    //国际贸易简制 （DDU - 平邮、挂号、中英、中澳） （DDP - 中美、中以）
        //    private $incoterm;
        //    //包裹保险金额
        //    private $insuranceValue;
        //    //包裹产品编码
        //    private $productCode;
        //    //此字段只针对WS客户，直客无需填写。
        //    private $workshareIndicator;
        //    //包裹备注（会出现在报关标签中的Remarks中）
        //    private $remarks;
        //    //包裹物品详细描述
        //    private $shipmentContents;
         */
        $shipment_item = new ShipmentItem();
        $shipment_item->setConsigneeAddress($consignee_address)
            ->setReturnAddress($return_address)
            ->setShipmentID('CNDFJ'.rand(100000,999999))
            ->setDeliveryConfirmationNo('abc'.rand(100000,999999))
            ->setPackageDesc('ecommerce test')
            ->setTotalWeight($weight)
            ->setShipmentContents($shipment_contents)
            ->setTotalWeightUOM('G')
            ->setFreightCharge(round(100,2))
            ->setContentIndicator('00')
            ->setTotalValue(round($paid_total,2))
            ->setCurrency('USD')
            ->setDimensionUOM('CM')
            ->setIncoterm('DDU')
            ->setInsuranceValue(0)
            ->setProductCode('PPS');
        $shipment_items = new ItemList();
        $shipment_items->addItem($shipment_item);
        //是否直接返回面单 仅可定义三个值： Y – 直接返回面单 N – 不返回面单，仅获取追踪号 U – 返回URL面单链接
        $inlineLabelReturn = 'Y';
        //$label
        $label = new Label();
        $label->setFormat('PDF')->setLayout('1x1')->setPageSize('400x400');
        $bd    = new Bd();
        //ecommerce config
        $config = $this->apiContext->getConfig();
        $bd->setPickupAccountId($config['pick_up_account'])
            ->setSoldToAccountId($config['sold_to_account'])
            ->setPickupDateTime(Carbon::now()->endOfDay()->subHours(7)->toIso8601String())
            ->setPickupAddress($pick_up_address)
            ->setShipperAddress($shipper_address)
            ->setShipmentItems($shipment_items)
            ->setInlineLabelReturn($inlineLabelReturn)
            ->setLabel($label);
        //------------------- label_request ----------------------
        $request = new Request();
        $request->setHdr($hdr)->setBd($bd);
        $label_request = new LabelRequest();
        $label_request->setLabelRequest($request);

        $result = \Tiway\DhlEcommerce\Ecommerce::label($this->apiContext)->execute($label_request->toArray());
        dd($result);

        //返回数据,根据业务调整即可
//        array:1 [
//            "labelResponse" => array:2 [
//            "hdr" => array:4 [
//            "messageType" => "LABEL"
//      "messageDateTime" => "2020-01-17T17:04:23+08:00"
//      "messageVersion" => "1.4"
//      "messageLanguage" => "zh_CN"
//    ]
//    "bd" => array:2 [
//            "labels" => array:1 [
//            0 => array:5 [
//            "shipmentID" => "CNDFJ980429"
//          "deliveryConfirmationNo" => ""
//          "labelURL" => null
//          "content" => "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fRzmHxvzo/r8H5gNHeQKZW5kc3RyZWFtCmVuZG9iagoyIDAgb2JqCjw8L0ZpbHRlci9GbGF0ZURlY29kZS9MZW5ndGggNjk+PnN0cmVhbQp4AQE6AMX/cQpCVAowLjUgNDMxLjUgVGQKRVQKUQpxIDI3MyAwIDAgNDA5LjUgNyAxMiBjbSAvaW1nMCBEbyBRCmDCDGsKZW5kc3RyZWFtCmVuZG9iago0IDAgb2JqCjw8L0NvbnRlbnRzIDIgMCBSL1R5cGUvUGFnZS9SZXNvdXJjZXM8PC9Qcm9jU2V0IFsvUERGIC9UZXh0IC9JbWFnZUIgL0ltYWdlQyAvSW1hZ2VJXS9YT2JqZWN0PDwvaW1nMCAxIDAgUj4+Pj4vUGFyZW50IDMgMCBSL01lZGlhQm94WzAgMCAyODggNDMyXT4+CmVuZG9iagozIDAgb2JqCjw8L0tpZHNbNCAwIFJdL1R5cGUvUGFnZXMvQ291bnQgMS9JVFhUKDIuMS43KT4+CmVuZG9iago1IDAgb2JqCjw8L1R5cGUvQ2F0YWxvZy9QYWdlcyAzIDAgUj4+CmVuZG9iago2IDAgb2JqCjw8L01vZERhdGUoRDoyMDIwMDExNzE3MDQyMyswOCcwMCcpL0NyZWF0aW9uRGF0ZShEOjIwMjAwMTE3MTcwNDIzKzA4JzAwJykvUHJvZHVjZXIoaVRleHQgMi4xLjcgYnkgMVQzWFQpPj4KZW5kb2JqCnhyZWYKMCA3CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAxNSAwMDAwMCBuIAowMDAwMDA5OTMyIDAwMDAwIG4gCjAwMDAwMTAyMjkgMDAwMDAgbiAKMDAwMDAxMDA2NyAwMDAwMCBuIAowMDAwMDEwMjkyIDAwMDAwIG4gCjAwMDAwMTAzMzcgMDAwMDAgbiAKdHJhaWxlcgo8PC9JbmZvIDYgMCBSL0lEIFs8MjY2MDVkNmEwMTMzYTE2NTg1OWE4MWViOWY1MTIxNTM+PGFlZmY4MDAzMjJmMmZhZDgzNDk4ZjI0NjIxNmUyZWUyPl0vUm9vdCA1IDAgUi9TaXplIDc+PgpzdGFydHhyZWYKMTA0NTkKJSVFT0YK"
//          "responseStatus" => array:3 [
//            "code" => "200"
//            "message" => "成功"
//            "messageDetails" => array:1 [
//            0 => array:1 [
//            "messageDetail" => "货次已处理，而标签亦已生成；"
//        ]
//            ]
//          ]
//        ]
//      ]
//      "responseStatus" => array:3 [
//            "code" => "200"
//        "message" => "成功"
//        "messageDetails" => array:1 [
//            0 => array:1 [
//            "messageDetail" => "所有货次已顺利处理。"
//        ]
//        ]
//      ]
//    ]
//  ]
//]

    }


}