<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 11:03
 */

namespace common\components\OAuthClient;

use backend\components\CtConstant;

class TaoBaoOAuthClient extends AbstractOAuthClient
{
    protected static $authorizeUrl = 'https://oauth.taobao.com/authorize';
    protected static $oauthTokenUrl = 'https://oauth.taobao.com/token';

    public function getAuthorizeUrl($redirectUri = '')
    {
        $params = [
            'response_type' => 'code',
            'client_id' => CtConstant::APP_KEY,
            'redirect_uri' => $redirectUri,
            'state' => 'huonu',
            'view' => 'web'
        ];

        return self::$authorizeUrl . '?' . http_build_query($params);
    }

    public function getAccessToken($code, $state, $redirectUri = null)
    {
        $params = array(
            'grant_type' => 'authorization_code',
            'client_id' => CtConstant::APP_KEY,
            'client_secret' => CtConstant::APP_SECRET,
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'state' => $state, // 可选参数state
            'view' => 'web', // 可选参数，默认为web
        );

        $url = self::$oauthTokenUrl . '?' . http_build_query($params);

        $responseJson = $this->postRequest($url);

        $responseArray = json_decode($responseJson, true);

        // 如果返回异常，会返回异常error 和 error_description
        if (isset($responseArray['error']) && isset($responseArray['error_description'])) {
            throw new \Exception($responseArray['error_description'], intval($responseArray['error']));
        }

        return $responseArray;
    }

}
