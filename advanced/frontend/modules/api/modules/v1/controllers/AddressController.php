<?php 
namespace v1\controllers;

use Yii;
use api\components\Controller;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use app\models\{Region,Address};
//use commom\models\User;

class AddressController extends Controller
{
    public $modelClass = 'app\models\Address';

    public function prepareDataProvider(){
        $models = $this->modelClass::findByUser()->orderBy(['default'=>SORT_DESC,'id'=>SORT_DESC])->indexBy('id')->all();
        return ['data'=>$this->serializeData($models)];
    }

    public function actionCreate(){
        $model = new $this->modelClass();
        $posts = Yii::$app->request->post();
        $model->attributes = $posts;
        $model->province = $posts['district'][0] ?? '';
        $model->city = $posts['district'][1] ?? '';
        $model->county = $posts['district'][2] ?? '';
        if ($model->default) 
            Address::updateAll(['default'=>0],['created_by'=>Yii::$app->user->id]);
        $this->saveModel($model);
        return ['data'=>$this->serializeData($model)];
    }

    public function actionUpdate($id){
        $model = Address::findByUser()->andWhere(['ID'=>$id])->one();
        $posts = Yii::$app->request->post();
        $model->attributes = $posts;
        if ($model->default) 
            Address::updateAll(['default'=>0],['created_by'=>Yii::$app->user->id]);
        $this->saveModel($model);
        return ['data'=>$this->serializeData($model)];
    }
    /**
     * 全国省市
     * @return [type] [description]
     */
    public function actionDistrict(){
        $region = Region::find()
            ->select('id,id as value,name as label,parent_id')
            ->where(['parent_id'=>1])
            ->with(['children'=>function($query){
                $query->select('id,id as value,name as label,parent_id')->with(['children'=>function($query){
                    $query->select('id,id as value,name as label,parent_id');
                }]);
            }])
            ->asArray()->all();
        return ['data'=>$region];
    }
}