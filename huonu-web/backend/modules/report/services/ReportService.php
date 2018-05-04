<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:44
 */

namespace backend\modules\report\services;

use backend\models\Multitray;
use backend\models\MultitrayPolicyGroup;
use backend\models\MultitrayStatistics;
use backend\models\SystemLog;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;
use yii\db\Exception;

// TODO 报表 service
class ReportService extends BaseService
{
    /**
     * 复盘删除
     */
    public function deleteOperation()
    {
        $multitrayId = Yii::$app->request->get('multitrayId');
        $multitray = Multitray::findOne($multitrayId);
        if (empty($multitray)) {
            CtHelper::response('false', '复盘不存在');
        }

        $multitray->is_delete = 1;
        if (!$multitray->save()) {
            CtHelper::response('false', $multitray->getErrors());
        }

        CtHelper::response('true', '删除成功！');
    }

    /**
     * 添加 复盘实际操作
     * @throws Exception
     * @throws \Exception
     */
    public function createOperation()
    {
        // 第一步保存的数据
        $setParameter = Yii::$app->session->get('setParameter');

        // 第二部保存的数据
        $strategyGroup = Yii::$app->session->get('strategyGroup');

        if (!isset($setParameter['taobao_id']) && empty($setParameter) && !isset($strategyGroup['taobao_id']) && empty($strategyGroup)) {
            CtHelper::response(false, '操作失败，请检查提交数据');
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            // 添加复盘
            $analyseArray['multitray_name'] = $setParameter['multitray_name'];
            $analyseArray['taobao_name'] = $setParameter['taobao_name'];
            $analyseArray['taobao_id'] = $setParameter['taobao_id'];
            $analyseArray['multitray_start_time'] = strtotime($setParameter['multitray_start_time']);
            $analyseArray['multitray_end_time'] = strtotime($setParameter['multitray_end_time']);
            $analyseArray['multitray_field'] = json_encode($setParameter['multitray_field']);
            $analyseArray['multitray_effect_model'] = $setParameter['multitray_effect_model'];
            $analyseArray['multitray_cycle'] = $setParameter['multitray_cycle'];

            $multitray = new Multitray();
            $multitray->setAttributes($analyseArray);
            if (!$multitray->save()) {
                throw new Exception('复盘添加失败：' . current($multitray->getFirstErrors()));
            }
            $multitrayId = Yii::$app->db->getLastInsertID();

            // 添加复盘日志
            $analyseRemarks = sprintf('%s添加了复盘：%s', Yii::$app->user->identity->username, $setParameter['multitray_name']);
            SystemLog::create(SystemLog::TYPE_CREATE, $multitrayId, $analyseRemarks, $setParameter);

            // TODO 添加策略组 策略组最多只能有9个 所以数据库要分批存储
            $policyGroupNameArray = [];
            foreach ($strategyGroup as $k => $v) {

                foreach ($v as $sk => $sv) {
                    $multitrayPolicyGroup = new MultitrayPolicyGroup();
                    $strategicGroup['multitray_id'] = $multitrayId;
                    $strategicGroup['policy_group_name'] = (string)$k;
                    $strategicGroup['taobao_id'] = $setParameter['taobao_id'];
                    $strategicGroup['target_id'] = $sv['targetId'];
                    $strategicGroup['target_name'] = $sv['targetName'];

                    $multitrayPolicyGroup->setAttributes($strategicGroup);
                    if (!$multitrayPolicyGroup->save()) {
                        throw new Exception('策略组添加失败：' . current($multitrayPolicyGroup->getFirstErrors()));
                    }
                    $multitrayPolicyGroupId = Yii::$app->db->getLastInsertID();

                    // 添加策略组日志
                    $policyGroupRemarks = sprintf('%s添加了策略组：%s', Yii::$app->user->identity->username, $k);
                    SystemLog::create(SystemLog::TYPE_CREATE, $multitrayPolicyGroupId, $policyGroupRemarks, $strategicGroup);
                }

                $policyGroupNameArray[] = $k;
            }

            // TODO 添加完数据之后 生成统计数据
            $field['multitrayName'] = $setParameter['multitray_name'];
            $field['startTime'] = $analyseArray['multitray_start_time'];
            $field['endTime'] = $analyseArray['multitray_end_time'];
            $field['policyGroupNameArray'] = $policyGroupNameArray;
            $field['taoBaoId'] = $setParameter['taobao_id'];
            $field['effect'] = $analyseArray['multitray_cycle'];
            $field['effectType'] = $analyseArray['multitray_effect_model'];
            $field['multitrayId'] = $multitrayId;
            $this->generateStatisticOperation($field);

            Yii::$app->session->set('whetherOrNotComplete', true);

            $transaction->commit();
            CtHelper::response(true, '操作成功');
        } catch (Exception $e) {
            $transaction->rollBack();
            CtHelper::response(false, $e->getMessage());
        }
    }

    // TODO 统计数据生成
    protected function generateStatisticOperation($field)
    {
        $timeArray = [];
        $logStartDate = date('Y-m-d', $field['startTime']);
        $logEndDate = date('Y-m-d', $field['endTime']);
        $taoBaoId = $field['taoBaoId'];
        $effect = $field['effect'];
        $effectType = $field['effectType'];
        $multitrayId = $field['multitrayId'];
        $multitrayName = $field['multitrayName'];

        while ($field['startTime'] <= $field['endTime']) {
            $timeArray[] = date('Y-m-d', $field['startTime']);
            $field['startTime'] = strtotime("+1 day", $field['startTime']);
        }

        // 查询出数据
        $resultSql = "select  sum(charge) as charge,
                sum(ad_pv) as ad_pv,
                sum(click) as click,
                sum(uv) as uv,
                sum(deep_inshop_uv) as deep_inshop_uv,
                sum(avg_access_time) as avg_access_time,
                sum(avg_access_page_num) as avg_access_page_num,
                sum(inshop_item_col_num) as inshop_item_col_num,
                sum(dir_shop_col_num) as dir_shop_col_num,
                sum(cart_num) as cart_num,
                sum(cart_num)*100/sum(uv) as purchase_rate_of_goods,
                sum(inshop_item_col_num)*100/sum(uv) as commodity_collection_rate,
                sum(charge)/sum(inshop_item_col_num) as commodity_collection_cost,
                sum(charge)/sum(cart_num) as purchase_cost_of_goods,
                sum(charge)/(sum(inshop_item_col_num)+sum(cart_num)) as purchase_cost_of_goods_collection,
                sum(gmv_inshop_num) as gmv_inshop_num,
                sum(gmv_inshop_amt) as gmv_inshop_amt,
                sum(alipay_in_shop_num) as alipay_in_shop_num,
                sum(alipay_inshop_amt) as alipay_inshop_amt,
                sum(charge)/sum(alipay_in_shop_num) as average_cost_of_order,
                sum(alipay_inshop_amt)/sum(alipay_in_shop_num) as order_average_amount,
                sum(alipay_inshop_amt)/sum(charge) as roi,
                sum(charge)*1000/sum(ad_pv) as ecpm,
                sum(click)/sum(ad_pv) as ctr,
                sum(charge)/sum(click) as ecpc,
                sum(alipay_in_shop_num)/sum(click) as cvr,
                policy_group_name,
                log_date 
                from    taobao_zs_advertiser_target_day_sum_list t1,
                        huonu_multitray_policy_group t2
                where 
                        t1.target_id = t2.target_id 
                and     log_date >= '2017-08-07' and log_date <= '2018-04-30' 
                and     taobao_user_id='$taoBaoId' 
                and     effect = '$effect' 
                and     effect_type = '$effectType' 
                group by log_date,policy_group_name order by log_date,policy_group_name";
        $result = Yii::$app->db->createCommand($resultSql)->queryAll();

        if (!empty($result)) {

            $lineInfoArray = [];
            $newInfoArray = [];

            foreach ($result as $k => $v) {
                $lineInfo = '["' . round($v['purchase_rate_of_goods'], 2)
                    . '","' . round($v['commodity_collection_rate'], 2)
                    . '","' . round($v['commodity_collection_cost'], 2)
                    . '","' . round($v['purchase_cost_of_goods'], 2)
                    . '","' . round($v['purchase_cost_of_goods_collection'], 2)
                    . '","' . round($v['average_cost_of_order'], 2)
                    . '","' . round($v['order_average_amount'], 2)
                    . '","' . round($v['alipay_inshop_amt'], 2)
                    . '","' . round($v['alipay_in_shop_num'], 2)
                    . '","' . round($v['gmv_inshop_amt'], 2)
                    . '","' . round($v['gmv_inshop_num'], 2)
                    . '","' . round($v['cart_num'], 2)
                    . '","' . round($v['dir_shop_col_num'], 2)
                    . '","' . round($v['inshop_item_col_num'], 2)
                    . '","' . round($v['avg_access_page_num'], 2)
                    . '","' . round($v['avg_access_time'], 2)
                    . '","' . round($v['deep_inshop_uv'], 2)
                    . '","' . round($v['charge'], 2)
                    . '","' . round($v['click'], 2)
                    . '","' . round($v['ad_pv'], 2)
                    . '","' . round($v['uv'], 2)
                    . '","' . round($v['ecpm'], 2)
                    . '","' . round($v['ecpc'], 2)
                    . '","' . round($v['ctr'], 2)
                    . '","' . round($v['cvr'], 2)
                    . '","' . round($v['roi'], 2) . '"]';

                $lineKey = strtotime($v['log_date']);
                $lineInfoArray[$v['policy_group_name']][$lineKey] = $lineInfo;

                foreach ($timeArray as $tk => $tv) {
                    $lineInfoArray[$v['policy_group_name']][strtotime($tv)] = '[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]';
                }
            }

            foreach ($lineInfoArray as $k => $v) {
                ksort($v, SORT_ASC);
                foreach ($v as $tk => $tv) {
                    $newInfoArray[$k][date('Y-m-d', $tk)] = $tv;
                }
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {

                $multitrayStatistics = new MultitrayStatistics();

                $multitrayStatisticsArray['multitray_id'] = $multitrayId;
                $multitrayStatisticsArray['multitray_statistics_content_json'] = json_encode($newInfoArray);

                $multitrayStatistics->setAttributes($multitrayStatisticsArray);
                if (!$multitrayStatistics->save()) {
                    throw new Exception('统计数据添加失败：' . current($multitrayStatistics->getFirstErrors()));
                }

                $multitrayStatisticsId = Yii::$app->db->getLastInsertID();

                // 添加统计数据日志
                $multitrayStatisticRemark = sprintf('%s添加了计划统计数据：%s', Yii::$app->user->identity->username, $multitrayName);
                SystemLog::create(SystemLog::TYPE_CREATE, $multitrayStatisticsId, $multitrayStatisticRemark, $multitrayStatisticsArray);

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw new \Exception($e->getMessage());
            }
        }
    }

    // 统计展现(包括下载数据)
    public function getShowOperation()
    {
        $multitrayId = Yii::$app->request->get('multitrayId');

        $multitray = Multitray::findOne($multitrayId);
        if (empty($multitray)) {
            CtHelper::response('false', '');
        }

        $logStartDate = '2017-02-01';//date('Y-m-d', $multitray->multitray_start_time);
        $logEndDate = date('Y-m-d', $multitray->multitray_end_time);

        // 花费占比(charge)、投入产出比(alipay_inshop_amt、roi)
        $statisticDataSql = "select sum(charge) as charge, 
                                sum(alipay_inshop_amt) as alipay_inshop_amt,
                                sum(roi) as roi, policy_group_name,
                                sum(cart_num)*100/sum(uv) as purchase_rate,
                                sum(inshop_item_col_num)*100/sum(uv) as commodity_collection_rate,
                                sum(charge)/(sum(inshop_item_col_num)+sum(cart_num)) as purchase_cost_of_goods_collection
                    from taobao_zs_advertiser_target_day_sum_list t1, huonu_multitray_policy_group t2  where log_date >= '$logStartDate' and log_date <= '$logEndDate'
                    and     t1.target_id = t2.target_id 
                    and     taobao_user_id='$multitray->taobao_id'
                    and     effect = '$multitray->multitray_cycle'
                    and     effect_type = '$multitray->multitray_effect_model'  group by policy_group_name order by policy_group_name";
        $statisticData = Yii::$app->db->createCommand($statisticDataSql)->queryAll();

        // TODO 按时日期分析
        // TODO 按人群分析
        // TODO 策略组按日分析
        // TODO 定向人群按日分析

        $result['multitrayId'] = $multitrayId;

        $result['multitrayName'] = $multitray->multitray_name;

        $result['policyGroupName'] = array_column($statisticData, 'policy_group_name');

        // 花费
        $result['charge'] = array_column($statisticData, 'charge');

        // 成交额
        $result['alipayInshopAmt'] = array_column($statisticData, 'alipay_inshop_amt');

        // 消耗产出比
        $result['roi'] = array_column($statisticData, 'roi');

        // 商品收藏率
        $result['commodityCollectionRate'] = array_column($statisticData, 'commodity_collection_rate');

        // 商品加购率
        $result['purchaseRate'] = array_column($statisticData, 'purchase_rate');

        // 商品收藏加购成本
        $result['purchaseCostGoodsCollection'] = array_column($statisticData, 'purchase_cost_of_goods_collection');

        return $result;
    }

    // TODO 下载
    public function exportOperation()
    {
    }
}
