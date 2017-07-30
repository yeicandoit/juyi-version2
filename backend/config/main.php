<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\seller\ShopMember',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
       'params' => $params,
       'language'=>'zh_cn',

    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/shopdetail',
            'uploadUrl' => '@web/shopdetail',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
        'sysadmin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',//yii2-admin的导航菜单
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'admin/*',//允许所有人访问admin节点及其子节点
            //'sysadmin/*',//允许所有人访问sysadmin节点及其子节点
            'gii/*',
            'redactor/*',
            'admin/login',
            'shop-seller/*',
            'site/*',
            'xyf/*',
        ]
    ],
];
