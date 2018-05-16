<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:37
 */

namespace backend\modules\plan\services;

use backend\models\TaobaoAuthorizeUser;
use backend\models\TaobaoZsAdgroupList;
use common\components\CtHelper;
use common\components\Toolkit\CurlToolkit;
use common\services\BaseService;
use Yii;

// TODO 单元 service
class UnitService extends BaseService
{
    public $get;

    public function __construct()
    {
        $this->get = Yii::$app->request->get();
    }

    // TODO 改变单元状态
    public function changeUnitState()
    {
        $get = $this->get;

        $taobaoZsAdgroup = TaobaoZsAdgroupList::find()
            ->where([
                'adgroup_id' => $get['adgroupId'],
                'taobao_user_id' => $get['taobaoUserId']
            ])
            ->one();
        if (empty($taobaoZsAdgroup)) {
            CtHelper::response(false, '单元不存在');
        }

        $taobaoZsAdgroup->online_status = $get['onlineStatus'];

        if (!$taobaoZsAdgroup->save()) {
            CtHelper::response(false, $taobaoZsAdgroup->getErrors());
        }

        // TODO 后期同步到淘宝

        CtHelper::response(true, '状态修改成功');
    }

    // TODO 移除单元
    public function removeUnit()
    {
        $get = $this->get;
        if (empty($get)) {
            CtHelper::response(false, '参数错误');
        }

        $taobaoZsAdgroup = TaobaoZsAdgroupList::find()
            ->where([
                'adgroup_id' => $get['adgroupId'],
                'taobao_user_id' => $get['taobaoUserId']
            ])
            ->one();
        if (empty($taobaoZsAdgroup)) {
            CtHelper::response(false, '单元不存在');
        }

        // 删除定向

        // 删除资源位

        // 删除创意

        CtHelper::response(true, '删除成功');
    }

    // TODO 单元同步
    public function unitSync()
    {
        $get = $this->get;
        if (empty($get)) {
            CtHelper::response(false, '参数错误');
        }

        $taobaoZsAdgroup = TaobaoZsAdgroupList::find()
            ->where([
                'adgroup_id' => $get['adgroupId'],
                'taobao_user_id' => $get['taobaoUserId'],
            ])
            ->asArray()->one();
        if (empty($taobaoZsAdgroup)) {
            CtHelper::response(false, '单元不存在');
        }

        $userInfo = TaobaoAuthorizeUser::findOne($get['taobaoUserId'])->toArray();
        if (empty($userInfo)) {
            CtHelper::response(false, '参数错误');
        }

        $data['user_id'] = $get['taobaoUserId'];
        $data['call_people'] = $userInfo['taobao_user_nick'];
        $data['campaign_id'] = $taobaoZsAdgroup['campaign_id'];

        // 单元同步
        $adgroupUrl = "http://localhost:30005/huonu/zxht/sync/adgroup/rtrpts";
        $adgroupResult = CurlToolkit::request('GET', $adgroupUrl, $data);

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