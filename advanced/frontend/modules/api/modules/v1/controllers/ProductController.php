<?php 
namespace v1\controllers;

use Yii;
use api\components\Controller;
use v1\models\{Goods};
use app\models\{Collection};
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class ProductController extends Controller
{
    public $modelClass = 'v1\models\Goods';
    public function actions()
    {
        $actions = parent::actions();
        // // 禁用"delete" 和 "create" 动作
        unset($actions['view']);
        return $actions;
    }

    public function prepareDataProvider(){
        $limit = Yii::$app->request->get('limit') ?: 10;
        $query = $this->modelClass::find()->active();
        // $data = $this->getActiveDataprovider($query,$limit);
        // $data['data'] = ArrayHelper::index($data['data'],'id');
        return $this->getActiveDataprovider($query,$limit);
    }

    public function actionRecommend(){
        $query = Goods::find()
            ->where(['status'=>0,'recommend'=>1])
            ->with(['images']);
        return $this->getActiveDataprovider($query,6);
    }

    public function actionView($id){
        $model = Goods::find()
            ->select(['id','name','sale_price as price','market_price','(virtual_nums + volume) as volume','stock'])
            ->where(['id'=>$id])
            ->with(['props.propsvalues','propsCombi','images'])
            ->asArray()->one();
        if ($model['propsCombi']) {
           $sale_price = $model['propsCombi'][0]['sale_price'];
           $sale_price .= ' - ' . end($model['propsCombi'])['sale_price'];
           $model['price'] = $sale_price;
           $model['stock'] = array_sum(array_column($model['propsCombi'], 'stock'));
        }
        $collection = $this->findCollection($model['id']);
        $model['collection'] = $collection['status'] ?: 0;
        $model['carousels']  = json_decode($model['images']['carousels'],true) ?: [];
        return ['data'=>$this->serializeData($model)];
    }

    /**
     * 商品收藏
     */
    public function actionCollect($id){
        $request = Yii::$app->request;
        $model = $this->findCollection($id);
        $model->status = $request->get('status');
        $this->saveModel($model);
        return $model->status;
    }

    public function findCollection($id){
        $userid = Yii::$app->user->id;
        if (($model = Collection::findOne(['product_id'=>$id,'created_by'=>$userid])) === null) {
            $model = new Collection;
            $model->product_id = $id;
            $model->created_by = $userid;
        }
        return $model;
    }
}
