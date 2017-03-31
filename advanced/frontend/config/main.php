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
    'name' =>'WTF+',        //平台名称
    //'defaultRoute'=>'goods',
    'aliases' => [
        '@goods' => '@app/modules/goods',
        '@api' => '@app/modules/api',
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
            'class'=>'app\Modules\goods\Module',
        ],
        //restful api
        'api'=>[
            'class'=>'app\Modules\api\Module',
        ],
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        //格式化错误响应
        // 'response' => [
        //     'class' => 'yii\web\Response',
        //     'on beforeSend' => function ($event) {
        //         $response = $event->sender;
        //         $response->format = 'json';
        //         if ($response->data !== NULL && Yii::$app->getRequest()->getIsAjax() && $response->isClientError) {
        //             $response->format = 'json';
        //             $response->data = [
        //                 'errCode'=>$response->isClientError,
        //                 'data' => $response->data,
        //             ];
        //             $response->statusCode = 200;
        //         }
        //     },  
        // ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
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
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/goods'],
                
                'goods/categories' => 'goods/category',
                '<module:\w+>/<controller:(props)>/<action:\w+>/pid/<pid:\d+>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            'site/login',
            'site/signup',
            'api/*',
            //'admin/*'
        ]
    ],
    'params' => $params,
];
