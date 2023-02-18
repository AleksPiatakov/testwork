<?php

die;
class easypay
{
    private $createApp = 'https://api.easypay.ua/api/system/createApp';
    private $createOrder = 'https://api.easypay.ua/api/merchant/createOrder';
    private $partnerKey = 'easypay-test';
    private $secretKey = 'test';
    private $serviceKey = 'MERCHANT-TEST';
    public $app;
    public $response;

    public function createApp()
    {
        $appData = [
            'PartnerKey' => $this->partnerKey,
            'locale' => 'ua',
        ];
        $this->app = $this->curlPostRequest($this->createApp, $appData, []);
    }

    private function curlPostRequest($url, $headers, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }

    public function createOrder()
    {
        $orderData = [
            'order' => [
                'serviceKey' => $this->serviceKey,
                'orderId' => '123',
                'description' => 'test',
                'amount' => '50',
            ],
            'urls' => [
                'success' => 'test/easypay.php',
                'failed ' => 'test/easypay.php',
            ]
        ];
        $orderData = json_encode($orderData);
        $orderHeaders = [
            "Content-Type:application/json",
            "PartnerKey:{$this->partnerKey}",
            "locale:ua",
            "AppId:{$this->app->appId}",
            "RequestedSessionId:{$this->app->requestedSessionId}",
            "PageId:{$this->app->pageId}",
            "Sign:{$this->getSign($orderData)}",
        ];
        $this->response = $this->curlPostRequest($this->createOrder, $orderHeaders, $orderData);
    }

    private function getSign($orderData)
    {
        return base64_encode(hash('sha256', $this->secretKey . $orderData, true));
    }
}
if (!empty($_REQUEST)) {
    file_put_contents('1.txt', json_encode($_REQUEST));
    die;
}
$easypay = new easypay();
$easypay->createApp();
$easypay->createOrder();
$redirect_url = $easypay->response->forwardUrl;

header("Location: $redirect_url");
die;
