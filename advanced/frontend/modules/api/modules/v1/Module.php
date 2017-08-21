<?php

namespace api\modules\v1;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        //初始模块配置
        //$config = require(__DIR__.'../config/Config.php');
        $config['language'] = 'cn';
        $config['components']['user'] = [
            'class' => 'aod\components\User',
            'identityClass' => 'app\models\User',
        ];
        $components = Yii::$app->getComponents();

        // foreach( $config['components'] AS $k=>$component ){
        //     if( isset($component['class']) && isset($components[$k]) == false ) continue;
        //     $config['components'][$k] = array_merge($components[$k], $component);
        // }
        Yii::configure(Yii::$app, $config);
    }
}
