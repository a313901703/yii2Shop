<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FreightTemp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="freight-temp-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group flex\">{label}{input}</div>\n{error}",
        ]
    ]); ?>

    <div class="form-groups flex">
        <?= $form->field($model, 'name') ?>
    </div>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'base_freight')->textInput() ?>

    <?= $form->field($model, 'renew')->textInput() ?>

    <?= $form->field($model, 'whether_post')->textInput() ?>

    <?= $form->field($model, 'free_post')->textInput() ?>

    <?= $form->field($model, 'charge_rule')->textInput() ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
