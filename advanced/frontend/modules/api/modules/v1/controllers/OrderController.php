<?php 
namespace v1\controllers;

use Yii;
use api\components\Controller;
use v1\models\{Goods};
use app\models\{PayCart,OrderProduct,Orders};
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class OrderController extends Controller
{
    public $modelClass = 'app\models\Orders';

    public function actions()
    {
        $actions = parent::actions();
        // // 禁用"delete" 和 "create" 动作
        unset($actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider(){
        $status = Yii::$app->request->get('status',null);
        $status = $status != 999 ? $status : null;
        $data = $this->findOrders(null,$status);
        return $this->converData($data);
    }

    public function actionView($id){
        $status = Yii::$app->request->get('status',null);
        $rows = $this->findOrders($id,$status);
        $order = current($rows['data']);
        if (!$order) 
            $this->throwBadRequest("订单不存在"); 
        return ['data'=>$order];
    }

    public function actionCreate(){
        $request = Yii::$app->request;
        $payCart = PayCart::getPayCartList();
        $payCart = $payCart['data'];
        if (!$payCart) 
            $this->throwBadRequest('请先添加购物车');
        //开启事务
        $db = Yii::$app->db;
        $result = $db->transaction(function($db) use ($payCart){
            $model = new $this->modelClass();
            foreach ($payCart as $payCartItem) {
                $model->total = (int)$model->total + $payCartItem['price'] * $payCartItem['nums'];
                //减少库存
                $propscombiId = $payCartItem['propscombi_id'];
                $productId = $payCartItem['goods_id'];
                $targetName = $payCartItem['propscombi_id'] ? 'propscombi' : 'goods';
                $targetId = $payCartItem['propscombi_id'] ? $propscombiId : $productId;
                if (!($db->createCommand()->update($targetName,['stock'=>'`stock` - 1'],"stock > 0 and id = $targetId")->execute())) {
                    $name = Goods::find()->select('name')->where(['ID'=>$productId])->scalar();
                    $this->throwBadRequest($name.' 库存不足,无法购买');
                }
                //生成order products
                $_orderProduct = new OrderProduct;
                $_orderProduct->attributes = $payCartItem;
                $_orderProduct->product_id = $productId;
                $_orderProduct->id = null;
                $orderProducts[] = $_orderProduct;
            }
            //保存订单
            $this->saveModel($model);
            $orderId = $model->id;
            foreach ($orderProducts as $orderProduct) {
                $orderProduct->order_id = $orderId;
                $orderProduct->save();
            }
            //清空购物车
            PayCart::clear();
        });
        return ['orderid'=>$orderId];
    }

    public function findOrders($id,$status){
        $query = Orders::findByUser()
            ->select("id,total,status,msg,pay_type,created_by,created_at")
            ->andWhere(['>=','status',0])
            ->andFilterWhere(['status'=>$status,'id'=>$id])
            ->with(['orderProducts'=>function($query){
                $query->select('product_id,props,order_id,op.nums,op.price,goods.name')
                ->alias('op')
                ->leftJoin('goods','goods.id = op.product_id');
            }])->asArray();
        return $this->getActiveDataprovider($query,6);
    }

    private function converData($data){
        foreach ($data['data'] as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
            $row['data'] = $row['orderProducts'];
            unset($row['orderProducts']);
        }
        return $data;
    }
}