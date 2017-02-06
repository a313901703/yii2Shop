<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-search">

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
    </div>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group btn-group">
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('查找', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
