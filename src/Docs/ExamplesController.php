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
            ->setDeliveryConfirmationNo(rand(100000,999999))
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
        $array = [
            "pickupAccountId"   => "5999999201",
            "soldToAccountId"   => "5999999201",
            "pickupDateTime"    => "2020-01-16T16:59:59+08:00",
            "pickupAddress"     => [
                "address1" => "nanning lu",
                "address2" => "520",
                "city"     => "Senzhen",
                "country"  => "CN",
                "name"     => "tttt",
                "state"    => "Guangdong",
            ],
            "shipperAddress"    => [
                "address1"    => "nanning lu",
                "city"        => "Senzhen",
                "country"     => "CN",
                "companyName" => "test",
                "name"        => "tiway",
                "phone"       => "1383838438",
            ],
            "shipmentItems"     => [
                "items" => [
                    [
                        "consigneeAddress"       => [
                            "address1" => "nanning lu",
                            "city"     => "Senzhen",
                            "country"  => "CN",
                            "name"     => "tttt",
                            "postCode" => "5688",
                            "state"    => "Guangdong",
                            "address2" => "520",
                        ],
                        "returnAddress"          => [
                            "address1"    => "nanning lu",
                            "city"        => "Senzhen",
                            "country"     => "CN",
                            "companyName" => "test",
                            "name"        => "tiway",
                            "phone"       => "1383838438",
                        ],
                        "shipmentID"             => "CNDFJ589791",
                        "deliveryConfirmationNo" => 747862,
                        "packageDesc"            => "ecommerce test",
                        "totalWeight"            => 100,
                        "shipmentContents"       => [
                            "items" => [
                                [
                                    "contentIndicator"  => "00",
                                    "countryOfOrigin"   => "CN",
                                    "description"       => "express test",
                                    "descriptionExport" => "测试",
                                    "descriptionImport" => "ceshi",
                                    "grossWeight"       => 100,
                                    "weightUOM"         => "G",
                                    "itemQuantity"      => 1,
                                    "itemValue"         => 100.0,
                                    "skuNumber"         => "sku_805354",
                                ]
                            ]
                        ],
                        "totalWeightUOM"         => "G",
                        "freightCharge"          => 100.0,
                        "contentIndicator"       => "00",
                        "totalValue"             => 100.0,
                        "currency"               => "USD",
                        "dimensionUOM"           => "CM",
                        "incoterm"               => "DDU",
                        "insuranceValue"         => 0,
                        "productCode"            => "PPS",
                    ]
                ]
            ],
            "inlineLabelReturn" => "Y",
            "label"             => [
                "format"   => "PDF",
                "layout"   => "1x1",
                "pageSize" => "400x400",
            ]
        ];

        $result = \Tiway\DhlEcommerce\Ecommerce::label($this->apiContext)->execute($label_request->toArray());

        //返回数据,根据业务调整即可
//        array:1 [
//            "labelResponse" => array:2 [
//            "hdr" => array:4 [
//            "messageType" => "LABEL"
//      "messageDateTime" => "2020-01-16T16:19:49+08:00"
//      "messageVersion" => "1.4"
//      "messageLanguage" => "zh_CN"
//    ]
//    "bd" => array:2 [
//            "labels" => array:1 [
//            0 => array:5 [
//            "shipmentID" => "CNDFJFH191227VCCN"
//          "deliveryConfirmationNo" => null
//          "labelURL" => null
//          "content" => null
//          "responseStatus" => array:3 [
//            "code" => "202"
//            "message" => "请求数据验证失败。"
//            "messageDetails" => array:1 [
//            0 => array:1 [
//            "messageDetail" => "发现有重覆的包裹ID。如需生成新标签，请更改包裹ID；如需重新生成原有标签，请检查所有栏位资讯是否与原有包裹吻合。 寄送内容"
//        ]
//            ]
//          ]
//        ]
//      ]
//      "responseStatus" => array:3 [
//            "code" => "400"
//        "message" => "错误"
//        "messageDetails" => array:1 [
//            0 => array:1 [
//            "messageDetail" => "因程序或系统错误，货次未被处理。请检查包​​裹内容以进行侦错。"
//        ]
//        ]
//      ]
//    ]
//  ]
//]
    }


}