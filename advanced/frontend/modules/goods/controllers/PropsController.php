<?php

namespace app\modules\goods\controllers;

use Yii;
use app\models\Goods;
use app\models\search\Goods as GoodsSearch;
use frontend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PropsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all props models.
     * @return mixed
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * Lists all props models.
     * @return mixed
     */
    public function actionCreate()
    {
        
        return $this->render('create');
    }
}

