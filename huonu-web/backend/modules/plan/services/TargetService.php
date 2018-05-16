<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:39
 */

namespace backend\modules\plan\services;

use backend\models\TaobaoAuthorizeUser;
use backend\models\TaobaoZsTargetList;
use common\components\CtHelper;
use common\components\Toolkit\CurlToolkit;
use common\services\BaseService;
use Yii;

// 定向 service TODO
class TargetService extends BaseService
{

    public $get;

    public function __construct()
    {
        $this->get = Yii::$app->request->get();
    }

    // TODO 移除定向
    public function removeTarget()
    {
        $get = $this->get;

        $taobaoZsTarget = TaobaoZsTargetList::find()
            ->where([
                'id' => $get['targetId'],
                'taobao_user_id' => $get['taobaoUserId']
            ])
            ->one();
        if (empty($taobaoZsTarget)) {
            CtHelper::response(false, '定向不存在');
        }

        // 删除资源位

        // 删除创意

        CtHelper::response(true, '删除成功');
    }

    // TODO 定向同步
    public function targetSync()
    {
        $get = $this->get;

        $taobaoZsTarget = TaobaoZsTargetList::find()
            ->where([
                'id' => $get['targetId'],
                'taobao_user_id' => $get['taobaoUserId']
            ])
            ->one();
        if (empty($taobaoZsTarget)) {
            CtHelper::response(false, '定向不存在');
        }

        $userInfo = TaobaoAuthorizeUser::findOne($get['taobaoUserId'])->toArray();
        if (empty($userInfo)) {
            CtHelper::response(false, '参数错误');
        }

        $data['user_id'] = $userInfo['taobao_user_id'];
        $data['call_people'] = $userInfo['taobao_user_nick'];
        $data['campaign_id'] = $get['targetId'];

        // 定向同步
        $targetUrl = "http://localhost:30005/huonu/zxht/sync/target/rtrpts";
        $targetResult = CurlToolkit::request('GET', $targetUrl, $data);

        // 创意同步
        $creativeUrl = "http://localhost:30005/huonu/zxht/sync/creative/rtrpts";
        $creativeResult = CurlToolkit::request('GET', $creativeUrl, $data);

        // 资源位同步
        $adzoneUrl = "http://localhost:30005/huonu/zxht/sync/adzone/rtrpts";
        $adzoneResult = CurlToolkit::request('GET', $adzoneUrl, $data);

        CtHelper::response(true, '');
    }
}