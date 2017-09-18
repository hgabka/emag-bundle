<?php

namespace Hgabka\EmagBundle\Helper;

class Connector
{
  protected $url;

  protected $username;
  protected $usercode;

  protected $password;

  protected function __construct($config)
  {
    $this->url = $config['app_emag_api_url'];
    $this->username = $config['api_username'];
    $this->password = $config['api_password'];
    $this->usercode = $config['api_usercode'];
  }

  public function callApi($data, $url)
  {
    $hash = sha1(http_build_query($data) . sha1($this->password));
    $requestData = array(
      'code' => $this->usercode,
      'username' => $this->username,
      'data' => $data,
      'hash' => $hash);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->url.$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));

    return json_decode(curl_exec($ch), true);

  }

  public function sendProduct(EmagProductInterface $product)
  {
    return $this->callApi($product->getEmagData(), '/product_offer/save');
  }
  
  public function getCategories($data)
  {
/*      $data = [
        'id' => 104,
        'itemsPerPage' => 10,
        'currentPage' => 1
      ];*/
    return $this->callApi($data, '/category/read');  
  }
}
