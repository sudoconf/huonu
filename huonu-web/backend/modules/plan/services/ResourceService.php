<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:40
 */

namespace backend\modules\plan\services;

use backend\models\TaobaoZsAdzoneList;
use backend\models\ZsAdzoneCondition;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;

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
        $get = Yii::$app->request->get();

        $tt = TaobaoZsAdzoneList::find()->asArray()->all();

        CtHelper::response(true, '', 'sssssssssssssssssss');
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