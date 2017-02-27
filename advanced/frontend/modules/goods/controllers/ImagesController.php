<?php

namespace goods\controllers;

use Yii;
use app\models\GoodsImages;
use frontend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class ImagesController extends Controller
{
    
    public function actionIndex(){
        $model = GoodsImages::find()->one();
        if (!$model) {
            $model = new GoodsImages();
        }
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


