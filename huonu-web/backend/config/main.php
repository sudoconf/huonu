<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    // 'defaultRoute' => 'login', // 默认配置访问地址
    'language' => 'zh-CN',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\BaseAdmin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            // 'authTimeout' => 86400
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            // 'timeout' => 5,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    // 'logFile' => "@app/runtime/logs/".date('Y-m-d H:i').'.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                // 'yii\web\AssetManager' => false,
                // 'yii\web\YiiAsset' => false,
                // 'yii\widgets\ActiveFormAsset' => false,
                // 'yii\validators\ValidationAsset' => false,
                // 'yii\bootstrap\BootstrapAsset' => false,
                // 'yii\bootstrap\BootstrapPluginAsset' => false,
                // 'yii\web\JqueryAsset' => false,
                // 'yii\grid\GridViewAsset' => false,
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false, // 隐藏index.php
            'suffix' => '.html', // 后缀
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            "defaultRoles" => ["guest"],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    // 'basePath' => '@backend/messages',
                    // 'sourceLanguage' => 'zh-CN',
                    'fileMap' => [
                        'app' => 'admin.php',
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'system' => [
            'class' => 'backend\modules\system\systemModule',
        ],
    ],
    'as access' => [
        'class' => 'backend\components\AccessControl',
        'allowActions' => [
            // 这里是允许访问的action
            'site/login',
            'site/captcha',
            'site/error',
            '*'
        ]
    ],
    'params' => $params,
];
