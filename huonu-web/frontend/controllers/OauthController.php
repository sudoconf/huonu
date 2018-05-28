<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/16 13:10
 */

namespace frontend\controllers;

use backend\models\TaobaoAuthorizeUser;
use common\components\CtHelper;
use common\components\OAuthClient\TaoBaoOAuthClient;
use yii\web\Controller;
use Yii;

/**
 * 授权过程 必须先订购 然后才能使用
 * Class OauthController
 * @package frontend\controllers
 */
class OauthController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 获取code
     */
    public function actionGetCode()
    {
        $taoBaoOAuthClient = new TaoBaoOAuthClient();
        $redirectUri = $taoBaoOAuthClient->getAuthorizeUrl('http://zz.huonu.com/oauth/get-access-token');

        $this->redirect($redirectUri);
    }

    /**
     * 获取token
     */
    public function actionGetAccessToken()
    {

        if (isset($_GET['code'])) {

            $state = isset($_GET['state']) ? $_GET['state'] : '';

            try {

                $taoBaoOAuthClient = new TaoBaoOAuthClient();
                $responseArray = $taoBaoOAuthClient->getAccessToken($_GET['code'], $state, 'http://zz.huonu.com/oauth/success');

                if (isset($responseArray['access_token'])) {

                    // 判断是否已经有了
                    $taobaoAuthorizeUser = TaobaoAuthorizeUser::findOne($responseArray['taobao_user_id'])->toArray();
                    if (!empty($taobaoAuthorizeUser)) {
                        Yii::$app->getSession()->setFlash('success', '您已经授权');
                        return $this->redirect(['site/index']);
                    }

                    $expireTime = $responseArray['expire_time'] / 1000;
                    $taobaoUserNick = urldecode($responseArray['taobao_user_nick']);

                    $taobaoAuthorizeUserField = [
                        'taobao_user_id' => $responseArray['taobao_user_id'],
                        'taobao_user_nick' => $taobaoUserNick,
                        'access_token' => $responseArray['access_token'],
                        'refresh_token' => $responseArray['refresh_token'],
                        'token_type' => $responseArray['token_type'],
                        're_expires_in' => $responseArray['re_expires_in'],
                        'expires_in' => $responseArray['expires_in'],
                        'r1_expires_in' => $responseArray['r1_expires_in'],
                        'r2_expires_in' => $responseArray['r2_expires_in'],
                        'w1_expires_in' => $responseArray['w1_expires_in'],
                        'w2_expires_in' => $responseArray['w2_expires_in'],
                        'r1_valid' => $responseArray['r1_valid'],
                        'r2_valid' => $responseArray['r2_valid'],
                        'w1_valid' => $responseArray['w1_valid'],
                        'w2_valid' => $responseArray['w2_valid'],
                        'refresh_token_valid_time' => $responseArray['refresh_token_valid_time'],
                        'expire_time' => date("Y-m-d H:i:s", $expireTime)
                    ];

                    // 插入 taobao_authorize_user
                    $taobaoAuthorizeUserModel = new TaobaoAuthorizeUser();
                    $taobaoAuthorizeUserModel->setAttributes($taobaoAuthorizeUserField);
                    if (!$taobaoAuthorizeUserModel->save()) {
                        CtHelper::response(false, $taobaoAuthorizeUserModel->getErrors());
                    }

                    CtHelper::response(true, '');

                }

            } catch (\Exception $e) {

                // 异常，重新获取
                CtHelper::response(false, '........');
            }

        } else {

            // 引导用户到授权登录页面
            $this->redirect('index');

        }
    }

    public function actionSuccess()
    {
        return CtHelper::response('true', '授权成功');
    }

}