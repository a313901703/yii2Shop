<?php

namespace frontend\components;

use Yii;
use yii\base\InlineAction;
use yii\helpers\{Url,Json};
use yii\web\{Controller as baseController,Response,Redis};


class Controller extends baseController
{
	const DELETE_STATUS = -1;
	const ACTIVE_STATUS = 0;
	const PAUSE_STATUS  = 1;

    /**
     * controller初始化
     */
    // public function init()
    // {
    // }

    /**
     * 删除，默认status
     */
    public function delete($model,$attribute = 'status'){
    	$model->$attribute = self::DELETE_STATUS;
    	return $model->save();
    }
   
    /**
     * 获取redis实例
     */
    public function getRedis(){
        return Yii::$app->redis;
    }
}