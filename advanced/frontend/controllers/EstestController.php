<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\esmodels\Products; 
/**
 * Site controller
 */
class EstestController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $res = Products::find()
            ->query([
                'multi_match'=>[
                    'query'=>'骁龙',
                    'fields'=>['name','desc'],
                ]
            ])
            ->all();
        return Yii::$app->mailer->process();
    }

    public function actionCreate()
    {
        $models = \app\models\Goods::find()
            ->select('id,name,good_note,created_at,updated_at,status,good_brand,good_cate')
            ->asArray()->all();
        foreach ($models as $model) {
            $product = Products::get($model['id']);
            //$product = new Products;
            $product->name = $model['name'];
            $product->desc = $model['good_note'];
            $product->product_id = $model['id'];
            $product->created_at = $model['created_at'];
            $product->updated_at = $model['updated_at'];
            $product->status = $model['status'];
            $product->brand = $model['good_brand'];
            $product->cate = $model['good_cate'];
            $product->save();
        }
        echo 'success';
    }

}
