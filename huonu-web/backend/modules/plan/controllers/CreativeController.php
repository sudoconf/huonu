<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:07
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\TaobaoZsAdgroupCreativeList;
use backend\models\TaobaoZsAdgroupList;
use backend\models\TaobaoZsCampList;
use backend\models\TaobaoZsCreativeList;
use backend\modules\plan\services\CreativeService;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;

class CreativeController extends BaseController
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

        $query = TaobaoZsCreativeList::find();

        $query->where('0=0');

        $camp = [];
        $adgroup = [];
        if (isset($get['campaignId']) && $get['campaignId'] != '') {
            $query = TaobaoZsAdgroupCreativeList::find()->where(['campaign_id' => $get['campaignId']]);
            $camp = TaobaoZsCampList::findOne($get['campaignId']);

            if (isset($get['adgroupId']) && $get['adgroupId'] != '') {
                $query->andWhere(['adgroup_id' => $get['adgroupId']]);
                $adgroup = TaobaoZsAdgroupList::findOne($get['adgroupId']);
            }
        }

        if (isset($get['customerId']) && !empty($get['customerId'])) {
            $query->andWhere(['taobao_user_id' => $get['customerId']]);
        } else {
            $get['customerId'] = '';
        }

        if (isset($get['creativeName']) && $get['creativeName'] != '') {
            $query->andWhere(['like', 'creative_name', trim($get['creativeName'])]);
        } else {
            $get['creativeName'] = '';
        }

        if (isset($get['auditStatus']) && $get['auditStatus'] != '') {
            $auditStatus = explode(',', $get['auditStatus']);
            $query->andWhere(['in', 'audit_status', $auditStatus]);
        } else {
            $get['auditStatus'] = '';
        }

        if (isset($get['creativeLevel']) && $get['creativeLevel'] != '') {
            $query->andWhere(['creative_level' => $get['creativeLevel']]);
        } else {
            $get['creativeLevel'] = '';
        }

        if (isset($get['creativeSize']) && $get['creativeSize'] != '') {
            $query->andWhere(['creative_size' => $get['creativeSize']]);
        } else {
            $get['creativeSize'] = '';
        }

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count()]);
        $taobaoZsCreative = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['create_time' => SORT_DESC, 'creative_id' => SORT_DESC])
            ->all();

        $customers = AuthorizeUser::find()->select([
            'taobao_user_id',
            'taobao_user_nick'
        ])->asArray()->all();

        return $this->render('index', [
            'taobaoZsCreative' => $taobaoZsCreative,
            'pagination' => $pagination,
            'customers' => $customers,
            'get' => $get,
            'camp' => $camp,
            'adgroup' => $adgroup
        ]);
    }

    /**
     * 保存创意 到 session
     */
    public function actionAjaxSaveCreative()
    {
        CreativeService::service()->saveCreative();
    }

    /**
     * ajax 获取创意列表
     */
    public function actionAjaxGetCreative()
    {
        CreativeService::service()->getCreative();
    }

    /**
     * ajax 获取session创意列表
     */
    public function actionAjaxGetSessionCreative()
    {
        CreativeService::service()->getSessionCreative();
    }

    // TODO 创意同步
    public function actionAjaxCreativeSync()
    {
    }

    // TODO 移除创意
    public function actionAjaxRemoveCreative()
    {
    }
}