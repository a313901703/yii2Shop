<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\components\SubTree;

use app\models\Category;
use app\models\Brand;
use app\models\FreightTemp;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
$inputClass = 'form-control';
$categories = Category::getSubTree1();
$brands = ArrayHelper::map(Brand::find()->where(['status'=>0])->all(),'id','name');
$freights = ArrayHelper::map(FreightTemp::find()->select('id,name')->all(),'id','name');
$model->market_price = $model->market_price / 100;
$model->sale_price = $model->sale_price / 100;
$model->cost = $model->cost / 100;
?>

<div class="table-content">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form','enctype' => 'multipart/form-data'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group flex\">{label}{input}</div>\n{error}",
        ]
    ]); ?>
    
    <div class="form-groups flex">
        <?= $form->field($model, 'name') ?>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'short_name') ?>
        <?= $form->field($model, 'keyword') ?>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'seo_title')->textInput(['data-toggle' => 'tooltip','data-placement'=>'top','title'=>'用于seo优化']) ?>
        <?= $form->field($model, 'seo_keyword')->textInput(['data-toggle' => 'tooltip','data-placement'=>'top','title'=>'用于seo优化']) ?> 
    </div>

    <div class="form-groups flex">
        <div class="form-group flex">
            <?= Html::activeLabel($model, 'seo_content') ?>
            <?= Html::activeTextarea($model, 'seo_content', ['class' => $inputClass,'row'=>6,'style'=>['resize'=>'none'],'data-toggle'=>"tooltip",'data-placement'=>"top",'title'=>"用于seo优化"]) ?>
        </div>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'good_cate')->widget(Select2::classname(), [
                'data' => $categories,
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        <?= $form->field($model, 'good_no')->textInput(['data-toggle' => 'tooltip','data-placement'=>'top','title'=>'商品货号,不填写则由系统随机生成']) ?>
        <?= $form->field($model, 'weight') ?>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'good_brand')->widget(Select2::classname(), [
                'data' => $brands,
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
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
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'freight')->widget(Select2::classname(), [
                'data' => $freights,
                'options' => ['placeholder' => '请选择'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'sale_price') ?>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'cost')?>
        <?= $form->field($model, 'stock') ?>
        <?= $form->field($model, 'alert')->textInput(['placeholder'=>0,'data-toggle' => 'tooltip','data-placement'=>'top','title'=>'库存不足警告']) ?>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'sort')->textInput(['placeholder'=>0,'data-toggle' => 'tooltip','data-placement'=>'top','title'=>'数字越大，排序越靠前'])?>
        <?= $form->field($model, 'integral')->textInput(['placeholder'=>0,'data-toggle' => 'tooltip','data-placement'=>'top','title'=>'赠送积分']) ?>
        <?= $form->field($model, 'virtual_nums')->textInput(['placeholder'=>0,'data-toggle' => 'tooltip','data-placement'=>'top','title'=>'虚拟购买数量']) ?>
    </div>

    <div class="form-groups flex">
        <?= $form->field($model, 'volume')->textInput(['placeholder'=>0,'readonly'=>true])?>
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
