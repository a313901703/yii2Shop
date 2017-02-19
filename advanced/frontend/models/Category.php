<?php

namespace app\models;

use Yii;
use frontend\components\SubTree;
//use app\models\customize\CommonQuery;


/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $pid
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

    public function beforeSave($insert)
    {  
        if(parent::beforeSave($insert)){  
            if($this->isNewRecord){  
                $this->created_at = time();  
                $this->created_by = Yii::$app->user->id;  
                $this->status = Yii::$app->params['activeStatus'];
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
            ['name', 'required'],
            [['name'], 'string', 'max' => 50],

            [['sort', 'pid'], 'integer'],

            [['status','pid'],'default','value'=>0],
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
            'created_at' => '创建时间',
        ];
    }

    /**
     * @inheritdoc
     * @return CommonQuery
     */
    public static function find()
    {
        return new CommonQuery(get_called_class());
    }

    /**
     * 获取分类树
     * @param  [type] $format [添加format]
     * @return [Array]        [分类树]
     */
    public static function getSubTree($format = false){
        return SubTree::getSubTree(static::find()->asArray()->all(),$format);
    }
}
