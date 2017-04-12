<?php 
namespace v1\controllers;

use yii\rest\ActiveController;
use v1\models\Goods;

class GoodsController extends ActiveController
{
    public $modelClass = 'v1\models\Goods';

    // public function actions()
    // {
    //     $actions = parent::actions();
    //     // // 禁用"delete" 和 "create" 动作
    //     // unset($actions['delete'], $actions['create']);

    //     // // 使用"prepareDataProvider()"方法自定义数据provider 
    //     // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
    //     return $actions;
    // }
    
    /**
     * 首页商品推荐
     */
    public function actionRecommend(){
        $goods = Goods::find()->select(['id','name','sale_price','(virtual_nums + volume) as volume'])
            ->where(['status'=>0,'recommend'=>1])
            ->limit(6)
            ->all();
        return $goods;
    }
}
