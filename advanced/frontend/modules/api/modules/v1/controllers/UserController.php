<?php 
namespace v1\controllers;

use Yii;
use app\components\Message;
use api\components\Controller;
use v1\models\User;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
//use commom\models\User;

class UserController extends Controller
{
    public $modelClass = 'v1\models\User';
    public function actions()
    {
        $actions = parent::actions();
        //unset($actions['index']);
        return $actions;
    }

    public function actionLogin(){
        $request = Yii::$app->request;
        $phone = $request->post('phone');
        $user = $this->findModel($phone);
        $user->code = $request->post('code');
        if ($user->signIn()) {
            $data = $user->getAttributes(['username','phone','auth_key']);
            return $data;
        }
        $error = array_values($user->getFirstErrors())[0];
        throw new BadRequestHttpException($error);
    }
    /**
     * 发送手机验证码
     * @return [type] [description]
     */
    public function actionCode($phone){
        $code = 1234;
        $_code = [];
        for ($i=0; $i < 4; $i++) {
            $_code[] = rand(0,9);
        }
        //$code = implode('', $_code);
        $attributes = [
            'phone' => $phone,
            'code' => $code,
            'content' => "【****】 本次验证码为$code,请在一分钟内输入并验证",
            'type' =>'login',
        ];
        //TODO 发送短信验证码
        $message = new Message;
        $message->send($attributes);        
    }

    private function findModel($phone){
        if (($model == User::findByPhone($phone)) === null) {
            $model = new User;
        }
    }
}
