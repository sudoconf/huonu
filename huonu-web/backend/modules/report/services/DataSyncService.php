<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:46
 */

namespace backend\modules\report\services;

use backend\models\TaobaoAuthorizeUser;
use common\components\CtHelper;
use common\components\Toolkit\CurlToolkit;
use common\services\BaseService;
use Yii;

// 报表数据同步 service
class DataSyncService extends BaseService
{
    /**
     * 同步
     */
    public function SyncOperation()
    {
        $request = Yii::$app->request->get();
        $callPeople = Yii::$app->user->getId(); // API 调用者

        $userInfo = TaobaoAuthorizeUser::findOne($request['userId']);
        if (empty($userInfo)) {
            CtHelper::response(false, '参数错误');
        }

        if ($userInfo->sync_status == 0) {
            // 全量同步
            $action = 'protion';
        } else {
            // 增量同步
            $action = 'entrie';
        }

        $url = sprintf('http://localhost:8010/zxht/sync/%s/%s/%s', $action, $userInfo->sync_status, $callPeople);
        $result = CurlToolkit::request('POST', $url);

        CtHelper::response(true, '', $result);
    }
}