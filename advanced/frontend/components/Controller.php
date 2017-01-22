<?php

namespace frontend\components;

use Yii;
use yii\base\InlineAction;
use yii\helpers\{Url,Json};
use yii\web\{Controller as baseController,Response};


class Controller extends baseController
{
	const DELETE_STATUS = -1;
	const ACTIVE_STATUS = 0;
	const PAUSE_STATUS  = 1;
	/**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            return true;
        }
        return false;
    }

    /**
     * 删除，默认status
     */
    public function delete($model,$attribute = 'status'){
    	$model->$attribute = self::DELETE_STATUS;
    	return $model->save();
    }
}