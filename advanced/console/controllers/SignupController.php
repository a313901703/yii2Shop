<?php 
namespace console\controllers;

use yii\console\widgets\Table;
use yii\helpers\Console;

class SignupController extends \yii\console\Controller{
    function actionIndex($role = 'admin'){
        $username = $this->prompt('请输入用户名:',['required'=>'true','error'=>'用户名必填']);
        $email = $this->prompt('请输入邮箱地址:',['required'=>'true','error'=>'邮箱地址必填']);
        $passwd = $this->prompt('请输入密码:',['required'=>'true','error'=>'密码必填']);
        echo Table::widget([
            'headers' => ['用户名', '邮箱', '角色','密码'],
            'rows' => [
                [$username, $email, $role ,$passwd],
            ],
        ]);
        if ($this->confirm('是否确认创建用户?')) {
            echo '创建成功';
        }else{
            echo '已取消';
        }
    }
}

 ?>