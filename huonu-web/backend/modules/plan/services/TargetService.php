<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:39
 */

namespace backend\modules\plan\services;

use backend\components\CtConstant;
use backend\models\AuthorizeUser;
use backend\models\TaobaoAuthorizeUser;
use backend\models\TaobaoZsCatList;
use backend\models\TaobaoZsDmpList;
use backend\models\TaobaoZsTargetList;
use common\components\CtHelper;
use common\components\Toolkit\CurlToolkit;
use common\services\BaseService;
use Yii;
use yii\data\Pagination;

// 定向 service TODO
class TargetService extends BaseService
{

    public $get;
    private $pageSize = 20;

    public function __construct()
    {
        $this->get = Yii::$app->request->get();

        require_once Yii::$app->getBasePath() . '/../vendor/taobao/TopSdk.php';
    }

    // TODO 移除定向
    public function removeTarget()
    {
        $get = $this->get;

        $taobaoZsTarget = TaobaoZsTargetList::find()
            ->where([
                'id' => $get['targetId'],
                'taobao_user_id' => $get['taobaoUserId']
            ])
            ->where(
                [
                    'id' => $get['targetId'],
                    'taobao_user_id' => $get['taobaoUserId'],
                ]
            )
            ->one();
        if (empty($taobaoZsTarget)) {
            CtHelper::response(false, '定向不存在');
        }

        // 删除资源位

        // 删除创意

        CtHelper::response(true, '删除成功');
    }

    // TODO 定向同步
    public function targetSync()
    {
        $get = $this->get;

        $taobaoZsTarget = TaobaoZsTargetList::find()
            ->where([
                'id' => $get['targetId'],
                'taobao_user_id' => $get['taobaoUserId']
            ])
            ->where(
                [
                    'id' => $get['targetId'],
                    'taobao_user_id' => $get['taobaoUserId'],
                ]
            )
            ->one();
        if (empty($taobaoZsTarget)) {
            CtHelper::response(false, '定向不存在');
        }

        $userInfo = TaobaoAuthorizeUser::findOne($get['taobaoUserId'])->toArray();
        if (empty($userInfo)) {
            CtHelper::response(false, '参数错误');
        }

        $data['user_id'] = $userInfo['taobao_user_id'];
        $data['call_people'] = $userInfo['taobao_user_nick'];
        $data['campaign_id'] = $get['targetId'];

        // 定向同步
        $targetUrl = "http://localhost:30005/huonu/zxht/sync/target/rtrpts";
        $targetResult = CurlToolkit::request('GET', $targetUrl, $data);

        // 创意同步
        $creativeUrl = "http://localhost:30005/huonu/zxht/sync/creative/rtrpts";
        $creativeResult = CurlToolkit::request('GET', $creativeUrl, $data);

        // 资源位同步
        $adzoneUrl = "http://localhost:30005/huonu/zxht/sync/adzone/rtrpts";
        $adzoneResult = CurlToolkit::request('GET', $adzoneUrl, $data);

        CtHelper::response(true, '');
    }

    /**
     * 获取相似宝贝定向
     */
    public function getSimilarBabyOrientation()
    {
        $setPlan = Yii::$app->session->get('setPlan');
        $taobaoUserId = $setPlan['taobao_user_id'];

        $taobaoUser = AuthorizeUser::findOne($taobaoUserId)->toArray();
        if (empty($taobaoUser)) {
            CtHelper::response(false, '店铺不存在');
        }

        $get = Yii::$app->request->get();

        $topClient = new \TopClient();
        $topClient->appkey = CtConstant::APP_KEY;
        $topClient->secretKey = CtConstant::APP_SECRET;
        $zuanshiShopItemFindRequest = new \ZuanshiShopItemFindRequest;
        $zuanshiShopItemFindRequest->setItemName($get['similarBabyName']);
        $zuanshiShopItemFindRequest->setPageSize('40');
        $zuanshiShopItemFindRequest->setItemName($get['similarBabyName']);
        $zuanshiShopItemFindRequest->setPageSize("$this->pageSize");
        $zuanshiShopItemFindRequest->setPageNum($get['page']);
        $responseXml = $topClient->execute($zuanshiShopItemFindRequest, $taobaoUser['access_token']);
        $responseArray = json_decode(json_encode($responseXml), true);

        if (!isset($responseArray['result']['items'])) {
            CtHelper::response(true, '暂无数据');
        }
        $pageSize = $this->pageSize;
        $totalCount = $responseArray['result']['total_count'];
        $page = ($totalCount > 0) ? ceil($totalCount / $pageSize) : 0;

        $result['page'] = $page;
        $result['items'] = $responseArray['result']['items']['item_d_t_o'];
        CtHelper::response(true, '', $result);
    }

    /**
     * 获取达摩盘定向
     */
    public function getDmpOrientate()
    {
        $dmpCrowdName = Yii::$app->request->get('dmpCrowdName');

        $setPlan = Yii::$app->session->get('setPlan');
        $taobaoUserId = $setPlan['taobao_user_id'];

        $taobaoUser = AuthorizeUser::findOne($taobaoUserId)->toArray();
        if (empty($taobaoUser)) {
            CtHelper::response(false, '店铺不存在');
        }

        $taobaoZsDmp = TaobaoZsDmpList::find()->where(['taobao_user_id' => $taobaoUserId]);
        if (!empty($dmpCrowdName)) {
            $taobaoZsDmp->andWhere(['like', 'dmp_crowd_name', $dmpCrowdName]);
        }
        $taobaoZsDmpCount = $taobaoZsDmp->count();
        $taobaoZsDmpPage = new Pagination(['totalCount' => $taobaoZsDmpCount, 'pageSize' => '40']);
        $taobaoZsDmp = $taobaoZsDmp->offset($taobaoZsDmpPage->offset)
            ->limit($taobaoZsDmpPage->limit)
            ->orderBy(['enable_time' => SORT_DESC])
            ->asArray()
            ->all();

        $result['taobaoZsDmpPageCount'] = $taobaoZsDmpPage->getPageCount();
        $result['taobaoZsDmpCount'] = $taobaoZsDmpCount;
        $result['taobaoZsDmp'] = $taobaoZsDmp;

        CtHelper::response(true, '', $result);
    }

    // 获取访客定向
    public function getVisitorsDirectional()
    {
    }

    // 类目型定向-高级兴趣点
    public function getClassOrientationAdvancedInterestPoint()
    {
        $get = Yii::$app->request->get();

        $setPlan = Yii::$app->session->get('setPlan');
        if (empty($setPlan)) {
            CtHelper::response(false, '参数错误');
        }

        $taobaoUserId = $setPlan['taobao_user_id'];
        $taobaoUser = AuthorizeUser::findOne($taobaoUserId)->toArray();
        if (empty($taobaoUser)) {
            CtHelper::response(false, '店铺不存在');
        }

        if (isset($get['interestName']) && $get['interestName'] != '') {
            $data['interest_name'] = trim($get['interestName']);
        }

        $data['user_id'] = $taobaoUserId;
        $data['call_people'] = $taobaoUser['taobao_user_nick'];
        $data['campaign_type'] = $setPlan['payment_type'];
        $url = 'http://192.168.8.58:8080/huonu/zxht/search/cat';
        $result = CurlToolkit::request('GET', $url, $data);
        $result = json_decode($result['data'], true);

        $seniorInterestDto = $result['zuanshi_banner_cat_find_response']['result']['interests']['senior_interest_dto'];

        CtHelper::response(true, '', $seniorInterestDto);
    }

    /**
     * 复盘获取定向
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getTarget()
    {
        $setParameter = Yii::$app->session->get('setParameter');

        if (empty($setParameter)) {
            CtHelper::response(false, '参数错误');
        }

        $taobaoZsTargetList = TaobaoZsTargetList::find()->select('id as target_id,crowd_name as target_name')
            ->where(['taobao_user_id' => $setParameter['taobao_id']])
            ->andWhere(['>=', 'gmt_create', $setParameter['multitray_start_time']])
            ->andWhere(['<=', 'gmt_create', $setParameter['multitray_end_time']])
            ->asArray()->all();
        return $taobaoZsTargetList;
    }
}