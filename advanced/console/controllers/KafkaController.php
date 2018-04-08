<?php 
namespace console\controllers;

use Yii;
use frontend\components\kafka;


class KafkaController extends \yii\console\Controller
{
    public function actionIndex(){
        $kafka = new kafka;
        $kafka->consumer('products');
    }
}