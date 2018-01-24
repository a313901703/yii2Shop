<?php 
namespace frontend\traits;

use Yii;
use Yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
/**
 * trait class
 * 一些公用的方法
 */
trait CommFunc{
    public function asDecimal($value,$multiple = 100 , $decimals = 2){
        $value = is_numeric($value) ? $value : 0;
        return Yii::$app->formatter->asDecimal($value/$multiple,$decimals);
    }

    public function asDateTime($value,$format = 'php:Y-m-d H:i:s'){
        return Yii::$app->formatter->asDateTime($value,$format);
    }

    public function throwBadRequest($e){
        throw new BadRequestHttpException($e);
    }
    
}