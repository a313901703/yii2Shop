<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\assets\AppAsset;

use kartik\file\FileInput;
use frontend\components\UploadImg;

/* @var $this yii\web\View */
/* @var $model app\models\props */
/* @var $form yii\widgets\ActiveForm */

?>
<style type="text/css">
   /* .search-form{
        background: none;
    }*/
   /* .items{
        background-color: #eee;
        margin-bottom: 10px;
    }
    .active-form .form-groups > .form-group{
        margin: 0 10px;
    }
    .file-thumbnail-footer{
        display: none;
    }
    .file-preview-frame{
        height:110px;
    }*/
    .active-form{
        background-color: #eee;
    }
</style>
<div >
    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form','enctype' => 'multipart/form-data'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group flex\">{label}{input}{hint}</div>\n{error}",
        ]
    ]); ?>
    <div class="form-groups flex">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
    </div>
    <div class="form-groups flex">
        <?= $form->field($model, 'sort')?>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
    </div>
    <div class="form-groups flex">
        <?= $form->field($model, 'thumb')->widget(FileInput::classname(),UploadImg::getFileInput($model->thumb))?>
        <div class="form-group flex"></div>
    </div>
        
    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
    
