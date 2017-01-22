<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $thumb
 * @property integer $sort
 * @property integer $created_at
 * @property integer $created_by
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
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
            [['name', 'thumb'], 'required'],
            ['sort', 'integer'],
            [['sort','status'], 'default','value'=>0],
            [['name'], 'string', 'max' => 50],
            //检查 "primaryImage" 是否为 PNG, JPG 格式的上传图片,且文件小于1M
            ['thumb', 'file', 'extensions' => ['png', 'jpg'],'skipOnEmpty' => false, 'maxSize' => 1024*1024*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '品牌名',
            'thumb' => '缩略图',
            'sort' => '排序',
            'created_at' => '创建时间',
            'created_by' => '创建人',
        ];
    }
}
