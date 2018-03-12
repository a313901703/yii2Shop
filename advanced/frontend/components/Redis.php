<?php
namespace frontend\components;

use Yii;
use yii\helpers\Json;

/**
* redis 操作
*/
class Redis
{
    public $redis;
    function __construct()
    {
        $this->redis = Yii::$app->redis;
    }

}
