<?php 
namespace app\components;

use Yii;
use app\models\MessageLog;
use yii\web\BadRequestHttpException;

/**
 * 手机验证码
 */
class Message
{
    CONST TABLE_NAME = 'message_log'; 

    function __call($method,$args){
        $method = "_$method";
        $model = $this->logBefore($args);
        $return = call_user_func_array(array($this,$method), $args);
        $this->logEnd($model,$return);
        return true;
    }

    public function _send(){
        //TODO 短信接口
        return true;
    }
    //发送日志
    private function logBefore($args){
        $model = new MessageLog;
        $model->attributes = $args[0];
        if (!$model->save()) {
            throw new BadRequestHttpException(json_encode($args[0]));
            $error = array_values($model->getFirstErrors())[0];
            throw new BadRequestHttpException($error);
        }
        return $model;
    }
    public function logEnd($model,$response){
        if ($response === true) {
            $attributes['status'] = 1;
        }else{
            $attributes['status'] = -1;
            $attributes['msg'] = $response['msg'];
        }
        $model->attributes = $attributes;
        $model->save();
    }
}