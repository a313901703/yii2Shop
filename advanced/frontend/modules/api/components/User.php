<?php

namespace aod\components;

use Yii;
use yii\web\BadRequestHttpException;

use app\models\User;
use app\models\{Advertiser,Agent};
use app\models\User\{Resource as UserResource};
use yii\helpers\ArrayHelper;


class User extends \yii\web\User
{
    public $_id;
    public function init(){
        $this->on(self::EVENT_AFTER_LOGIN, [$this, 'setUser']);
    }

    public function setUser(){
        
    }
}