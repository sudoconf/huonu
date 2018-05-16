<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/16 13:10
 */

namespace backend\controllers;

use backend\models\Admin;
use backend\models\TaobaoAuthorizeUser;
use common\components\CtHelper;
use common\components\OAuthClient\TaoBaoOAuthClient;
use yii\web\Controller;
use Yii;

class OauthController extends Controller
{
    // 获取code
    public function actionGetCode()
    {
        $taoBaoOAuthClient = new TaoBaoOAuthClient();
        $redirectUri = $taoBaoOAuthClient->getAuthorizeUrl('http://data.huonu.com/oahth/get-access-token.html?state=1212&view=web');

        $this->redirect($redirectUri);
    }

    // 获取token
    public function actionGetAccessToken($code)
    {

        $taoBaoOAuthClient = new TaoBaoOAuthClient();
        $response = $taoBaoOAuthClient->getAccessToken($code, '');
        

        // 插入 zxht_admin
        $adminModel = new Admin();
        $adminField = [];
        $adminModel->setAttributes($adminField);
        if (!$adminModel->save()) {
            CtHelper::response(false, $adminModel->getErrors());
        }
        $adminId = Yii::$app->db->getLastInsertID();

        // 插入 taobao_authorize_user
        $taobaoAuthorizeUserModel = new TaobaoAuthorizeUser();
        $taobaoAuthorizeUserField = [];
        $taobaoAuthorizeUserModel->setAttributes($taobaoAuthorizeUserField);
        if (!$taobaoAuthorizeUserModel->save()) {
            CtHelper::response(false, $taobaoAuthorizeUserModel->getErrors());
        }

        CtHelper::response(true, '');
    }

}