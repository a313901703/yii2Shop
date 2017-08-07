<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FreightTemp */

$this->title = '新建模板';
$this->params['breadcrumbs'][] = ['label' => '运费模板', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-temp-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
