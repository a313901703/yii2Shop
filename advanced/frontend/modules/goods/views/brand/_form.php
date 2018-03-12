<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

use frontend\components\UploadImg;


/* @var $this yii\web\View */
/* @var $model app\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form','enctype' => 'multipart/form-data'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group flex\">{label}{input}{hint}</div>\n{error}",
        ]
    ]); ?>

    <div class="form-groups flex">
        <?= $form->field($model, 'name') ?>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'sort')->textInput(['maxlength' => 255,'placeholder'=>'0'])->hint('(数字越大排序越靠前)') ?>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
    </div>
        
    
    <div class="form-groups flex">
        <?= $form->field($model, 'thumb',['enableClientValidation' => $model->isNewRecord])->widget(FileInput::classname(), UploadImg::getFileInput($model->thumb));?>
    </div>

     <p class="space"></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>['width'=>'100%']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
