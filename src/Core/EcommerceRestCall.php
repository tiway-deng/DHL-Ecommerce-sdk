<?php


namespace Tiway\DhlEcommerce\Core;


use Tiway\DhlEcommerce\Exception\EcommerceException;

class EcommerceRestCall
{
    private $apiContext;

    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
    }

    public function execute($path, $method, $data = '', $headers = [])
    {
        if (is_array($data)) {
            $data = json_encode($data,true);
        }
        $host = $this->apiContext->getHost();
        $headerArray = array_merge(["Content-type:application/json;","Accept:application/json"],$headers);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $host.$path);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);

        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
        }

        $result = curl_exec($ch);

        //Throw Exception if Retries and Certificates doenst work
        if (curl_errno($ch)) {
            $ex = new EcommerceException(
                curl_error($ch)
            );
            curl_close($ch);
            throw $ex;
        }

        curl_close($ch);
        $result = json_decode($result,true);

        return $result;
    }

}