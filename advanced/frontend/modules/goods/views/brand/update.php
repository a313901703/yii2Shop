<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = 'Update Brand: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '品牌','url' => ['/goods/brand']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
