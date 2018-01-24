<?php 

namespace v1\models;

use Yii;
use common\models\User as commUser;
use yii\helpers\ArrayHelper;


class User extends commUser
{
    public $code;

    public function fields()
    {
        return [
            'id',
            'username',
            'auth_key',
            'phone',
            'status',
        ];
    }

    public function rules()
    {
        return [
            ['phone', 'trim'],
            ['phone', 'required','message'=>'请输入正确的手机号码'],
            //['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号已注册'],
            ['phone', 'match', 'pattern' => '/^1[3|5|7|9][0-9]{9}/','message'=>'请输入正确的手机号码'],

            ['code', 'required'],
            ['code', 'match', 'pattern' => '/[0-9]{4}/','message'=>'验证码错误'],
            ['code', 'exist', 
                'targetClass' => '\app\models\MessageLog', 
                'filter' => ['and',['status'=>1],['>=','created_at',time() - 60],['phone'=>$this->phone]],
                'message' => '验证码错误'
            ],
            ['username','default','value'=>Yii::$app->name . '__' . time().rand(1000,9999)],
            ['password','default','value'=>'123456'],
            ['status','default','value'=>9],
        ];
    }

    public function signIn()
    {
        if ($this->validate() ) {
            if ($this->isNewRecord) {
                $user->generateAuthKey();
                $this->save();
                //添加到角色
                $auth = Yii::$app->authManager;
                $authRole = $auth->getRole('api_vi_登录');
                $auth->assign($authRole,$user->getId());
            }
            return true;
        } else {
            return false;
        }
    }
}