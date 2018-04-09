<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use yii\bootstrap\ActiveForm;

$this->title = '智行智投 - 客户报表';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '客户报表']);
$this->registerMetaTag(['name' => 'description', 'content' => '人群复盘列表'], 'description');

// $rules = array_keys(Yii::$app->authManager->getRules());
// $rules = array_combine($rules, $rules);
// unset($rules[RouteRule::RULE_NAME]);
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= Url::toRoute('/site/index') ?>">智行智投</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> 用户信息</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-gear fa-fw"></i> 设置</a>
                </li>
                <li class="divider"></li>
                <li>
                    <?= Html::beginForm(['/site/logout'], 'post'); ?>
                    <?= Html::submitButton(
                        '<i class="ace-icon fa fa-power-off"></i> 退出登录 ',
                        ['class' => 'btn btn-link logout']
                    ) ?>
                    <?= Html::endForm(); ?>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>

    <div class="navbar-default sidebar" role="navigation">

        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?= Url::toRoute('/site/index') ?>"><i class="fa fa-dashboard fa-fw"></i> 控制盘</a>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="fa fa-bar-chart-o fa-fw"></i> 系统管理
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= Url::toRoute('/system/user') ?>">用户列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/role') ?>">角色列表</a>
                        </li>
                        <li>
                            <a href="#">权限列表</a>
                        </li>
                        <li>
                            <a href="#">路由列表</a>
                        </li>
                        <li>
                            <a href="#">规则列表</a>
                        </li>
                        <li>
                            <a href="#">菜单列表</a>
                        </li>
                        <li>
                            <a href="#">备份数据库</a>
                        </li>
                        <li>
                            <a href="#">还原数据库</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->

    </div>
    <!-- /.navbar-static-side -->

</nav>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                系统管理
                <small>角色</small>
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
                <a href="javascript:;">角色管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:;">角色列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <button type="button" class="btn btn-primary create-role-button">创建角色</button>
                </div>

                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => '名称',
                                'content' => function ($dataProvider) {
                                    return $dataProvider->name;
                                },
                            ],
                            [
                                'attribute' => '规则名称',
                                'content' => function ($dataProvider) {
                                    return $dataProvider->ruleName;
                                },
                            ],
                            [
                                'attribute' => '描述',
                                'content' => function ($dataProvider) {
                                    return $dataProvider->description;
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn',],
                        ],
                        'emptyText' => '没有筛选到任何内容哦',
                    ]); ?>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /#page-wrapper -->

<!-- 创建角色弹出框 -->
<div class="layer-form-create-role" style="display: none">
    <?php $form = ActiveForm::begin([
        'id' => 'search-form',
        'method' => 'post',
        'action' => Url::toRoute('role/create')
    ]); ?>
    <div class="layer-form">
        <div class="control-group">
            <div class="controls">
                <?= $form->field($authItem, 'name')->textInput(['placeholder' => $authItem->getAttributeLabel('name'), 'autofocus' => true])->label(false) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <?= $form->field($authItem, 'description')->textarea(['placeholder' => $authItem->getAttributeLabel('rule_name'), 'rows' => 3])->label(false) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <?= $form->field($authItem, 'rule_name')->textInput(['placeholder' => $authItem->getAttributeLabel('rule_name')])->label(false) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <?= $form->field($authItem, 'data')->textarea(['placeholder' => $authItem->getAttributeLabel('data'), 'rows' => 3])->label(false) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="submit" class="btn btn-primary">重置</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>