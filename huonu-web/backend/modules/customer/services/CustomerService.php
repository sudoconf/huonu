<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/16 11:50
 */
namespace backend\modules\customer\services;

use backend\models\TaobaoAuthorizeUser;
use common\components\CtHelper;
use common\components\Toolkit\CurlToolkit;
use common\services\BaseService;
use Yii;

// 报表数据同步 service
class CustomerService extends BaseService
{
    /**
     * 同步
     */
    public function SyncOperation()
    {
        $request = Yii::$app->request->get();
        // $taobaoUserId = Yii::$app->user->getId(); // API 调用者

        $userInfo = TaobaoAuthorizeUser::findOne($request['userId']);
        if (empty($userInfo)) {
            CtHelper::response(false, '参数错误');
        }

        if ($userInfo->sync_status == 0) {
            // 全量同步
            $action = 'entrie';
        } else {
            // 增量同步
            $action = 'protion';
        }

        $url = sprintf('http://localhost:30005/huonu/zxht/sync/%s', $action);
        // $url1 = 'http://114.55.238.227:30005/huonu/test/cod';

        $data['user_id'] = $userInfo->taobao_user_id;
        $data['call_people'] = $userInfo->taobao_user_nick;

        $result = CurlToolkit::request('GET', $url, $data);

        CtHelper::response(true, $result['errMsg']);
    }
}