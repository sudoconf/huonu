<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

$this->title = '智行智投 - 客户报表';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '客户报表']);
$this->registerMetaTag(['name' => 'description', 'content' => '人群复盘列表'], 'description');
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
                    <a href="<?= Url::toRoute('/site') ?>"><i class="fa fa-dashboard fa-fw"></i> 控制盘</a>
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
                <small>用户</small>
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
                <a href="javascript:;">用户管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:;">账户列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    查询条件
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'search-form',
                    'method' => 'get',
                    'action' => Url::toRoute('user/index')
                    ]); ?>
                <div class="panel-body form-group">
                    <div class="form-filter">
                        <label class="form-filter-field">用户名：</label>
                        <div class="form-filter-content">
                            <?= $form->field($searchModel, 'username')->textInput(['placeholder' => $searchModel->getAttributeLabel('username')])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-filter">
                        <label class="form-filter-field">角色：</label>
                        <div class="form-filter-content">
                            <select class="form-control">
                                <option value="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-filter">
                        <label class="form-filter-field">状态：</label>
                        <div class="form-filter-content">
                            <select class="form-control">
                                <option value="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-filter-btn">
                        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="panel-body">
                    <button type="button" class="btn btn-primary create-user-button">添加管理员</button>
                </div>

                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            [
                                'attribute' => 'username',
                                'content' => function ($dataProvider) {
                                    return $dataProvider['username'];
                                },
                            ],
                            [
                                'attribute' => 'role',
                                'content' => function ($dataProvider) {
                                    return $dataProvider['role'];
                                },
                            ],
                            'email:email',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => '{password}{disable}',
                                'headerOptions' => ['width' => '200', 'class' => 'padding-left-5px',],
                                'contentOptions' => ['class' => 'padding-left-5px'],
                                'buttons' => [
                                    'password' => function ($url, $model, $key) {
                                        return Html::button('重置密码', [
                                            'class' => 'btn btn-primary reset-password'
                                        ]);
                                    },
                                    'disable' => function ($url, $model, $key) {
                                        return Html::button('禁用', [
                                            'class' => 'btn btn-primary forbidden'
                                        ]);
                                    },
                                ],
                            ],
                        ],
                        'emptyText' => '没有筛选到任何内容哦',
                    ]); ?>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /#page-wrapper -->

<!-- 添加管理员弹出框 -->
<div class="layer-form-create-user" style="display: none">
    <div class="layer-form">
        <div class="control-group">
            <div class="controls">
                <input type="text" class="form-control" placeholder="账号昵称">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <input type="text" class="form-control" placeholder="密码">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <input type="text" class="form-control" placeholder="邮箱">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <select class="form-control">
                    <option value="">1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-default">提交</button>
                <button type="submit" class="btn btn-default">重置</button>
            </div>
        </div>
    </div>
</div>

<!-- 重置密码弹出框 -->
<div class="layer-form-reset-password" style="display: none">
    <div class="layer-form">
        <div class="control-group">
            <div class="controls">
                <img src="http://a-ssl.duitang.com/uploads/item/201404/15/20140415192752_JGUFz.jpeg"
                     style="width: 50px">
                <span>管理员</span>
                <span>huonuadmin</span>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <input type="text" class="form-control" placeholder="设置密码">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-default">提交</button>
                <button type="submit" class="btn btn-default">重置</button>
            </div>
        </div>
    </div>
</div>