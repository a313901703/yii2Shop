<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' =>'zh-CN',  //增加此行，默认使用中文
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2adv',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            // 'enableSchemaCache' => true,
            // // Duration of schema cache.
            // 'schemaCacheDuration' => 3600,
            // // Name of the cache component used to store schema information
            // 'schemaCache' => 'cache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'suffix' => '.html',//后缀
            'rules' => [
                // '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                // '<controller:(post|comment)>/<id:\d+>' => '<controller>/view',
                // '<controller:(post|comment)>s' => '<controller>/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0, // <-- 这里
        ],
    ],
];
