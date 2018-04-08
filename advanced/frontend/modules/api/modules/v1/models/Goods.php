<?php 

namespace v1\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
* 
*/
class Goods extends \app\models\Goods
{
    public function fields()
    {
        return [
            // 字段名和属性名相同
            'id',
            // 字段名为"name", 值由一个PHP回调函数定义
            'name',
            'images',
            'price'=>function($model){
                return $model['sale_price'] / 100;
            },
            'market_price'=>function($model){
                return $model['market_price'] / 100;
            },
            'volume'=>function($model){
                return $model['virtual_nums'] + $model['volume'];
            },
            'stock',
            'thumb'=>function($model){
                return $model['images'] ? $model['images']['thumb'] : '';
            },
            'good_note',
            'carousels'=>function($model){
                return $model['images'] ? json_decode($model['images']['carousels'],true) : [];
            },
        ];
    }

    public function extraFields(){
        return [
            'props'=>function($model){
                $props = \app\models\Itemprops::find()->where(['goods_id'=>$model->id])
                    ->with('propsvalues')
                    ->asArray()
                    ->all();
                return $props;
            },
            'propsCombi',
            'collection'=>function($model){
                if (($collection = \app\models\Collection::findOne(['product_id'=>$model['id'],'created_by'=>Yii::$app->user->id])) === null) {
                    return 0;
                }
                return $collection['status'];
            }
        ];
    }

}