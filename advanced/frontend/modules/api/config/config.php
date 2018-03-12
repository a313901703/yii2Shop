<?php

return [
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json'=>'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'response' => [
            'format'=>\yii\web\Response::FORMAT_JSON,
            'on beforeSend'=>function($event){
                $response = $event->sender;
                $data['errcode'] = $response->isSuccessful ? 0 : 1;
                if($response->data){
                    if ($response->isSuccessful) {
                        $data['ret_msg'] = $response->data ?: '';
                    }else{
                        $data['ret_msg'] = $response->data['message'];
                        $data['ret_msg'] = $response->data;
                    }
                }
                $response->data = $data;
            },
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'api/*',
        ]
    ],
];
