<?php

return [
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/goods'],
            ],
        ],
    ],
   
];
