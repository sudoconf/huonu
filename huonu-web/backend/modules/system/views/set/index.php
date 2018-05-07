<?php

use yii\helpers\Url;

$this->title = '系统管理 - 系统设置';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                系统管理
                <small>系统设置</small>
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
                <a href="javascript:;">系统设置</a>
                <i class="fa fa-angle-right"></i>
            </li>
        </ul>
    </div>

    <div class="row col-lg-12">

        <div class="view">
            <div class="tabbable">

                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a href="#set-up-parameters" data-toggle="tab" data-placement="top" title="基本设置">
                            <i class="create-step">1</i>
                            <i class="fa fa-wrench"></i>
                            基本设置
                        </a>
                    </li>
                    <li>
                        <a href="#add-survey-group1" data-toggle="tab" data-placement="top" title="安全设置">
                            <i class="create-step">2</i>
                            <i class="fa fa-align-justify"></i>
                            安全设置
                        </a>
                    </li>
                    <li>
                        <a href="#add-survey-group2" data-toggle="tab" data-placement="top" title="邮件设置">
                            <i class="create-step">2</i>
                            <i class="fa fa-align-justify"></i>
                            邮件设置
                        </a>
                    </li>
                    <li>
                        <a href="#add-survey-group3" data-toggle="tab" data-placement="top" title="定时任务设置">
                            <i class="create-step">2</i>
                            <i class="fa fa-align-justify"></i>
                            定时任务设置
                        </a>
                    </li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade in active" id="set-up-parameters">

                        <div class="form-group form-inline">
                            <div class="control-group">
                                <span>复盘名称</span>
                                <input type="text" class="form-control multitray-name" placeholder="复盘名称"
                                       name="multitray_name" value="">
                            </div>

                            <div class="control-group">
                                <span>效果模型</span>
                                <label class="form-inline">
                                    <input type="radio" value="click" name="multitray_effect_model">点击效果
                                    <input type="radio" value="impression" name="multitray_effect_model">展示效果
                                </label>
                            </div>

                            <span class="create btn btn-primary">下一步，添加对比组</span>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="add-survey-group1">

                        <div class="form-group">

                            <div class="control-group">
                                <input type="button" value="添加策略组" class="btn btn-primary add-survey-group">
                            </div>

                            <div class="control-group">
                                <input type="button" value="下一步，生成报表" class="btn btn-primary generate-report">
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="add-survey-group2">

                        <div class="form-group">

                            <div class="control-group">
                                <input type="button" value="添加策略组" class="btn btn-primary add-survey-group">
                            </div>

                            <div class="control-group">
                                <input type="button" value="下一步，生成报表" class="btn btn-primary generate-report">
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="add-survey-group3">

                        <div class="form-group">

                            <div class="control-group">
                                <input type="button" value="添加策略组" class="btn btn-primary add-survey-group">
                            </div>

                            <div class="control-group">
                                <input type="button" value="下一步，生成报表" class="btn btn-primary generate-report">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<script>
    $(function () {
        $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚
    });
</script>