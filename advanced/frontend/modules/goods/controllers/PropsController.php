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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $query = Itemprops::find()->where(['type'=>2])->with(['propsvalues']);
            $provider = $this->getActiveDataprovider($query,['pageSize'=>20,'sort'=>['sort' => SORT_DESC,'id' => SORT_DESC]]);
            return $this->render('index', [
                'model' => $model,
                'provider' => $provider
            ]);
        }
    }

    /**
     * Lists all props models.
     * @return mixed
     */
    public function actionCreate($pid)
    {
        $model = new Propsvalue();
        
        return $this->render('create');
    }

    /**
     * Lists all props models.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        return $this->render('_form',['model'=>$model]);
    }

    protected function findModel($id){
        if (($model = Itemprops::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

