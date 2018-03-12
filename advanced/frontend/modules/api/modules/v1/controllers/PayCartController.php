<?php 
namespace v1\controllers;

use Yii;
use api\components\Controller;
use app\models\{PayCart,Propscombi,Propsvalue,Goods};
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class PayCartController extends Controller
{
    public $modelClass = 'app\models\PayCart';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider(){
        return PayCart::getPayCartList();
    }

    public function actionCreate(){
        $request = Yii::$app->request;
        $model = $this->findModelByProduct();
        $model->nums = (int)$model->nums + $request->post('nums');
        //Yii::info($request->post());
        $this->saveModel($model);
        return 'success';
    }

    public function actionUpdate($id){
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->nums = $request->post('nums');
        $this->saveModel($model);
        return $this->prepareDataProvider();
    }

    public function actionDelete($id){
        $this->findModel($id)->delete();
        return $this->prepareDataProvider();
    }

    private function findModel($id){
        if (($model = PayCart::find()->where(['id'=>$id])->createdBy()->one()) === null) {
            throw new BadRequestHttpException("商品信息不存在");
        }
        return $model;
    }

    private function findModelByProduct(){
        $request = Yii::$app->request;
        $model = PayCart::find()
            ->where(['goods_id'=>$request->post('productId')])
            ->andWhere(['propscombi_id'=>$request->post('propsCombiId')])
            ->createdBy()
            ->one();
        if ($model === null) {
            $model = new PayCart;
            $model->goods_id = $request->post('productId');
            $model->propscombi_id = $request->post('propsCombiId');
        }
        return $model;
    }
}