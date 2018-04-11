<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '智行智投 - 客户报表';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '客户报表']);
$this->registerMetaTag(['name' => 'description', 'content' => '人群复盘列表'], 'description');
?>

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