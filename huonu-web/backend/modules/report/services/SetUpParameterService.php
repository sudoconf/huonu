<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/4 14:35
 */

namespace backend\modules\report\services;

use backend\models\TaobaoZsAdvertiserTargetDaySumList;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;

class SetUpParameterService extends BaseService
{
    /**
     * 保存参数
     */
    public function saveParameter()
    {

        $data = Yii::$app->request->post();

        if (empty($data)) {
            return CtHelper::response('false', '参数错误');
        }

        // TODO 校验提交的字段
        // $this->check($data);

        // 判断选定时间段是否有数据
        $taobaoZsAdvertiserTargetDaySumList = TaobaoZsAdvertiserTargetDaySumList::find()->select('sum(charge)')
            ->where(['>=', 'log_date', $data['multitray_start_time']])
            ->andWhere(['<=', 'log_date', $data['multitray_end_time']])
            ->andWhere(['taobao_user_id' => $data['taobao_id']])
            ->andWhere(['effect' => $data['multitray_cycle']])
            ->andWhere(['effect_type' => $data['multitray_effect_model']])
            ->groupBy('log_date')
            ->asArray()->all();
        if (empty($taobaoZsAdvertiserTargetDaySumList)) {
            CtHelper::response(false, '暂无数据');
        }

        if (isset($data['_csrf-backend'])) {
            unset($data['_csrf-backend']);
            unset($data['multitray_time']);
        }

        $setParameter = Yii::$app->session->get('setParameter');
        if ($setParameter && is_array($setParameter)) {
            Yii::$app->session->remove('setParameter');
            Yii::$app->session->set('setParameter', $data);
        } else {
            Yii::$app->session->set('setParameter', $data);
        }

        return CtHelper::response('true', '保存成功');

    }

    /**
     * 检测参数
     * @param $data
     * @return array
     */
    private function check($data)
    {
        $params = array(
            'multitray_name',
            'taobao_name',
            'taobao_id',
            'multitray_start_time',
            'multitray_end_time',
            'multitray_field',
            'multitray_effect_model',
            'multitray_cycle',
        );



        return $params;
    }

}