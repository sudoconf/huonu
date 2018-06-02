<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\components\widget\GoLinkPager;
use backend\models\TaobaoZsCampList;

$this->title = '计划列表';
$this->params['breadcrumbs'][] = $this->title;

?>
<?= Html::cssFile('@web/css/test.css') ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small><?= $this->title ?></small>
            </h3>
        </div>
    </div>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">客户计划</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="<?= Url::toRoute('default/index') ?>"><?= $this->title ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tabbable">
                <ul class="nav nav-pills">
                    <li class="active"><a href="<?= Url::toRoute('default/index') ?>" data-placement="top"
                                          data-toggle="tab" title="计划">计划</a></li>
                    <li class=""><a href="<?= Url::toRoute('unit/index') ?>" title="单元">单元</a></li>
                    <li class=""><a href="<?= Url::toRoute('target/index') ?>" title="定向">定向</a></li>
                    <li class=""><a href="<?= Url::toRoute('resource/index') ?>" title="资源位">资源位</a></li>
                    <li class=""><a href="<?= Url::toRoute('creative/index') ?>" title="创意">创意</a></li>
                </ul>
                <div class="tab-content">
                    <!-- 计划 -->
                    <div class="tab-pane fade in active">

                        <div class="control-group pt15 pb15">
                            <div class="fl mr10">
                                <a href="<?= Url::toRoute('create') ?>" id="create-plan"
                                   class="btn btn-primary create-plan">
                                    <i class="fa fa-plus"></i>
                                    新建推广计划
                                </a>
                            </div>

                            <div class="form-inline">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'camp-form',
                                    'method' => 'get',
                                ]); ?>
                                <select name="customerId" class="form-control">
                                    <option value="" <?= ($get['customerId'] == '') ? 'selected' : '' ?>>请选择客户
                                    </option>
                                    <?php foreach ($customers as $k => $v) { ?>
                                        <option value="<?= $v['taobao_user_id'] ?>" <?= ($get['customerId'] == $v['taobao_user_id']) ? 'selected' : '' ?>>
                                            <?= $v['taobao_user_nick'] ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <select name="onlineStatus" class="form-control">
                                    <option value="99" <?= ($get['onlineStatus'] == 99) ? 'selected' : '' ?>>全部状态
                                    </option>
                                    <option value="1" <?= ($get['onlineStatus'] == 1) ? 'selected' : '' ?>>正在投放</option>
                                    <option value="0" <?= ($get['onlineStatus'] == 0) ? 'selected' : '' ?>>暂停投放</option>
                                    <option value="9" <?= ($get['onlineStatus'] == 9) ? 'selected' : '' ?>>结束投放</option>
                                </select>

                                <select name="marketingdemand" class="form-control">
                                    <option value="" <?= ($get['marketingdemand'] == 0) ? 'selected' : '' ?>>全部计划类型
                                    </option>
                                    <option value="-1" <?= ($get['marketingdemand'] == -1) ? 'selected' : '' ?>>自定义计划
                                    </option>
                                    <option value="1" <?= ($get['marketingdemand'] == 1) ? 'selected' : '' ?>>日常托管计划
                                    </option>
                                    <option value="2" <?= ($get['marketingdemand'] == 2) ? 'selected' : '' ?>>日常推荐计划
                                    </option>
                                    <option value="3" <?= ($get['marketingdemand'] == 3) ? 'selected' : '' ?>>拉新托管计划
                                    </option>
                                    <option value="4" <?= ($get['marketingdemand'] == 4) ? 'selected' : '' ?>>拉新推荐计划
                                    </option>
                                </select>

                                <select name="type" class="form-control">
                                    <option value="" <?= ($get['type'] == 0) ? 'selected' : '' ?>>所有付费方式</option>
                                    <option value="2" <?= ($get['type'] == 2) ? 'selected' : '' ?>>按展现付费(CPM)</option>
                                    <option value="8" <?= ($get['type'] == 8) ? 'selected' : '' ?>>按点击付费(CPC)</option>
                                </select>

                                <input type="text" name="planName" class="form-control" value="<?= $get['planName'] ?>"
                                       placeholder="请输入计划名称">
                                <?php ActiveForm::end(); ?>
                            </div>

                        </div>

                        <div class="control-group table-responsive">

                            <table class="table table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="计划当前的投放状态。">状态</span></th>
                                    <th>计划信息</th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="计划设定的开始时间至结束时间。">投放时间</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="计划每天的消耗上限，计划上的消耗不会超过此金额，日预算修改之后将会立即生效。单位元。">日预算</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="所有创意在钻石展位资源上被展现后所产生的费用。单位元。">消耗</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="所有创意在钻石展位资源上被买家看到的次数。注意，虚假展现会被反作弊体系过滤，该数据为反作弊系统过滤后的数据。">展现量</span>
                                    </th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="所有创意在钻石展位资源上被买家点击的次数。">点击量</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="千次展现成本=消耗/（展现/1000），表示创意在每获得1000次展现后所产生的平均费用。">千次展现成本</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="点击率=点击/展现，可直观表示创意对买家的吸引程度，点击率越高说明创意对买家的吸引程度越大。">点击率</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="点击单价=消耗/点击，表示创意在每获得1次点击后所产生的平均费用。单位元。">点击单价</span></th>
                                </tr>
                                </thead>
                                <tbody class="plan-table">

                                <?php foreach ($camps as $k => $v) { ?>
                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div class="w60">
                                                <div class="ux-status-handle">
                                                    <i class="glyphicon <?= TaobaoZsCampList::$onlineStatusIcon[$v['online_status']] ?> s_fs_20"
                                                       title="<?= TaobaoZsCampList::$onlineStatusTitle[$v['online_status']] ?>"></i>
                                                    <i class="fa fa-caret-down s_fc_9 ux-status-arrow"></i>
                                                    <div class="ux-status-info dpn">
                                                        <ul class="ux-status-operations">
                                                            <li data-url="<?= Url::toRoute(['ajax-change-plan-state', 'planId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>"
                                                                title="正在投放"
                                                                data-value-status="1">
                                                                <i class="glyphicon glyphicon-play-circle s_fs_20 s_fc_green"></i>
                                                                <a href="javascript:;">正在投放</a>
                                                                <?= ($v['online_status'] == 1) ? '<i class="glyphicon glyphicon-ok ux-operation-cur-icon"></i>' : '' ?>
                                                            </li>
                                                            <li data-url="<?= Url::toRoute(['ajax-change-plan-state', 'planId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>"
                                                                title="暂停投放"
                                                                data-value-status="0">
                                                                <i class="glyphicon glyphicon-pause s_fs_20 s_fc_red"></i>
                                                                <a href="javascript:;">暂停投放</a>
                                                                <?= ($v['online_status'] == 0) ? '<i class="glyphicon glyphicon-ok ux-operation-cur-icon"></i>' : '' ?>
                                                            </li>
                                                            <li data-url="<?= Url::toRoute(['ajax-change-plan-state', 'planId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>"
                                                                title="结束投放"
                                                                data-value-status="9">
                                                                <i class="glyphicon glyphicon-minus-sign s_fs_20 s_fc_9"></i>
                                                                <a href="javascript:;">结束投放</a>
                                                                <?= ($v['online_status'] == 9) ? '<i class="glyphicon glyphicon-ok ux-operation-cur-icon"></i>' : '' ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $v['sort'] ? '<i class="fa fa-chevron-circle-up displacement-2 s_fs_18 s_fc_ct cursor-help" data-placement="bottom" data-toggle="tab" title="置顶计划"></i>' : '' ?>
                                            <?= $v['name'] ?>
                                        </td>
                                        <td>
                                            <div class="nowrap mb10">
                                                起：<?= date('Y-m-d', strtotime($v['start_time'])) ?>
                                            </div>
                                            <div class="nowrap">
                                                止：<?= date('Y-m-d', strtotime($v['end_time'])) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="zs_iconfont s_fc_9 s_fs_18 cursor-help" data-placement="bottom"
                                               data-toggle="tab" title="按图片单次点击出价，注：展现不另外计费。"></i>
                                            <?= $v['day_budget'] / 100 ?>
                                        </td>
                                        <td><?= (!$v['charge']) ? '--' : $v['charge'] ?></td>
                                        <td><?= (!$v['ad_pv']) ? '--' : $v['ad_pv'] ?></td>
                                        <td><?= (!$v['click']) ? '--' : $v['click'] ?></td>
                                        <td><?= (!$v['ad_pv']) ? '--' : round($v['charge'] / ($v['ad_pv'] / 1000), 2) ?></td>
                                        <td><?= (!$v['click'] || !$v['ad_pv']) ? '--' : (round(($v['click'] / $v['ad_pv']), 2) * 100) . '%' ?></td>
                                        <td><?= (!$v['charge'] || !$v['click']) ? '--' : round(($v['charge'] / $v['click']), 2) ?></td>
                                    </tr>
                                    <tr class="odd gradeX dpn">
                                        <td colspan="11" class="operation-td">
                                            <!--<a href="javascript:;" class="btn btn-primary mr10">设置</a>-->
                                            <a href="<?= Url::toRoute(['unit/index', 'campaignId' => $v['id']]) ?>"
                                               class="btn btn-primary mr10">详情</a>
                                            <!--<a href="javascript:;" class="btn btn-primary mr10">编辑</a>-->
                                            <a href="javascript:;" class="btn btn-primary mr10 ajax-remove-plan"
                                               data-url="<?= Url::toRoute(['ajax-remove-plan', 'planId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>"
                                               data-title="<?= $v['name'] ?>">移除</a>
                                            <a href="javascript:;" class="btn btn-primary mr10 ajax-plan-sort"
                                               data-url="<?= Url::toRoute(['ajax-plan-sort', 'planId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>"><?= ($v['sort']) ? '取消置顶' : '置顶' ?></a>
                                            <a href="javascript:;" class="btn btn-primary mr10 ajax-plan-sync"
                                               data-url="<?= Url::toRoute(['ajax-plan-sync', 'planId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>">同步</a>
                                            <!--<a href="javascript:;" class="btn btn-primary mr10">报表</a>-->
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                            <?= GoLinkPager::widget([
                                'pagination' => $pages,
                                'maxButtonCount' => 5,
                                'firstPageLabel' => '首页',
                                'lastPageLabel' => '末页',
                                'go' => true,
                            ]); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- 引入jQuery的js文件 -->
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

    $(function () {

        $("select[name='customerId']").change(function () {
            $('#camp-form').submit();
        });

        $("select[name='onlineStatus']").change(function () {
            $('#camp-form').submit();
        });

        $("select[name='marketingdemand']").change(function () {
            $('#camp-form').submit();
        });

        $("select[name='type']").change(function () {
            $('#camp-form').submit();
        });

        $("input[name='planName']").blur(function () {
            $('#camp-form').submit();
        });

        $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚

        // 改变状态
        $('.ux-status-handle ul li').click(function () {
            var _this = $(this);
            var ajaxUrl = $(this).attr("data-url");
            var dataValueStatus = $(this).attr("data-value-status");
            var onlineStatusArray = ['0', '9'];
            var dataTitle = '确定更改状态为：' + $(this).attr('title');

            if ($.inArray(dataValueStatus, onlineStatusArray) >= 0) {

                layer.confirm(dataTitle, {icon: 3, title: '提示'}, function (i) {
                    ajaxChangePlanState(_this, ajaxUrl, dataValueStatus);
                });

                return false;
            }

            ajaxChangePlanState(_this, ajaxUrl, dataValueStatus);
            return false;
        });

        function ajaxChangePlanState(_this, ajaxUrl, dataValueStatus) {
            $.ajax({
                url: ajaxUrl,
                type: 'get',
                data: {
                    'onlineStatus': dataValueStatus,
                },
                beforeSend: function () {
                    _this.button('loading');
                },
                success: function (req) {
                    if (!req.result) {
                        LAYER_MSG('状态修改失败');
                        return false;
                    }
                    window.location.reload();
                },
                error: function (e, jqxhr, settings, exception) {
                    LAYER_MSG('服务器错误');
                }
            });
        }

        // 移除
        $('.ajax-remove-plan').click(function () {
            var _this = $(this);
            var ajaxUrl = $(this).attr("data-url");
            var dataTitle = '确定删除计划？' + $(this).attr("data-title");

            layer.confirm(dataTitle, {icon: 3, title: '提示'}, function (i) {

                $.ajax({
                    url: ajaxUrl,
                    type: 'get',
                    beforeSend: function () {
                        _this.button('loading');
                    },
                    success: function (req) {
                        if (!req.result) {
                            LAYER_MSG('操作失败');
                            return false;
                        }
                        window.location.reload();
                    },
                    error: function (e, jqxhr, settings, exception) {
                        LAYER_MSG('服务器错误');
                    }
                });

                CLOSE_LOAD_LAYER(i);
            });

        });

        // 置顶
        $('.ajax-plan-sort').click(function () {
            var _this = $(this);
            var ajaxUrl = $(this).attr("data-url");

            $.ajax({
                url: ajaxUrl,
                type: 'get',
                beforeSend: function () {
                    _this.button('loading');
                },
                success: function (req) {
                    if (!req.result) {
                        LAYER_MSG('操作失败');
                        return false;
                    }
                    window.location.reload();
                },
                error: function (e, jqxhr, settings, exception) {
                    LAYER_MSG('服务器错误');
                }
            });
        });

        // 计划同步
        $('.ajax-plan-sync').click(function () {

            var _this = $(this);
            var ajaxUrl = $(this).attr("data-url");
            $.ajax({
                url: ajaxUrl,
                type: 'get',
                beforeSend: function () {
                    _this.button('loading');
                },
                success: function (req) {
                    layer.msg('同步成功', {
                        icon: 1,
                        shade: [0.5],
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    });
                    _this.button('reset');
                },
                error: function (e, jqxhr, settings, exception) {
                    LAYER_MSG('服务器错误');
                    _this.button('reset');
                }
            });

        });

    });

</script>