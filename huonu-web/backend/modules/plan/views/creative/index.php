<?php

use yii\helpers\Url;
use backend\models\TaobaoZsCreativeList;
use yii\widgets\ActiveForm;

$this->title = '创意列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small><?= (!empty($camp)) ? $camp['name'] : $this->title ?></small>
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
                <a href="<?= Url::toRoute('creative/index') ?>"><?= (!empty($camp)) ? $camp['name'] : $this->title ?></a>
            </li>
            <?php
            if (!empty($adgroup)) {
                ?>
                <li>
                    <i class="fa fa-angle-right"></i>
                    <a href="#"><?= $adgroup['adgroup_name'] ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tabbable">
                <ul class="nav nav-pills">
                    <?php
                    if (isset($get['campaignId'])) {
                        ?>
                        <?php if (!empty($adgroup)) {
                            ?>
                            <li class=""><a
                                        href="<?= Url::toRoute(['target/index', 'campaignId' => $get['campaignId'], 'adgroupId' => $get['adgroupId']]) ?>"
                                        title="定向">定向</a></li>
                            <li class=""><a
                                        href="<?= Url::toRoute(['resource/index', 'campaignId' => $get['campaignId'], 'adgroupId' => $get['adgroupId']]) ?>"
                                        title="资源位">资源位</a></li>
                            <li class="active"><a
                                        href="<?= Url::toRoute(['creative/index', 'campaignId' => $get['campaignId'], 'adgroupId' => $get['adgroupId']]) ?>"
                                        data-placement="top"
                                        data-toggle="tab" title="创意">创意</a></li>
                        <?php } else {?>
                            <li class=""><a href="<?= Url::toRoute(['unit/index', 'campaignId' => $get['campaignId']]) ?>"
                                            title="单元">单元</a></li>
                            <li class=""><a
                                        href="<?= Url::toRoute(['target/index', 'campaignId' => $get['campaignId']]) ?>"
                                        title="定向">定向</a></li>
                            <li class=""><a
                                        href="<?= Url::toRoute(['resource/index', 'campaignId' => $get['campaignId']]) ?>"
                                        title="资源位">资源位</a></li>
                            <li class="active"><a
                                        href="<?= Url::toRoute(['creative/index', 'campaignId' => $get['campaignId']]) ?>"
                                        data-placement="top"
                                        data-toggle="tab"
                                        title="创意">创意</a></li>
                        <?php } ?>

                        <?php
                    } else { ?>
                        <li class=""><a href="<?= Url::toRoute('default/index') ?>" title="计划">计划</a></li>
                        <li class=""><a href="<?= Url::toRoute('unit/index') ?>" title="单元">单元</a></li>
                        <li class=""><a href="<?= Url::toRoute('target/index') ?>" title="定向">定向</a></li>
                        <li class=""><a href="<?= Url::toRoute('resource/index') ?>" title="资源位">资源位</a></li>
                        <li class="active"><a href="<?= Url::toRoute('creative/index') ?>" data-placement="top"
                                              data-toggle="tab" title="创意">创意</a></li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <!-- 创意 -->
                    <div class="tab-pane fade in active" id="creative">

                        <div class="control-group pt15 pb15">
                            <div class="fl mr10">
                                <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                    <i class="fa fa-plus"></i>
                                    从创意库选择
                                </span>

                                <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                    添加新创意
                                </span>
                            </div>

                            <div class="form-inline">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'adzone-form',
                                    'method' => 'get',
                                ]); ?>
                                <select name="customerId" class="form-control">
                                    <option value="" <?= ($get['customerId'] == '') ? 'selected' : '' ?>>请选择客户
                                    <?php foreach ($customers as $k => $v) { ?>
                                        <option value="<?= $v['taobao_user_id'] ?>" <?= ($get['customerId'] == $v['taobao_user_id']) ? 'selected' : '' ?>>
                                    <?= $v['taobao_user_nick'] ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <select name="auditStatus" class="form-control">
                                    <option value="" <?= ($get['auditStatus'] == '') ? 'selected' : '' ?>>全部状态</option>
                                    <option value="-4,-1,0" <?= ($get['auditStatus'] == '-4,-1,0') ? 'selected' : '' ?>>待审核</option>
                                    <option value="1" <?= ($get['auditStatus'] == '1') ? 'selected' : '' ?>>审核通过</option>
                                    <option value="-2,-5,-9" <?= ($get['auditStatus'] == '-2,-5,-9') ? 'selected' : '' ?>>审核拒绝</option>
                                </select>

                                <select name="creativeLevel" class="form-control">
                                    <option value="" <?= ($get['creativeLevel'] == '') ? 'selected' : '' ?>>全部等级</option>
                                    <option value="1" <?= ($get['creativeLevel'] == '1') ? 'selected' : '' ?>>一级</option>
                                    <option value="2" <?= ($get['creativeLevel'] == '2') ? 'selected' : '' ?>>二级</option>
                                    <option value="3" <?= ($get['creativeLevel'] == '3') ? 'selected' : '' ?>>三级</option>
                                    <option value="4" <?= ($get['creativeLevel'] == '4') ? 'selected' : '' ?>>四级</option>
                                    <option value="10" <?= ($get['creativeLevel'] == '10') ? 'selected' : '' ?>>十级</option>
                                    <option value="99" <?= ($get['creativeLevel'] == '99') ? 'selected' : '' ?>>未分级</option>
                                </select>

                                <select name="creativeSize" class="form-control">
                                    <option value="" <?= ($get['creativeSize'] == '') ? 'selected' : '' ?>>全部尺寸</option>
                                    <option value="520,280" <?= ($get['creativeSize'] == '520,280') ? 'selected' : '' ?>>520x280</option>
                                    <option value="640,200" <?= ($get['creativeSize'] == '640,200') ? 'selected' : '' ?>>640x200</option>
                                    <option value="1180,500" <?= ($get['creativeSize'] == '1180,500') ? 'selected' : '' ?>>1180x500</option>
                                </select>

                                <input type="text" name="creativeName" class="form-control"
                                       value="<?= $get['creativeName'] ?>" placeholder="请输入资源位名称">
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>

                        <div class="control-group table-responsive">
                            <table class="table table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>创意基本信息</th>
                                    <th>创意状态<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                               data-toggle="tab" title="创意所处的审核状态，未审核通过的创意将自动从推广单元中去除。"></i></th>
                                    <th>上下线时间<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                                data-toggle="tab" title="可对创意设置上下线时间，时间开始自动投放，时间到期自动结束。"></i></th>
                                    <th>消耗<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                             data-toggle="tab" title="所有创意在钻石展位资源上被展现后所产生的费用。单位元。"></i></th>
                                    <th>展现量<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                              data-toggle="tab"
                                              title="所有创意在钻石展位资源上被买家看到的次数。注意，虚假展现会被反作弊体系过滤，该数据为反作弊系统过滤后的数据。"></i></th>
                                    <th>点击量<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                              data-toggle="tab" title="所有创意在钻石展位资源上被买家点击的次数"></i></th>
                                    <th>千次展现成本<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                                 data-toggle="tab"
                                                 title="千次展现成本=消耗/（展现/1000），表示创意在每获得1000次展现后所产生的平均费用。"></i></th>
                                    <th>点击率<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                              data-toggle="tab"
                                              title="点击率=点击/展现，可直观表示创意对买家的吸引程度，点击率越高说明创意对买家的吸引程度越大。"></i></th>
                                    <th>点击单价<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                               data-toggle="tab" title="点击单价=消耗/点击，表示创意在每获得1次点击后所产生的平均费用。单位元。"></i></th>
                                </tr>
                                </thead>
                                <tbody class="plan-table">

                                <?php foreach ($taobaoZsCreative as $k => $v) { ?>
                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div style="width: 300px;" class="pr clearfix">
                                                <div class="creativeImgLi"
                                                     style="position: absolute; width: 102px; overflow: hidden; text-align: center; top:50%; margin-top: -50px;">
                                                    <div class="vertical-align-middle-100"
                                                         style="border: 1px solid #e6e6e6;">
                                                        <div class="inline-block" data-url="<?= $v['image_path'] ?>"
                                                             data-clickurl="<?= $v['image_path'] ?>">
                                                            <img src="<?= $v['image_path'] ?>"
                                                                 style="width: 100px; height: 31.25px; max-width: 100px; max-height: 100px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pic-preview hide">
                                                    <img src="<?= $v['image_path'] ?>">
                                                </div>
                                                <div style="float: right; width: 190px; overflow: hidden;">
                                                    <div class="nowrap">
                                                        <div class="editable">
                                                            <div class="editable-toggle">
                                                                <span class="editable-content nowrap"
                                                                      style="max-width: 165px;"><?= $v['creative_name'] ?></span>
                                                                <a href="javascript:;" class="operation"
                                                                   title="创意ID：<?= $v['creative_id'] ?>">
                                                                    <i class="fa fa-tasks s_fc_9 ml5"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="s_fc_9 mt4">计划：</div>
                                                    <div class="s_fc_9 mt4">单元：</div>
                                                    <div class="s_fc_9 mt4">
                                                        创意等级/类型：<?= TaobaoZsCreativeList::$creativeLevel[$v['creative_level']] ?>
                                                        /图片
                                                    </div>
                                                    <div class="s_fc_9 mt4">创意尺寸：<?= $v['creative_size'] ?></div>
                                                    <div class="s_fc_9 ellipsis s_fc_9 mt4">
                                                        URL：<?= $v['click_url'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            if (in_array($v['audit_status'], TaobaoZsCreativeList::$toAudit)) {
                                                echo '待审核';
                                            } else if (in_array($v['audit_status'], TaobaoZsCreativeList::$passAudit)) {
                                                echo '<span class="qualification_status_P">审核通过</span>';
                                            } else if (in_array($v['audit_status'], TaobaoZsCreativeList::$auditRefused)) {
                                                echo '审核拒绝';
                                            }
                                            ?>
                                        </td>
                                        <td>起：<?= $v['create_time'] ?><br>止：<?= $v['exprie_time'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr dpn">
                                        <td colspan="10" class="operation-td">
                                            <a href="javascript:;" class="btn btn-primary mr10"
                                               data-value="<?= $v['creative_id'] ?>">移除</a>
                                            <a href="javascript:;" class="btn btn-primary mr10"
                                               data-value="<?= $v['creative_id'] ?>">报表</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>

                            <?= \backend\components\widget\GoLinkPager::widget([
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

        $("select[name='customerId']").change(function () {
            $('#adzone-form').submit();
        });
        $("select[name='auditStatus']").change(function () {
            $('#adzone-form').submit();
        });

        $("select[name='creativeLevel']").change(function () {
            $('#adzone-form').submit();
        });

        $("select[name='creativeSize']").change(function () {
            $('#adzone-form').submit();
        });

        $("input[name='creativeName']").blur(function () {
            $('#adzone-form').submit();
        });

        $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚

        $(".creativeImgLi").hover(function () {
            var x = $('.creativeImgLi').offset();
            $(".creativeImgLi").mousemove(function (e) {
                $(this).siblings().css({
                    "top": (10) + "px",
                    "left": (111) + "px"
                }).removeClass('hide')
            });
        }, function () {
            $('.pic-preview').addClass('hide');
        });

    });

</script>