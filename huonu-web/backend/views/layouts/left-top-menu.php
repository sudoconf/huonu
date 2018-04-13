<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\components\MenuHelper;
use yii\bootstrap\Nav;

$tt = MenuHelper::getAssignedMenu(Yii::$app->user->id);
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
            <?php
            // echo Nav::widget(
            //     [
            //         "encodeLabels" => false,
            //         "options" => ["id" => "sidebar-menu"],
            //         "items" => MenuHelper::getAssignedMenu(Yii::$app->user->id),
            //     ]
            // );
            ?>
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
                            <a href="<?= Url::toRoute('/system/user') ?>">管理员列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/assignment') ?>">分配</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/role') ?>">角色列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/permission') ?>">权限列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/route') ?>">路由列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/rule') ?>">规则列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/menu') ?>">菜单列表</a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/log') ?>">操作日志</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->

    </div>
    <!-- /.navbar-static-side -->

</nav>