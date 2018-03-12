<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $parent_id
 * @property integer $level
 * @property double $order
 * @property string $en_name
 * @property string $en_shot_name
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'name', 'parent_id', 'level', 'order', 'en_name', 'en_shot_name'], 'required'],
            [['id', 'parent_id', 'level'], 'integer'],
            [['order'], 'number'],
            [['code', 'name', 'en_name'], 'string', 'max' => 100],
            [['en_shot_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'level' => 'Level',
            'order' => 'Order',
            'en_name' => 'En Name',
            'en_shot_name' => 'En Shot Name',
        ];
    }

    public function getChildren(){
        return $this->hasMany(Region::className(), ['parent_id' => 'id']);
    }
}
