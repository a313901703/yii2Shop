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
            $model = new Itemprops();
        } 
        $query = Itemprops::find()->andWhere(['type'=>2])->with(['propsvalues']);
        $provider = $this->getActiveDataprovider($query,[],['defaultOrder'=>['sort' => SORT_DESC,'id' => SORT_DESC]]);
        return $this->render('index', [
            'model' => $model,
            'provider' => $provider
        ]);
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
   
    //创建和展示属性值
    public function actionCreate($pid)
    {
        $model = new Propsvalue();
        $propsModel = $this->findModel($pid);
        if ($model->load(Yii::$app->request->post())){
            $model->props_id = $pid;
            $this->uploadImg($model,'_thumb','thumb');
            $this->saveModel($model);
            return $this->refresh();
        }
        $query = Propsvalue::find()->where(['props_id'=>$pid])->goods();
        $provider = $this->getActiveDataprovider($query,['pageSize'=>20],['defaultOrder'=>['sort' => SORT_DESC,'id' => SORT_DESC]]);
        return $this->render('create',['model'=>$model,'propsModel'=>$propsModel,'provider'=>$provider]);
    }

    //修改属性值
    public function actionUpdateValue($id)
    {
        $model = $this->findValueModel($id);
        $propsModel = $this->findModel($model->props_id);
        if ($model->load(Yii::$app->request->post())){
            $this->uploadImg($model,'_thumb','thumb');
            $this->saveModel($model);
            return $this->redirect(['create','pid'=>$propsModel->id]);
        }
        return $this->render('updateValue',['model'=>$model,'propsModel'=>$propsModel]);
    }

    //删除属性值
    public function actionDeleteValue($id)
    {
        $model = $this->findValueModel($id);
        $propsModel = $this->findModel($model->props_id);
        $model->delete();
        return $this->redirect(['create','pid'=>$propsModel->id]);
    }

    /**
     * findModel by id
     */
    protected function findValueModel($id){
        if (($model = Propsvalue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在');
        }
    }

    protected function findModel($id){
        if (($model = Itemprops::find()->where(['id'=>$id,'type'=>2])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面不存在');
        }
    }
}

