<?php
namespace api\components;

use Yii;
use yii\data\{Pagination,ActiveDataProvider};
use yii\helpers\{Json,ArrayHelper};
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\filters\auth\{QueryParamAuth,HttpBasicAuth};
use api\filters\OAuthFilter;
use frontend\traits\CommFunc;

/**
* 
*/
class Controller extends ActiveController
{
    use CommFunc;
    public function actions()
    {
        $actions = parent::actions();
        //禁用 "delete"动作
        unset($actions['delete'],$actions['create'],$actions['update']);
        //兼容curd外的action
        $_act = Yii::$app->request->get('_act');
        $_act = $_act ? 'action'.ucfirst($_act) : '';
        if ($_act && $this->checkActionExist($_act)) {
            $actions['index']['prepareDataProvider'] = [$this, $_act];
        }elseif($this->checkActionExist('prepareDataProvider')){
            $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        }
        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam'=>'token', 
        ];
        $behaviors = ArrayHelper::merge($behaviors,[OAuthFilter::className()]);
        return $behaviors;
    }   

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD' , 'POST'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH','POST'],
            'delete' => ['DELETE'],
            'add' => ['POST'],
        ];
    }

    public function checkActionExist($action){
        $methods = get_class_methods($this);
        return in_array($action, $methods);
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
    public function getActiveDataprovider($query,$pageSize = 10,$sort = [],$withCount = true){
        $sort = ['defaultOrder'=>ArrayHelper::merge(['id'=>SORT_DESC],$sort)];
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>$pageSize],
            'sort' => $sort,
        ]);
        $data = ['data'=>$this->serializeData($provider)];
        if ($withCount) 
            $data['count'] = $this->getDataproviderCount($provider);
        return $data;
    }

    private function getDataproviderCount($provider){
        return [
            'page'=>Yii::$app->request->get('page',1),
            'count'=>$provider->totalCount,
        ];
    }

    public function saveModel($model){
        if (!$model->save()) {
            $error = array_values($model->getFirstErrors())[0];
            throw new BadRequestHttpException($error);
        }
    }

    protected function serializeData($data)
    {
        return Yii::createObject(['class'=>$this->serializer,'preserveKeys'=>3])->serialize($data);
    }
}



