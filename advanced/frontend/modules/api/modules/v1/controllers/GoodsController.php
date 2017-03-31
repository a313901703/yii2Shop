<?php 
namespace v1\controllers;

use yii\rest\ActiveController;

class GoodsController extends ActiveController
{
    public $modelClass = 'v1\models\Goods';

    public function actions()
    {
        $actions = parent::actions();
        // // 禁用"delete" 和 "create" 动作
        // unset($actions['delete'], $actions['create']);

        // // 使用"prepareDataProvider()"方法自定义数据provider 
        // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
}
