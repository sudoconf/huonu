<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:56
 */

namespace common\components\OAuthClient;

abstract class AbstractOAuthClient
{
    protected $connectTimeout = 30;

    protected $timeout = 30;

    public function __construct()
    {
    }

    /**
     * 获取code 跳转至回调地址
     * @param $redirectUri
     * @return mixed
     */
    abstract public function getAuthorizeUrl($redirectUri);

    /**
     * 获取token
     * @param $code
     * @param $redirectUri
     * @return mixed
     */
    abstract public function getAccessToken($code, $redirectUri);

    /**
     * HTTP POST.
     *
     * @param string $url 要请求的url地址
     * @param array $params 请求的参数
     *
     * @return string
     */
    public function postRequest($url, $params)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_URL, $url);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * HTTP GET.
     *
     * @param string $url 要请求的url地址
     * @param array $params 请求的参数
     *
     * @return string
     */
    public function getRequest($url, $params)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        $url = $url . '?' . http_build_query($params);
        curl_setopt($curl, CURLOPT_URL, $url);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}