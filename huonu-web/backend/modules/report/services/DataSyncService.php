<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:46
 */

namespace backend\modules\report\services;

use backend\models\TaobaoAuthorizeUser;
use common\services\BaseService;
use Yii;
use yii\data\ActiveDataProvider;

// 报表数据同步 service TODO
class DataSyncService extends BaseService
{

    // 同步成功之后 同步状态要更改为未同步

    // 获取需要同步的店铺
    public function getShopNeedSync()
    {
        $searchModel = new TaobaoAuthorizeUser();
        //
        $query = $searchModel::find()->select(['taobao_user_nick', 'taobao_user_id', 'sync_status']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];
    }

}