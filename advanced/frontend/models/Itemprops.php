<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemprops".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $type
 *
 * @property Propsvalue[] $propsvalues
 */
class Itemprops extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itemprops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort', 'type'], 'integer'],
            [['name'], 'string', 'max' => 50],

            ['type','default','value'=>2],
            ['type','in','range'=>[1,2,3]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '属性名',
            'sort' => '排序',
            'type' => '类型',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropsvalues()
    {
        return $this->hasMany(Propsvalue::className(), ['props_id' => 'id']);
    }
}
