<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\components\ActiveRecord;


/**
 * This is the model class for table "pay_cart".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property integer $nums
 * @property integer $created_at
 */
class PayCart extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pay_cart';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'required'],
            ['goods_id','exist',
                'targetClass'=>'\app\models\Goods',
                'targetAttribute'=>'id',
                'filter'=>['show'=>0],
            ],
            ['propscombi_id','exist',
                'targetClass'=>'\app\models\Propscombi',
                'targetAttribute'=>'id',
                'filter'=>['goods_id'=>$this->goods_id],
                'when'=>function($model){
                    return $model->propscombi_id;
                }
            ],
            [['goods_id', 'nums','propscombi_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品ID',
            'created_by' => '创建人',
            'nums' => '数量',
            'created_at' => '创建时间',
        ];
    }

    public static function getPayCartList(){
        $models = self::find()->createdBy()->with(['product','propsCombi'])->indexBy('id')->all();
        $cartItems = [];
        foreach ($models as $_id => $model) {
            $cartItem = $model->getAttributes(['id','goods_id','propscombi_id','nums']);
            //product
            $product  = $model['product'];
            $cartItem['product_name'] = $product['name'];
            //propsCombi
            $propsCombi = $model['propsCombi'];
            $cartItem['props'] = '';
            if ($propsCombi) {
                $props = Propsvalue::find()
                    ->where("id in (" .$propsCombi['pids'] . ")")
                    ->with('props')
                    ->asArray()
                    ->all();
                foreach ($props as $item) {
                    $cartItem['props'] .=  $item['props']['name'] . ' : ' .$item['name'] .',';
                }
                $cartItem['price'] = $propsCombi['sale_price'];
                $cartItem['cost'] = $propsCombi['cost'];
                $cartItem['stock'] = $propsCombi['stock'];
            }else{
                $cartItem['price'] = $product['sale_price'];
                $cartItem['cost'] = $product['cost'];
                $cartItem['stock'] = $product['stock'];
            }
            $cartItems[$_id] = $cartItem;
        }
        $count = ['nums'=>0,'price'=>0];
        foreach ($cartItems as $cartItem) {
            $count['nums'] += $cartItem['nums'];
            $count['price'] += $cartItem['price'] * $cartItem['nums'];
        }
        return ['data'=>$cartItems,'count'=>$count];
    }

    public static function clear($userId = null){
        $userId = $userId ?: Yii::$app->user->id;
        return self::deleteAll(['created_by'=>$userId]);
    }

    public function getProduct(){
        return $this->hasOne(Goods::className(),['id'=>'goods_id']);
    }

    public function getPropsCombi(){
        return $this->hasOne(Propscombi::className(),['id'=>'propscombi_id']);
    }
}
