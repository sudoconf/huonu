<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/metisMenu/metisMenu.min.css',
        'css/hn-admin.css',
        'vendor/font-awesome/css/font-awesome.min.css'
    ];
    public $js = [
        'vendor/bootstrap/js/bootstrap.min.js',
        'vendor/metisMenu/metisMenu.min.js',
        'vendor/layer/layer.js',
        'js/hn-admin.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public static function addJsFile($view, $jsFile)
    {
        // POS_HEAD——head结束标签之前：$this->registerJs('alert(4)',View::POS_HEAD);
        // POS_BEGIN——body开始标签之后：$this->registerJs('alert(4)',View::POS_BEGIN);
        // POS_END——body结束标签之前：$this->registerJs('alert(4)',View::POS_END);
        // POS_READY POS_LOAD：$this->registerJs('alert(4)', View::POS_READY);
        $view->registerJsFile($jsFile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset', 'position' => $view::POS_END]);
    }
}
