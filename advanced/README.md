Yii 2 商城
===============================

Yii2-shop
#### 手机端参考(React-native) https://github.com/a313901703/AwesomeProject
#### WEB端参考(Vue) https://github.com/a313901703/vue-shop

安装
-------------------
```
#初始化
./init                          

#安装扩展
composer update   

#安装数据库
./yii migrate                   
./yii migrate --migrationPath=@mdm/admin/migrations
./yii yii migrate --migrationPath=@yii/rbac/migrations

#创建admin角色账号
./yii signup 

#参考文档
http://www.yiiframework.com/doc-2.0/guide-index.html
https://github.com/mdmsoft/yii2-admin  

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

模块
-------------------

```
商品模块：支持一个商品多SKU模式
用户模块：注册登录，用户角色权限管理
地址模块
订单模块
购物车模块
API模块

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
