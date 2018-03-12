<?php 
namespace app\components;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public static function find(){
        return new CommonQuery(get_called_class());
    }

    public static function findByUser($userid = null){
        $userid = $userid ?: Yii::$app->user->id;
        return self::find()->where(['created_by'=>$userid]);
    }
}