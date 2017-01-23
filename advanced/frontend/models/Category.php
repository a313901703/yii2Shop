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

    public function beforeSave($insert)
    {  
        if(parent::beforeSave($insert)){  
            if($this->isNewRecord){  
                $this->created_at = time();  
                $this->created_by = Yii::$app->user->id;  
                $this->status = Yii::$app->params['activeStatus'];
                if ($this->pid != 0) {
                    $model = self::findOne($this->pid);
                    if ($model === null) {
                        return false;
                    }
                    if ($model->pid == 0) {
                        $this->pid_sign = $this->pid.',';
                    }else{
                        $this->pid_sign = $model->pid_sign.','.$this->pid.',';
                    }
                }else{
                    $this->pid_sign = 0;
                }
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

            [['pid_sign'], 'string', 'max' => 255],
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
}
