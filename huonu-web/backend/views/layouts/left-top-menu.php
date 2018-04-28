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
                        <i class="fa fa-gear"></i> 系统管理
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= Url::toRoute('/system/user') ?>">
                                <i class="fa fa-list-ul"></i>
                                管理员列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/assignment') ?>">
                                <i class="fa fa-list-alt"></i>
                                分配
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/role') ?>">
                                <i class="fa fa-list-ul"></i>
                                角色列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/permission') ?>">
                                <i class="fa fa-list-ul"></i>
                                权限列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/route') ?>">
                                <i class="fa fa-list-ul"></i>
                                路由列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/rule') ?>">
                                <i class="fa fa-list-ul"></i>
                                规则列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/menu') ?>">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                                菜单列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/system/log') ?>">
                                <i class="fa fa-list-alt"></i>
                                操作日志
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="glyphicon glyphicon-list-alt"></i> 客户报表
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= Url::toRoute('/report/default') ?>">
                                <i class="fa fa-list-alt"></i>
                                人群复盘列表
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/report/data-sync') ?>">
                                <i class="fa fa-list-alt"></i>
                                数据同步
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="glyphicon glyphicon-list"></i> 客户计划
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= Url::toRoute('/plan/default') ?>">
                                <i class="fa fa-list-alt"></i>
                                计划列表
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->

    </div>
    <!-- /.navbar-static-side -->

</nav>