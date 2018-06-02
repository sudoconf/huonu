<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:05
 */


namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\TaobaoZsAdgroupList;
use backend\models\TaobaoZsAdvertiserTargetRtrptsTotalList;
use backend\models\TaobaoZsCampList;
use backend\models\TaobaoZsTargetList;
use backend\modules\plan\services\TargetService;
use common\components\Toolkit\ArrayToolkit;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;

class TargetController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '' => [''],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();

        $query = TaobaoZsTargetList::find();

        $query->where('0=0');

        if (isset($get['targetName'])) {
            $query->andWhere(['like', 'target.crowd_name', trim($get['targetName'])]);
        } else {
            $get['targetName'] = '';
        }

        if (isset($get['customerId']) && !empty($get['customerId'])) {
            $query->andWhere(['target.taobao_user_id' => $get['customerId']]);
        } else {
            $get['customerId'] = '';
        }

        if (isset($get['crowdType']) && !empty($get['crowdType'])) {
            $query->andWhere(['target.crowd_type' => $get['crowdType']]);
        } else {
            $get['crowdType'] = '';
        }

        $camp = [];
        if (isset($get['campaignId']) && $get['campaignId'] != '') {
            $query->andWhere(['target.campaign_id' => $get['campaignId']]);
            $camp = TaobaoZsCampList::findOne($get['campaignId']);
        }

        $adgroup = [];
        if (isset($get['adgroupId']) && $get['adgroupId'] != '') {
            $query->andWhere(['target.adgroup_id' => $get['adgroupId']]);
            $adgroup = TaobaoZsAdgroupList::findOne($get['adgroupId']);
        }

        $query->from(TaobaoZsTargetList::tableName() . ' target')
            ->select([
                '`target`.*',
                '`timeShare`.charge',
                '`timeShare`.ecpc',
                '`timeShare`.ad_pv',
                '`timeShare`.click',
                '`timeShare`.ecpm',
                '`timeShare`.ctr'
            ])
            ->leftJoin(TaobaoZsAdvertiserTargetRtrptsTotalList::tableName() . ' timeShare', 'target.id = timeShare.target_id');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $targets = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'taobao_user_id' => SORT_ASC,
                'id' => SORT_DESC
            ])
            ->asArray()
            ->all();

        $campaignIds = ArrayToolkit::column($targets, 'campaign_id');
        $camps = TaobaoZsCampList::find()->select(['name', 'id'])->where(['in', 'id', $campaignIds])->asArray()->all();
        $camps = ArrayToolkit::index($camps, 'id');

        $adgroupIds = ArrayToolkit::column($targets, 'adgroup_id');
        $adgroups = TaobaoZsAdgroupList::find()->select(['adgroup_name', 'adgroup_id'])->where(['in', 'adgroup_id', $adgroupIds])->asArray()->all();
        $adgroups = ArrayToolkit::index($adgroups, 'adgroup_id');

        $customers = AuthorizeUser::find()->select([
            'taobao_user_id',
            'taobao_user_nick'
        ])->asArray()->all();

        return $this->render('index', [
            'targets' => $targets,
            'pagination' => $pages,
            'customers' => $customers,
            'camps' => $camps,
            'adgroups' => $adgroups,
            'get' => $get,
            'camp' => $camp,
            'adgroup' => $adgroup
        ]);
    }

    // TODO 移除定向
    public function actionAjaxRemoveTarget()
    {
        TargetService::service()->removeTarget();
    }

    // TODO 定向同步
    public function actionAjaxTargetSync()
    {
        TargetService::service()->targetSync();
    }

    // TODO 增加定向
    public function actionAddTarget()
    {

    }

    /**
     * 获取相似宝贝定向
     */
    public function actionAjaxGetSimilarBabyOrientation()
    {
        TargetService::service()->getSimilarBabyOrientation();
    }

    /**
     * 获取达摩盘定向
     */
    public function actionAjaxGetDmpOrientate()
    {
        TargetService::service()->getDmpOrientate();
    }

    // 获取访客定向
    public function actionAjaxGetVisitorsDirectional()
    {
        TargetService::service()->getVisitorsDirectional();
    }

    // 类目型定向-高级兴趣点
    public function actionAjaxGetClassOrientationAdvancedInterestPoint()
    {
        TargetService::service()->getClassOrientationAdvancedInterestPoint();
    }
}