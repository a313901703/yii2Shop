<?php 
namespace v1\controllers;

use yii\rest\Controller;
use app\models\Goods;

class HomePageController extends Controller
{
    public function actionGoods(){
        $goods = Goods::find()->select(['id','name','sale_price','(virtual_nums + volume) as volume'])
            ->where(['status'=>0,'recommend'=>1])
            ->limit(4)
            ->all();
        return $goods;
    }
}
