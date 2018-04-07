<?php

namespace Hgabka\EmagBundle\Helper;

class Connector
{
    /** @var string */
    protected $url;

    /** @var string */
    protected $username;

    /** @var string */
    protected $usercode;

    /** @var string */
    protected $password;

    /**
     * Connector constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->url = $config['api_url'];
        $this->username = $config['api_username'];
        $this->password = $config['api_password'];
        $this->usercode = $config['api_usercode'];
    }

    /**
     * @param $data
     * @param $url
     *
     * @return mixed
     */
    public function callApi($data, $url)
    {
 /*       $hash = sha1(http_build_query($data).sha1($this->password));
        $requestData = [
            'code' => $this->usercode,
            'username' => $this->username,
            'data' => $data,
            'hash' => $hash,
        ];
 */
        $hash = base64_encode($this->username . ':' . $this->password);
        $headers = array(
            'Authorization: Basic ' . $hash
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));

        return json_decode(curl_exec($ch), true);
    }

    /**
     * @param EmagProductInterface $product
     *
     * @return mixed
     */
    public function sendProduct(EmagProductInterface $product)
    {
        return $this->callApi($product->getEmagData(), '/product_offer/save');
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function getCategories($data)
    {
        return $this->callApi($data, '/category/read');
    }
}
