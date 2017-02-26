<?php

namespace frontend\components;

use Yii;
use yii\base\InlineAction;
use yii\data\ActiveDataProvider;
use yii\helpers\{Url,Json,ArrayHelper};
use yii\web\{Controller as baseController,Response};
use yii\web\NotFoundHttpException;

use frontend\components\{UploadImg};


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

    public function saveModel($model){
        if ($model->save()) 
            return true;
        Yii::$app->session->setFlash('alert', ['type'=>'warning','title'=>'錯誤','text'=>array_values($model->getFirstErrors())[0]]);
        return false;
    } 

    public function setWarningFlash($text){
        Yii::$app->session->setFlash('alert', ['type'=>'warning','title'=>'錯誤','text'=>$text]);
    }

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
     * @param  [type] $pagination 分页
     * @param  [type] $sort 排序
     * @return [obj]         ActiveDataprovider
     */
    public function getActiveDataprovider($query,$pagination = [],$sort = []){
        $pagination = ArrayHelper::merge(['pageSize' => 20],$pagination);
        $sort = ArrayHelper::merge(['defaultOrder'=>['id' => SORT_DESC]],$sort);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
        return $provider;
    } 

    /**
     * 图片上传
     */
    public function uploadImg(&$model,$_attr,$attr){
        $uploadImg = UploadImg::uploadImgNew($model,$_attr,$attr);
        if ($uploadImg !== true) {
            Yii::$app->session->setFlash('alert',['type'=>'warning','title'=>'錯誤','text'=>$uploadImg]);
        }
    }

    /**
     * 以json格式返回数据
     */
    public function returnData($data,$status = '200'){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['data'=>$data,'status'=>$status];
        $response->send();
    }
}