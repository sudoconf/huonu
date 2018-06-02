<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Multitray;

$this->title = $reportData['multitray']['multitray_name'] . ' - 复盘';
$this->params['breadcrumbs'][] = $this->title;

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户报表
                <small><?= $reportData['multitray']['multitray_name'] ?></small>
            </h3>
        </div>
    </div>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= Url::toRoute('/site') ?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="<?= Url::toRoute('index') ?>">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">报表详情</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#"><?= $reportData['multitray']['multitray_name'] ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" id="multitrayId" name="multitrayId"
                   value="<?= $reportData['multitray']['multitray_id'] ?>">
            <input type="hidden" id="policyGroupName" name="policyGroupName"
                   value="<?= implode(',', $reportData['policyGroupName']) ?>">

            <div class="control-group" id="field-select">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle"
                            data-toggle="dropdown">统计字段选择 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        $multitrayField = json_decode($reportData['multitray']['multitray_field']);
                        foreach ($multitrayField as $k => $v) {
                            ?>
                            <li class="field">
                                <a href="javasrcipt:;"
                                   data-value="<?= $v ?>"><?= Multitray::getMultitrayField($v) ?></a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>

<!--            <div class="control-group">-->
<!--                <div class="analyse" id="analyse" style="width: 100%; height: 600px;"></div>-->
<!--                <div class="consumption" id="consumption" style="width: 100%; height: 600px;"></div>-->
<!--                <div class="inputOutput" id="inputOutput" style="width: 100%; height: 600px;"></div>-->
<!--                <div class="treasureCollectionPurchase." id="treasureCollectionPurchase"-->
<!--                style="width: 100%; height: 600px;"></div>-->
<!--                <div class="testChart4" id="testChart4" style="width: 100%; height: 600px;"></div>-->
<!--            </div>-->

            <div class="control-group">

                <div class="control-group mt80 mb30">
                    <div class="panel-heading pt15 pb15 detail-data-head">
                        <span class="s_fs_26 pull-left pdr70">数据明细</span>
                        <div id="myTab">
                            <ul class="nav nav-tabs pull-left">
                                <li>
                                    <span class="s_fc_green s_fs_26 pdl15 cp" data-toggle="tab" data-placement="top"
                                          title="按日期"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                </li>
                                <li>
                                    <span class="s_fs_26 pdl15 cp" data-toggle="tab" data-placement="top" title="按人群"><i
                                                class="fa fa-th-large"></i></span>
                                </li>
                                <li>
                                    <span class="s_fs_26 pdl15 cp" data-toggle="tab" data-placement="top"
                                          title="每日人群细分表"><i class="fa fa-windows"></i></span>
                                </li>
                                <li>
                                    <span class="s_fs_26 pdl15 cp" data-toggle="tab" data-placement="top"
                                          title="人群每日细分"><i class="fa fa-stack-exchange"></i></span>
                                </li>
                            </ul>
                        </div>

                        <a href="<?= Url::toRoute(['ajax-export', 'multitray_id' => $reportData['multitray']['multitray_id']]) ?>"
                           class="btn btn-primary pull-right report-download">报表下载 <i
                                    class="fa fa-download"></i></a>
                    </div>
                </div>

                <div class="control-group mt20 mb60">

                    <div class="panel-body analysis-data">
                        <!--按日期-->
                        <div class="tab-pane" id="on-time-analysis">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>人群名称</th>
                                    <th>展现量</th>
                                    <th>点击量</th>
                                    <th>消耗</th>
                                    <th>收藏宝贝量</th>
                                    <th>成交订单量</th>
                                    <th>成交订单金额</th>
                                    <th>添加购物车量</th>
                                    <th>千次展现成本</th>
                                    <th>点击率</th>
                                    <th>点击单价</th>
                                    <th>点击转化率</th>
                                    <th>投资回报率</th>
                                </tr>
                                </thead>
                                <tbody class="analyse-table">

                                <?php
                                foreach ($reportData['onTimeAnalysis'] as $k => $v) {
                                    ?>
                                    <tr class="odd gradeX operation-open">
                                        <th><?= date('Y-m-d', strtotime($v['log_date'])) ?></th>
                                        <td><a href="javascript:;" class="add" timeValue="<?= $v['log_date'] ?>"
                                               multitrayId="<?= $reportData['multitray']['multitray_id'] ?>"><i
                                                        class="fa fa-plus-square"></i>总计</a></td>
                                        <td><?= $v['ad_pv'] ?></td>
                                        <td><?= $v['click']; ?></td>
                                        <td><?= $v['charge']; ?></td>
                                        <td><?= $v['inshop_item_col_num']; ?></td>
                                        <td><?= $v['alipay_in_shop_num']; ?></td>
                                        <td><?= $v['alipay_inshop_amt']; ?></td>
                                        <td><?= $v['cart_num']; ?></td>
                                        <td><?= round($v['ecpm'], 2); ?></td>
                                        <td>
                                            <?php
                                            $ctr = (round($v['ctr'], 4) * 100);
                                            if ($ctr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($ctr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['ecpc'], 2); ?></td>
                                        <td>
                                            <?php
                                            $cvr = (round($v['cvr'], 4) * 100);
                                            if ($cvr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($cvr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['alipay_inshop_amt'] / $v['charge'], 2) ?></td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style=" display: none">
                                        <td></td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>

                        <!--按人群-->
                        <div class="tab-pane" id="crowd-analysis" style="display: none">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>人群名称</th>
                                    <th>展现量</th>
                                    <th>点击量</th>
                                    <th>消耗</th>
                                    <th>收藏宝贝量</th>
                                    <th>成交订单量</th>
                                    <th>成交订单金额</th>
                                    <th>添加购物车量</th>
                                    <th>千次展现成本</th>
                                    <th>点击率</th>
                                    <th>点击单价</th>
                                    <th>点击转化率</th>
                                    <th>投资回报率</th>
                                </tr>
                                </thead>
                                <tbody class="analyse-table">

                                <?php
                                foreach ($reportData['crowdAnalysis'] as $k => $v) {
                                    ?>
                                    <tr class="odd gradeX operation-open">
                                        <td><a href="javascript:;"><i
                                                        class="fa fa-plus-square"></i><?= $v['policy_group_name'] ?></a>
                                        </td>
                                        <td><?= $v['ad_pv'] ?></td>
                                        <td><?= $v['click']; ?></td>
                                        <td><?= $v['charge']; ?></td>
                                        <td><?= $v['inshop_item_col_num']; ?></td>
                                        <td><?= $v['alipay_in_shop_num']; ?></td>
                                        <td><?= $v['alipay_inshop_amt']; ?></td>
                                        <td><?= $v['cart_num']; ?></td>
                                        <td><?= round($v['ecpm'], 2); ?></td>
                                        <td>
                                            <?php
                                            $ctr = (round($v['ctr'], 4) * 100);
                                            if ($ctr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($ctr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['ecpc'], 2); ?></td>
                                        <td>
                                            <?php
                                            $cvr = (round($v['cvr'], 4) * 100);
                                            if ($cvr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($cvr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['alipay_inshop_amt'] / $v['charge'], 2) ?></td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style=" display: none">
                                        <td></td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>

                        <!--每日人群细分表-->
                        <div class="tab-pane" id="sters" style="display: none">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>人群名称</th>
                                    <th>展现量</th>
                                    <th>点击量</th>
                                    <th>消耗</th>
                                    <th>收藏宝贝量</th>
                                    <th>成交订单量</th>
                                    <th>成交订单金额</th>
                                    <th>添加购物车量</th>
                                    <th>千次展现成本</th>
                                    <th>点击率</th>
                                    <th>点击单价</th>
                                    <th>点击转化率</th>
                                    <th>投资回报率</th>
                                </tr>
                                </thead>
                                <tbody class="analyse-table">

                                <?php
                                foreach ($reportData['crowdAnalysis'] as $k => $v) {
                                    ?>
                                    <tr class="odd gradeX operation-open">
                                        <td><a href="javascript:;"><i
                                                        class="fa fa-plus-square"></i><?= $v['policy_group_name'] ?></a>
                                        </td>
                                        <td><?= $v['ad_pv'] ?></td>
                                        <td><?= $v['click']; ?></td>
                                        <td><?= $v['charge']; ?></td>
                                        <td><?= $v['inshop_item_col_num']; ?></td>
                                        <td><?= $v['alipay_in_shop_num']; ?></td>
                                        <td><?= $v['alipay_inshop_amt']; ?></td>
                                        <td><?= $v['cart_num']; ?></td>
                                        <td><?= round($v['ecpm'], 2); ?></td>
                                        <td>
                                            <?php
                                            $ctr = (round($v['ctr'], 4) * 100);
                                            if ($ctr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($ctr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['ecpc'], 2); ?></td>
                                        <td>
                                            <?php
                                            $cvr = (round($v['cvr'], 4) * 100);
                                            if ($cvr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($cvr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['alipay_inshop_amt'] / $v['charge'], 2) ?></td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style=" display: none">
                                        <td></td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>

                        <!--人群每日细分-->
                        <div class="tab-pane" id="sters" style="display: none">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>定向名称</th>
                                    <th>展现量</th>
                                    <th>点击量</th>
                                    <th>消耗</th>
                                    <th>收藏宝贝量</th>
                                    <th>成交订单量</th>
                                    <th>成交订单金额</th>
                                    <th>添加购物车量</th>
                                    <th>千次展现成本</th>
                                    <th>点击率</th>
                                    <th>点击单价</th>
                                    <th>点击转化率</th>
                                    <th>投资回报率</th>
                                </tr>
                                </thead>
                                <tbody class="analyse-table">

                                <?php
                                foreach ($reportData['directedCrowdAnalyzedDaily'] as $k => $v) {
                                    ?>
                                    <tr class="odd gradeX operation-open">
                                        <td><?= date('Y-m-d', strtotime($v['log_date'])) ?></td>
                                        <td><a href="javascript:;"><i
                                                        class="fa fa-plus-square"></i><?= $v['target_name'] ?></a>
                                        </td>
                                        <td><?= $v['ad_pv'] ?></td>
                                        <td><?= $v['click']; ?></td>
                                        <td><?= $v['charge']; ?></td>
                                        <td><?= $v['inshop_item_col_num']; ?></td>
                                        <td><?= $v['alipay_in_shop_num']; ?></td>
                                        <td><?= $v['alipay_inshop_amt']; ?></td>
                                        <td><?= $v['cart_num']; ?></td>
                                        <td><?= round($v['ecpm'], 2); ?></td>
                                        <td>
                                            <?php
                                            $ctr = (round($v['ctr'], 4) * 100);
                                            if ($ctr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($ctr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?= round($v['ecpc'], 2); ?></td>
                                        <td>
                                            <?php
                                            $cvr = (round($v['cvr'], 4) * 100);
                                            if ($cvr > 100) {
                                                echo '100%';
                                            } else {
                                                echo(($cvr * 1) . '%');
                                            }; ?>
                                        </td>
                                        <td><?php //echo round($v['alipay_inshop_amt'] / $v['charge'], 2) ?></td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style=" display: none">
                                        <td></td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                        <td>111111</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<?= Html::jsFile('@web/vendor/echarts-2.2.7/echarts-all.js') ?>
<?= Html::jsFile('@web/js/report/timelineOption.js') ?>
<?= Html::jsFile('@web/js/report/show.js') ?>
