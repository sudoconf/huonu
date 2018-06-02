<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:40
 */

namespace backend\modules\plan\services;

use backend\models\AuthorizeUser;
use backend\models\TaobaoZsAdzoneList;
use backend\models\ZsAdzoneCondition;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;
use yii\data\Pagination;

class ResourceService extends BaseService
{
    /**
     * 获取资源位筛选条件
     */
    public function getResourceCondition()
    {
        $zsAdzoneConditions = ZsAdzoneCondition::find()->asArray()->all();
        $zsAdzoneConditions = $this->getTree($zsAdzoneConditions, 0);
        CtHelper::response(true, '', $zsAdzoneConditions);
    }

    /**
     * 获取资源位列表
     */
    public function getResources()
    {
        $adzoneName = Yii::$app->request->get('adzoneName');

        $setPlan = Yii::$app->session->get('setPlan');
        $taobaoUserId = $setPlan['taobao_user_id'];
        $taobaoUser = AuthorizeUser::findOne($taobaoUserId)->toArray();
        if (empty($taobaoUser)) {
            CtHelper::response(false, '店铺不存在');
        }

        $model = TaobaoZsAdzoneList::find()->where(['taobao_user_id' => $taobaoUserId]);

        if ($adzoneName != '') {
            $model->andWhere(['like', 'adzone_name', $adzoneName]);
        }

        $taobaoZsAdzoneCount = $model->count();
        $taobaoZsAdzonePage = new Pagination(['totalCount' => $taobaoZsAdzoneCount, 'pageSize' => '40']);
        $taobaoZsAdzones = $model->offset($taobaoZsAdzonePage->offset)
            ->limit($taobaoZsAdzonePage->limit)
            ->orderBy(['adzone_id' => SORT_DESC])
            ->asArray()
            ->all();

        $result['taobaoZsAdzonePageCount'] = $taobaoZsAdzonePage->getPageCount();
        $result['taobaoZsAdzoneCount'] = $taobaoZsAdzoneCount;
        $result['taobaoZsAdzones'] = $taobaoZsAdzones;

        CtHelper::response(true, '', $result);
    }

    /**
     * @param $data
     * @param $pId
     * @return array|string
     */
    public function getTree($data, $pId)
    {
        $tree = '';
        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $pId) {
                $v['children'] = self::getTree($data, $v['condition_id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }
}