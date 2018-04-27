<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 11:03
 */

namespace common\components\OAuthClient;

// 抽象 实现类
class TaoBaoOAuthClient extends AbstractOAuthClient
{
    const USERINFO_URL = '';
    const AUTHORIZE_URL = '';
    const OAUTH_TOKEN_URL = '';

    public function getAuthorizeUrl($callbackUrl)
    {
        $params = array();
        $params['appid'] = $this->config['setting']['key'];
        $params['redirect_uri'] = $callbackUrl;
        $params['response_type'] = 'code';
        $params['scope'] = 'snsapi_userinfo';

        return self::AUTHORIZE_URL.http_build_query($params).'#wechat_redirect';
    }

    public function getAccessToken($code)
    {
        $params = array(
            'appid' => $this->config['setting']['key'],
            'secret' => $this->config['setting']['secret'],
            'code' => $code,
            'grant_type' => 'authorization_code',
        );
        $result = $this->getRequest(self::OAUTH_TOKEN_URL, $params);
        $rawToken = json_decode($result, true);

        return array(
            'openid' => $rawToken['openid'],
            'access_token' => $rawToken['access_token'],
            'expired_time' => time() + (int)$rawToken['expires_in'],
        );
    }

    public function getUserInfo($token)
    {
        $params = array(
            'openid' => $token['openid'],
            'access_token' => $token['access_token'],
            'lang' => 'zh_CN',
        );
        $result = $this->getRequest(self::USERINFO_URL, $params);
        $info = json_decode($result, true);

        return $this->convertUserInfo($info);
    }

    private function convertUserInfo($info)
    {
        $userInfo = array();
        $userInfo['id'] = $info['unionid'];
        $userInfo['openid'] = $info['openid'];
        $userInfo['name'] = $info['nickname'];
        $userInfo['avatar'] = $info['headimgurl'];
        $userInfo['sex'] = $info['sex'] == 2 ? 'female' : 'male';
        $userInfo['type'] = 'wechat';

        return $userInfo;
    }
}