<?php 
namespace v1\controllers;

use yii\rest\Controller;
use app\models\Goods;
use yii\helpers\ArrayHelper;

class HomePageController extends Controller
{
    
    public function actionGoods(){
        
        return $goods;
    }
}
