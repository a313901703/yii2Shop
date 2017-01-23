<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group flex\">{label}{input}{hint}</div>\n{error}",
        ]
    ]); ?>

    <div class="form-groups flex">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort') ?>
        <div class="form-group flex"></div>
    </div>


    <div class="form-groups flex">
        <?= $form->field($model, 'pid')->widget(Select2::classname(), [
                'data' => [],
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
    </div>

    <p class="space"></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>['width'=>'100%']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
