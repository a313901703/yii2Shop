<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' =>'zh-CN',  //增加此行，默认使用中文
    'timeZone'=>'Asia/Shanghai',
    'charset'=>'utf-8',
    
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter'=>[
            'defaultTimeZone'=>'PRC',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => '0', //db1：elasticSearch db2:邮件
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'autodetectCluster' => false,
            'nodes' => [
                ['http_address' => 'localhost:9200'],
            ],
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => '',
            'dsn' => '',
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
