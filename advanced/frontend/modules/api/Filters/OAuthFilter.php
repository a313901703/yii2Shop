<?php

namespace api\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\ArrayHelper;

use app\components\{ReturnInfo,HttpException};
use yii\web\BadRequestHttpException;
use app\models\User;
use aod\components\User as webUser;



class OAuthFilter extends ActionFilter
{
    public function beforeAction($action)
    {   
        if (parent::beforeAction($action)) {
            $params = Yii::$app->request->get();
            $this->checkQueryParams($params);
            $this->checkTimeValid($params["timestamp"]);
            $this->checkSignature($params);
            return true;
        }
        return false;
    }
    /**
     * 检验参数是否存在
     * @param  [type] $params [description]
     */
    public function checkQueryParams($params){
        $queryParams = ['appid','timestamp','signature'];
        foreach ($queryParams as $key => $queryParam) {
            if (!ArrayHelper::getValue($params,$queryParam)) 
                throw new BadRequestHttpException($queryParam." is required", PARAMETER_ERROR);
        }
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

    /**
     * 验证signature
     * @param  [type] $params [description]
     * @param  [type] $user   [description]
     * @return [type]         [description]
     */
    public function checkSignature($params) {
        $user = Yii::$app->user->identity;
        $accessToken = $user->access_token;
        if ($params["signature"] != sha1($accessToken . '&' . $params["appid"] .'&'. $params["timestamp"])) 
            throw new BadRequestHttpException("signature error", PARAMETER_ERROR);
    }
}