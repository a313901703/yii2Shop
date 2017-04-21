<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;

use app\models\China;
use app\models\Region;

/* @var $this yii\web\View */
/* @var $model app\models\FreightTemp */
/* @var $form yii\widgets\ActiveForm */
$locations = Region::find()->where(['parent_id'=>1])->andWhere(['!=','id',1])->with('child')->asArray()->all();
$regionChecked = $model->region ? explode(',', $model->region) : [];
AppAsset::addScript($this,Yii::$app->request->baseUrl."/js/app/freight_form.js");

?>
<style type="text/css">
    .areaBox{
        padding: 10px;
        border:1px solid #ddd;
        height:200px;
        overflow-y: scroll;
    }
    .province-item{
        display: block;
    } 
    .province-item.active{
        background-color: #eee;
    }
   
</style>

<div class="freight-temp-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>' active-form'],
        'fieldConfig'=>[
            'template'=> "<div class=\"form-group flex\">{label}{input}</div>\n{error}",
        ]
    ]); ?>
    
    <div class="form-groups">
        <?= $form->field($model, 'name') ?>
    </div>

    <div class="form-groups">
        <?= $form->field($model, 'whether_post')->radioList([0=>'买家承担运费',1=>'卖家承担运费']) ?>
    </div>
    
    <hr>

    <div class="whether_post_box <?= $model->whether_post ? 'hidden' : ''?>" id="free_post_box"" >
        <div class="form-groups">
            <?= $form->field($model, 'charge_rule')->radioList([1=>'按件数',2=>'按重量']) ?>
        </div>
        
        <div class="form-groups">
            <div class="form-group">
                <label>邮费</label>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>配送区域</th>
                            <th>首件（<span class="charge_rule_units">件</span>）</th>
                            <th>收费（元）</th>
                            <th>需件（<span class="charge_rule_units">件</span>）</th>
                            <th>续费（元）</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="400">
                                <span id="locations"><?=$model->region_name;?></span>&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">编辑配送区域</a>
                            </td>
                            <td><?= Html::activeInput('text', $model, 'base_num', ['class' =>'form-control']) ?></td>
                            <td><?= Html::activeInput('text', $model, 'base_freight', ['class' =>'form-control']) ?></td>
                            <td><?= Html::activeInput('text', $model, 'renew_num', ['class' =>'form-control']) ?></td>
                            <td><?= Html::activeInput('text', $model, 'renew', ['class' =>'form-control']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        
        <div class="form-groups">
            <?= $form->field($model, 'free_post')->radioList([0=>'不选择',1=>'按件数',2=>'按金额']) ?>
        </div>
        
        <div class="form-groups <?= $model->free_post ? '' : 'hidden'?>" id="free_post_box">
            <div class="form-group">
                <div class="form-group flex">
                    <label></label>
                    <?= Html::activeInput('text', $model, 'free_post_value', ['class' =>'form-control','style' => 'width:100px;display:inline-block']) ?>
                    <span class="free_post_units">件</span>(包邮)
                </div>
            </div>
        </div>

        <?= Html::activeInput('text', $model, 'region', ['class' =>'hidden']) ?>
        <?= Html::activeInput('text', $model, 'region_name', ['class' =>'hidden']) ?>
    </div>
        

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Modal --> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">配送区域选择</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-2">
                        <div class="col-sm-6 areaBox" id="provinces">
                            <?php foreach ($locations as $key => $location): ?>
                               <span class='province-item' data-id="<?=$location['id'] ?>"><?=$location['name']?></span> 
                            <?php endforeach ?>
                        </div>
                        <div class="col-sm-6 areaBox" id="cities">
                            <?php foreach ($locations as  $location): ?>
                                <div class="city-box hidden" id="city-box-<?= $location['id']?>">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="region-all" data-id='<?=$location['id']?>' >全部
                                        </label>
                                    </div>
                                <?php foreach ($location['child'] as  $city): ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="region" data-name='<?= $city['name']?>' value="<?=$city['id']?>" 
                                                <?= in_array($city['id'],$regionChecked) ? 'checked' : '' ?>> <?= $city['name']?>
                                        </label>
                                    </div>
                                <?php endforeach ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-btn">确定</button>
            </div>
        </div>
    </div>
</div>
