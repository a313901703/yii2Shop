<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
* 
*/
class GlobalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'frontend\components\ErrorAction',
            ],
        ];
    }
}