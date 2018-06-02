<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:41
 */

namespace backend\modules\plan\services;

use backend\models\AuthorizeUser;
use backend\models\TaobaoZsCreativeList;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;
use yii\data\Pagination;

class CreativeService extends BaseService
{
    public $get;

    public function __construct()
    {
        $this->get = Yii::$app->request->get();
    }

    /**
     * 获取创意列表
     */
    public function getCreative()
    {
        $setPlan = Yii::$app->session->get('setPlan');
        $taobaoUserId = $setPlan['taobao_user_id'];

        $taobaoUser = AuthorizeUser::findOne($taobaoUserId)->toArray();
        if (empty($taobaoUser)) {
            CtHelper::response(false, '店铺不存在');
        }

        $get = Yii::$app->request->get();
        $taobaoZsCreative = TaobaoZsCreativeList::find()->where(['taobao_user_id' => $taobaoUserId]);

        if (isset($get['creativeSize']) && $get['creativeSize'] != '') {
            $taobaoZsCreative->andWhere(['creative_size' => $get['creativeSize']]);
        }

        if (isset($get['creativeLevel']) && $get['creativeLevel'] != '') {
            $taobaoZsCreative->andWhere(['creative_level' => $get['creativeLevel']]);
        }

        if (isset($get['auditStatus']) && $get['auditStatus'] != '') {
            $auditStatus = explode(',', $get['auditStatus']);
            $taobaoZsCreative->andWhere(['in', 'audit_status', $auditStatus]);
        }

        if (isset($get['creativeName']) && $get['creativeName'] != '') {
            $taobaoZsCreative->andWhere(['like', 'creative_name', $get['creativeName']]);
        }

        $taobaoZsCreativeCount = $taobaoZsCreative->count();
        $taobaoZsCreativePage = new Pagination(['totalCount' => $taobaoZsCreativeCount, 'pageSize' => '40']);

        $taobaoZsCreative = $taobaoZsCreative->offset($taobaoZsCreativePage->offset)
            ->limit($taobaoZsCreativePage->limit)
            ->orderBy(['create_time' => SORT_DESC])
            ->asArray()
            ->all();

        $result['taobaoZsCreativePageCount'] = $taobaoZsCreativePage->getPageCount();
        $result['taobaoZsCreativeCount'] = $taobaoZsCreativeCount;
        $result['taobaoZsCreative'] = $taobaoZsCreative;

        CtHelper::response(true, '', $result);
    }

    /**
     * 保存创意到session
     */
    public function saveCreative()
    {
        $get = $this->get;

        if (!isset($get['creativeIdList'])) {
            CtHelper::response(false, '参数错误');
        }

        $setCreative = Yii::$app->session->get('setCreative');
        if ($setCreative && is_array($setCreative)) {
            Yii::$app->session->remove('setCreative');
        }
        Yii::$app->session->set('setCreative', $get);
        CtHelper::response(true, '操作成功');
    }

    /**
     * 获取session 创意
     */
    public function getSessionCreative()
    {
        $setCreative = Yii::$app->session->get('setCreative');

        $creativeIdList = [];
        $taobaoZsCreatives = [];
        if (isset($setCreative['creativeIdList']) && $setCreative['creativeIdList'] != '') {
            $creativeIds = explode(',', $setCreative['creativeIdList']);
            $taobaoZsCreatives = TaobaoZsCreativeList::find()
                ->select(['creative_id', 'click_url', 'image_path'])
                ->where(['in', 'creative_id', $creativeIds])
                ->asArray()->all();
            $creativeIdList = $setCreative['creativeIdList'];
        }

        $result['taobaoZsCreatives'] = $taobaoZsCreatives;
        $result['creativeIdList'] = $creativeIdList;

        CtHelper::response(true, '', $result);
    }

    // 移除创意 TODO
    public function removeCreative()
    {
    }
}