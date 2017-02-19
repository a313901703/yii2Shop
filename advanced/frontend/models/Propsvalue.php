<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "propsvalue".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $props_id
 * @property integer $status
 *
 * @property Itemprops $props
 */
class Propsvalue extends \yii\db\ActiveRecord
{
    public $_thumb;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propsvalue';
    }

    public function beforeSave($insert)
    {  
        if(parent::beforeSave($insert)){  
            if($this->isNewRecord){  
                $this->goods_id = Yii::$app->redis->get(Yii::$app->user->id.'_currentGoods');
            }
            return true;  
        }else{  
            return false;  
        }  
    } 

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'props_id'], 'required'],
            [['sort', 'props_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['props_id'], 'exist', 'skipOnError' => true, 'targetClass' => Itemprops::className(), 'targetAttribute' => ['props_id' => 'id']],

            ['_thumb', 'image', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024,'maxWidth'=>100,'maxHeight'=>100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '属性值名',
            'sort' => '排序',
            'props_id' => '属性ID',
            'status' => '状态',
            'thumb' => '缩略图',
            '_thumb' => '缩略图',
        ];
    }

    public static function find(){
        return new CommonQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProps()
    {
        return $this->hasOne(Itemprops::className(), ['id' => 'props_id']);
    }
}
