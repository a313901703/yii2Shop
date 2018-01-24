<?php

namespace app\modules\api;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $config = require(__DIR__.'/config/config.php');
        $components = \Yii::$app->getComponents();

        foreach( $config['components'] AS $k=>$component ){
            if( isset($component['class']) && isset($components[$k]) == false ) continue;
            $config['components'][$k] = array_merge($components[$k], $component);
        }
        \Yii::configure(\Yii::$app, $config);
        // custom initialization code goes here
        $this->modules = [ 
            'v1' => [
                'class' => 'api\modules\v1\Module',
            ],
        ];
    }
}
