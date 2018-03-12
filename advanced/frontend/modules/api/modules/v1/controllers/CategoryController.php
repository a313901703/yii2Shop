<?php 
namespace v1\controllers;

use Yii;
use api\components\Controller;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class CategoryController extends Controller
{
    public $modelClass = 'app\models\Category';

    public function prepareDataProvider(){
        $models = $this->modelClass::find()->select('id,name,sort,img,pid')
            ->with(['children'=>function($query){
                return $query->select('id,name,sort,img,pid')->orderBy(['sort'=>SORT_DESC,'id'=>SORT_ASC]);
            }])
            ->orderBy(['sort'=>SORT_DESC,'id'=>SORT_ASC])
            ->where(['pid'=>0])
            ->asArray()
            ->all();
        return ['data'=>$models];
    }
}