<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods_images".
 *
 * @property integer $id
 * @property string $thumb
 * @property string $carousels
 * @property integer $goods_id
 */
class GoodsImages extends \yii\db\ActiveRecord
{
    public $_thumb;
    public $_carousels;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thumb', 'carousels'], 'required'],
            ['goods_id','default','value'=>Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods')],
            [['thumb', 'carousels'], 'string', 'max' => 255],

            ['_thumb', 'image', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024,'maxWidth'=>200,'maxHeight'=>150],
            ['_carousels', 'image', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024,'maxWidth'=>800,'maxHeight'=>200,'maxFiles'=>5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'thumb' => '商品缩略图',
            'carousels' => '轮播',
            'goods_id' => '商品ID',

            '_thumb' => '商品缩略图',
            '_carousels' => '轮播',

        ];
    }

    public static function find(){
        return parent::find()->where(['goods_id'=>Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods')]);
    }
}
