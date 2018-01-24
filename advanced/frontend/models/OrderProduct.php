<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "order_products".
 *
 * @property integer $id
 * @property integer $nums
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $sale_price
 * @property integer $market_price
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_products';
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
            [['nums', 'order_id', 'product_id', 'price'], 'required'],
            [['cost','propscombi_id'],'default','value'=>0],
            ['props','string'],
            [['nums', 'order_id', 'product_id', 'price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nums' => '数量',
            'order_id' => '订单ID',
            'product_id' => '商品ID',
            'price' => '商品的售价',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'created_by' => '创建人',
            'updated_by' => '修改人',
        ];
    }

    public function getProduct(){
        return $this->hasOne(Goods::className(),['id'=>'product_id']);
    }
}
