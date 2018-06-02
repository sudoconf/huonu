<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:00
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\TaobaoZsAdgroupList;
use backend\models\TaobaoZsAdvertiserAdgroupRtrptsTotalList;
use backend\models\TaobaoZsCampList;
use backend\modules\plan\services\UnitService;
use common\components\CtHelper;
use common\components\Toolkit\ArrayToolkit;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;

class UnitController extends BaseController
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

        $query = TaobaoZsAdgroupList::find();

        $query->where('0=0');

        if (isset($get['adgroupName'])) {
            $query->andWhere(['like', 'adGroup.adgroup_name', trim($get['adgroupName'])]);
        } else {
            $get['adgroupName'] = '';
        }

        if (isset($get['customerId']) && !empty($get['customerId'])) {
            $query->andWhere(['adGroup.taobao_user_id' => $get['customerId']]);
        } else {
            $get['customerId'] = '';
        }

        if (isset($get['onlineStatus']) && $get['onlineStatus'] < 99) {
            $query->andWhere(['adGroup.online_status' => $get['onlineStatus']]);
        } else {
            $get['onlineStatus'] = 99;
        }

        $camp = [];
        if (isset($get['campaignId']) && $get['campaignId'] != '') {
            $query->andWhere(['adGroup.campaign_id' => $get['campaignId']]);
            $camp = TaobaoZsCampList::findOne($get['campaignId']);
        }

        $query->from(TaobaoZsAdgroupList::tableName() . ' adGroup')
            ->select([
                '`adGroup`.*',
                '`timeShare`.charge',
                '`timeShare`.ecpc',
                '`timeShare`.ad_pv',
                '`timeShare`.click',
                '`timeShare`.ecpm',
                '`timeShare`.ctr'
            ])
            ->leftJoin(TaobaoZsAdvertiserAdgroupRtrptsTotalList::tableName() . ' timeShare', 'adGroup.adgroup_id = timeShare.adgroup_id');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $adgroups = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'taobao_user_id' => SORT_ASC,
                'adGroup.adgroup_id' => SORT_DESC
            ])
            ->asArray()
            ->all();

        $campaignIds = ArrayToolkit::column($adgroups, 'campaign_id');
        $camps = TaobaoZsCampList::find()->select(['name', 'id'])->where(['in', 'id', $campaignIds])->asArray()->all();
        $camps = ArrayToolkit::index($camps, 'id');

        $customers = AuthorizeUser::find()->select([
            'taobao_user_id',
            'taobao_user_nick'
        ])->asArray()->all();

        return $this->render('index', [
            'adgroups' => $adgroups,
            'pagination' => $pages,
            'customers' => $customers,
            'camps' => $camps,
            'get' => $get,
            'camp' => $camp
        ]);
    }

    /**
     * ajax 保存单元设置
     */
    public function actionAjaxSaveSetUnit()
    {
        UnitService::service()->saveSetUnit();
    }

    /**
     * 获取session 设置
     */
    public function actionAjaxGetSetUnit()
    {
        UnitService::service()->getSetUnit();
    }

    // TODO 改变单元状态
    public function actionAjaxChangeUnitState()
    {
        UnitService::service()->changeUnitState();
    }

    // TODO 移除单元
    public function actionAjaxRemoveUnit()
    {
        UnitService::service()->removeUnit();
    }

    // TODO 单元同步
    public function actionAjaxUnitSync()
    {
        UnitService::service()->unitSync();
    }

    // TODO 新建单元
    public function actionAjaxCreateUnit()
    {
    }
}