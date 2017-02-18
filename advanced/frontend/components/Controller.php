<?php

namespace frontend\components;

use Yii;
use yii\base\InlineAction;
use yii\data\ActiveDataProvider;
use yii\helpers\{Url,Json};
use yii\web\{Controller as baseController,Response};
use yii\web\NotFoundHttpException;



class Controller extends baseController
{
	const DELETE_STATUS = -1;
	const ACTIVE_STATUS = 0;
	const PAUSE_STATUS  = 1;

    /**
     * controller初始化
     */
    // public function init()
    // {
    // }

    /**
     * 删除，默认status
     */
    public function delete($model,$attribute = 'status'){
    	$model->$attribute = self::DELETE_STATUS;
    	return $model->save();
    }
   
    /**
     * 获取redis实例
     */
    public function getRedis(){
        return Yii::$app->redis;
    }

    /**
     * 获取ActiveDataprovider   用于GridView
     * @param  [type] $query  查询条件
     * @param  [type] $params 参数
     * @return [obj]         ActiveDataprovider
     */
    public function getActiveDataprovider($query,$pagination = ['pageSize' => 20],$sort = ['defaultOrder'=>['id' => SORT_DESC]]){
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
        return $provider;
    } 

    public function saveModel($model){
        if ($model->save()) 
            return true;
        else
            Yii::$app->session->setFlash('alert', ['type'=>'warning','text'=>array_values($model->getFirstErrors())[0]]);
        return false;
    } 

}