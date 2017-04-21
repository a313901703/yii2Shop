<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FreightTemp */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '运费模板', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>
<div class="freight-temp-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
