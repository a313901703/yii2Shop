Yii 2 商城
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

安装
-------------------
```
./init                          初始化

composer update                 安装扩展

./yii migrate                   安装数据库
./yii migrate --migrationPath=@mdm/admin/migrations
./yii yii migrate --migrationPath=@yii/rbac/migrations

./yii signup     创建admin角色账号

```

配置
-------------------
```
# common/config/main.php
...
'components' => [
    ...
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=',
        'username' => '',
        'password' => '',
        'charset' => '',
    ],
    #redis 必填
    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => '127.0.0.1',
        'port' => 6379,
        'database' => '0',
    ],
    /**
    # 搭配ELK使用
    'elasticsearch' => [
        'class' => 'yii\elasticsearch\Connection',
        'nodes' => [
            ['http_address' => 'localhost:9200'],
        ],
    ],
    'mongodb' => [
        'class' => '\yii\mongodb\Connection',
        'dsn' => '',
    ],
    'qiniu'=> [ 
        'class' => 'crazyfd\qiniu\Qiniu', 
        'accessKey' => '', 
        'secretKey' => '', 
        'domain' => '', 
        'bucket' => 'app-shop', 
    ],
    */   
    ...
],

# frontend/config/main.php
as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        //未登录状态可以访问的路径
        '*',
    ]
],
...
```


目录
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
