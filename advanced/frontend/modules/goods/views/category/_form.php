<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use frontend\components\UploadImg;
use yii\helpers\ArrayHelper;

use app\models\Category;

$categories = ArrayHelper::map(Category::find()->where(['pid'=>0])->all(),'id','name');
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
        <?= $form->field($model, 'sort')->textInput(['placeholder' => 0]) ?>
        <div class="form-group flex"></div>
    </div>


    <div class="form-groups flex">
        <?= $form->field($model, 'pid')->widget(Select2::classname(), [
                'data' => $categories,
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        <div class="form-group flex"></div>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, '_img')->widget(FileInput::classname(),UploadImg::getFileInput($model->img))->hint('(尺寸100*80, <= 1M)')?>
    </div>

    <p class="space"></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>['width'=>'100%']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
