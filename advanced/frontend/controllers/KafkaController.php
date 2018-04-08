<?php 

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\components\Kafka;
use app\models\Goods;

class KafkaController extends Controller
{
    public function actionIndex(){
        $products = Goods::find()->select('id as key,name as value')->asArray()->all();
        $products = \yii\helpers\ArrayHelper::map($products,'key','value');
        $kafka = new kafka;
        //print_r($products);exit;
        $kafka->producer('products',$products);
    }

    public function actionView(){
        $kafka = new kafka;
        $kafka->consumer('products');
    }
}