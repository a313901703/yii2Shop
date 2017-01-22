<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $pid
 * @property string $pid_sign
 * @property integer $created_at
 * @property integer $created_by
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by'], 'required'],
            [['sort', 'pid', 'created_at', 'created_by'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['pid_sign'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名',
            'sort' => '排序',
            'pid' => '父级',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ];
    }
}
