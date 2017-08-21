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
    const ROLE_ADMIN = 1;//系统超级管理员
    const ROLE_MANAGER = 20;//iclick客户经理
    const ROLE_AGENT = 21;//代理商经理
    const ROLE_AGENT_OPERATOR = 22;//代理商运营
    const ROLE_AE = 23; //AE
    const ROLE_DATAUSER = 24;//数据用户

    public $opt_id;
    public $allAdvers;
    public $allAgents;
    //public $current;

    public function init(){
        $this->on(self::EVENT_AFTER_LOGIN, [$this, 'setUser']);
    }

    public function setUser(){
        $this->setAgents();
        $this->setAdvertisers();
    }

    public function setAgents(){
        $roleid = $this->identity->roleid;
        $query = Agent::find()->select('ID,name')->where(['type'=>AGENT_TYPE]);
        switch ($roleid) {
            case ROLE_ADMIN:
                break;
            case ROLE_AGENT:
                $agentids = UserResource::find()->select('resourceid')->where(['resource_type'=>'agent','userid'=>$this->ID])->column();
                $query->andWhere(['ID'=>$agentids]);
                break;
            default:
                $query->andWhere(['ID'=>0]);
                break;
        }
        $agents = $query->asArray()->all();
        if (!$agents) 
            throw new BadRequestHttpException('没有分配可用的代理商');
        $this->allAgents = $agents;
    }

    public function getAgents(){
        return ArrayHelper::getColumn($this->allAgents,'ID');
    }

    public function setAdvertisers(){
        $this->allAdvers = $this->getAllowAdvers();
    }

    public function getAdvertisers(){
        return ArrayHelper::getColumn($this->allAdvers,'ID');
    }

    public function getCurrentAgent($key = ''){
        return null;
    }

    public function getCurrentAdvertiser($key='')
    {
        return null;
    }

    //所有可操作的广告主
    public function getAllowAdvers($agentid = null){
        $roleid = $this->identity->roleid;
        $agents = $agentid ? $agentid : ($this->allAgents ?: [0]);
        $query = Advertiser::find()->select('ID,name')->where('status>=0')->andWhere(['agentid'=>$agents]);
        //对代理商下所有广告主拥有权限
        if (!in_array($roleid,[self::ROLE_ADMIN,self::ROLE_MANAGER,  self::ROLE_AE,self::ROLE_AGENT])){
            $adverIds = UserResource::findByNormalStatus()->select('resourceid')->andWhere(['userid'=>$this->id,'resource_type'=>'advertiser','status'=>0])->column();
            $query->andWhere(['ID'=>$adverIds]);
        }
        $advers = $query->asArray()->all();
        return $advers;
    }
}