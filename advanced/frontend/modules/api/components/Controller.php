<?php
namespace aod\components;

use Yii;
use yii\data\{Pagination,ActiveDataProvider};
use yii\helpers\{Json,ArrayHelper};
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\filters\auth\QueryParamAuth;

use app\components\{
    HttpException, ReturnInfo
};
use api\filters\OAuthFilter;
use app\models\Agent\CostRule;


/**
* 
*/
class Controller extends ActiveController
{
    public $request;
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        //格式化输出
        Yii::$app->response->on(yii\web\Response::EVENT_BEFORE_SEND, function($event){
            $response = $event->sender;
            if($response->data){
                $data['status'] = $response->isSuccessful ? 0 : 1;
                $data['msg'] = $response->isSuccessful ? $response->data : $response->data['message'];
                $response->statusCode = $response->status;
                $response->data = $data;
            }
        });
        $this->request = Yii::$app->request;
    }

    public function actions()
    {
        $actions = parent::actions();
        //禁用 "delete"动作
        unset($actions['delete'],$actions['create'],$actions['update']);
        return $actions;
    }

    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator'] = [
    //         'class' => QueryParamAuth::className(),
    //         'tokenParam'=>'appid'
    //     ];
    //     $behaviors = ArrayHelper::merge($behaviors, [OAuthFilter::className()]);
    //     return $behaviors;
    // }


    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH','POST'],
            'delete' => ['DELETE'],
        ];
    }

    // public function beforeAction($action)
    // {
    //     if(parent::beforeAction($action)){
    //         $getParams  = $this->request->get();
    //         if($this->request->isPost){
    //             $postParams = $this->request->post();
    //         }else{
    //             $postParams = [];
    //         }
    //         $params = array_merge($getParams, $postParams);
    //         $type   = $this->id.' /'.$this->action->id;
    //         //写入日志
    //         $this->writeLog($type, $params);
    //         return true;
    //     }
    //     return false;
    // }

    /*
     * 记录日志
     * @params $action     接口类型
     * @params $getParams  get参数
     * @params $postParams post参数  
     */
    protected function writeLog($action, $params){
        $message = '['.Json::encode($params).']';
        Yii::getLogger()->log('action:'.$action.'-----params:'.$message, \yii\log\Logger::LEVEL_INFO,"aod");
    }

    /**
     * 数据提供器 用于restApi分页
     * @param  [type] $query  activeQuery
     * @param  [type] $pageSize 
     * @param  [type] $sort 排序
     * @return [array] 
     */
    public function getActiveDataprovider($query,$pageSize = 10,$sort = []){
        $sort = ['defaultOrder'=>ArrayHelper::merge(['ID'=>SORT_DESC],$sort)];
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>$pageSize],
            'sort' => $sort,
        ]);
        $conf = [
            'total_num'=>$provider->totalCount,
            'page_size'=>$pageSize, 
            'page'=>$this->request->get('page',1)
        ];
        return [$provider->getModels(),$conf];
    } 

    public function saveModel($model){
        if (!$model->save()) {
            $error = array_values($model->getFirstErrors())[0];
            throw new BadRequestHttpException($error);
        }
    }

    protected function getCostRule($type = 0, $campaignid = 0, $gross_bid = 0)
    {
        $advertiserid = AOD_ADVERID;

        $result = ['rule' => 2, 'price' => $gross_bid];

        $CostRuleModel = CostRule::find()
            ->where('advertiserid = :advertiserid and campaignid = :campaignid')
            ->addParams([':advertiserid' => $advertiserid, ':campaignid' => $campaignid])
            ->one();

        if (empty($CostRuleModel)) {
            $CostRuleModel = CostRule::find()
                ->where('advertiserid = :advertiserid and campaignid = :campaignid')
                ->addParams([':advertiserid' => $advertiserid, ':campaignid' => 0])
                ->one();
        }

        if ($type == 1) {
            $rule = !empty($CostRuleModel) ? $CostRuleModel->rule : 2;
            return $rule;
        }

        if (empty($CostRuleModel) || $CostRuleModel->rule == 2) {
            return $result;
        } elseif ($CostRuleModel->rule == 1) {
            $ratio = $CostRuleModel->ratio ?? 0;
            $price = round($gross_bid / (1 + $ratio / 100), 2);
            $result = ['rule' => $CostRuleModel->rule, 'price' => $price];
            return $result;
        }
    }

}



