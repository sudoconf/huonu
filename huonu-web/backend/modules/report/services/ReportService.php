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
use backend\models\TaobaoZsAdvertiserTargetDaySumList;
use backend\modules\plan\services\TargetService;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;
use yii\db\Exception;

// TODO 报表 service
class ReportService extends BaseService
{
    /**
     * 添加首页展示数据
     * @return array
     */
    public function create()
    {
        $whetherOrNotComplete = Yii::$app->session->get('whetherOrNotComplete');
        if ($whetherOrNotComplete) {
            Yii::$app->session->remove('setParameter');
            Yii::$app->session->remove('strategyGroup');
            Yii::$app->session->remove('whetherOrNotComplete');
        }

        $setParameter = Yii::$app->session->get('setParameter');
        if (empty($setParameter)) {
            $setParameter['multitray_name'] = '';
            $setParameter['taobao_name'] = '';
            $setParameter['taobao_id'] = '';
            $setParameter['multitray_start_time'] = '';
            $setParameter['multitray_end_time'] = '';
            $setParameter['multitray_effect_model'] = 'click';
            $setParameter['multitray_cycle'] = 3;
            $setParameter['multitray_field'] = [];
        } else {
            $setParameter['multitray_field'] = explode(',', $setParameter['multitray_field']);
        }

        $strategyGroup = Yii::$app->session->get('strategyGroup');
        if (empty($strategyGroup)) {
            $strategyGroup = [];
        }

        $result = [
            'setParameter' => $setParameter,
            'strategyGroup' => $strategyGroup,
        ];

        return $result;
    }

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

        if (empty($strategyGroup)) {
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
            $analyseArray['multitray_field'] = json_encode(explode(',', $setParameter['multitray_field']));
            $analyseArray['multitray_effect_model'] = $setParameter['multitray_effect_model'];
            $analyseArray['multitray_cycle'] = $setParameter['multitray_cycle'];

            $multitray = new Multitray();
            $multitray->setAttributes($analyseArray);
            if (!$multitray->save()) {
                throw new Exception('复盘添加失败：' . current($multitray->getFirstErrors()));
            }
            $multitrayId = Yii::$app->db->getLastInsertID();

            // 添加复盘日志
            $analyseRemarks = sprintf(
                '%s添加了复盘：%s',
                Yii::$app->user->identity->username,
                $setParameter['multitray_name']
            );
            SystemLog::create(SystemLog::TYPE_CREATE, $multitrayId, $analyseRemarks, $setParameter);

            // 添加策略组 策略组最多只能有9个 所以数据库要分批存储
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
                    SystemLog::create(
                        SystemLog::TYPE_CREATE,
                        $multitrayPolicyGroupId,
                        $policyGroupRemarks,
                        $strategicGroup
                    );

                }
            }

            // 添加完数据之后 生成统计数据
            $field['multitrayName'] = $setParameter['multitray_name'];
            $field['startTime'] = $analyseArray['multitray_start_time'];
            $field['endTime'] = $analyseArray['multitray_end_time'];
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

    /**
     * 统计数据生成
     * @param $field
     * @throws Exception
     * @throws \Exception
     */
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

        $tt = [];

        $zxht_multitray_policy_group_list = MultitrayPolicyGroup::find()
            ->where(['multitray_id' => $multitrayId])
            ->asArray()->all();
        foreach ($zxht_multitray_policy_group_list as $k => $v) {

            $taobao_zs_advertiser_target_day_sum_list = TaobaoZsAdvertiserTargetDaySumList::find()
                ->select(
                    [
                        'target_id',
                        'sum(charge) as charge',
                        'sum(ad_pv) as ad_pv',
                        'sum(click) as click',
                        'sum(uv) as uv',
                        'sum(deep_inshop_uv) as deep_inshop_uv',
                        'sum(avg_access_time) as avg_access_time',
                        'sum(avg_access_page_num) as avg_access_page_num',
                        'sum(inshop_item_col_num) as inshop_item_col_num',
                        'sum(dir_shop_col_num) as dir_shop_col_num',
                        'sum(cart_num) as cart_num',
                        'sum(cart_num)*100/sum(uv) as purchase_rate_of_goods',
                        'sum(inshop_item_col_num)*100/sum(uv) as commodity_collection_rate',
                        'sum(charge)/sum(inshop_item_col_num) as commodity_collection_cost',
                        'sum(charge)/sum(cart_num) as purchase_cost_of_goods',
                        'sum(charge)/(sum(inshop_item_col_num)+sum(cart_num)) as purchase_cost_of_goods_collection',
                        'sum(gmv_inshop_num) as gmv_inshop_num',
                        'sum(gmv_inshop_amt) as gmv_inshop_amt',
                        'sum(alipay_in_shop_num) as alipay_in_shop_num',
                        'sum(alipay_inshop_amt) as alipay_inshop_amt',
                        'sum(charge)/sum(alipay_in_shop_num) as average_cost_of_order',
                        'sum(alipay_inshop_amt)/sum(alipay_in_shop_num) as order_average_amount',
                        'sum(alipay_inshop_amt)/sum(charge) as roi',
                        'sum(charge)*1000/sum(ad_pv) as ecpm',
                        'sum(click)/sum(ad_pv) as ctr',
                        'sum(charge)/sum(click) as ecpc',
                        'sum(alipay_in_shop_num)/sum(click) as cvr',
                        'log_date',
                    ]
                )
                ->where(['>=', 'log_date', $logStartDate])
                ->andWhere(['<=', 'log_date', $logEndDate])
                ->andWhere(
                    [
                        'taobao_user_id' => $taoBaoId,
                        'effect' => $effect,
                        'effect_type' => $effectType,
                        'target_id' => $v['target_id'],
                    ]
                )
                ->groupBy(['log_date'])
                ->asArray()->all();

            if (!empty($taobao_zs_advertiser_target_day_sum_list)) {

                foreach ($taobao_zs_advertiser_target_day_sum_list as $tk => $tv) {

                    $tt[$v['policy_group_name']][] = $tv;

                }

            }

        }
        // 总花费
        $charge = [];

        // 总成交额
        $alipayInshopAmt = [];

        // 总消耗产出比
        $roi = [];

        // 总商品收藏率
        $commodityCollectionRate = [];

        // 总商品加购率
        $purchaseRate = [];

        // 总商品收藏加购成本
        $purchaseCostGoodsCollection = [];


        $lineInfoArray = [];
        foreach ($tt as $sk => $sv) {

            foreach ($sv as $wk => $wv) {

                $logDateKey = date('Y-m-d', strtotime($wv['log_date']));

                if (isset($lineInfoArray[$sk][$logDateKey])) {
                    $lineInfoArray[$sk][$logDateKey]['charge'] += $wv['charge'];
                    $lineInfoArray[$sk][$logDateKey]['ad_pv'] += $wv['ad_pv'];
                    $lineInfoArray[$sk][$logDateKey]['click'] += $wv['click'];
                    $lineInfoArray[$sk][$logDateKey]['uv'] += $wv['uv'];
                    $lineInfoArray[$sk][$logDateKey]['deep_inshop_uv'] += $wv['deep_inshop_uv'];
                    $lineInfoArray[$sk][$logDateKey]['avg_access_time'] += $wv['avg_access_time'];
                    $lineInfoArray[$sk][$logDateKey]['avg_access_page_num'] += $wv['avg_access_page_num'];
                    $lineInfoArray[$sk][$logDateKey]['inshop_item_col_num'] += $wv['inshop_item_col_num'];
                    $lineInfoArray[$sk][$logDateKey]['dir_shop_col_num'] += $wv['dir_shop_col_num'];
                    $lineInfoArray[$sk][$logDateKey]['cart_num'] += $wv['cart_num'];
                    $lineInfoArray[$sk][$logDateKey]['purchase_rate_of_goods'] += $wv['purchase_rate_of_goods'];
                    $lineInfoArray[$sk][$logDateKey]['commodity_collection_rate'] += $wv['commodity_collection_rate'];
                    $lineInfoArray[$sk][$logDateKey]['commodity_collection_cost'] += $wv['commodity_collection_cost'];
                    $lineInfoArray[$sk][$logDateKey]['purchase_cost_of_goods'] += $wv['purchase_cost_of_goods'];
                    $lineInfoArray[$sk][$logDateKey]['purchase_cost_of_goods_collection'] += $wv['purchase_cost_of_goods_collection'];
                    $lineInfoArray[$sk][$logDateKey]['gmv_inshop_num'] += $wv['gmv_inshop_num'];
                    $lineInfoArray[$sk][$logDateKey]['gmv_inshop_amt'] += $wv['gmv_inshop_amt'];
                    $lineInfoArray[$sk][$logDateKey]['alipay_in_shop_num'] += $wv['alipay_in_shop_num'];
                    $lineInfoArray[$sk][$logDateKey]['alipay_inshop_amt'] += $wv['alipay_inshop_amt'];
                    $lineInfoArray[$sk][$logDateKey]['average_cost_of_order'] += $wv['average_cost_of_order'];
                    $lineInfoArray[$sk][$logDateKey]['order_average_amount'] += $wv['order_average_amount'];
                    $lineInfoArray[$sk][$logDateKey]['roi'] += $wv['roi'];
                    $lineInfoArray[$sk][$logDateKey]['ecpm'] += $wv['ecpm'];
                    $lineInfoArray[$sk][$logDateKey]['ctr'] += $wv['ctr'];
                    $lineInfoArray[$sk][$logDateKey]['ecpc'] += $wv['ecpc'];
                    $lineInfoArray[$sk][$logDateKey]['cvr'] += $wv['cvr'];

                    $charge[$sk] += $wv['charge'];
                    $alipayInshopAmt[$sk] += $wv['alipay_inshop_amt'];
                    $roi[$sk] += $wv['roi'];
                    $commodityCollectionRate[$sk] += $wv['commodity_collection_rate'];
                    $purchaseRate[$sk] += $wv['purchase_rate_of_goods'];
                    $purchaseCostGoodsCollection[$sk] += $wv['purchase_cost_of_goods_collection'];

                } else {
                    $lineInfoArray[$sk][$logDateKey] = $wv;

                    $charge[$sk] = $wv['charge'];
                    $alipayInshopAmt[$sk] = $wv['alipay_inshop_amt'];
                    $roi[$sk] = $wv['roi'];
                    $commodityCollectionRate[$sk] = $wv['commodity_collection_rate'];
                    $purchaseRate[$sk] = $wv['purchase_rate_of_goods'];
                    $purchaseCostGoodsCollection[$sk] = $wv['purchase_cost_of_goods_collection'];
                }

                foreach ($timeArray as $tk => $tv) {

                    if (!array_key_exists($tv, $lineInfoArray[$sk])) {
                        $lineInfoArray[$sk][$tv] = [
                            'charge' => 0,
                            'ad_pv' => 0,
                            'click' => 0,
                            'uv' => 0,
                            'deep_inshop_uv' => 0,
                            'avg_access_time' => 0,
                            'avg_access_page_num' => 0,
                            'inshop_item_col_num' => 0,
                            'dir_shop_col_num' => 0,
                            'cart_num' => 0,
                            'purchase_rate_of_goods' => 0,
                            'commodity_collection_rate' => 0,
                            'commodity_collection_cost' => 0,
                            'purchase_cost_of_goods' => 0,
                            'purchase_cost_of_goods_collection' => 0,
                            'gmv_inshop_num' => 0,
                            'gmv_inshop_amt' => 0,
                            'alipay_in_shop_num' => 0,
                            'alipay_inshop_amt' => 0,
                            'average_cost_of_order' => 0,
                            'order_average_amount' => 0,
                            'roi' => 0,
                            'ecpm' => 0,
                            'ctr' => 0,
                            'ecpc' => 0,
                            'cvr' => 0,
                        ];
                    }
                }

            }

        }

        $newLineInfoArray = [];
        foreach ($lineInfoArray as $ak => $av) {

            ksort($av, SORT_ASC);

            foreach ($av as $ok => $ov) {

                $lineInfo = '["' . round($ov['charge'], 2)
                    . '","' . round($ov['ad_pv'], 2)
                    . '","' . round($ov['click'], 2)
                    . '","' . round($ov['uv'], 2)
                    . '","' . round($ov['deep_inshop_uv'], 2)
                    . '","' . round($ov['avg_access_time'], 2)
                    . '","' . round($ov['avg_access_page_num'], 2)
                    . '","' . round($ov['inshop_item_col_num'], 2)
                    . '","' . round($ov['dir_shop_col_num'], 2)
                    . '","' . round($ov['cart_num'], 2)
                    . '","' . round($ov['purchase_rate_of_goods'], 2)
                    . '","' . round($ov['commodity_collection_rate'], 2)
                    . '","' . round($ov['commodity_collection_cost'], 2)
                    . '","' . round($ov['purchase_cost_of_goods'], 2)
                    . '","' . round($ov['purchase_cost_of_goods_collection'], 2)
                    . '","' . round($ov['gmv_inshop_num'], 2)
                    . '","' . round($ov['gmv_inshop_amt'], 2)
                    . '","' . round($ov['alipay_in_shop_num'], 2)
                    . '","' . round($ov['alipay_inshop_amt'], 2)
                    . '","' . round($ov['average_cost_of_order'], 2)
                    . '","' . round($ov['order_average_amount'], 2)
                    . '","' . round($ov['roi'], 2)
                    . '","' . round($ov['ecpm'], 2)
                    . '","' . round($ov['ctr'], 2)
                    . '","' . round($ov['ecpc'], 2)
                    . '","' . round($ov['cvr'], 2) . '"]';

                $newLineInfoArray[$ak][$ok] = $lineInfo;
            }

        }

        $transaction = Yii::$app->db->beginTransaction();
        try {

            $multitrayStatistics = new MultitrayStatistics();

            $multitrayStatisticsArray['multitray_id'] = $multitrayId;
            $multitrayStatisticsArray['multitray_statistics_content_json'] = json_encode($newLineInfoArray, JSON_UNESCAPED_UNICODE);
            $multitrayStatisticsArray['charge'] = json_encode($charge, JSON_UNESCAPED_UNICODE);
            $multitrayStatisticsArray['alipay_inshop_amt'] = json_encode($alipayInshopAmt, JSON_UNESCAPED_UNICODE);
            $multitrayStatisticsArray['roi'] = json_encode($roi, JSON_UNESCAPED_UNICODE);
            $multitrayStatisticsArray['commodity_collection_rate'] = json_encode($commodityCollectionRate, JSON_UNESCAPED_UNICODE);
            $multitrayStatisticsArray['purchase_rate'] = json_encode($purchaseRate, JSON_UNESCAPED_UNICODE);
            $multitrayStatisticsArray['purchase_cost_of_goods_collection'] = json_encode($purchaseCostGoodsCollection, JSON_UNESCAPED_UNICODE);

            $multitrayStatistics->setAttributes($multitrayStatisticsArray);
            if (!$multitrayStatistics->save()) {
                throw new Exception('统计数据添加失败：' . current($multitrayStatistics->getFirstErrors()));
            }

            $multitrayStatisticsId = Yii::$app->db->getLastInsertID();

            // 添加统计数据日志
            $multitrayStatisticRemark = sprintf('%s添加了计划统计数据：%s', Yii::$app->user->identity->username, $multitrayName);
            SystemLog::create(
                SystemLog::TYPE_CREATE,
                $multitrayStatisticsId,
                $multitrayStatisticRemark,
                $multitrayStatisticsArray
            );

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * TODO 下载
     */
    public function exportOperation()
    {
        $multitrayId = Yii::$app->request->get('multitray_id');

        $multitray = Multitray::findOne($multitrayId)->toArray();
        if (empty($multitray)) {
            CtHelper::response(false, '参数错误');
        }

        $multitrayPolicyGroup = MultitrayPolicyGroup::find()->select('policy_group_name,target_id')->where(
            ['multitray_id' => $multitrayId]
        )->asArray()->all();

        $targetIdArray = [];
        foreach ($multitrayPolicyGroup as $v) {
            $targetIdArray[] = $v['target_id'];
        }

        $logStartDate = date('Y-m-d', $multitray['multitray_start_time']);
        $logEndDate = date('Y-m-d', $multitray['multitray_end_time']);

        $taobaoZsAdvertiserTargetDaySumList = TaobaoZsAdvertiserTargetDaySumList::find()
            ->where(['in', 'target_id', $targetIdArray])
            ->andWhere(['>=', 'log_date', $logStartDate])
            ->andWhere(['<=', 'log_date', $logEndDate])
            ->andWhere(
                [
                    'effect' => $multitray['multitray_cycle'],
                    'effect_type' => $multitray['multitray_effect_model'],
                ]
            )
            ->asArray()->all();

        $filePath = Yii::$app->basePath . '\web\excel-template\haixin-test.xlsx';
        //读取文件
        if (!file_exists($filePath)) {
            CtHelper::response(false, '模板不存在');
        }

        $objPHPExcel = \PHPExcel_IOFactory::load($filePath);
        $sheet = $objPHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数

        $objPHPExcel->setActiveSheetIndex(0);

        foreach ($taobaoZsAdvertiserTargetDaySumList as $k => $v) {

            $k = $k + 3;
            $objPHPExcel->getactivesheet()->setcellvalue('A' . $k, $v['target_name']);
            $objPHPExcel->getactivesheet()->setcellvalue('B' . $k, date('Y-m-d', strtotime($v['log_date'])));
            $objPHPExcel->getactivesheet()->setcellvalue('C' . $k, '');
            $objPHPExcel->getactivesheet()->setcellvalue('D' . $k, $v['ad_pv']);
            $objPHPExcel->getactivesheet()->setcellvalue('E' . $k, $v['click']);
            $objPHPExcel->getactivesheet()->setcellvalue('F' . $k, $v['charge']);
            $objPHPExcel->getactivesheet()->setcellvalue('G' . $k, $v['inshop_item_col_num']);
            $objPHPExcel->getactivesheet()->setcellvalue('H' . $k, $v['cart_num']);
            $objPHPExcel->getactivesheet()->setcellvalue('I' . $k, $v['alipay_in_shop_num']);
            $objPHPExcel->getactivesheet()->setcellvalue('J' . $k, $v['alipay_inshop_amt']);

        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");

        $filename = date('Y-m-d-His') . '-数据明细' . '.xlsx';
        $filename = iconv('UTF-8', 'GBK//IGNORE', $filename);
        ob_end_clean();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="' . $filename . '"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');

    }

    /**
     * 统计展现
     * @return mixed
     */
    public function getShowOperation()
    {
        $multitrayId = Yii::$app->request->get('multitrayId');

        $multitray = Multitray::findOne($multitrayId);
        if (empty($multitray)) {
            CtHelper::response('false', '');
        }

        $multitrayPolicyGroup = MultitrayPolicyGroup::find()->select('policy_group_name,target_id')->where(
            ['multitray_id' => $multitrayId]
        )->asArray()->all();

        $logStartDate = date('Y-m-d', $multitray->multitray_start_time);
        $logEndDate = date('Y-m-d', $multitray->multitray_end_time);

        $targetIdArray = [];
        $policyGroup = [];
        foreach ($multitrayPolicyGroup as $v) {
            $targetIdArray[] = $v['target_id'];
            $policyGroup[$v['policy_group_name']][] = $v['target_id'];
        }

        // TODO 按时日期分析
        $onTimeAnalysis = TaobaoZsAdvertiserTargetDaySumList::find()
            ->select(
                [
                    'sum(charge) as charge',
                    'sum(ad_pv) as ad_pv',
                    'sum(click) as click',
                    'sum(inshop_item_col_num) as inshop_item_col_num',
                    'sum(cart_num) as cart_num',
                    'sum(alipay_in_shop_num) as alipay_in_shop_num',
                    'sum(alipay_inshop_amt) as alipay_inshop_amt',
                    'sum(alipay_inshop_amt)/sum(charge) as roi',
                    'sum(charge)*1000/sum(ad_pv) as ecpm',
                    'sum(click)/sum(ad_pv) as ctr',
                    'sum(charge)/sum(click) as ecpc',
                    'sum(alipay_in_shop_num)/sum(click) as cvr',
                    'log_date',
                ]
            )
            ->where(['in', 'target_id', $targetIdArray])
            ->andWhere(['>=', 'log_date', $logStartDate])
            ->andWhere(['<=', 'log_date', $logEndDate])
            ->andWhere(
                [
                    'effect' => $multitray->multitray_cycle,
                    'effect_type' => $multitray->multitray_effect_model,
                ]
            )
            ->groupBy(['log_date'])
            ->asArray()->all();

        // TODO 按人群分析
        $crowdAnalysis = TaobaoZsAdvertiserTargetDaySumList::find()
            ->select(
                [
                    MultitrayPolicyGroup::tableName() . '.policy_group_name',
                    'sum(charge) as charge',
                    'sum(ad_pv) as ad_pv',
                    'sum(click) as click',
                    'sum(inshop_item_col_num) as inshop_item_col_num',
                    'sum(cart_num) as cart_num',
                    'sum(alipay_in_shop_num) as alipay_in_shop_num',
                    'sum(alipay_inshop_amt) as alipay_inshop_amt',
                    'sum(alipay_inshop_amt)/sum(charge) as roi',
                    'sum(charge)*1000/sum(ad_pv) as ecpm',
                    'sum(click)/sum(ad_pv) as ctr',
                    'sum(charge)/sum(click) as ecpc',
                    'sum(alipay_in_shop_num)/sum(click) as cvr',
                ]
            )
            ->join('LEFT JOIN', MultitrayPolicyGroup::tableName(), MultitrayPolicyGroup::tableName() . '.target_id = ' . TaobaoZsAdvertiserTargetDaySumList::tableName() . '.target_id')
            ->where(['in', MultitrayPolicyGroup::tableName() . '.target_id', $targetIdArray])
            ->andWhere(['>=', 'log_date', $logStartDate])
            ->andWhere(['<=', 'log_date', $logEndDate])
            ->andWhere(
                [
                    'effect' => $multitray->multitray_cycle,
                    'effect_type' => $multitray->multitray_effect_model,
                ]
            )
            ->groupBy([MultitrayPolicyGroup::tableName() . '.policy_group_name'])
            ->asArray()->all();

        // TODO 策略组按日分析

        // TODO 定向人群按日分析
        $directedCrowdAnalyzedDaily = TaobaoZsAdvertiserTargetDaySumList::find()
            ->select(
                [
                    'log_date',
                    'target_name',
                    'sum(charge) as charge',
                    'sum(ad_pv) as ad_pv',
                    'sum(click) as click',
                    'sum(inshop_item_col_num) as inshop_item_col_num',
                    'sum(cart_num) as cart_num',
                    'sum(alipay_inshop_amt)/sum(charge) as roi',
                    'sum(charge)*1000/sum(ad_pv) as ecpm',
                    'sum(click)/sum(ad_pv) as ctr',
                    'sum(charge)/sum(click) as ecpc',
                    'sum(alipay_in_shop_num)/sum(click) as cvr',
                    'sum(alipay_in_shop_num) as alipay_in_shop_num',
                    'sum(alipay_inshop_amt) as alipay_inshop_amt',
                ]
            )
            ->where(['in', 'target_id', $targetIdArray])
            ->andWhere(['>=', 'log_date', $logStartDate])
            ->andWhere(['<=', 'log_date', $logEndDate])
            ->andWhere(
                [
                    'effect' => $multitray->multitray_cycle,
                    'effect_type' => $multitray->multitray_effect_model,
                ]
            )
            ->groupBy('target_name')
            ->asArray()->all();

        $result['multitray'] = $multitray->toArray();

        $result['policyGroupName'] = array_unique(array_column($multitrayPolicyGroup, 'policy_group_name'));

        $result['onTimeAnalysis'] = $onTimeAnalysis;

        $result['crowdAnalysis'] = $crowdAnalysis;

        $result['directedCrowdAnalyzedDaily'] = $directedCrowdAnalyzedDaily;

        return $result;
    }
}
