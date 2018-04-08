<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
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
        <?= $form->field($model, 'status')->widget(Select2::classname(), [
                'data' =>[
                    0=>'未支付',
                    1=>'待发货',
                    2=>'已发货',
                    3=>'待确认',
                    4=>'已确认',
                    5=>'退货',
                    '-1'=>['value'=>'删除','status'=>'danger'],
                ],
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('状态');
        ?>

        <?php
            echo $form->field($model, 'created_at')->widget(DateRangePicker::classname(), [
                'startAttribute' => 'start',
                'endAttribute' => 'end',
            ]);
         ?>
    
        <div class="form-group flex"></div>
    </div>

    <div class="form-group btn-group">
        <?= Html::submitButton('查找', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
