<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "propscombi".
 *
 * @property integer $id
 * @property string $pids
 * @property integer $goods_id
 * @property integer $sale_price
 * @property integer $cost
 * @property integer $stock
 */
class Propscombi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propscombi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pids', 'sale_price'], 'required'],
            [['goods_id', 'sale_price', 'cost', 'stock'], 'integer'],
            [['cost','stock'],'default','value'=>0],
            ['goods_id','default','value'=>Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods')],
            [['pids'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pids' => '属性id组合',
            'goods_id' => '商品',
            'sale_price' => '价格',
            'cost' => '成本',
            'stock' => '库存',
        ];
    }

    public static function find(){
        return parent::find()->where(['goods_id'=>Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods')]);
    }
}
