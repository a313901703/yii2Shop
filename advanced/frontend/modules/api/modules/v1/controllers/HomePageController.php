<?php 
namespace v1\controllers;

use yii\rest\Controller;
use app\models\Goods;
use yii\helpers\ArrayHelper;

class HomePageController extends Controller
{
    
    public function actionGoods(){
        $goods = Goods::find()->select(['id','name','sale_price','(virtual_nums + volume) as volume1'])
            ->where(['status'=>0,'recommend'=>1])
            ->limit(6)
            ->asArray()
            ->all();
        return $goods;
    }
}
