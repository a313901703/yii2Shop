<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

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
            <?= Html::activeLabel($model, 'good_no', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'good_no', ['class' => 'form-flex3 form-control']) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($model, 'good_cate', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'good_cate',['class' => 'form-flex3 form-control']) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($model, 'good_brand', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'good_brand',['class' => 'form-flex3 form-control']) ?>
        </div>
        
    </div>
    <div class="form-inline-group">
        <div class="form-group">
            <?= Html::activeLabel($model, 'recommend', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'recommend',['class' => 'form-flex3 form-control']) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($model, 'show', ['class' => 'form-label']) ?>
            <?= Html::activeInput('text', $model, 'show',['class' => 'form-flex3 form-control']) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group btn-group">
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('查找', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
