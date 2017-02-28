<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\Category;
use app\models\Brand;
$categories = ArrayHelper::map(Category::getSubTree(true),'id','name');
$brands = ArrayHelper::map(Brand::find()->where(['status'=>0])->all(),'id','name');

/* @var $this yii\web\View */
/* @var $model app\models\search\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>'active-form search-form'],
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [  //统一修改字段的模板
            'template' => "<div class=\"form-group flex\">{label}{input}</div>", 
            'labelOptions' => ['class' => 'form-label'],  //修改label的样式
        ]
    ]); ?>

    <div class="form-groups flex">

    <!-- <div class="form-inline-group"> -->
        <?= $form->field($model, 'name')->textInput(['class'=>'form-flex3 form-control']) ?>

        <?= $form->field($model, 'good_no')->textInput(['class'=>'form-flex3 form-control']) ?>
        
        <?= $form->field($model, 'good_cate')->widget(Select2::classname(), [
                'data' => $categories,
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>

        <?= $form->field($model, 'good_brand')->widget(Select2::classname(), [
                'data' => $brands,
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
    </div>

    <div class="form-groups flex">

    <!-- <div class="form-inline-group"> -->
        <?= $form->field($model, 'recommend')->widget(Select2::classname(), [
                'data' => [0=>'不推荐','1'=>'首页推荐'],
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>  

        <?= $form->field($model, 'show')->widget(Select2::classname(), [
                'data' =>[0=>'上架','1'=>'不上架'],
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
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
