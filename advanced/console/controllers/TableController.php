<?php 
namespace console\controllers;

use yii\console\widgets\Table;

class TableController extends \yii\console\Controller{
    function actionIndex(){
        echo Table::widget([
            
        ]); 
    }
}

 ?>