<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'name' =>'Yii-shop',        //平台名称
    'aliases' => [
        '@goods' => '@app/modules/goods',
        '@api' => '@app/modules/api',
        '@orders' => '@app/modules/orders',
        '@v1' => '@app/modules/api/modules/v1',
    ],
    'modules' => [
        //权限管理模块
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'layout' => 'left-menu',
            'mainLayout'=> '@frontend/views/layouts/main.php',
        ],
        //富文本编辑器
        'redactor' => [ 
            'class' => 'yii\redactor\RedactorModule', 
            'uploadDir' => '@webroot/imgs/uploads',
            'imageAllowExtensions'=>['jpg','png','gif']
        ], 
        //商品管理
        'goods'=>[
            'class'=>'app\modules\goods\Module',
        ],
        //restful api
        'api'=>[
            'class'=>'app\modules\api\Module',
        ],
        //订单模块
        'orders' => [
            'class'=>'app\modules\orders\Module',
        ],
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        // 'view'=>[
        //     'class'=>'app\components\View',
        // ],
        'sentry' => [
            'class' => 'mito\sentry\Component',
            'dsn' => 'http://9dcf5ef60ca5466b958b10d22c5612c8:57887b713705411a86a98265bd08e658@192.144.132.75:9000/2', // private DSN
            'environment' => 'production', // if not set, the default is `production`
            // 'jsNotifier' => true, // to collect JS errors. Default value is `false`
            // 'jsOptions' => [ // raven-js config parameter
            //     'whitelistUrls' => [ // collect JS errors from these urls
            //         'http://staging.my-product.com',
            //         'https://my-product.com',
            //     ],
            // ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                // [
                //     'class' => 'yii\log\FileTarget',
                //     //'class' => 'app\components\FileTarget',
                //     'categories' => ['yii\*'],
                //     'levels' => ['error', 'warning'],
                //     'logVars' => [],
                //     'except' => [
                //         'yii\db\*'
                //     ],
                //     'prefix' => function ($message) {
                //         $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
                //         $userID = $user ? $user->getId(false) : '-';
                //         return "[$userID]";
                //     }
                // ],
                [
                    'class' => 'mito\sentry\Target',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //模板
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-black',
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'api/v1/goods',
                        'api/v1/product',
                        'api/v1/user',
                        'api/v1/pay-cart',
                        'api/v1/order',
                        'api/v1/address',
                        'api/v1/category',
                    ],
                    'suffix'=>'',
                    'tokens'=>[
                        '{id}' => '<id:\\d[\\d,]*>',
                        '{_act}'=>'<_act>',
                    ],
                    'patterns'=>[
                        'PUT,PATCH {id}' => 'update',
                        'DELETE {id}' => 'delete',
                        'GET,HEAD {id}' => 'view',
                        'POST' => 'create',
                        'GET,POST {_act}' => 'index',
                        'GET,HEAD' => 'index',
                        '{id}' => 'options',
                        '' => 'options',
                    ],
                ],
                'goods/categories' => 'goods/category',
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            //'site/login',
            '*',
        ]
    ],
    'params' => $params,
];
