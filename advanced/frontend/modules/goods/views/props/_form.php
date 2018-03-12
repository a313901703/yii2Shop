<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\props */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
$this->registerJs(
    '$("document").ready(function(){ 
        var container = $("#propses");//容器
        $("#new_props").on("pjax:end", function() {
            $.pjax.reload({container:"#propses",timeout: 5000});  //Reload GridView
        });
    });'
);
?>
<div >
    <?php yii\widgets\Pjax::begin(['id' => 'new_props']) ?>
    <?php $form = ActiveForm::begin([
        'options'=>['class'=>'search-form','data-pjax' => true],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group\">{label}{input}</div>\n{error}",
        ]
    ]); ?>

    <div class="form-inline-group">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort')->textInput(['placeholder' => 0])?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>
</div>
