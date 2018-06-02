<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:07
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\TaobaoZsAdgroupAdzoneList;
use backend\models\TaobaoZsAdgroupList;
use backend\models\TaobaoZsAdzoneList;
use backend\models\TaobaoZsCampList;
use backend\modules\plan\services\ResourceService;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;

class ResourceController extends BaseController
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


        $query = TaobaoZsAdzoneList::find();

        $query->where('0=0');

        $camp = [];
        $adgroup = [];
        if (isset($get['campaignId']) && $get['campaignId'] != '') {
            $query = TaobaoZsAdgroupAdzoneList::find()->where(['campaign_id' => $get['campaignId']]);
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

        if (isset($get['adzoneName'])) {
            $query->andWhere(['like', 'adzone_name', trim($get['adzoneName'])]);
        } else {
            $get['adzoneName'] = '';
        }

        if (isset($get['mediaType']) && !empty($get['mediaType'])) {
            $query->andWhere(['media_type' => $get['mediaType']]);
        } else {
            $get['mediaType'] = '';
        }

        if (isset($get['allowAdFormat'])) {
            $query->andWhere(['like', 'allow_ad_format_list', $get['allowAdFormat']]);
        } else {
            $get['allowAdFormat'] = '';
        }

        if (isset($get['adzoneSize']) && !empty($get['adzoneSize'])) {
            $query->andWhere(['adzone_size_list' => "[{$get['adzoneSize']}]"]);
        } else {
            $get['adzoneSize'] = '';
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $adzones = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'taobao_user_id' => SORT_ASC,
                'adzone_id' => SORT_DESC
            ])
            ->asArray()
            ->all();

        $customers = AuthorizeUser::find()->select([
            'taobao_user_id',
            'taobao_user_nick'
        ])->asArray()->all();

        return $this->render('index', [
            'adzones' => $adzones,
            'pagination' => $pages,
            'customers' => $customers,
            'get' => $get,
            'camp' => $camp,
            'adgroup' => $adgroup
        ]);
    }

    // TODO 资源位同步
    public function actionAjaxResourceSync()
    {

    }

    // TODO 移除资源位
    public function actionAjaxRemoveResource()
    {

    }

    // TODO 增加资源位
    public function actionAddResource()
    {

    }

    /**
     * 获取资源位筛选条件
     */
    public function actionAjaxGetResourceCondition()
    {
        ResourceService::service()->getResourceCondition();
    }

    /**
     * 获取资源位列表
     */
    public function actionAjaxGetResources()
    {
        ResourceService::service()->getResources();
    }
}