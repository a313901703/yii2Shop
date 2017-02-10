<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\assets\AppAsset;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '属性列表';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="flex">
    <?= $this->render('@goods/views/nav.php', ['id'=>1])?>
    <div style="flex:1">
        <div class="category-index">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <div class="space"></div>
            <?= GridView::widget([
                'dataProvider' => $provider,
                'options'=>['class'=>'list-table'],
                'layout'=>"{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
                    'name',
                    [
                        'label' => '属性值',
                        'value' => function ($model) {
                            return '黑色，白色，红色，蓝色';
                        }
                    ],
                    'sort',
                    [
                        //动作列yii\grid\ActionColumn 
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作', 
                        'template' => '{addvalue} &nbsp;{update} &nbsp;{delete}',//只需要展示删除和更新
                        'headerOptions' => ['width' => '300'],
                        'buttons' => [
                            'addvalue' => function($url, $model, $key){
                                return Html::a('<i class="fa fa-list"></i> 属性值',['create', 'pid' => $key], ['class' => 'btn btn-success btn-sm']);
                            },
                            'update' => function($url, $model, $key){
                                return Html::a('<i class="fa fa-pencil"></i> 修改','#', 
                                    ['class' => 'btn btn-primary btn-sm modalBtn','data-toggle'=>Url::to(['props/update','id'=>$key]),'data-title'=>$model->name]);
                            },
                            'delete' => function($url, $model, $key){
                                return Html::a('<i class="fa fa-trash-o"></i> 删除',['delete', 'id' => $key], 
                                    ['class' => 'btn btn-danger btn-sm','data' => ['confirm' => '你确定要删除吗？','method' => 'post']]);
                            },
                       ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>





