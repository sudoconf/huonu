<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/23 15:58
 */

namespace backend\controllers;

use backend\components\CtConstant;
use yii\web\Controller;
use Yii;

class TestController extends Controller
{
    public static $sessionKey = '6201826184f96415e48346ba84dd41f24cegc196ec42642429413615';

    public function init()
    {
        parent::init();
        // 加载淘宝sdk
        require_once(__DIR__ . '/../../vendor/taobao/TopSdk.php');
    }

    public function actionIndex()
    {
        $aa['crowds']['crowd_type'] = 0;
        $aa['crowds']['matrix_price']['adzone_id'] = '34492608';
        $aa['crowds']['matrix_price']['price'] = '100';
        $aa['adzone_bid_list']['adzone_id'] = '34492608';
        print_r(json_encode($aa));
        die;
    }

    public function actionAddUnit()
    {
        $c = new \TopClient();
        $c->appkey = CtConstant::APP_KEY;
        $c->secretKey = CtConstant::APP_SECRET;
        $req = new \ZuanshiBannerAdgroupCreateRequest;
        $req->setCampaignId("327431568");
        $req->setIntelligentBid("1");
        $req->setName("火奴测试单元");

        $crowds = new \Crowd;
        $crowds->crowd_type = "0";
        $crowds->crowd_value = "10";
        $crowds->crowd_name = "通投";

        $sub_crowds = new \SubCrowd;
        $sub_crowds->sub_crowd_name = "通投";
        $sub_crowds->sub_crowd_value = "all";
        $crowds->sub_crowds = $sub_crowds;

        $matrix_price = new \MatrixPrice;
        $matrix_price->adzone_id = "21374664";
        $matrix_price->price = "100";
        $crowds->matrix_price = $matrix_price;
        $req->setCrowds(json_encode($crowds));

        $adzone_bid_list = new \AdzoneBid;
        $adzone_bid_list->adzone_id = "21374664";
        $req->setAdzoneBidList(json_encode($adzone_bid_list));

        $resp = $c->execute($req, self::$sessionKey);
        print_r($resp);
        die;
    }

    public function actionInterestFind(){
        $c = new \TopClient;
        $c->appkey = CtConstant::APP_KEY;
        $c->secretKey = CtConstant::APP_SECRET;
        $req = new \ZuanshiBannerInterestFindRequest;
        $req->setNickname("XX旗舰店");
        $req->setKeyword("大衣");
        $resp = $c->execute($req, self::$sessionKey);
        print_r($resp);
    }

    public function actionGetAdSpace(){
        $c = new \TopClient;
        $c->appkey = CtConstant::APP_KEY;
        $c->secretKey = CtConstant::APP_SECRET;
        $req = new \ZuanshiBannerAdzoneFindpageRequest;
        $resp = $c->execute($req, self::$sessionKey);
        print_r(json_decode(json_encode($resp), true));
    }

    public function actionGetAdCondition(){
        $c = new \TopClient;
        $c->appkey = CtConstant::APP_KEY;
        $c->secretKey = CtConstant::APP_SECRET;
        $req = new \ZuanshiBannerAdzoneConditionRequest;
        $resp = $c->execute($req, self::$sessionKey);
        print_r(json_decode(json_encode($resp), true));
    }

}