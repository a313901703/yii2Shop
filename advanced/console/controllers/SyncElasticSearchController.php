<?php 

namespace console\controllers;

use Yii;
use frontend\models\esmodels\EsProducts; 
use frontend\models\Goods as Products;

class SyncElasticSearchController extends \yii\console\Controller{
    const ES_PRODUCTS_LIST_KEY = 'elastic_products_lists';
    /**
     * 将数据异步存入es
     * @return [type] [description]
     */
    public function actionProducts(){
        $redis = Yii::$app->redis;
        $redis->database = 1;
        $key = self::ES_PRODUCTS_LIST_KEY;
        $length = $redis->llen($key);
        if ($length)
            return;
        $productIds = [];
        while ($length ) {
            $productIds[] = $redis->lpop($key);
            $length --;
        }
        $products = $this->getProducts($productIds);
        $errIds = $this->setEsProducts($products);
        if ($errIds) {
            echo '商品：'.implode(',', $errIds).'写入ES失败';
        }
    }

    private function getProducts($ids){
        $products = Products::find()
            ->select('id,name,good_note,created_at,updated_at,status,good_brand,good_cate')
            ->asArray()->all();
        return $products;
    }

    private function setEsProducts($products){
        $redis = Yii::$app->redis;
        $redis->database = 1;
        $errIds = [];
        foreach ($products as $model) {
            $esProduct = EsProducts::get($model['id']);
            if ($esProduct === null) {
                $esProduct = new Products;
            }
            $esProduct->name = $model['name'];
            $esProduct->desc = $model['good_note'];
            $esProduct->product_id = $model['id'];
            $esProduct->created_at = $model['created_at'];
            $esProduct->updated_at = $model['updated_at'];
            $esProduct->status = $model['status'];
            $esProduct->brand = $model['good_brand'];
            $esProduct->cate = $model['good_cate'];
            if (!$esProduct->save()) {
                $errIds[] = $model['id'];
                $redis->rpush(self::ES_PRODUCTS_LIST_KEY,$model['id']);
            }
        }
        return $errIds;
    }
}