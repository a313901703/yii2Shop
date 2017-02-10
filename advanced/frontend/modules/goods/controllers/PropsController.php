<?php

namespace app\modules\goods\controllers;

use Yii;
use app\models\{Itemprops,Propsvalue};
use frontend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PropsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all props models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Itemprops();
        if ($model->load(Yii::$app->request->post())) {
            $this->saveModel($model);
            return $this->redirect(['index']);
        } 
        $query = Itemprops::find()->where(['type'=>2])->with(['propsvalues']);
        $provider = $this->getActiveDataprovider($query,['pageSize'=>20,'sort'=>['sort' => SORT_DESC,'id' => SORT_DESC]]);
        return $this->render('index', [
            'model' => $model,
            'provider' => $provider
        ]);
    }

    public function actionCreate($pid)
    {
        $valueModel = new Propsvalue();
        $model = $this->findModel($pid);
        if ($post = Yii::$app->request->post()){
            print_r($post);exit;
        }
        return $this->render('create',['model'=>$model,'valueModel'=>$valueModel]);
    }

    public function actionUpdate($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
            $this->saveModel($model);
            return $this->redirect(['index']);
        }
        return $this->render('_form',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    
    protected function findModel($id){
        if (($model = Itemprops::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在');
        }
    }
}

