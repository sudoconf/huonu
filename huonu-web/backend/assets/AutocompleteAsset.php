<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/12 11:58
 */

namespace backend\assets;

use yii\web\AssetBundle;

class AutocompleteAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */

    public $sourcePath = '@webroot/vendor/jquery-ui';
    /**
     * @inheritdoc
     */
    public $css = [
        'jquery-ui.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'jquery-ui.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
