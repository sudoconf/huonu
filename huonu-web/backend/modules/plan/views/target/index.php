<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\widget\GoLinkPager;

$this->title = '定向列表';
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
                <a href="<?= Url::toRoute('target/index') ?>"><?= $this->title ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tabbable">
                <ul class="nav nav-pills">
                    <li class=""><a href="<?= Url::toRoute('default/index') ?>" title="计划">计划</a></li>
                    <li class=""><a href="<?= Url::toRoute('unit/index') ?>" title="单元">单元</a></li>
                    <li class="active"><a href="<?= Url::toRoute('target/index') ?>" data-placement="top"
                                          data-toggle="tab" title="定向">定向</a></li>
                    <li class=""><a href="<?= Url::toRoute('resource/index') ?>" title="资源位">资源位</a></li>
                    <li class=""><a href="<?= Url::toRoute('creative/index') ?>" title="创意">创意</a></li>
                </ul>
                <div class="tab-content">
                    <!-- 定向 -->
                    <div class="tab-pane fade in active" id="target">

                        <div class="control-group form-inline pt15 pb15">
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                <i class="fa fa-plus"></i>
                                增加定向
                            </span>

                            <select name="" class="form-control">
                                <option>全部计划类型</option>
                                <option>自定义计划</option>
                                <option>系统推荐计划</option>
                            </select>

                            <select name="" class="form-control">
                                <option>所有付费方式</option>
                                <option>按展现付费(CPM)</option>
                                <option>按点击付费(CPC)</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部定向</option>
                                <option>访客定向</option>
                                <option>达摩盘定向</option>
                                <option>店铺型定向</option>
                                <option>C智能定向</option>
                                <option>类目型定向 - 高级兴趣点</option>
                                <option>相似宝贝定向</option>
                                <option>M智能定向</option>
                            </select>

                        </div>

                        <div class="control-group table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="钻石展位提供不同的人群定向技术，包括场景定向、群体定向、访客定向、兴趣点定向等等。">定向信息</span></th>
                                    <th><span class="cursor-help" data-placement="bottom" data-toggle="tab"
                                              title="为每个资源位上的定向人群单独出价，在定向或资源位维度下都可设置。">出价</span></th>
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

                                <?php foreach ($models as $k => $v) { ?>
                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td><?= $v['crowd_name'] ?></td>
                                        <td>
                                            <i class="zs_iconfont s_fc_9 s_fs_18 cursor-help" data-placement="bottom"
                                               data-toggle="tab" title="按图片单次点击出价，注：展现不另外计费。"></i>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr dpn">
                                        <td colspan="9" class="operation-td">
                                            <a href="javascript:;" class="btn btn-primary mr10">编辑</a>
                                            <a href="javascript:;" class="btn btn-primary mr10 ajax-remove-target"
                                               data-url="<?= Url::toRoute(['ajax-remove-target', 'targetId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>"
                                               data-title="<?= $v['crowd_name'] ?>">移除</a>
                                            <a href="javascript:;" class="btn btn-primary mr10 ajax-target-sync"
                                               data-url="<?= Url::toRoute(['ajax-target-sync', 'targetId' => $v['id'], 'taobaoUserId' => $v['taobao_user_id']]) ?>">同步</a>
                                            <a href="javascript:;" class="btn btn-primary mr10">报表</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                            <?= GoLinkPager::widget([
                                'pagination' => $pagination,
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
        $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚

        // 移除
        $('.ajax-remove-target').click(function () {
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

        // 计划同步
        $('.ajax-target-sync').click(function () {

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