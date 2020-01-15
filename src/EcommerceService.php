<?php
/**
 * Created by PhpStorm.
 * User: SZJLS
 * Date: 2019/8/8
 * Time: 11:22
 */

namespace App\Services;


use App\Models\Batch;
use App\Packages\Ecommerce\Core\ConfigManager;
use App\Packages\Ecommerce\Core\Src\Bd;
use App\Packages\Ecommerce\Core\Src\Hdr;
use App\Packages\Ecommerce\Core\Src\LabelReprintRequest;
use App\Packages\Ecommerce\Core\Src\LabelRequest;
use App\Packages\Ecommerce\Core\Src\Request;
use App\Packages\Ecommerce\Core\Src\TrackingItemRequest;
use App\Packages\Ecommerce\Restful\GetTokenRequest;
use App\Traits\Admin\EcommerceCreateTrait;
use Carbon\Carbon;
use Mockery\Exception;

/**
 * Class EcommerceService
 * @package App\Services
 */
class EcommerceService extends ExpressBaseService
{
    use EcommerceCreateTrait;

    private $cache_key = 'dhl_ecommerce_token';

    /**
     * @Desc: 时间格式化 2017-03-27T15:28:15+08:00
     *
     * @Auth: tiway
     * @Date: 2019/8/8
     * @return false|string
     */
    protected function getFormatDateNow() {
        return Carbon::now()->toIso8601String();

    }

    /**
     * @Desc: 取货时间
     *
     * @Auth: tiway
     * @Date: 2019/8/8
     * @return string
     */
    protected function getPickDate(){
        return Carbon::now()->endOfDay()->subHours(7)->toIso8601String();
    }

    /**
     * @Desc: 获取token并缓存
     *
     * @Auth: tiway
     * @Date: 2019/8/16
     * @return mixed
     */
    protected function setTokenCache(){
        $result = (new GetTokenRequest())->request();
        if (!isset($result['accessTokenResponse']['token'])) {
            throw new Exception('请求token 失败');
        }
        $token = $result['accessTokenResponse']['token'];
        \Cache::put($this->cache_key, $token, CACHE_PUT_DAY);
        return $token;
    }

    /**
     * @Desc: 获取token
     *
     * @Auth: tiway
     * @Date: 2019/8/8
     * @return mixed
     */
    protected function getToken() {
        $tokenCacheKey = 'dhl_ecommerce_token';
        $token         = \Cache::get($tokenCacheKey);  //优先从缓存获取
        if (!$token) {  //未获取到（失效）
            $token = $this->setTokenCache();
        }

        return $token;
    }

    /**
     * @Desc: 预报（创建邮寄面单信息）
     *
     * @Auth: tiway
     * @Date: 2019/8/8
     */
    public function createLabel($batch_num,$products) {
        try{
            $batch = Batch::query()->where('batch_num',$batch_num)->firstOrFail();
            if (!$batch) {
                throw new Exception('获取批次信息失败');
            }
            //获取token
            $token = $this->getToken();
            //---------------------- hdr ----------------------------
            $hdr = new Hdr();
            $hdr->setAccessToken($token)->setMessageDateTime($this->getFormatDateNow())->setMessageLanguage('zh_CN')->setMessageType('LABEL')->setMessageVersion('1.4');
            //---------------------- bd -----------------------------
            //提货地址详情
            $address         = $batch->address;
            $pick_up_address = $this->getPickUpAddress($address);
            //发件人地址详情
            $shipper_address = $this->getShipperAddress($this->shipper);
            //发货包裹信息详情
            $weight = $this->getWeightTotal($batch);
            $paid_total = $this->getPaidTotal($batch);
            $shipment_items = $this->getShipmentItems($batch,$products,$this->shipper,$weight,$paid_total);
            //是否直接返回面单 仅可定义三个值： Y – 直接返回面单 N – 不返回面单，仅获取追踪号 U – 返回URL面单链接
            $inlineLabelReturn = 'Y';
            //$label
            $label = $this->getLabel();
            $bd    = new Bd();
            //ecommerce config
            $config = ConfigManager::getInstance()->getConfigs();
            $bd->setPickupAccountId($config['pick_up_account'])->setSoldToAccountId($config['sold_to_account'])->setPickupDateTime($this->getPickDate())->setPickupAddress($pick_up_address)->setShipperAddress($shipper_address)->setShipmentItems($shipment_items)->setInlineLabelReturn($inlineLabelReturn)->setLabel($label);
            //------------------- label_request ----------------------
            $request = new Request();
            $request->setHdr($hdr)->setBd($bd);
            $label_request = new LabelRequest();
            $label_request->setLabelRequest($request);

            //请求物流
            self::$log->info($batch_num.'ecommerce创建面单请求参数：',['request'=>$label_request->toArray()]);
            $result = (new \App\Packages\Ecommerce\Restful\LabelRequest())->request($label_request->toJSON());
            self::$log->info($batch_num.'ecommerce创建面单请求返回：',['result'=>$result]);
            if (array_get($result,'labelResponse.bd.responseStatus.code') == 202 &&  array_get($result,'labelResponse.bd.responseStatus.message') == '令牌验证失败.') {
                $this->setTokenCache();
            }

            return $result;

        }catch (Exception $e) {

            self::$log->info('ecommerce 创建失败：'.$e->getMessage(). $e->getFile(),['batch_num'=>$batch_num,'products'=>$products]);
        }
    }

    /**
     * @Desc: 标签获取
     *
     * @Auth: tiway
     * @Date: 2019/8/9
     * @param array $shipment_ids
     * @return bool|mixed
     */
    public function getLabels(array $shipment_ids) {
        try{
            //获取token
            $token = $this->getToken();
            //---------------------- hdr ----------------------------
            $hdr = new Hdr();
            $hdr->setAccessToken($token)->setMessageDateTime($this->getFormatDateNow())->setMessageLanguage('zh_CN')->setMessageType('LABELREPRINT')->setMessageVersion('1.0');
            //---------------------- bd -----------------------------
            $bd    = new Bd();
            //ecommerce config
            $config = ConfigManager::getInstance()->getConfigs();
            $bd->setPickupAccountId($config['pick_up_account'])->setSoldToAccountId($config['sold_to_account']);
            //shipmentItems
            $shipment_Items = [];
            if (empty($shipment_id_array)) {
                foreach ($shipment_ids as $item) {
                    $shipment_Items[] = [
                        'shipmentID' => $item,
                    ];
                }
            }
            $bd->setShipmentItems($shipment_Items);
            //------------------- label_reprint_request ----------------------
            $request = new Request();
            $request->setHdr($hdr)->setBd($bd);
            $label_request = new LabelReprintRequest();
            $label_request->setLabelReprintRequest($request);

            //请求物流
            self::$log->info('ecommerce 标签获取请求参数：',['request'=>$label_request->toArray()]);
            $result = (new \App\Packages\Ecommerce\Restful\LabelReprintRequest())->request($label_request->toJSON());
            self::$log->info('ecommerce 标签获取返回：',['result'=>$result]);


            return $result;

        }catch (Exception $e) {

            self::$log->info('ecommerce 获取面单失败：'.$e->getMessage(). $e->getFile(),['shipment_id_array'=>$shipment_id_array,]);
        }

    }

    /**
     * @Desc: 轨迹追踪
     *
     * @Auth: tiway
     * @Date: 2019/8/9
     * @param array $tracking_ids 追踪号
     * @return bool|mixed
     */
    public function getTracking(array $tracking_ids) {
        try{
            //获取token
            $token = $this->getToken();
            //------------------- tracking_item_request ----------------------
            $request = new Request();
            $request->setTrackingReferenceNumber($tracking_ids)->setMessageLanguage('zh_CN')->setMessageVersion('1.1')->setToken($token);
            $tracking_item_request = new TrackingItemRequest();
            $tracking_item_request->setTrackItemRequest($request);

            //请求物流
            self::$log->info('ecommerce 轨迹追踪请求参数：',['request'=>$tracking_item_request->toArray()]);
            $result = (new \App\Packages\Ecommerce\Restful\TrackingRequest())->request($tracking_item_request->toJSON());
            self::$log->info('ecommerce 轨迹追踪返回：',['result'=>$result]);

            return $result;

        }catch (Exception $e) {

            self::$log->info('ecommerce 轨迹获取失败：'.$e->getMessage(). $e->getFile(),['tracking_ids'=>$tracking_ids,]);
        }
    }

    /**
     * @Desc: 设置token缓存
     *
     * @Auth: tiway
     * @Date: 2019/8/16
     * @return mixed
     */
    public function resetToken() {
        return $this->setTokenCache();
    }
    

}