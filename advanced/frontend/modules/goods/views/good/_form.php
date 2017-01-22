<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
$labelClass = '';
$inputClass = 'form-control';
?>

<div class="table-content">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form','enctype' => 'multipart/form-data'],
    ]); ?>
    
    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'name') ?>
            <?= Html::activeInput('text', $model, 'name', ['class' => 'form-control required']) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'short_name') ?>
            <?= Html::activeInput('text', $model, 'short_name', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'keyword') ?>
            <?= Html::activeInput('text', $model, 'keyword', ['class' => $inputClass]) ?>
        </div>
    </div>
    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'seo_title') ?>
            <?= Html::activeInput('text', $model, 'seo_title', ['class' => $inputClass,'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"用于seo优化"]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'seo_keyword') ?>
            <?= Html::activeInput('text', $model, 'seo_keyword', ['class' => $inputClass,'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"用于seo优化"]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'seo_content') ?>
            <?= Html::activeTextarea($model, 'seo_content', ['class' => $inputClass,'row'=>6,'style'=>['resize'=>'none'],'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"用于seo优化"]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'good_no') ?>
            <?= Html::activeInput('text', $model, 'good_no', ['class' => $inputClass,'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"商品货号,不填写则由系统随机生成"]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'weight') ?>
            <?= Html::activeInput('text', $model, 'weight', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'good_cate') ?>
            <?= Html::activeInput('text', $model, 'good_cate', ['class' => $inputClass]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'good_brand') ?>
            <?= Html::activeInput('text', $model, 'good_brand', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'recommend') ?>
            <?= Html::activeInput('text', $model, 'recommend', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'show') ?>
            <?= Html::activeInput('text', $model, 'show', ['class' => $inputClass]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'freight') ?>
            <?= Html::activeInput('text', $model, 'freight', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'market_price') ?>
            <?= Html::activeInput('text', $model, 'market_price', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'sale_price') ?>
            <?= Html::activeInput('text', $model, 'sale_price', ['class' => $inputClass]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'cost') ?>
            <?= Html::activeInput('text', $model, 'cost', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'stock') ?>
            <?= Html::activeInput('text', $model, 'stock', ['class' => $inputClass]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'alert') ?>
            <?= Html::activeInput('text', $model, 'alert', ['class' => $inputClass,'placeholder'=>0,'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"库存不足警告"]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'sort') ?>
            <?= Html::activeInput('text', $model, 'sort', ['class' => $inputClass,'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"数字越大，排序越靠前"]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'integral') ?>
            <?= Html::activeInput('text', $model, 'integral', ['class' => $inputClass,'placeholder'=>0]) ?>
        </div>
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'virtual_nums') ?>
            <?= Html::activeInput('text', $model, 'virtual_nums', ['class' => $inputClass,'placeholder'=>0,'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"虚拟购买数量"]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'volume') ?>
            <?= Html::activeInput('text', $model, 'volume', ['class' => $inputClass,'readonly'=>true,'placeholder'=>0]) ?>
        </div>
        <div class="form-group flex"></div>
        <div class="form-group flex"></div>
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'good_note') ?>
            <?= Html::activeTextarea($model, 'good_note', ['class' => $inputClass,'style'=>['height'=>'150px','resize'=>'none']]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <?= Html::activeLabel($model, 'good_desc',['style'=>['width'=>'90px']]) ?>
        <div class="form-group ">
            <?= \yii\redactor\widgets\Redactor::widget([
                'model' => $model, 
                'attribute' => 'good_desc',
                'clientOptions'=>['lang' => 'zh_cn','minHeight'=>150,'plugins' => ['clips', 'fontcolor','imagemanager']],
                ]
            ) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <?= Html::activeLabel($model, 'good_detail',['style'=>['width'=>'90px']]) ?>
        <div class="form-group ">
            <?= \yii\redactor\widgets\Redactor::widget([
                'model' => $model, 
                'attribute' => 'good_detail',
                'clientOptions'=>['lang' => 'zh_cn','minHeight'=>150,'plugins' => ['clips', 'fontcolor','imagemanager']],
                ]
            ) ?>
        </div>
    </div>

    <p class="space"></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>['width'=>'100%']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
