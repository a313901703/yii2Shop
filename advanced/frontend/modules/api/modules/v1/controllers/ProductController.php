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
        return $this->findModels(['recommend'=>1]);
    }

    public function actionRecommend(){
        return $this->findModels(['recommend'=>1]);
    }

    public function actionView($id){
        if (!($model = $this->findModels(['id'=>$id])['data'])) {
            throw new BadRequestHttpException("商品不存在");
        }
        $model = current($model);
        // $model = $this->serializeData($model);
        // $collection = $this->findCollection($model['id']);
        // $model['collection'] = $collection['status'] ?: 0;
        return ['data'=>$this->serializeData($model)]; 
    }


    public function findModels($andWhere = null){
        $limit = Yii::$app->request->get('limit') ?: 10;
        $query = Goods::find()
            ->where(['status'=>0])
            ->andFilterWhere($andWhere)
            ->with(['images'])
            ->indexBy('id');
        return $this->getActiveDataprovider($query,$limit); 
    }

    /**
     * 商品收藏
     */
    public function actionCollect(){
        $request = Yii::$app->request;
        $id = $request->get('id');
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
