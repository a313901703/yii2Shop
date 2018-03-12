<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '属性', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $propsModel->name, 'url' => ['create','pid'=>$propsModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_valueForm', [
    'model' => $model,
]) ?>
