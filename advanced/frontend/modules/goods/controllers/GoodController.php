<?php

namespace app\modules\goods\controllers;

use Yii;
use app\models\Goods;
use app\models\search\Goods as GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use arogachev\excel\import\advanced\Importer;
use yii\helpers\Html;


/**
 * GoodController implements the CRUD actions for Goods model.
 */
class GoodController extends Controller
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
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) 
                return $this->redirect(['index']);
            else{
                Yii::$app->session->setFlash('warning', array_values($model->getFirstErrors())[0]);
            }
        } 
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) 
                return $this->redirect(['index']);
            else{
                Yii::$app->session->setFlash('warning', array_values($model->getFirstErrors())[0]);
            }
        } 
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExport(){
        $importer = new Importer([
            'filePath' => Yii::getAlias('@webroot/excel/test.xlsx'),
            'standardModelsConfig' => [
                [
                    'className' => Goods::className(),
                    'standardAttributesConfig' => [
                        [
                            'name' => 'good_no',
                            //'valueReplacement' => 1,
                        ],
                        [
                            'name' => 'id',
                            'valueReplacement' => function ($value) {
                                return $value ? Html::tag('p', $value) : '';
                            },
                        ],
                        [
                            'name' => 'name',
                            'valueReplacement' => function ($value) {
                                return $value ? Html::tag('p', $value) : '';
                                //return Goods::find()->select('id')->where(['name' => $value]);
                            },
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
