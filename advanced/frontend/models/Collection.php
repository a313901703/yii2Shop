<?php

namespace app\models;

use Yii;
use app\components\ActiveRecord;


/**
 * This is the model class for table "collection".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_at
 */
class Collection extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            ['created_by','default','value'=>Yii::$app->user->id],
            ['updated_at','default','value'=>time()],
            [['product_id', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => '商品ID',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_at' => '修改时间',
        ];
    }
}
