<?php

namespace goods\controllers;

use Yii;
use app\models\GoodsImages;
use frontend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class ImagesController extends Controller
{
    
    public function actionIndex(){
        $model = GoodsImages::find()->products()->one();
        if (!$model) 
            $model = new GoodsImages();
        else
            $model->_carousels = Json::decode($model->carousels,true);
        if ($model->load(Yii::$app->request->post())) {
            $this->uploadImg($model,'_thumb','thumb');
            $this->uploadImgs($model,'_carousels','carousels');
            $this->saveModel($model);
            return $this->refresh();
        }
        return $this->render('index',[
            'model'=>$model,
        ]);
    }

}


