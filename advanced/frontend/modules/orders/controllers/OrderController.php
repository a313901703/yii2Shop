<?php

namespace orders\controllers;

use Yii;
use frontend\components\Controller;
use app\service\Orders as OrdersService;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{
    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersService();
        $query = $searchModel->search(Yii::$app->request->queryParams);
        $query->with('products.product');
        $dataProvider = $this->getActiveDataprovider($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id){
        if (($model = OrdersService::findOne($id)) === null ) {
            throw new NotFoundHttpException("订单信息不存在");
        }
        return $model;
    }

}
