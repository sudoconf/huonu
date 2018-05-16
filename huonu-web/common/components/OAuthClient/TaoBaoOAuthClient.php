<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 11:03
 */

namespace common\components\OAuthClient;

class TaoBaoOAuthClient extends AbstractOAuthClient
{
    const APP_KEY = '24544547';
    const APP_SECRET = 'fb256ba89bd6207531a676df2fdad049';
    const AUTHORIZE_URL = 'https://oauth.taobao.com/authorize';
    const OAUTH_TOKEN_URL = 'https://oauth.taobao.com/token';

    public function getAuthorizeUrl($redirectUri = '')
    {
        $params = [
            'response_type' => 'code',
            'client_id' => self::APP_KEY,
            'redirect_uri' => $redirectUri,
        ];

        return self::AUTHORIZE_URL . http_build_query($params);
    }

    public function getAccessToken($code = '', $redirectUri = '')
    {
        $params = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => self::APP_KEY,
            'client_secret' => self::APP_SECRET,
            'redirect_uri' => $redirectUri
        );

        return $this->getRequest(self::OAUTH_TOKEN_URL, $params);
    }

}
