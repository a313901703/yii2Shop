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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propsvalue';
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProps()
    {
        return $this->hasOne(Itemprops::className(), ['id' => 'props_id']);
    }
}
