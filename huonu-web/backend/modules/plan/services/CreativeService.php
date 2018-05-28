<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:41
 */

namespace backend\modules\plan\services;

use backend\models\TaobaoZsCreativeList;
use common\services\BaseService;
use Yii;
use yii\data\Pagination;

// 创意 service TODO
class CreativeService extends BaseService
{
    public function getCreative()
    {
        $query = TaobaoZsCreativeList::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['creative_id' => SORT_DESC, 'create_time' => SORT_DESC])
            ->all();
        $result['pages'] = $pages;
        $result['models'] = $models;
        return $result;
    }

    // 移除创意 TODO
    public function removeCreative()
    {
    }
}