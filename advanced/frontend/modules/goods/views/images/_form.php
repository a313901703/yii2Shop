<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\file\FileInput;
use frontend\components\UploadImg;


?>

<?php $form = ActiveForm::begin([
    'options'=>['class'=>' active-form','enctype' => 'multipart/form-data'],
    'fieldConfig'=>[
        'template'=> "<div class=\"form-group flex\">{label}{input}{hint}</div>\n{error}",
    ]
]); ?>

<div class="form-groups flex">
    <?= $form->field($model, '_thumb')->widget(FileInput::classname(),UploadImg::getFileInput($model->thumb))->hint('(建议尺寸160*120,且小于1M)')?>
</div>

<div class="form-groups flex">
    <?= $form->field($model, '_carousels[]')->widget(FileInput::classname(),UploadImg::getFileInput($model->_carousels,['multiple' => true],[
            'previewSettings' => ['image'=>['width'=>'400px','height'=>'100px']],
            'maxFileCount' => 5
        ]))->hint('(建议尺寸600*150,图片小于1M,不多于5张)')?>
</div>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>['width'=>'100%']]) ?>  
</div>
<?php ActiveForm::end(); ?>