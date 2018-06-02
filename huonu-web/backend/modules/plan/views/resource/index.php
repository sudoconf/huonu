<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\widget\GoLinkPager;
use yii\widgets\ActiveForm;

$this->title = '资源位列表';
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
                <a href="<?= Url::toRoute('resources/index') ?>"><?= (!empty($camp)) ? $camp['name'] : $this->title ?></a>
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
                            <li class="active"><a
                                        href="<?= Url::toRoute(['resource/index', 'campaignId' => $get['campaignId'], 'adgroupId' => $get['adgroupId']]) ?>"
                                        data-placement="top"
                                        data-toggle="tab" title="资源位">资源位</a></li>
                            <li class=""><a
                                        href="<?= Url::toRoute(['creative/index', 'campaignId' => $get['campaignId'], 'adgroupId' => $get['adgroupId']]) ?>"
                                        title="创意">创意</a></li>
                        <?php } else {?>
                            <li class=""><a href="<?= Url::toRoute(['unit/index', 'campaignId' => $get['campaignId']]) ?>"
                                            title="单元">单元</a></li>
                            <li class=""><a
                                        href="<?= Url::toRoute(['target/index', 'campaignId' => $get['campaignId']]) ?>"
                                        title="定向">定向</a></li>
                            <li class="active"><a
                                        href="<?= Url::toRoute(['resource/index', 'campaignId' => $get['campaignId']]) ?>"
                                        data-placement="top"
                                        data-toggle="tab"
                                        title="资源位">资源位</a></li>
                            <li class=""><a
                                        href="<?= Url::toRoute(['creative/index', 'campaignId' => $get['campaignId']]) ?>"
                                        title="创意">创意</a></li>
                        <?php } ?>

                        <?php
                    } else { ?>
                        <li class=""><a href="<?= Url::toRoute('default/index') ?>" title="计划">计划</a></li>
                        <li class=""><a href="<?= Url::toRoute('unit/index') ?>" title="单元">单元</a></li>
                        <li class=""><a href="<?= Url::toRoute('target/index') ?>" title="定向">定向</a></li>
                        <li class="active"><a href="<?= Url::toRoute('resource/index') ?>" data-placement="top"
                                              data-toggle="tab" title="资源位">资源位</a></li>
                        <li class=""><a href="<?= Url::toRoute('creative/index') ?>" title="创意">创意</a></li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <!-- 资源位 -->
                    <div class="tab-pane fade in active" id="resources">

                        <div class="control-group pt15 pb15">
                            <div class="fl mr10">
                                <a href="javascript:;" id="create-plan"
                                   class="btn btn-primary create-plan">
                                    <i class="fa fa-plus"></i>
                                    增加资源位
                                </a>
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

                                <select name="mediaType" class="form-control">
                                    <option value="" <?= ($get['mediaType'] == '') ? 'selected' : '' ?>>所有媒体类型</option>
                                    <option value="1" <?= ($get['mediaType'] == 1) ? 'selected' : '' ?>>PC</option>
                                    <option value="2" <?= ($get['mediaType'] == 2) ? 'selected' : '' ?>>无线</option>
                                </select>

                                <select name="allowAdFormat" class="form-control">
                                    <option value="" <?= ($get['allowAdFormat'] == '') ? 'selected' : '' ?>>全部创意类型</option>
                                    <option value="2" <?= ($get['allowAdFormat'] == 2) ? 'selected' : '' ?>>图片</option>
                                    <option value="3" <?= ($get['allowAdFormat'] == 3) ? 'selected' : '' ?>>Flash</option>
                                    <option value="5" <?= ($get['allowAdFormat'] == 5) ? 'selected' : '' ?>>文字链</option>
                                    <option value="9" <?= ($get['allowAdFormat'] == 9) ? 'selected' : '' ?>>Flash 不遮盖</option>
                                    <option value="10" <?= ($get['allowAdFormat'] == 10) ? 'selected' : '' ?>>创意模板</option>
                                </select>

                                <select name="adzoneSize" class="form-control">
                                    <option value="" <?= ($get['adzoneSize'] == '') ? 'selected' : '' ?>>全部资源位尺寸</option>
                                    <option value="0x0" <?= ($get['adzoneSize'] == '0x0') ? 'selected' : '' ?>>0x0</option>
                                    <option value="160x200" <?= ($get['adzoneSize'] == '160x200') ? 'selected' : '' ?>>160x200</option>
                                    <option value="190x43" <?= ($get['adzoneSize'] == '190x43') ? 'selected' : '' ?>>190x43</option>
                                    <option value="190x90" <?= ($get['adzoneSize'] == '190x90') ? 'selected' : '' ?>>190x90</option>
                                    <option value="210x220" <?= ($get['adzoneSize'] == '210x220') ? 'selected' : '' ?>>210x220</option>
                                    <option value="240x200" <?= ($get['adzoneSize'] == '240x200') ? 'selected' : '' ?>>240x200</option>
                                    <option value="270x180" <?= ($get['adzoneSize'] == '270x180') ? 'selected' : '' ?>>270x180</option>
                                    <option value="300x125" <?= ($get['adzoneSize'] == '300x125') ? 'selected' : '' ?>>300x125</option>
                                    <option value="300x250" <?= ($get['adzoneSize'] == '300x250') ? 'selected' : '' ?>>300x250</option>
                                    <option value="300x350" <?= ($get['adzoneSize'] == '300x350') ? 'selected' : '' ?>>300x350</option>
                                    <option value="320x200" <?= ($get['adzoneSize'] == '320x200') ? 'selected' : '' ?>>320x200</option>
                                    <option value="336x280" <?= ($get['adzoneSize'] == '336x280') ? 'selected' : '' ?>>336x280</option>
                                    <option value="370x100" <?= ($get['adzoneSize'] == '370x100') ? 'selected' : '' ?>>370x100</option>
                                    <option value="375x130" <?= ($get['adzoneSize'] == '375x130') ? 'selected' : '' ?>>375x130</option>
                                    <option value="520x280" <?= ($get['adzoneSize'] == '520x280') ? 'selected' : '' ?>>520x280</option>
                                    <option value="600x350" <?= ($get['adzoneSize'] == '600x350') ? 'selected' : '' ?>>600x350</option>
                                    <option value="640x200" <?= ($get['adzoneSize'] == '640x200') ? 'selected' : '' ?>>640x200</option>
                                    <option value="642x250" <?= ($get['adzoneSize'] == '642x250') ? 'selected' : '' ?>>642x250</option>
                                    <option value="676x396" <?= ($get['adzoneSize'] == '676x396') ? 'selected' : '' ?>>676x396</option>
                                    <option value="728x90" <?= ($get['adzoneSize'] == '728x90') ? 'selected' : '' ?>>728x90</option>
                                    <option value="740x230" <?= ($get['adzoneSize'] == '740x230') ? 'selected' : '' ?>>740x230</option>
                                    <option value="750x90" <?= ($get['adzoneSize'] == '750x90') ? 'selected' : '' ?>>750x90</option>
                                    <option value="800x330" <?= ($get['adzoneSize'] == '800x330') ? 'selected' : '' ?>>800x330</option>
                                    <option value="940x107" <?= ($get['adzoneSize'] == '940x107') ? 'selected' : '' ?>>940x107</option>
                                    <option value="940x180" <?= ($get['adzoneSize'] == '940x180') ? 'selected' : '' ?>>940x180</option>
                                    <option value="950x90" <?= ($get['adzoneSize'] == '950x90') ? 'selected' : '' ?>>950x90</option>
                                    <option value="990x90" <?= ($get['adzoneSize'] == '990x90') ? 'selected' : '' ?>>990x90</option>
                                    <option value="1000x90" <?= ($get['adzoneSize'] == '1000x90') ? 'selected' : '' ?>>1000x90</option>
                                    <option value="1000x400" <?= ($get['adzoneSize'] == '1000x400') ? 'selected' : '' ?>>1000x400</option>
                                    <option value="1035x390" <?= ($get['adzoneSize'] == '1035x390') ? 'selected' : '' ?>>1035x390</option>
                                    <option value="1180x500" <?= ($get['adzoneSize'] == '1180x500') ? 'selected' : '' ?>>1180x500</option>
                                </select>
                                <input type="text" name="adzoneName" class="form-control"
                                       value="<?= $get['adzoneName'] ?>" placeholder="请输入资源位名称">
                                <?php ActiveForm::end(); ?>
                            </div>

                            <div class="control-group table-responsive">
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>资源位信息</th>
                                        <th>出价</th>
                                        <th>创意要求</th>
                                        <th>消耗</th>
                                        <th>展现量</th>
                                        <th>点击量</th>
                                        <th>千次展现成本</th>
                                        <th>点击率</th>
                                        <th>点击单价</th>
                                    </tr>
                                    </thead>
                                    <tbody class="plan-table">

                                    <?php foreach ($adzones as $k => $v) { ?>
                                        <tr class="odd gradeX operation-open">
                                            <th><input type="checkbox"></th>
                                            <td>
                                                <div><?= $v['adzone_name'] ?></div>
                                                <!-- <div class="mt10 word-break">
                                                    <span class="s_fc_9">计划：</span>
                                                    <span class="s_fc_9"></span>
                                                </div>
                                                <div class="mt10 word-break">
                                                    <span class="s_fc_9">单元：</span>
                                                    <span class="s_fc_9"></span>
                                                </div> -->
                                            </td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                        </tr>
                                        <tr class="odd gradeX cur-table-operation-tr dpn">
                                            <td colspan="10" class="operation-td">
                                                <a href="javascript:;" class="btn btn-primary mr10">移除</a>
                                                <a href="javascript:;" class="btn btn-primary mr10">同步</a>
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

</div>



<!-- 引入jQuery的js文件 -->
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

    $(function () {

        $("select[name='customerId']").change(function () {
            $('#adzone-form').submit();
        });
        $("select[name='mediaType']").change(function () {
            $('#adzone-form').submit();
        });

        $("select[name='allowAdFormat']").change(function () {
            $('#adzone-form').submit();
        });

        $("select[name='adzoneSize']").change(function () {
            $('#adzone-form').submit();
        });

        $("input[name='adzoneName']").blur(function () {
            $('#adzone-form').submit();
        });

        $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚
    });

</script>