<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\props */
/* @var $form yii\widgets\ActiveForm */
?>

<div >
    <?php $form = ActiveForm::begin([
        'options'=>['class'=>'search-form'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group\">{label}{input}</div>\n{error}",
        ]
    ]); ?>

    <div class="form-inline-group">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort')?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
