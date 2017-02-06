<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

   <?php $form = ActiveForm::begin([
        'options'=>['class'=>'search-form'],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="form-inline-group">
        <div class="form-group">
            <?= Html::activeLabel($model, 'name', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'name', ['class' => 'form-flex3 form-control']) ?>
        </div>

        <div class="form-group">
            <?= Html::activeLabel($model, 'pid', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'pid', ['class' => 'form-flex3 form-control']) ?>
        </div>
    </div>

    <div class="form-group btn-group">
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('查找', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
