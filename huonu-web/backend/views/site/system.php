<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
        <a class="navbar-brand" href="<?= Url::toRoute('site/index') ?>">智行智投</a>
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
                    <a href="javascript:;"><i class="fa fa-user fa-fw"></i> 用户信息</a>
                </li>
                <li>
                    <a href="javascript:;"><i class="fa fa-gear fa-fw"></i> 设置</a>
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
                    <a href="<?= Url::to(['site/index']) ?>"><i class="fa fa-dashboard fa-fw"></i> 控制盘</a>
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
        <div class="col-xs-12 col-sm-12">
            <h4 class="blue">
                <span class="middle"><i class="ace-icon glyphicon glyphicon-user light-blue bigger-110"></i></span>
                账号信息
            </h4>
            <div class="profile-user-info">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 账号</div>
                    <div class="profile-info-value">
                        <span><?= $this->params['admin']->username ?></span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 角色</div>
                    <div class="profile-info-value">
                        <span><?= $this->params['admin']->role ?></span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 上次登录时间</div>
                    <div class="profile-info-value">
                        <span><?= date('Y-m-d H:i:s', $this->params['admin']->last_time) ?></span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 上次登录IP</div>
                    <div class="profile-info-value">
                        <span><?= $this->params['admin']->last_ip ?></span>
                    </div>
                </div>
            </div>
            <div class="hr hr16 dotted"></div>

            <h4 class="blue">
                <span class="middle"><i class="fa fa-desktop light-blue bigger-110"></i></span>
                其他信息
            </h4>

            <div class="profile-user-info">
                <div class="profile-info-row">
                    <div class="profile-info-name"> Yii版本</div>
                    <div class="profile-info-value">
                        <span><?= $yii ?></span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 上传文件</div>
                    <div class="profile-info-value">
                        <span><?= $upload ?></span>
                    </div>
                </div>
            </div>

            <div class="hr hr-8 dotted"></div>

            <div class="profile-user-info">
                <div class="profile-info-row">
                    <div class="profile-info-name">
                        <i class="fa fa-github-square" aria-hidden="true"></i>
                        GitHub
                    </div>
                    <div class="profile-info-value">
                        <a href="https://github.com/prtens" target="_blank">https://github.com/prtens</a>
                    </div>
                </div>
            </div>
            <div class="hr hr16 dotted"></div>
        </div>
    </div>

</div>
<!-- /#page-wrapper -->