<?php

use mdm\admin\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $routes [] */

$this->title = Yii::t('admin', 'Routes');
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'routes' => $routes,
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                系统管理
                <small>路由列表</small>
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
                <a href="javascript:;">系统管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:;">路由列表</a>
            </li>
        </ul>
    </div>

    <div class="row col-lg-12">

        <h1><?=Html::encode($this->title);?></h1>
        <div class="row">
            <div class="col-sm-11">
                <div class="input-group">
                    <input id="inp-route" type="text" class="form-control"
                           placeholder="<?=Yii::t('admin', 'New route(s)');?>">
                    <span class="input-group-btn">
                        <?=Html::a(Yii::t('admin', 'Create route') . $animateIcon, ['create'], [
            'class' => 'btn btn-success',
            'id' => 'btn-new',
        ]);?>
                    </span>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-sm-5">
                <div class="input-group">
                    <input class="form-control search" data-target="available"
                           placeholder="<?=Yii::t('admin', 'Search for available');?>">
                    <span class="input-group-btn">
                        <?=Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['refresh'], [
            'class' => 'btn btn-default',
            'id' => 'btn-refresh',
        ]);?>
                    </span>
                </div>
                <select multiple size="20" class="form-control list" data-target="available"></select>
            </div>
            <div class="col-sm-1">
                <br><br>
                <?=Html::a('&gt;&gt;' . $animateIcon, ['assign'], [
            'class' => 'btn btn-success btn-assign',
            'data-target' => 'available',
            'title' => Yii::t('admin', 'Assign'),
        ]);?><br><br>
                <?=Html::a('&lt;&lt;' . $animateIcon, ['remove'], [
            'class' => 'btn btn-danger btn-assign',
            'data-target' => 'assigned',
            'title' => Yii::t('admin', 'Remove'),
        ]);?>
            </div>
            <div class="col-sm-5">
                <input class="form-control search" data-target="assigned"
                       placeholder="<?=Yii::t('admin', 'Search for assigned');?>">
                <select multiple size="20" class="form-control list" data-target="assigned"></select>
            </div>
        </div>

    </div>

</div>
