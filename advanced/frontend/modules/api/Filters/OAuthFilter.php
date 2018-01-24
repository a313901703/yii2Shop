<?php

namespace api\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;



class OAuthFilter extends ActionFilter
{
    public function beforeAction($action)
    {   
        if (parent::beforeAction($action)) {
            $this->checkAccess($action->getUniqueId());
            return true;
        }
        return false;
    }

    private function checkAccess($uniqueId){
        $userid = Yii::$app->user->id;
        $permissions = Yii::$app->authManager->getPermissionsByUser($userid);
        foreach ($permissions as $pattern => $permission) {
            if (fnmatch($pattern,'/' . $uniqueId)) {
                return true;
            }
        }
        throw new ForbiddenHttpException("you have no access");
    }
    /**
     * 10秒以上时差认为这个请求是非常规的
     * @param  [type] $params [description]
     */
    public function checkTimeValid($timestamp){
        return true;
        if( abs( time() - $timestamp ) > 10  )
            throw new BadRequestHttpException("timestamp out of time", PARAMETER_ERROR);
    }
}